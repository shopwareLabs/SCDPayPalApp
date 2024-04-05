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
use Swag\PayPalApp\Api\Struct\V2\Order\PaymentSource\Common\ExperienceContext;
use Swag\PayPalApp\Api\Struct\V2\Order\PaymentSource\PayUponInvoice\DepositBankDetails;

#[OA\Schema(schema: 'swag_paypal_v2_order_payment_source_pay_upon_invoice')]
class PayUponInvoice extends AbstractPaymentSource
{
    #[OA\Property(ref: Name::class)]
    protected Name $name;

    #[OA\Property(type: 'string')]
    protected string $email;

    #[OA\Property(type: 'string')]
    protected string $birthDate;

    #[OA\Property(ref: PhoneNumber::class)]
    protected PhoneNumber $phone;

    #[OA\Property(ref: Address::class)]
    protected Address $billingAddress;

    #[OA\Property(type: 'string')]
    protected string $paymentReference;

    #[OA\Property(ref: DepositBankDetails::class)]
    protected DepositBankDetails $depositBankDetails;

    public function getName(): Name
    {
        return $this->name;
    }

    public function setName(Name $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    public function setBirthDate(string $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    public function getPhone(): PhoneNumber
    {
        return $this->phone;
    }

    public function setPhone(PhoneNumber $phone): void
    {
        $this->phone = $phone;
    }

    public function getBillingAddress(): Address
    {
        return $this->billingAddress;
    }

    public function setBillingAddress(Address $billingAddress): void
    {
        $this->billingAddress = $billingAddress;
    }

    public function getPaymentReference(): string
    {
        return $this->paymentReference;
    }

    public function setPaymentReference(string $paymentReference): void
    {
        $this->paymentReference = $paymentReference;
    }

    public function getDepositBankDetails(): DepositBankDetails
    {
        return $this->depositBankDetails;
    }

    public function setDepositBankDetails(DepositBankDetails $depositBankDetails): void
    {
        $this->depositBankDetails = $depositBankDetails;
    }

    public function getExperienceContext(): ExperienceContext
    {
        return $this->experienceContext;
    }

    public function setExperienceContext(ExperienceContext $experienceContext): void
    {
        $this->experienceContext = $experienceContext;
    }
}
