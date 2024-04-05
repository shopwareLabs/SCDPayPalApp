<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V2\Common;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;

#[OA\Schema(schema: 'swag_paypal_v2_common_phone_number')]
class PhoneNumber extends PayPalApiStruct
{
    #[OA\Property(type: 'string')]
    protected string $nationalNumber;

    #[OA\Property(type: 'string')]
    protected string $countryCode;

    public function getNationalNumber(): string
    {
        return $this->nationalNumber;
    }

    public function setNationalNumber(string $nationalNumber): void
    {
        $this->nationalNumber = $nationalNumber;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }
}
