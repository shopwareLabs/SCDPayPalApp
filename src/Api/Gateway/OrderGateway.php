<?php

namespace Swag\PayPalApp\Api\Gateway;

use Shopware\App\SDK\Shop\ShopInterface;
use Swag\PayPalApp\Api\Client\ApiContext;
use Swag\PayPalApp\Api\Client\AuthenticationBuilder;
use Swag\PayPalApp\Api\Client\ClientFactory;
use Swag\PayPalApp\Api\Client\CredentialsIdentifier;
use Swag\PayPalApp\Api\Constants;
use Swag\PayPalApp\Api\Struct\V2\Order;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\HttpOptions;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OrderGateway extends AbstractGateway
{
    private const GATEWAY_URL = 'v2/checkout/orders';

    public function createOrder(Order $order, ApiContext $context): Order
    {
        return $this->request(
            'POST',
            self::GATEWAY_URL,
            $order,
            Order::class,
            $context
        );
    }
}