<?php

declare(strict_types=1);

namespace Swag\PayPalApp\Controller\Storefront;

use Shopware\App\SDK\Context\Cart\Cart;
use Shopware\App\SDK\Context\SalesChannelContext\SalesChannelContext;
use Shopware\App\SDK\Context\Storefront\StorefrontAction;
use Swag\PayPalApp\Api\Client\ApiContext;
use Swag\PayPalApp\Api\Converter\PayPalOrderBuilder;
use Swag\PayPalApp\Api\Gateway\OrderGateway;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/storefront/order')]
class OrderController
{
    public function __construct(
        private readonly PayPalOrderBuilder $orderBuilder,
        private readonly OrderGateway $orderGateway,
    ) {
    }

    #[Route('/', name: 'storefront.order.create', methods: ['POST'])]
    public function pay(StorefrontAction $action, Request $request): Response
    {
        $body = \json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $cart = new Cart($body['cart']);
        $salesChannelContext = new SalesChannelContext($body['salesChannelContext']);
        $formData = new ParameterBag($body['formData'] ?? []);

        $order = $this->orderBuilder->getOrderFromCart($cart, $salesChannelContext, $formData);

        $apiContext = new ApiContext($action->claims->getSalesChannelId(), $action->shop, preferRepresentation: true);
        $order = $this->orderGateway->createOrder($order, $apiContext);

        return new JsonResponse([
            'orderId' => $order->getId(),
        ]);
    }
}
