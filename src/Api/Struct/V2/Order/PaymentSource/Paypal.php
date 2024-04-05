<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V2\Order\PaymentSource;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\V2\Common\Address;
use Swag\PayPalApp\Api\Struct\V2\Common\Name;
use Swag\PayPalApp\Api\Struct\V2\Common\PhoneNumber;
use Swag\PayPalApp\Api\Struct\V2\Order\PaymentSource\Common\Attributes;

#[OA\Schema(schema: 'swag_paypal_v2_order_payment_source_paypal')]
class Paypal extends AbstractPaymentSource implements VaultablePaymentSourceInterface
{
    #[OA\Property(type: 'string')]
    protected string $emailAddress;

    #[OA\Property(type: 'string')]
    protected string $accountId;

    #[OA\Property(type: 'string')]
    protected string $billingAgreementId;

    #[OA\Property(type: 'string')]
    protected string $vaultId;

    #[OA\Property(ref: Name::class)]
    protected Name $name;

    #[OA\Property(ref: PhoneNumber::class, nullable: true)]
    protected ?PhoneNumber $phoneNumber = null;

    #[OA\Property(ref: Address::class)]
    protected Address $address;

    #[OA\Property(type: 'string')]
    protected string $birthDate;

    #[OA\Property(type: 'string')]
    protected string $phoneType;

    #[OA\Property(ref: Attributes::class, nullable: true)]
    protected ?Attributes $attributes = null;

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    public function setEmailAddress(string $emailAddress): void
    {
        $this->emailAddress = $emailAddress;
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function setAccountId(string $accountId): void
    {
        $this->accountId = $accountId;
    }

    public function getBillingAgreementId(): string
    {
        return $this->billingAgreementId;
    }

    public function setBillingAgreementId(string $billingAgreementId): void
    {
        $this->billingAgreementId = $billingAgreementId;
    }

    public function getVaultId(): string
    {
        return $this->vaultId;
    }

    public function setVaultId(string $vaultId): void
    {
        $this->vaultId = $vaultId;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function setName(Name $name): void
    {
        $this->name = $name;
    }

    public function getPhoneNumber(): ?PhoneNumber
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?PhoneNumber $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }

    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    public function setBirthDate(string $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    public function getPhoneType(): string
    {
        return $this->phoneType;
    }

    public function setPhoneType(string $phoneType): void
    {
        $this->phoneType = $phoneType;
    }

    public function getAttributes(): ?Attributes
    {
        return $this->attributes;
    }

    public function setAttributes(?Attributes $attributes): void
    {
        $this->attributes = $attributes;
    }

    public function getVaultIdentifier(): string
    {
        return $this->getEmailAddress();
    }
}
