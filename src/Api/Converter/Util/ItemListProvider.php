<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Converter\Util;


use Shopware\App\SDK\Context\Cart\CalculatedPrice;
use Shopware\App\SDK\Context\Cart\Cart;
use Shopware\App\SDK\Context\Cart\CartPrice;
use Shopware\App\SDK\Context\Cart\LineItem;
use Shopware\App\SDK\Context\Order\Order as ShopwareOrder;
use Shopware\App\SDK\Context\Order\OrderLineItem;
use Shopware\App\SDK\Context\SalesChannelContext\Currency;
use Swag\PayPalApp\Api\Struct\V2\Common\Money;
use Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit\Amount;
use Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit\Item;
use Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit\ItemCollection;

class ItemListProvider
{
    /**
     * @internal
     */
    public function __construct(
        private readonly PriceFormatter $priceFormatter,
    ) {
    }

    public function getItemList(Currency $currency, ShopwareOrder $order): ItemCollection
    {
        $items = new ItemCollection();
        $currencyCode = $currency->getIsoCode();
        $isNet = $order->getTaxStatus() !== CartPrice::TAX_STATE_GROSS; /* @phpstan-ignore-line */
        $lineItems = $this->getNestedLineItems($order->getLineItems());
        if ($lineItems === null) {
            return new ItemCollection();
        }

        foreach ($lineItems as $lineItem) {
            $item = new Item();
            $this->setName($lineItem, $item);
            $this->setSku($lineItem, $item);
            $item->setCategory(Item::CATEGORY_PHYSICAL_GOODS);
            $this->buildPriceData($lineItem, $item, $currencyCode, $isNet);

            $items->add($item);
        }

        return $items;
    }

    public function getItemListFromCart(Currency $currency, Cart $cart): ItemCollection
    {
        $items = new ItemCollection();
        $currencyCode = $currency->getIsoCode();
        $isNet = $cart->getPrice()->getTaxStatus() !== CartPrice::TAX_STATE_GROSS;

        foreach ($cart->getLineItems() as $lineItem) {
            $item = new Item();
            $this->setName($lineItem, $item);
            $this->setSku($lineItem, $item);
            $item->setCategory(Item::CATEGORY_PHYSICAL_GOODS);
            $this->buildPriceData($lineItem, $item, $currencyCode, $isNet);

            $items->add($item);
        }

        return $items;
    }

    private function setName(LineItem $lineItem, Item $item): void
    {
        $label = $lineItem->getLabel() ?? '';

        try {
            $item->setName($label);
        } catch (\LengthException $e) {
            $item->setName(\mb_substr($label, 0, Item::MAX_LENGTH_NAME));
        }
    }

    private function setSku(LineItem $lineItem, Item $item): void
    {
        $payload = $lineItem->getPayload();
        if ($payload === null || !\array_key_exists('productNumber', $payload)) {
            return;
        }

        $productNumber = $payload['productNumber'];

        try {
            $item->setSku($productNumber);
        } catch (\LengthException $e) {
            $item->setSku(\mb_substr($productNumber, 0, Item::MAX_LENGTH_SKU));
        }
    }

    private function buildPriceData(LineItem $lineItem, Item $item, string $currencyCode, bool $isNet): void
    {
        $unitPrice = $this->priceFormatter->formatPrice($lineItem->getPrice()?->getUnitPrice() ?? 0.0, $currencyCode);

        $unitAmount = new Amount();
        $unitAmount->setCurrencyCode($currencyCode);
        $unitAmount->setValue($unitPrice);
        $item->setUnitAmount($unitAmount);
        $item->setQuantity($lineItem->getQuantity());

        $tax = new Money();
        $tax->setCurrencyCode($currencyCode);
        $tax->setValue($this->getTax($lineItem, $isNet, true, $currencyCode));
        $item->setTax($tax);
        $item->setTaxRate($this->getTaxRate($isNet, $lineItem->getPrice()));

        if (!$this->hasMismatchingPrice($lineItem, $item, $isNet, $currencyCode)) {
            return;
        }

        $unitAmount->setValue($this->priceFormatter->formatPrice($lineItem->getPrice()?->getTotalPrice() ?? 0.0, $currencyCode));
        $tax->setValue($this->getTax($lineItem, $isNet, false, $currencyCode));
        $item->setQuantity(1);
        $item->setName(\mb_substr(\sprintf('%s x %s', $lineItem->getQuantity(), $item->getName()), 0, Item::MAX_LENGTH_NAME));
    }

    private function getTax(LineItem $lineItem, bool $isNet, bool $perUnit, string $currencyCode): string
    {
        $price = $lineItem->getPrice();
        if (!$isNet || $price === null) {
            return '0.00';
        }

        return $this->priceFormatter->formatPrice($this->priceFormatter->getTaxAmount($price->getCalculatedTaxes()) / ($perUnit ? $lineItem->getQuantity() : 1.0), $currencyCode);
    }

    private function getTaxRate(bool $isNet, ?CalculatedPrice $price): float
    {
        if (!$isNet || $price === null) {
            return 0.0;
        }

        $calculatedTax = \current($price->getCalculatedTaxes());
        if (!$calculatedTax) {
            return 0.0;
        }

        return $calculatedTax->getTaxRate();
    }

    private function hasMismatchingPrice(LineItem $lineItem, Item $item, bool $isNet, string $currencyCode): bool
    {
        $totalTaxes = $this->getTax($lineItem, $isNet, false, $currencyCode);
        if ($totalTaxes !== $this->priceFormatter->formatPrice((float) $item->getTax()->getValue() * $lineItem->getQuantity(), $currencyCode)) {
            return true;
        }

        $totalPrice = $this->priceFormatter->formatPrice($lineItem->getPrice()?->getTotalPrice() ?? 0.0, $currencyCode);
        if ($totalPrice !== $this->priceFormatter->formatPrice((float) $item->getUnitAmount()->getValue() * $lineItem->getQuantity(), $currencyCode)) {
            return true;
        }

        return false;
    }

    /**
     * @param OrderLineItem[] $lineItems
     *
     * @return OrderLineItem[]
     */
    private function getNestedLineItems(array $lineItems): array
    {
        $lineItems = array_filter($lineItems, static function (OrderLineItem $lineItem): bool {
            return $lineItem->getParentId() > 0;
        });

        usort($lineItems, fn(OrderLineItem $a, OrderLineItem $b) => $a->getPosition() <=> $b->getPosition());

        return $lineItems;
    }
}
