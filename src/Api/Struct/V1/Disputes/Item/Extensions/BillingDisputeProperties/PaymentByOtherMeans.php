<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\Disputes\Item\Extensions\BillingDisputeProperties;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;

#[OA\Schema(schema: 'swag_paypal_v1_disputes_item_extensions_billing_dispute_properties_payment_by_other_means')]
class PaymentByOtherMeans extends PayPalApiStruct
{
    #[OA\Property(type: 'boolean')]
    protected bool $chargeDifferentFromOriginal;

    #[OA\Property(type: 'boolean')]
    protected bool $receivedDuplicate;

    #[OA\Property(type: 'string')]
    protected string $paymentMethod;

    #[OA\Property(type: 'string')]
    protected string $paymentInstrumentSuffix;

    public function isChargeDifferentFromOriginal(): bool
    {
        return $this->chargeDifferentFromOriginal;
    }

    public function setChargeDifferentFromOriginal(bool $chargeDifferentFromOriginal): void
    {
        $this->chargeDifferentFromOriginal = $chargeDifferentFromOriginal;
    }

    public function isReceivedDuplicate(): bool
    {
        return $this->receivedDuplicate;
    }

    public function setReceivedDuplicate(bool $receivedDuplicate): void
    {
        $this->receivedDuplicate = $receivedDuplicate;
    }

    public function getPaymentMethod(): string
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(string $paymentMethod): void
    {
        $this->paymentMethod = $paymentMethod;
    }

    public function getPaymentInstrumentSuffix(): string
    {
        return $this->paymentInstrumentSuffix;
    }

    public function setPaymentInstrumentSuffix(string $paymentInstrumentSuffix): void
    {
        $this->paymentInstrumentSuffix = $paymentInstrumentSuffix;
    }
}
