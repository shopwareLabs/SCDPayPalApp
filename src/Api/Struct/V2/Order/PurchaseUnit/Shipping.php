<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;
use Swag\PayPalApp\Api\Struct\V2\Common\Address;
use Swag\PayPalApp\Api\Struct\V2\Order\PurchaseUnit\Shipping\Name;

#[OA\Schema(schema: 'swag_paypal_v2_order_purchase_unit_shipping')]
class Shipping extends PayPalApiStruct
{
    #[OA\Property(ref: Name::class)]
    protected Name $name;

    #[OA\Property(ref: Address::class)]
    protected Address $address;

    public function getName(): Name
    {
        return $this->name;
    }

    public function setName(Name $name): void
    {
        $this->name = $name;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }
}
