<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\Disputes\Item\Extensions;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;
use Swag\PayPalApp\Api\Struct\V1\Disputes\Common\ProductDetails;
use Swag\PayPalApp\Api\Struct\V1\Disputes\Common\ServiceDetails;

#[OA\Schema(schema: 'swag_paypal_v1_disputes_item_extensions_merchandize_dispute_properties')]
class MerchandizeDisputeProperties extends PayPalApiStruct
{
    #[OA\Property(type: 'string')]
    protected string $issueType;

    #[OA\Property(ref: ProductDetails::class)]
    protected ProductDetails $productDetails;

    #[OA\Property(ref: ServiceDetails::class)]
    protected ServiceDetails $serviceDetails;

    public function getIssueType(): string
    {
        return $this->issueType;
    }

    public function setIssueType(string $issueType): void
    {
        $this->issueType = $issueType;
    }

    public function getProductDetails(): ProductDetails
    {
        return $this->productDetails;
    }

    public function setProductDetails(ProductDetails $productDetails): void
    {
        $this->productDetails = $productDetails;
    }

    public function getServiceDetails(): ServiceDetails
    {
        return $this->serviceDetails;
    }

    public function setServiceDetails(ServiceDetails $serviceDetails): void
    {
        $this->serviceDetails = $serviceDetails;
    }
}
