<?php

declare(strict_types=1);

namespace Swag\PayPalApp\Controller\Payment;

use Psr\Http\Message\ResponseInterface;
use Shopware\App\SDK\Authentication\ResponseSigner;
use Shopware\App\SDK\Context\Payment\PaymentFinalizeAction;
use Shopware\App\SDK\Context\Payment\PaymentPayAction;
use Shopware\App\SDK\Response\PaymentResponse;
use Shopware\App\SDK\Shop\ShopInterface;
use Swag\PayPalApp\Api\Client\ApiContext;
use Swag\PayPalApp\Api\Converter\PayPalOrderBuilder;
use Swag\PayPalApp\Api\Gateway\OrderGateway;
use Swag\PayPalApp\Api\Struct\V2\Common\Link;
use Swag\PayPalApp\Api\Struct\V2\PatchCollection;
use Swag\PayPalApp\Service\OrderExecuteService;
use Swag\PayPalApp\Service\PatchBuilder;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/payment/paypal')]
class PayPalController
{
    public function __construct(
        private readonly PayPalOrderBuilder $orderBuilder,
        private readonly OrderGateway $orderGateway,
        private readonly OrderExecuteService $orderExecuteService,
        private readonly PatchBuilder $patchBuilder,
    ) {
    }

    #[Route('/pay', name: 'payment.paypal.pay', methods: ['POST'])]
    public function pay(PaymentPayAction $payAction, ShopInterface $shop): ResponseInterface
    {
        $orderId = $payAction->requestData['paypalOrderId'] ?? null;
        if ($orderId) {
            $apiContext = new ApiContext($payAction->order->getSalesChannelId(), $shop, preferRepresentation: true);

            $patch = $this->patchBuilder->createPurchaseUnitPatch($payAction->order, $payAction->orderTransaction);
            $this->orderGateway->patchOrder($orderId, new PatchCollection([$patch]), $apiContext);

            return PaymentResponse::redirect($payAction->returnUrl . '&' . \http_build_query(['token' => $orderId]));
        }

        $order = $this->orderBuilder->getOrder($payAction, new ParameterBag($payAction->requestData));

        $apiContext = new ApiContext($payAction->order->getSalesChannelId(), $shop, preferRepresentation: true);
        $order = $this->orderGateway->createOrder($order, $apiContext);

        return PaymentResponse::redirect($order->getLinks()->getRelation(Link::RELATION_PAYER_ACTION)->getHref());
    }

    #[Route('/finalize', name: 'payment.paypal.finalize', methods: ['POST'])]
    public function finalize(PaymentFinalizeAction $finalizeAction, ShopInterface $shop): ResponseInterface
    {
        if ($finalizeAction->queryParameters['cancel'] ?? null) {
            return PaymentResponse::cancelled('Customer cancelled');
        }

        $orderId = $finalizeAction->queryParameters['token'];
        $salesChannelId = $finalizeAction->orderTransaction->getOrder()->getSalesChannelId();

        $apiContext = new ApiContext($salesChannelId, $shop, preferRepresentation: true);
        $order = $this->orderGateway->getOrder($orderId, $apiContext);
        $status = $this->orderExecuteService->captureOrAuthorizeOrder($order, $apiContext);

        return PaymentResponse::createStatusResponse($status);
    }
}
