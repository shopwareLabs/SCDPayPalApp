<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\Payment\Transaction\RelatedResource;

use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'swag_paypal_v1_payment_transaction_related_resource_refund')]
class Refund extends RelatedResource
{
    #[OA\Property(type: 'string')]
    protected string $saleId;

    #[OA\Property(type: 'string')]
    protected string $captureId;

    public function getSaleId(): string
    {
        return $this->saleId;
    }

    public function setSaleId(string $saleId): void
    {
        $this->saleId = $saleId;
    }

    public function getCaptureId(): string
    {
        return $this->captureId;
    }

    public function setCaptureId(string $captureId): void
    {
        $this->captureId = $captureId;
    }
}
