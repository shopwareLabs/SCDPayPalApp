<?php

namespace Swag\PayPalApp\Api\Client;

use Swag\PayPalApp\Api\Constants;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\HttpOptions;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AuthenticationClientFactory
{

    public function __construct(
        private string $clientId,
        private string $clientSecret,
        private string $clientIdSandbox,
        private string $clientSecretSandbox,
        private HttpClient $clientFactory
    )
    {
    }

    public function createAuthenticationClient(bool $sandbox): HttpClientInterface
    {
        $clientId = $sandbox ? $this->clientIdSandbox : $this->clientId;
        $clientSecret = $sandbox ? $this->clientSecretSandbox : $this->clientSecret;

        $clientOptions = new HttpOptions();
        $clientOptions->setAuthBasic($clientId, $clientSecret);
        $clientOptions->setBaseUri($sandbox ? Constants::BASEURL_SANDBOX : Constants::BASEURL_LIVE);
        $clientOptions->setHeaders([
            'PayPal-Partner-Attribution-Id' => Constants::PARTNER_ATTRIBUTION_ID,
        ]);

        return $this->clientFactory->create($clientOptions->toArray());
    }
}