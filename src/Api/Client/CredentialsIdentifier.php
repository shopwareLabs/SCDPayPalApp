<?php

namespace Swag\PayPalApp\Api\Client;

class CredentialsIdentifier
{
    public function __construct(
        private readonly string $clientId,
        private readonly ?string $merchantId,
        private readonly bool $sandbox,
    )
    {
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getMerchantId(): ?string
    {
        return $this->merchantId;
    }

    public function isSandbox(): bool
    {
        return $this->sandbox;
    }
}