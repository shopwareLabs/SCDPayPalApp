<?php

namespace Swag\PayPalApp\Api\Client;

use Swag\PayPalApp\Api\Constants;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\HttpOptions;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AuthenticationClientFactory
{

    public function __construct(
        #[Autowire(env: 'CLIENT_ID')]
        private string $clientId,
        #[Autowire(env: 'CLIENT_SECRET')]
        private string $clientSecret,
        #[Autowire(env: 'CLIENT_ID_SANDBOX')]
        private string $clientIdSandbox,
        #[Autowire(env: 'CLIENT_SECRET_SANDBOX')]
        private string $clientSecretSandbox,
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

        return HttpClient::create($clientOptions->toArray());
    }
}