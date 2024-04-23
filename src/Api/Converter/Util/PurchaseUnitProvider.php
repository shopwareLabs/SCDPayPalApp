<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Converter\Util;


use Shopware\App\SDK\Context\Cart\CalculatedPrice;
use Shopware\App\SDK\Context\SalesChannelContext\Address as ShopwareAddress;
use Shopware\App\SDK\Context\SalesChannelContext\Currency;
use Shopware\App\SDK\Context\SalesChannelContext\Customer;
use Shopware\App\SDK\Context\Order\Order as ShopwareOrder;
use Shopware\App\SDK\Context\Order\OrderTransaction;
use Swag\PayPalApp\Api\Struct\V2\Common\Address;
use Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit;
use Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit\ItemCollection;
use Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit\Shipping;
use Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit\Shipping\Name;

class PurchaseUnitProvider
{
    /**
     * @internal
     */
    public function __construct(
        private readonly AmountProvider $amountProvider,
        private readonly AddressProvider $addressProvider,
        private readonly CustomIdProvider $customIdProvider,
    ) {
    }

    public function createPurchaseUnit(
        CalculatedPrice $totalAmount,
        CalculatedPrice $shippingCosts,
        ?Customer $customer,
        ?ItemCollection $itemList,
        Currency $currency,
        bool $isNet,
        ?ShopwareOrder $order = null,
        ?OrderTransaction $orderTransaction = null
    ): PurchaseUnit {
        $purchaseUnit = new PurchaseUnit();

        if ($itemList !== null) {
            $purchaseUnit->setItems($itemList);
        }

        $amount = $this->amountProvider->createAmount(
            $totalAmount,
            $shippingCosts,
            $currency,
            $purchaseUnit,
            $isNet
        );

        $purchaseUnit->setAmount($amount);

        $shipping = $this->createShipping($customer, $order);
        if ($shipping !== null) {
            $purchaseUnit->setShipping($shipping);
        }

        if ($orderTransaction !== null) {
            $purchaseUnit->setCustomId($this->customIdProvider->createCustomId($orderTransaction));
        }

        $orderNumber = $order?->getOrderNumber();

        if ($orderNumber !== null) {
            $purchaseUnit->setInvoiceId($orderNumber);
        }

        return $purchaseUnit;
    }

    private function createShipping(?Customer $customer, ?ShopwareOrder $order): ?Shipping
    {
        $shippingAddress = \current($order?->getDeliveries() ?? [])?->getShippingOrderAddress() ?? $customer?->getActiveShippingAddress();
        if ($shippingAddress === null) {
            return null;
        }

        $shipping = new Shipping();
        $address = new Address();
        $this->addressProvider->createAddress($shippingAddress, $address);
        $shipping->setAddress($address);
        $shipping->setName($this->createShippingName($shippingAddress));

        return $shipping;
    }

    private function createShippingName(ShopwareAddress $shippingAddress): Name
    {
        $shippingName = new Name();
        $shippingName->setFullName(\sprintf('%s %s', $shippingAddress->getFirstName(), $shippingAddress->getLastName()));

        return $shippingName;
    }
}
