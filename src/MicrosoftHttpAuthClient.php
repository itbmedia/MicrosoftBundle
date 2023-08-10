<?php
namespace Logy\Bundle\MicrosoftBundle;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\ScopingHttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class MicrosoftHttpAuthClient extends ScopingHttpClient
{
    protected HttpClientInterface $client;

    static function build(string $tenant, string $version, array $defaultOptions = [], int $maxHostConnections = 6, int $maxPendingPushes = 50): self
    {
        return new static(HttpClient::createForBaseUri(sprintf("https://login.microsoftonline.com/%s/oauth2/%s/", $tenant, $version), $defaultOptions, $maxHostConnections, $maxPendingPushes), $defaultOptions = []);
    }

    public function __construct(HttpClientInterface $client, array $defaultOptions) {
        parent::__construct($client, $defaultOptions);
    }

    public function requestTokenFromCode(string $client, string $secret, string $code, string $redirectUrl): ResponseInterface
    {
        return $this->request("POST", "token", array(
            'headers' => array(
                'Content-Type' => 'application/x-www-form-urlencoded; charset=utf-8'
            ),
            'body' => array(
                'client_id' => $client,
                'code' => $code,
                'redirect_uri' => $redirectUrl,
                'grant_type' => "authorization_code",
                'client_secret' => $secret,
            ),
        ));
    }
}