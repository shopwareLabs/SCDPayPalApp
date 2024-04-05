<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\Disputes\Item;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;
use Swag\PayPalApp\Api\Struct\V1\Common\Money;

#[OA\Schema(schema: 'swag_paypal_v1_disputes_item_dispute_outcome')]
class DisputeOutcome extends PayPalApiStruct
{
    #[OA\Property(type: 'string')]
    protected string $outcomeCode;

    #[OA\Property(ref: Money::class)]
    protected Money $amountRefunded;

    public function getOutcomeCode(): string
    {
        return $this->outcomeCode;
    }

    public function setOutcomeCode(string $outcomeCode): void
    {
        $this->outcomeCode = $outcomeCode;
    }

    public function getAmountRefunded(): Money
    {
        return $this->amountRefunded;
    }

    public function setAmountRefunded(Money $amountRefunded): void
    {
        $this->amountRefunded = $amountRefunded;
    }
}
