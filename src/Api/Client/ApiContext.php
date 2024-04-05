<?php

namespace Swag\PayPalApp\Api\Client;

use Shopware\App\SDK\Shop\ShopInterface;

class ApiContext
{
    public const DEFAULT_PARTNER_ATTRIBUTION_ID = 'shopwareAG_Cart_Shopware6_PPCP';

    public function __construct(
        private readonly ?string $salesChannelId,
        private readonly ShopInterface $shop,
        private readonly string $partnerAttributionId = self::DEFAULT_PARTNER_ATTRIBUTION_ID,
        private readonly ?string $requestId = null,
        private readonly ?string $clientMetadataId = null,
        private readonly bool $preferRepresentation = false,
    )
    {
    }

    public function getSalesChannelId(): ?string
    {
        return $this->salesChannelId;
    }

    public function getShop(): ShopInterface
    {
        return $this->shop;
    }

    public function getPartnerAttributionId(): string
    {
        return $this->partnerAttributionId;
    }

    public function getRequestId(): ?string
    {
        return $this->requestId;
    }

    public function getClientMetadataId(): ?string
    {
        return $this->clientMetadataId;
    }

    public function isPreferRepresentation(): bool
    {
        return $this->preferRepresentation;
    }

    public function withRequestParams(
        ?string $partnerAttributionId = null,
        ?string $requestId = null,
        ?string $clientMetadataId = null,
        bool $preferRepresentation = false
    ): self
    {
        return new self(
            $this->salesChannelId,
            $this->shop,
            $partnerAttributionId,
            $requestId,
            $clientMetadataId,
            $preferRepresentation
        );
    }

    public function toHeaders(): array
    {
        $headers = [
            'PayPal-Partner-Attribution-Id' => $this->partnerAttributionId,
        ];
        if ($this->preferRepresentation) {
            $headers['Prefer'] = 'return=representation';
        }
        if ($this->clientMetadataId !== null) {
            $headers['PayPal-Client-Metadata-Id'] = $this->clientMetadataId;
        }
        if ($this->requestId !== null) {
            $headers['PayPal-Request-Id'] = $this->requestId;
        }

        return $headers;
    }
}