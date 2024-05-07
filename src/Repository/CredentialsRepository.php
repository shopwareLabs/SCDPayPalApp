<?php

namespace Swag\PayPalApp\Repository;

use Swag\PayPalApp\Api\Client\ApiContext;
use Swag\PayPalApp\Api\Client\AuthenticationClientFactory;
use Swag\PayPalApp\Api\Client\CredentialsIdentifier;
use Swag\PayPalApp\Api\Struct\V1\Token;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class CredentialsRepository
{

    public function __construct(
        #[Autowire(env: 'CLIENT_ID')]
        private string $clientId,
        #[Autowire(env: 'CLIENT_ID_SANDBOX')]
        private string $clientIdSandbox,
        #[Autowire(env: 'MERCHANT_ID')]
        private readonly string $merchantId,
        #[Autowire(env: 'SANDBOX')]
        private readonly bool $sandbox,
    ) {
    }

    public function getShopConfig(ApiContext $context): CredentialsIdentifier
    {
        // TODO: build a repository to do this
        // for now, we just return the hardcoded values from env

        return new CredentialsIdentifier($this->sandbox ? $this->clientIdSandbox : $this->clientId, $this->merchantId, $this->sandbox);
    }
}