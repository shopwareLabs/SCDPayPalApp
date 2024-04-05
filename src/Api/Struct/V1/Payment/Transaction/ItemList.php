<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\Payment\Transaction;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;
use Swag\PayPalApp\Api\Struct\V1\Payment\Transaction\ItemList\Item;
use Swag\PayPalApp\Api\Struct\V1\Payment\Transaction\ItemList\ItemCollection;
use Swag\PayPalApp\Api\Struct\V1\Payment\Transaction\ItemList\ShippingAddress;
use Swag\PayPalApp\Api\Struct\V1\Payment\Transaction\ItemList\ShippingOption;
use Swag\PayPalApp\Api\Struct\V1\Payment\Transaction\ItemList\ShippingOptionCollection;

#[OA\Schema(schema: 'swag_paypal_v1_payment_transaction_item_list')]
class ItemList extends PayPalApiStruct
{
    #[OA\Property(ref: ShippingAddress::class)]
    protected ShippingAddress $shippingAddress;

    #[OA\Property(type: 'array', items: new OA\Items(ref: Item::class))]
    protected ItemCollection $items;

    #[OA\Property(type: 'array', items: new OA\Items(ref: ShippingOption::class))]
    protected ShippingOptionCollection $shippingOptions;

    #[OA\Property(type: 'string')]
    protected string $shippingPhoneNumber;

    public function getShippingAddress(): ShippingAddress
    {
        return $this->shippingAddress;
    }

    public function setShippingAddress(ShippingAddress $shippingAddress): void
    {
        $this->shippingAddress = $shippingAddress;
    }

    public function getItems(): ItemCollection
    {
        return $this->items;
    }

    public function setItems(ItemCollection $items): void
    {
        $this->items = $items;
    }

    public function getShippingOptions(): ShippingOptionCollection
    {
        return $this->shippingOptions;
    }

    public function setShippingOptions(ShippingOptionCollection $shippingOptions): void
    {
        $this->shippingOptions = $shippingOptions;
    }

    public function getShippingPhoneNumber(): string
    {
        return $this->shippingPhoneNumber;
    }

    public function setShippingPhoneNumber(string $shippingPhoneNumber): void
    {
        $this->shippingPhoneNumber = $shippingPhoneNumber;
    }
}
