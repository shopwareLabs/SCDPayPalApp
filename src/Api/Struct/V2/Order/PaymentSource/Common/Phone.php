<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V2\Order\PaymentSource\Common;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;
use Swag\PayPalApp\Api\Struct\V2\Common\PhoneNumber;

#[OA\Schema(schema: 'swag_paypal_v2_order_payment_source_common_phone')]
class Phone extends PayPalApiStruct
{
    #[OA\Property(type: 'string')]
    protected string $phoneType;

    #[OA\Property(ref: PhoneNumber::class)]
    protected PhoneNumber $phoneNumber;

    public function getPhoneType(): string
    {
        return $this->phoneType;
    }

    public function setPhoneType(string $phoneType): void
    {
        $this->phoneType = $phoneType;
    }

    public function getPhoneNumber(): PhoneNumber
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(PhoneNumber $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }
}
