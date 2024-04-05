<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\Disputes\Item\Evidence\EvidenceInfo;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;

#[OA\Schema(schema: 'swag_paypal_v1_disputes_item_evidence_evidence_info_tracking_info')]
class TrackingInfo extends PayPalApiStruct
{
    #[OA\Property(type: 'string')]
    protected string $carrierName;

    #[OA\Property(type: 'string')]
    protected string $carrierNameOther;

    #[OA\Property(type: 'string')]
    protected string $trackingUrl;

    #[OA\Property(type: 'string')]
    protected string $trackingNumber;

    public function getCarrierName(): string
    {
        return $this->carrierName;
    }

    public function setCarrierName(string $carrierName): void
    {
        $this->carrierName = $carrierName;
    }

    public function getCarrierNameOther(): string
    {
        return $this->carrierNameOther;
    }

    public function setCarrierNameOther(string $carrierNameOther): void
    {
        $this->carrierNameOther = $carrierNameOther;
    }

    public function getTrackingUrl(): string
    {
        return $this->trackingUrl;
    }

    public function setTrackingUrl(string $trackingUrl): void
    {
        $this->trackingUrl = $trackingUrl;
    }

    public function getTrackingNumber(): string
    {
        return $this->trackingNumber;
    }

    public function setTrackingNumber(string $trackingNumber): void
    {
        $this->trackingNumber = $trackingNumber;
    }
}
