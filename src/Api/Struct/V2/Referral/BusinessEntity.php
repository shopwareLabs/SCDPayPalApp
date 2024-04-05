<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V2\Referral;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;
use Swag\PayPalApp\Api\Struct\V2\Referral\BusinessEntity\Address;
use Swag\PayPalApp\Api\Struct\V2\Referral\BusinessEntity\AddressCollection;

#[OA\Schema(schema: 'swag_paypal_v2_referral_business_entity')]
class BusinessEntity extends PayPalApiStruct
{
    #[OA\Property(type: 'array', items: new OA\Items(ref: Address::class))]
    protected AddressCollection $addresses;

    public function getAddresses(): AddressCollection
    {
        return $this->addresses;
    }

    public function setAddresses(AddressCollection $addresses): void
    {
        $this->addresses = $addresses;
    }
}
