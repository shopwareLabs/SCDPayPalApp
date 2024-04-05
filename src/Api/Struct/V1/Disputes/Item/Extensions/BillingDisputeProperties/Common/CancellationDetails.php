<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\Disputes\Item\Extensions\BillingDisputeProperties\Common;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;

#[OA\Schema(schema: 'swag_paypal_v1_disputes_item_extensions_billing_dispute_properties_common_cancellation_details')]
class CancellationDetails extends PayPalApiStruct
{
    #[OA\Property(type: 'string')]
    protected string $cancellationDate;

    #[OA\Property(type: 'string')]
    protected string $cancellationNumber;

    #[OA\Property(type: 'boolean')]
    protected bool $cancelled;

    #[OA\Property(type: 'string')]
    protected string $cancellationMode;

    public function getCancellationDate(): string
    {
        return $this->cancellationDate;
    }

    public function setCancellationDate(string $cancellationDate): void
    {
        $this->cancellationDate = $cancellationDate;
    }

    public function getCancellationNumber(): string
    {
        return $this->cancellationNumber;
    }

    public function setCancellationNumber(string $cancellationNumber): void
    {
        $this->cancellationNumber = $cancellationNumber;
    }

    public function isCancelled(): bool
    {
        return $this->cancelled;
    }

    public function setCancelled(bool $cancelled): void
    {
        $this->cancelled = $cancelled;
    }

    public function getCancellationMode(): string
    {
        return $this->cancellationMode;
    }

    public function setCancellationMode(string $cancellationMode): void
    {
        $this->cancellationMode = $cancellationMode;
    }
}
