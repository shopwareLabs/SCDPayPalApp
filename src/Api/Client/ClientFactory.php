<?php

namespace Swag\PayPalApp\Api\Client;

use Shopware\App\SDK\Shop\ShopInterface;
use Swag\PayPalApp\Api\Constants;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\HttpOptions;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ClientFactory
{
    public function __construct(
        private AuthenticationBuilder $authenticationBuilder,
        private HttpClient $clientFactory
    )
    {
    }

    public function createFirstPartyClient(ApiContext $context): HttpClientInterface
    {
        $shopConfig = $this->getShopConfig($context);

        return $this->clientFactory->create($this->getDefaultHttpOptions($shopConfig)->toArray());
    }

    public function createThirdPartyClient(ApiContext $context): HttpClientInterface
    {
        $shopConfig = $this->getShopConfig($context);
        $httpOptions = $this->getDefaultHttpOptions($shopConfig);
        $httpOptions->setHeaders([
            'PayPal-Auth-Assertion' => $this->authenticationBuilder->getAuthAssertion($shopConfig->isSandbox(), $shopConfig->getMerchantId()),
            ...$context->toHeaders()
        ]);

        return $this->clientFactory->create($httpOptions->toArray());
    }


    private function getDefaultHttpOptions(CredentialsIdentifier $shopConfig): HttpOptions
    {
        $httpOptions = new HttpOptions();
        $httpOptions->setAuthBearer($this->authenticationBuilder->getAccessToken($shopConfig->isSandbox()));
        $httpOptions->setBaseUri($shopConfig->isSandbox() ? Constants::BASEURL_SANDBOX : Constants::BASEURL_LIVE);
        $httpOptions->setHeaders([
            'PayPal-Partner-Attribution-Id' => Constants::PARTNER_ATTRIBUTION_ID,
        ]);

        return $httpOptions;
    }

    private function getShopConfig(ApiContext $context): CredentialsIdentifier
    {
        // TODO: build a repository to do this

        return new CredentialsIdentifier('dummy', true);
    }
}