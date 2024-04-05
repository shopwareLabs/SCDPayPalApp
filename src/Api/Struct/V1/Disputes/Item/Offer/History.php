<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\Disputes\Item\Offer;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;

#[OA\Schema(schema: 'swag_paypal_v1_disputes_item_offer_history')]
class History extends PayPalApiStruct
{
    #[OA\Property(type: 'string')]
    protected string $offerTime;

    #[OA\Property(type: 'string')]
    protected string $actor;

    #[OA\Property(type: 'string')]
    protected string $eventType;

    #[OA\Property(type: 'string')]
    protected string $offerType;

    public function getOfferTime(): string
    {
        return $this->offerTime;
    }

    public function setOfferTime(string $offerTime): void
    {
        $this->offerTime = $offerTime;
    }

    public function getActor(): string
    {
        return $this->actor;
    }

    public function setActor(string $actor): void
    {
        $this->actor = $actor;
    }

    public function getEventType(): string
    {
        return $this->eventType;
    }

    public function setEventType(string $eventType): void
    {
        $this->eventType = $eventType;
    }

    public function getOfferType(): string
    {
        return $this->offerType;
    }

    public function setOfferType(string $offerType): void
    {
        $this->offerType = $offerType;
    }
}
