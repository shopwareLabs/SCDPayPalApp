<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\Disputes\Item\Extensions\BillingDisputeProperties\Common;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;

#[OA\Schema(schema: 'swag_paypal_v1_disputes_item_extensions_billing_dispute_properties_common_agreed_refund_details')]
class AgreedRefundDetails extends PayPalApiStruct
{
    #[OA\Property(type: 'boolean')]
    protected bool $merchantAgreedRefund;

    #[OA\Property(type: 'string')]
    protected string $merchantAgreedRefundTime;

    public function isMerchantAgreedRefund(): bool
    {
        return $this->merchantAgreedRefund;
    }

    public function setMerchantAgreedRefund(bool $merchantAgreedRefund): void
    {
        $this->merchantAgreedRefund = $merchantAgreedRefund;
    }

    public function getMerchantAgreedRefundTime(): string
    {
        return $this->merchantAgreedRefundTime;
    }

    public function setMerchantAgreedRefundTime(string $merchantAgreedRefundTime): void
    {
        $this->merchantAgreedRefundTime = $merchantAgreedRefundTime;
    }
}
