<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\Disputes\Item;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;

#[OA\Schema(schema: 'swag_paypal_v1_disputes_item_supporting_info')]
class SupportingInfo extends PayPalApiStruct
{
    #[OA\Property(type: 'string')]
    protected string $notes;

    #[OA\Property(type: 'string')]
    protected string $source;

    #[OA\Property(type: 'string')]
    protected string $providedTime;

    public function getNotes(): string
    {
        return $this->notes;
    }

    public function setNotes(string $notes): void
    {
        $this->notes = $notes;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function setSource(string $source): void
    {
        $this->source = $source;
    }

    public function getProvidedTime(): string
    {
        return $this->providedTime;
    }

    public function setProvidedTime(string $providedTime): void
    {
        $this->providedTime = $providedTime;
    }
}
