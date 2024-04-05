<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;
use Swag\PayPalApp\Api\Struct\V1\Common\Link;
use Swag\PayPalApp\Api\Struct\V1\Common\LinkCollection;
use Swag\PayPalApp\Api\Struct\V1\Common\Money;
use Swag\PayPalApp\Api\Struct\V1\Subscription\ApplicationContext;
use Swag\PayPalApp\Api\Struct\V1\Subscription\BillingInfo;
use Swag\PayPalApp\Api\Struct\V1\Subscription\Subscriber;

/**
 * @codeCoverageIgnore
 *
 * @experimental
 *
 * This class is experimental and not officially supported.
 * It is currently not used within the plugin itself. Use with caution.
 */
#[OA\Schema(schema: 'swag_paypal_v1_subscription')]
class Subscription extends PayPalApiStruct
{
    #[OA\Property(type: 'string')]
    protected string $id;

    #[OA\Property(type: 'string')]
    protected string $planId;

    #[OA\Property(type: 'string')]
    protected string $startTime;

    #[OA\Property(type: 'string')]
    protected string $quantity;

    #[OA\Property(ref: Money::class)]
    protected Money $shippingAmount;

    #[OA\Property(ref: Subscriber::class)]
    protected Subscriber $subscriber;

    #[OA\Property(ref: BillingInfo::class, nullable: true)]
    protected ?BillingInfo $billingInfo = null;

    #[OA\Property(ref: ApplicationContext::class)]
    protected ApplicationContext $applicationContext;

    #[OA\Property(type: 'string')]
    protected string $status;

    #[OA\Property(type: 'string')]
    protected string $statusUpdateTime;

    #[OA\Property(type: 'string')]
    protected string $createTime;

    #[OA\Property(type: 'string')]
    protected string $updateTime;

    #[OA\Property(type: 'array', items: new OA\Items(ref: Link::class))]
    protected LinkCollection $links;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getPlanId(): string
    {
        return $this->planId;
    }

    public function setPlanId(string $planId): void
    {
        $this->planId = $planId;
    }

    public function getStartTime(): string
    {
        return $this->startTime;
    }

    public function setStartTime(string $startTime): void
    {
        $this->startTime = $startTime;
    }

    public function getQuantity(): string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getShippingAmount(): Money
    {
        return $this->shippingAmount;
    }

    public function setShippingAmount(Money $shippingAmount): void
    {
        $this->shippingAmount = $shippingAmount;
    }

    public function getSubscriber(): Subscriber
    {
        return $this->subscriber;
    }

    public function setSubscriber(Subscriber $subscriber): void
    {
        $this->subscriber = $subscriber;
    }

    public function getApplicationContext(): ApplicationContext
    {
        return $this->applicationContext;
    }

    public function setApplicationContext(ApplicationContext $applicationContext): void
    {
        $this->applicationContext = $applicationContext;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getStatusUpdateTime(): string
    {
        return $this->statusUpdateTime;
    }

    public function setStatusUpdateTime(string $statusUpdateTime): void
    {
        $this->statusUpdateTime = $statusUpdateTime;
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

    public function getLinks(): LinkCollection
    {
        return $this->links;
    }

    public function setLinks(LinkCollection $links): void
    {
        $this->links = $links;
    }

    public function getBillingInfo(): ?BillingInfo
    {
        return $this->billingInfo;
    }

    public function setBillingInfo(?BillingInfo $billingInfo): void
    {
        $this->billingInfo = $billingInfo;
    }
}
