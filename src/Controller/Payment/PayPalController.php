<?php

declare(strict_types=1);

namespace Swag\PayPalApp\Controller\Payment;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Shopware\App\SDK\AppLifecycle;
use Shopware\App\SDK\Authentication\ResponseSigner;
use Shopware\App\SDK\Context\Payment\PaymentFinalizeAction;
use Shopware\App\SDK\Context\Payment\PaymentPayAction;
use Shopware\App\SDK\Response\PaymentResponse;
use Shopware\App\SDK\Shop\ShopInterface;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\RouterInterface;

#[AsController]
#[Route('/payment/paypal')]
class PayPalController
{
    public function __construct(
        private readonly ResponseSigner $responseSigner
    ) {
    }

    #[Route('/pay', name: 'payment.paypal.pay', methods: ['POST'])]
    public function pay(PaymentPayAction $payAction, ShopInterface $shop): ResponseInterface
    {
        $response = PaymentResponse::redirect($payAction->returnUrl ?? '');

        return $this->responseSigner->signResponse($response, $shop);
    }

    #[Route('/finalize', name: 'payment.paypal.finalize', methods: ['POST'])]
    public function finalize(PaymentFinalizeAction $finalizeAction, ShopInterface $shop): ResponseInterface
    {
        $response = PaymentResponse::paid();

        return $this->responseSigner->signResponse($response, $shop);
    }
}
