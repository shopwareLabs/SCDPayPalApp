<?php

namespace Swag\PayPalApp\Api\Gateway;

use Swag\PayPalApp\Api\Client\ApiContext;
use Swag\PayPalApp\Api\Struct\V2\Order;
use Swag\PayPalApp\Api\Struct\V2\PatchCollection;

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

    public function getOrder(string $orderId, ApiContext $context): Order
    {
        return $this->request(
            'GET',
            self::GATEWAY_URL . '/' . $orderId,
            null,
            Order::class,
            $context
        );
    }

    public function authorizeOrder(string $orderId, ApiContext $context): Order
    {
        return $this->request(
            'POST',
            self::GATEWAY_URL . '/' . $orderId . '/authorize',
            null,
            Order::class,
            $context
        );
    }

    public function captureOrder(string $orderId, ApiContext $context): Order
    {
        return $this->request(
            'POST',
            self::GATEWAY_URL . '/' . $orderId . '/capture',
            null,
            Order::class,
            $context
        );
    }

    public function patchOrder(string $orderId, PatchCollection $patches, ApiContext $context): void
    {
        $this->request(
            'PATCH',
            self::GATEWAY_URL . '/' . $orderId,
            $patches,
            null,
            $context
        );
    }
}