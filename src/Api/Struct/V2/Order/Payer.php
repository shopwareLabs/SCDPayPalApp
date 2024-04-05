<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V2\Order;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;
use Swag\PayPalApp\Api\Struct\V2\Common\Address;
use Swag\PayPalApp\Api\Struct\V2\Common\Name;
use Swag\PayPalApp\Api\Struct\V2\Order\PaymentSource\Common\Phone;

#[OA\Schema(schema: 'swag_paypal_v2_order_payer')]
class Payer extends PayPalApiStruct
{
    #[OA\Property(ref: Name::class)]
    protected Name $name;

    #[OA\Property(type: 'string')]
    protected string $emailAddress;

    #[OA\Property(type: 'string')]
    protected string $payerId;

    #[OA\Property(ref: Phone::class, nullable: true)]
    protected ?Phone $phone = null;

    #[OA\Property(ref: Address::class)]
    protected Address $address;

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    public function setEmailAddress(string $emailAddress): void
    {
        $this->emailAddress = $emailAddress;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function setName(Name $name): void
    {
        $this->name = $name;
    }

    public function getPayerId(): string
    {
        return $this->payerId;
    }

    public function setPayerId(string $payerId): void
    {
        $this->payerId = $payerId;
    }

    public function getPhone(): ?Phone
    {
        return $this->phone;
    }

    public function setPhone(?Phone $phone): void
    {
        $this->phone = $phone;
    }
}
