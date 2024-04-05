<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\Disputes\Item;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;

#[OA\Schema(schema: 'swag_paypal_v1_disputes_item_communication_details')]
class CommunicationDetails extends PayPalApiStruct
{
    #[OA\Property(type: 'string')]
    protected string $email;

    #[OA\Property(type: 'string')]
    protected string $note;

    #[OA\Property(type: 'string')]
    protected string $timePosted;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function setNote(string $note): void
    {
        $this->note = $note;
    }

    public function getTimePosted(): string
    {
        return $this->timePosted;
    }

    public function setTimePosted(string $timePosted): void
    {
        $this->timePosted = $timePosted;
    }
}
