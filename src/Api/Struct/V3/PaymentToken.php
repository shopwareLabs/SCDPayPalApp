<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V3;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;
use Swag\PayPalApp\Api\Struct\V2\Common\Link;
use Swag\PayPalApp\Api\Struct\V2\Common\LinkCollection;
use Swag\PayPalApp\Api\Struct\V2\Order\PaymentSource;
use Swag\PayPalApp\Api\Struct\V2\Order\PaymentSource\Common\Attributes\Customer;
use Swag\PayPalApp\Api\Struct\V3\PaymentToken\Metadata;

#[OA\Schema(schema: 'swag_paypal_v3_payment_token')]
class PaymentToken extends PayPalApiStruct
{
    #[OA\Property(type: 'string')]
    protected string $id;

    #[OA\Property(type: 'string')]
    protected string $status;

    #[OA\Property(ref: Customer::class)]
    protected ?Customer $customer = null;

    #[OA\Property(ref: PaymentSource::class)]
    protected PaymentSource $paymentSource;

    #[OA\Property(type: 'array', items: new OA\Items(ref: Link::class))]
    protected LinkCollection $links;

    #[OA\Property(ref: Metadata::class, nullable: true)]
    protected ?Metadata $metadata = null;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): void
    {
        $this->customer = $customer;
    }

    public function getPaymentSource(): PaymentSource
    {
        return $this->paymentSource;
    }

    public function setPaymentSource(PaymentSource $paymentSource): void
    {
        $this->paymentSource = $paymentSource;
    }

    public function getLinks(): LinkCollection
    {
        return $this->links;
    }

    public function setLinks(LinkCollection $links): void
    {
        $this->links = $links;
    }

    public function getMetadata(): ?Metadata
    {
        return $this->metadata;
    }

    public function setMetadata(?Metadata $metadata): void
    {
        $this->metadata = $metadata;
    }
}
