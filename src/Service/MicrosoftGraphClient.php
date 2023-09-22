<?php

namespace Logy\Bundle\MicrosoftBundle\Service;

use Logy\Bundle\MicrosoftBundle\Model\Token;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MicrosoftGraphClient
{
    private HttpClientInterface $microsoftGraphClient;

    public function __construct(HttpClientInterface $microsoftGraphClient)
    {
        $this->microsoftGraphClient = $microsoftGraphClient;
    }

    public function Request(Token $token, string $method, string $endpoint, ?array $data = null)
    {
        $response = $this->microsoftGraphClient->request($method, $endpoint, array(
            'headers' => array(
                'Authorization' => $token->getTokenType() . " " . $token->getAccessToken(),
            ),
            'json' => $data
        ));
        if($response->getStatusCode() === 401) throw new \Exception("Unauthorized", 401);
        return $response;
    }
}
