<?php

namespace Logy\Bundle\MicrosoftBundle\Service;

use JsonException;
use Logy\Bundle\MicrosoftBundle\Event\MicrosoftEvent;
use Logy\Bundle\MicrosoftBundle\MicrosoftEvents;
use Logy\Bundle\MicrosoftBundle\Model\Microsoft\Email\EmailRequest;
use Logy\Bundle\MicrosoftBundle\Model\Token;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Routing\RouterInterface;

class MicrosoftService implements MicrosoftServiceInterface
{
    const VERSION = "v2.0";
    protected LoggerInterface $logger;
    protected RouterInterface $router;
    protected EventDispatcherInterface $dispatcher;
    protected HttpClientInterface $httpClient;
    protected DataSerializerInterface $serializer;
    protected MicrosoftGraphClient $graphClient;

    protected string $server;
    protected string $tenant;
    protected string $client;
    protected string $secret;

    public function __construct(
        LoggerInterface $logger,
        RouterInterface $router,
        EventDispatcherInterface $dispatcher,
        HttpClientInterface $httpClient,
        DataSerializerInterface $serializer,
        MicrosoftGraphClient $graphClient,
        string $server,
        string $tenant,
        string $client,
        string $secret
    ) {
        $this->logger = $logger;
        $this->router = $router;
        $this->dispatcher = $dispatcher;
        $this->httpClient = $httpClient;
        $this->serializer = $serializer;
        $this->graphClient = $graphClient;
        $this->server = $server;
        $this->tenant = $tenant;
        $this->client = $client;
        $this->secret = $secret;
    }
    //TODO: replace hardcoded urls
    public function createAuthRedirectResponse(string $scope, string $route, array $params, array $state): RedirectResponse
    {
        return new RedirectResponse(
            sprintf("https://login.microsoftonline.com/%s/oauth2/%s/authorize?%s", $this->tenant, self::VERSION, http_build_query(
                array(
                    'client_id' => $this->client,
                    'response_type' => "code",
                    'response_mode' => "query",
                    'redirect_uri' => $this->server . $this->router->generate($route, $params, RouterInterface::ABSOLUTE_PATH),
                    'state' => base64_encode(json_encode($state)),
                    'scope' => $scope,
                )
            ))
        );
    }

    public function requestTokenFromCode(string $code, string $route, array $params): Token
    {
        $response = $this->httpClient->request("POST", sprintf("https://login.microsoftonline.com/%s/oauth2/%s/token", $this->tenant, self::VERSION), array(
            'headers' => array(
                'Content-Type' => 'application/x-www-form-urlencoded; charset=utf-8'
            ),
            'body' => array(
                'client_id' => $this->client,
                'code' => $code,
                'redirect_uri' => $this->server . $this->router->generate($route, $params, RouterInterface::ABSOLUTE_PATH),
                'grant_type' => "authorization_code",
                'client_secret' => $this->secret,
            ),
        ));

        if ($response->getStatusCode() === 200) {
            return $this->serializer->deserialize($response->getContent(), Token::class);
        }

        throw new JsonException($response->getContent(), $response->getStatusCode());
    }

    public function refreshToken(Token $expiredToken): Token
    {
        $response = $this->httpClient->request("POST", sprintf("https://login.microsoftonline.com/%s/oauth2/%s/token", $this->tenant, self::VERSION), array(
            'headers' => array(
                'Content-Type' => 'application/x-www-form-urlencoded; charset=utf-8'
            ),
            'body' => array(
                'client_id' => $this->client,
                'client_secret' => $this->secret,
                'grant_type' => "refresh_token",
                'refresh_token' => $expiredToken->getRefreshToken(),
                'scope' => $expiredToken->getScope()
            ),
        ));
        $token = $this->serializer->deserialize($response->getContent(), Token::class);
        $this->logger->critical($token->getAccessToken());

        $this->dispatcher->dispatch(new MicrosoftEvent($token), MicrosoftEvents::TOKEN_REFRESH);
        return $token;
    }

    public function sendEmail(Token $token, EmailRequest $request, ?bool $retry = true)
    {
        try {
            $this->graphClient->Request($token, "POST", "me/sendMail", $request->toArray());
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            if (!$retry) throw $e;
            $this->sendEmail($this->refreshToken($token), $request, false);
        }
    }
}
