<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Converter\Util;


use Shopware\App\SDK\Context\Cart\CalculatedPrice;
use Shopware\App\SDK\Context\SalesChannelContext\Currency;
use Swag\PayPalApp\Api\Struct\V2\Common\Money;
use Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit;
use Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit\Amount;
use Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit\Amount\Breakdown;
use Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit\ItemCollection;

class AmountProvider
{
    private PriceFormatter $priceFormatter;

    /**
     * @internal
     */
    public function __construct(PriceFormatter $priceFormatter)
    {
        $this->priceFormatter = $priceFormatter;
    }

    public function createAmount(
        CalculatedPrice $totalAmount,
        CalculatedPrice $shippingCosts,
        Currency $currency,
        PurchaseUnit $purchaseUnit,
        bool $isNet
    ): Amount {
        $currencyCode = $currency->getIsoCode();

        $amount = new Amount();
        $amount->setCurrencyCode($currencyCode);
        $amount->setValue($this->priceFormatter->formatPrice($totalAmount->getTotalPrice(), $currencyCode));

        $items = $purchaseUnit->getItems();
        if ($items !== null) {
            // Only set breakdown if items are submitted, otherwise the breakdown will be invalid
            $amount->setBreakdown(
                $this->createBreakdown(
                    $items,
                    $purchaseUnit,
                    $currencyCode,
                    $shippingCosts,
                    $isNet,
                    (float) $amount->getValue()
                )
            );
        }

        return $amount;
    }

    private function createBreakdown(
        ItemCollection $items,
        PurchaseUnit $purchaseUnit,
        string $currencyCode,
        CalculatedPrice $shippingCosts,
        bool $isNet,
        float $amountValue
    ): Breakdown {
        $accumulatedAmountValue = 0.0;
        $accumulatedTaxValue = 0.0;
        $newItems = new ItemCollection();

        foreach ($items as $item) {
            $itemUnitAmount = (float) $item->getUnitAmount()->getValue();
            if ($itemUnitAmount >= 0.0) {
                $accumulatedAmountValue += $item->getQuantity() * $itemUnitAmount;
                $newItems->add($item);
                $accumulatedTaxValue += $item->getQuantity() * (float) $item->getTax()->getValue();
            }
        }
        $purchaseUnit->setItems($newItems);

        $itemTotal = new Money();
        $itemTotal->setCurrencyCode($currencyCode);
        $itemTotal->setValue($this->priceFormatter->formatPrice($accumulatedAmountValue, $currencyCode));

        $shipping = new Money();
        $shipping->setCurrencyCode($currencyCode);
        $shipping->setValue($this->priceFormatter->formatPrice($shippingCosts->getTotalPrice() + ($isNet ? $this->priceFormatter->getTaxAmount($shippingCosts->getCalculatedTaxes()) : 0.0), $currencyCode));
        $accumulatedAmountValue += (float) $shipping->getValue();

        $taxTotal = new Money();
        $taxTotal->setCurrencyCode($currencyCode);
        $taxTotal->setValue($this->priceFormatter->formatPrice($accumulatedTaxValue, $currencyCode));
        $accumulatedAmountValue += (float) $taxTotal->getValue();

        $discount = new Money();
        $discount->setCurrencyCode($currencyCode);
        $discount->setValue($this->priceFormatter->formatPrice($accumulatedAmountValue - $amountValue, $currencyCode));

        $handling = new Money();
        $handling->setCurrencyCode($currencyCode);
        // if due to rounding the order is more than the items, we add a fake handling fee
        if ((float) $discount->getValue() < 0.0) {
            $discount->setValue($this->priceFormatter->formatPrice(0.0, $currencyCode));
            $handling->setValue($this->priceFormatter->formatPrice($amountValue - $accumulatedAmountValue, $currencyCode));
        } else {
            $handling->setValue($this->priceFormatter->formatPrice(0.0, $currencyCode));
        }

        $breakdown = new Breakdown();
        $breakdown->setItemTotal($itemTotal);
        $breakdown->setShipping($shipping);
        $breakdown->setTaxTotal($taxTotal);
        $breakdown->setDiscount($discount);
        $breakdown->setHandling($handling);

        return $breakdown;
    }
}
