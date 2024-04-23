<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Service;

use Shopware\App\SDK\Response\PaymentResponse;
use Swag\PayPalApp\Api\Client\ApiContext;
use Swag\PayPalApp\Api\Gateway\OrderGateway;
use Swag\PayPalApp\Api\Struct\V2\Order;
use Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit\Payments;
use Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit\Payments\Authorization;
use Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit\Payments\Capture;

class OrderExecuteService
{

    /**
     * @internal
     */
    public function __construct(
        private readonly OrderGateway $orderGateway,
    ) {
    }

    public function captureOrAuthorizeOrder(
        Order $paypalOrder,
        ApiContext $apiContext,
    ): string {
        $status = $this->getOrderStatus($paypalOrder, $apiContext, false);
        if ($status) {
            return $status;
        }

        if ($paypalOrder->getIntent() === Order::INTENT_CAPTURE) {
            $response = $this->orderGateway->captureOrder($paypalOrder->getId(), $apiContext);
        } else {
            $response = $this->orderGateway->authorizeOrder($paypalOrder->getId(), $apiContext);
        }

        return $this->getOrderStatus($response, $apiContext);
    }

    private function getOrderStatus(Order $order, ApiContext $context, bool $refetch = true): ?string
    {
        if ($order->getIntent() === Order::INTENT_CAPTURE) {
            $capture = $this->getPayments($order, $context, $refetch)?->getCaptures()?->first();
            if ($capture === null) {
                return null;
            }

            if ($capture->getStatus() === Capture::STATE_COMPLETED) {
                return PaymentResponse::ACTION_PAID;
            }

            if ($capture->getStatus() === Capture::STATE_DECLINED
                || $capture->getStatus() === Capture::STATE_FAILED) {
                return PaymentResponse::ACTION_FAIL;
            }

            return null;
        }

        $authorization = $this->getPayments($order, $context, $refetch)?->getAuthorizations()?->first();
        if ($authorization === null) {
            return null;
        }

        if ($authorization->getStatus() === Authorization::STATE_CREATED) {
            return PaymentResponse::ACTION_AUTHORIZE;
        }

        if ($authorization->getStatus() === Authorization::STATE_DENIED
            || $authorization->getStatus() === Authorization::STATE_VOIDED) {
            return PaymentResponse::ACTION_FAIL;
        }

        return null;
    }

    private function getPayments(Order $order, ApiContext $context, bool $refetch): ?Payments
    {
        $payments = $order->getPurchaseUnits()->first()?->getPayments();
        if ($payments !== null) {
            return $payments;
        }

        if (!$refetch) {
            return null;
        }

        $refetchedOrder = $this->orderGateway->getOrder($order->getId(), $context);

        $payments = $refetchedOrder->getPurchaseUnits()->first()?->getPayments();
        if ($payments === null) {
            return null;
        }

        $order->setPurchaseUnits($refetchedOrder->getPurchaseUnits());

        return $payments;
    }
}
