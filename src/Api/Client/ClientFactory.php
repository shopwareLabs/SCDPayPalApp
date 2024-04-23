<?php

namespace Swag\PayPalApp\Api\Client;

use Swag\PayPalApp\Api\Constants;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\HttpOptions;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ClientFactory
{
    public function __construct(
        private readonly AuthenticationBuilder $authenticationBuilder,
        #[Autowire(env: 'MERCHANT_ID')]
        private readonly string $merchantId,
        #[Autowire(env: 'SANDBOX')]
        private readonly bool $sandbox,
    )
    {
    }

    public function createFirstPartyClient(ApiContext $context): HttpClientInterface
    {
        $shopConfig = $this->getShopConfig($context);

        return HttpClient::create($this->getDefaultHttpOptions($shopConfig)->toArray());
    }

    public function createThirdPartyClient(ApiContext $context): HttpClientInterface
    {
        $shopConfig = $this->getShopConfig($context);
        $httpOptions = $this->getDefaultHttpOptions($shopConfig);
        $httpOptions->setHeaders([
            'PayPal-Auth-Assertion' => $this->authenticationBuilder->getAuthAssertion($shopConfig->isSandbox(), $shopConfig->getMerchantId()),
            ...$context->toHeaders()
        ]);

        return HttpClient::create($httpOptions->toArray());
    }


    private function getDefaultHttpOptions(CredentialsIdentifier $shopConfig): HttpOptions
    {
        $httpOptions = new HttpOptions();
        $httpOptions->setAuthBearer($this->authenticationBuilder->getAccessToken($shopConfig->isSandbox()));
        $httpOptions->setBaseUri($shopConfig->isSandbox() ? Constants::BASEURL_SANDBOX : Constants::BASEURL_LIVE);

        return $httpOptions;
    }

    private function getShopConfig(ApiContext $context): CredentialsIdentifier
    {
        // TODO: build a repository to do this

        return new CredentialsIdentifier($this->merchantId, $this->sandbox);
    }
}