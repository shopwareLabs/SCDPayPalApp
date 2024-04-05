<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\Payment\Transaction\RelatedResource;

use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'swag_paypal_v1_payment_transaction_related_resource_authorization')]
class Authorization extends RelatedResource
{
    #[OA\Property(type: 'string')]
    protected string $reasonCode;

    #[OA\Property(type: 'string')]
    protected string $validUntil;

    public function getReasonCode(): string
    {
        return $this->reasonCode;
    }

    public function setReasonCode(string $reasonCode): void
    {
        $this->reasonCode = $reasonCode;
    }

    public function getValidUntil(): string
    {
        return $this->validUntil;
    }

    public function setValidUntil(string $validUntil): void
    {
        $this->validUntil = $validUntil;
    }
}
