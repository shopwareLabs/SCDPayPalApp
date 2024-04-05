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

#[OA\Schema(schema: 'swag_paypal_v1_disputes_item_partner_action')]
class PartnerAction extends PayPalApiStruct
{
    #[OA\Property(type: 'string')]
    protected string $id;

    #[OA\Property(type: 'string')]
    protected string $name;

    #[OA\Property(type: 'string')]
    protected string $createTime;

    #[OA\Property(type: 'string')]
    protected string $updateTime;

    #[OA\Property(type: 'string')]
    protected string $dueTime;

    #[OA\Property(type: 'string')]
    protected string $status;

    #[OA\Property(ref: Money::class)]
    protected Money $amount;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCreateTime(): string
    {
        return $this->createTime;
    }

    public function setCreateTime(string $createTime): void
    {
        $this->createTime = $createTime;
    }

    public function getUpdateTime(): string
    {
        return $this->updateTime;
    }

    public function setUpdateTime(string $updateTime): void
    {
        $this->updateTime = $updateTime;
    }

    public function getDueTime(): string
    {
        return $this->dueTime;
    }

    public function setDueTime(string $dueTime): void
    {
        $this->dueTime = $dueTime;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function setAmount(Money $amount): void
    {
        $this->amount = $amount;
    }
}
