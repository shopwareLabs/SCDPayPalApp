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
use Swag\PayPalApp\Service\OrderExecuteService;
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
        private readonly ResponseSigner $responseSigner,
        private readonly OrderExecuteService $orderExecuteService,
    ) {
    }

    #[Route('/pay', name: 'payment.paypal.pay', methods: ['POST'])]
    public function pay(PaymentPayAction $payAction, ShopInterface $shop): ResponseInterface
    {
        $order = $this->orderBuilder->getOrder($payAction, new ParameterBag($payAction->requestData));

        $apiContext = new ApiContext($payAction->order->getSalesChannelId(), $shop, preferRepresentation: true);
        $order = $this->orderGateway->createOrder($order, $apiContext);

        $response = PaymentResponse::redirect($order->getLinks()->getRelation(Link::RELATION_PAYER_ACTION)->getHref());

        return $this->responseSigner->signResponse($response, $shop);
    }

    #[Route('/finalize', name: 'payment.paypal.finalize', methods: ['POST'])]
    public function finalize(PaymentFinalizeAction $finalizeAction, ShopInterface $shop): ResponseInterface
    {
        if ($finalizeAction->queryParameters['cancel'] ?? null) {
            return $this->responseSigner->signResponse(PaymentResponse::cancelled('Customer cancelled'), $shop);
        }

        $orderId = $finalizeAction->queryParameters['token'];
        $salesChannelId = $finalizeAction->orderTransaction->getOrder()->getSalesChannelId();

        $apiContext = new ApiContext($salesChannelId, $shop, preferRepresentation: true);
        $order = $this->orderGateway->getOrder($orderId, $apiContext);
        $status = $this->orderExecuteService->captureOrAuthorizeOrder($order, $apiContext);

        return $this->responseSigner->signResponse(PaymentResponse::createStatusResponse($status), $shop);
    }
}
