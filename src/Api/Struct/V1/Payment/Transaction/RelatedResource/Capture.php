<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\Payment\Transaction\RelatedResource;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\V1\Common\Value;

#[OA\Schema(schema: 'swag_paypal_v1_payment_transaction_related_resource_capture')]
class Capture extends RelatedResource
{
    #[OA\Property(type: 'string')]
    protected string $custom;

    #[OA\Property(ref: Value::class)]
    protected Value $transactionFee;

    #[OA\Property(type: 'string')]
    protected string $invoiceNumber;

    public function getCustom(): string
    {
        return $this->custom;
    }

    public function setCustom(string $custom): void
    {
        $this->custom = $custom;
    }

    public function getTransactionFee(): Value
    {
        return $this->transactionFee;
    }

    public function setTransactionFee(Value $transactionFee): void
    {
        $this->transactionFee = $transactionFee;
    }

    public function getInvoiceNumber(): string
    {
        return $this->invoiceNumber;
    }

    public function setInvoiceNumber(string $invoiceNumber): void
    {
        $this->invoiceNumber = $invoiceNumber;
    }
}
