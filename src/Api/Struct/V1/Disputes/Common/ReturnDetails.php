<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\Disputes\Common;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;

#[OA\Schema(schema: 'swag_paypal_v1_disputes_common_return_details')]
class ReturnDetails extends PayPalApiStruct
{
    #[OA\Property(type: 'string')]
    protected string $returnTime;

    #[OA\Property(type: 'string')]
    protected string $mode;

    #[OA\Property(type: 'boolean')]
    protected bool $receipt;

    #[OA\Property(type: 'string')]
    protected string $returnConfirmationNumber;

    #[OA\Property(type: 'boolean')]
    protected bool $returned;

    public function getReturnTime(): string
    {
        return $this->returnTime;
    }

    public function setReturnTime(string $returnTime): void
    {
        $this->returnTime = $returnTime;
    }

    public function getMode(): string
    {
        return $this->mode;
    }

    public function setMode(string $mode): void
    {
        $this->mode = $mode;
    }

    public function isReceipt(): bool
    {
        return $this->receipt;
    }

    public function setReceipt(bool $receipt): void
    {
        $this->receipt = $receipt;
    }

    public function getReturnConfirmationNumber(): string
    {
        return $this->returnConfirmationNumber;
    }

    public function setReturnConfirmationNumber(string $returnConfirmationNumber): void
    {
        $this->returnConfirmationNumber = $returnConfirmationNumber;
    }

    public function isReturned(): bool
    {
        return $this->returned;
    }

    public function setReturned(bool $returned): void
    {
        $this->returned = $returned;
    }
}
