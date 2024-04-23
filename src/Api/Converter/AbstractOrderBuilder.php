<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Converter;

use Shopware\App\SDK\Context\Cart\CalculatedPrice;
use Shopware\App\SDK\Context\Cart\Cart;
use Shopware\App\SDK\Context\Cart\CartPrice;
use Shopware\App\SDK\Context\Cart\Delivery;
use Shopware\App\SDK\Context\Payment\PaymentPayAction;
use Shopware\App\SDK\Context\SalesChannelContext\SalesChannelContext;
use Shopware\App\SDK\Context\Order\Order as ShopwareOrder;
use Shopware\App\SDK\Context\Order\OrderTransaction as ShopwareOrderTransaction;
use Swag\PayPalApp\Api\Converter\Util\AddressProvider;
use Swag\PayPalApp\Api\Converter\Util\ItemListProvider;
use Swag\PayPalApp\Api\Converter\Util\PurchaseUnitProvider;
use Swag\PayPalApp\Api\Struct\V2\Order;
use Swag\PayPalApp\Api\Struct\V2\Order\PaymentSource;
use Swag\PayPalApp\Api\Struct\V2\Order\PaymentSource\Common\ExperienceContext;
use Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit;
use Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnitCollection;
use Symfony\Component\HttpFoundation\ParameterBag;

abstract class AbstractOrderBuilder
{
    public const FAKE_URL = 'https://www.example.com/';

    /**
     * @internal
     */
    public function __construct(
        protected readonly PurchaseUnitProvider $purchaseUnitProvider,
        protected readonly AddressProvider $addressProvider,
        protected readonly ItemListProvider $itemListProvider,
    ) {
    }

    public function getOrder(
        PaymentPayAction $paymentTransaction,
        ParameterBag $requestDataBag
    ): Order {
        $purchaseUnit = $this->createPurchaseUnitFromOrder(
            $paymentTransaction->order,
            $paymentTransaction->orderTransaction,
        );

        $order = new Order();
        $order->setIntent($this->getIntent($paymentTransaction->order->getSalesChannelId()));
        $order->setPurchaseUnits(new PurchaseUnitCollection([$purchaseUnit]));
        $paymentSource = new PaymentSource();
        $this->buildPaymentSourceFromOrder($paymentTransaction, $requestDataBag, $paymentSource);
        $order->setPaymentSource($paymentSource);

        return $order;
    }

    public function getOrderFromCart(
        Cart $cart,
        SalesChannelContext $salesChannelContext,
        ParameterBag $requestDataBag
    ): Order {
        $purchaseUnit = $this->createPurchaseUnitFromCart($salesChannelContext, $cart);

        $order = new Order();
        $order->setIntent($this->getIntent($salesChannelContext->getSalesChannel()->getId()));
        $order->setPurchaseUnits(new PurchaseUnitCollection([$purchaseUnit]));
        $paymentSource = new PaymentSource();
        $this->buildPaymentSourceFromCart($cart, $salesChannelContext, $requestDataBag, $paymentSource);
        $order->setPaymentSource($paymentSource);

        return $order;
    }

    abstract protected function buildPaymentSourceFromOrder(
        PaymentPayAction $paymentTransaction,
        ParameterBag $requestDataBag,
        PaymentSource $paymentSource,
    ): void;

    abstract protected function buildPaymentSourceFromCart(
        Cart $cart,
        SalesChannelContext $salesChannelContext,
        ParameterBag $requestDataBag,
        PaymentSource $paymentSource,
    ): void;

    protected function createPurchaseUnitFromOrder(
        ShopwareOrder $order,
        ShopwareOrderTransaction $orderTransaction
    ): PurchaseUnit {
        $items = $this->submitCart($order->getSalesChannelId()) ? $this->itemListProvider->getItemList($order->getCurrency(), $order) : null;

        $purchaseUnit = $this->purchaseUnitProvider->createPurchaseUnit(
            $orderTransaction->getAmount(),
            $order->getShippingCosts(),
            null,
            $items,
            $order->getCurrency(),
            $order->getTaxStatus() !== CartPrice::TAX_STATE_GROSS,
            $order,
            $orderTransaction
        );

        return $purchaseUnit;
    }

    protected function createPurchaseUnitFromCart(
        SalesChannelContext $salesChannelContext,
        Cart $cart,
    ): PurchaseUnit {
        $cartTransaction = \current($cart->getTransactions());
        if ($cartTransaction === null) {
            throw new \Exception('No transaction found in cart');
        }

        $items = $this->submitCart($salesChannelContext->getSalesChannel()->getId())
            ? $this->itemListProvider->getItemListFromCart($salesChannelContext->getCurrency(), $cart)
            : null;

        return $this->purchaseUnitProvider->createPurchaseUnit(
            $cartTransaction->getAmount(),
            CalculatedPrice::sum(\array_map(static fn (Delivery $delivery): CalculatedPrice => $delivery->getShippingCosts(), $cart->getDeliveries())),
            $salesChannelContext->getCustomer(),
            $items,
            $salesChannelContext->getCurrency(),
            $cart->getPrice()->getTaxStatus() !== CartPrice::TAX_STATE_GROSS
        );
    }

    protected function getIntent(string $salesChannelId): string
    {
        return Order::INTENT_CAPTURE;
    }

    protected function createExperienceContext(
        string $salesChannelId,
        ?PaymentPayAction $paymentTransaction = null,
    ): ExperienceContext {
        $experienceContext = new ExperienceContext();
        $experienceContext->setLocale($this->getLocaleCode());
        $experienceContext->setLandingPage($this->getLandingPageType($salesChannelId));

        if ($paymentTransaction?->returnUrl !== null) {
            $experienceContext->setReturnUrl($paymentTransaction->returnUrl);
            $experienceContext->setCancelUrl(\sprintf('%s&cancel=1', $paymentTransaction->returnUrl));
        } else {
            $experienceContext->setReturnUrl(self::FAKE_URL);
            $experienceContext->setCancelUrl(self::FAKE_URL . '?cancel=1');
        }

        return $experienceContext;
    }

    protected function submitCart(string $salesChannelId): bool
    {
        return true;
    }

    private function getLandingPageType(string $salesChannelId) : string
    {
        return 'NO_PREFERENCE';
    }

    private function getLocaleCode(): string
    {
        return 'en-US';
    }
}
