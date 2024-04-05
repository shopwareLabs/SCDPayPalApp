<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\Disputes\Item;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;

#[OA\Schema(schema: 'swag_paypal_v1_disputes_item_adjudication')]
class Adjudication extends PayPalApiStruct
{
    #[OA\Property(type: 'string')]
    protected string $type;

    #[OA\Property(type: 'string')]
    protected string $adjudicationTime;

    #[OA\Property(type: 'string')]
    protected string $reason;

    #[OA\Property(type: 'string')]
    protected string $disputeLifeCycleStage;

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getAdjudicationTime(): string
    {
        return $this->adjudicationTime;
    }

    public function setAdjudicationTime(string $adjudicationTime): void
    {
        $this->adjudicationTime = $adjudicationTime;
    }

    public function getReason(): string
    {
        return $this->reason;
    }

    public function setReason(string $reason): void
    {
        $this->reason = $reason;
    }

    public function getDisputeLifeCycleStage(): string
    {
        return $this->disputeLifeCycleStage;
    }

    public function setDisputeLifeCycleStage(string $disputeLifeCycleStage): void
    {
        $this->disputeLifeCycleStage = $disputeLifeCycleStage;
    }
}
