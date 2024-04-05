<?php
declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V1\Subscription\Subscriber;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;
use Swag\PayPalApp\Api\Struct\V1\Subscription\Subscriber\ShippingAddress\Address;
use Swag\PayPalApp\Api\Struct\V1\Subscription\Subscriber\ShippingAddress\Name;

/**
 * @codeCoverageIgnore
 *
 * @experimental
 *
 * This class is experimental and not officially supported.
 * It is currently not used within the plugin itself. Use with caution.
 */
#[OA\Schema(schema: 'swag_paypal_v1_subscription_subscriber_shipping_address')]
class ShippingAddress extends PayPalApiStruct
{
    #[OA\Property(ref: Name::class, nullable: true)]
    protected ?Name $name = null;

    #[OA\Property(ref: Address::class, nullable: true)]
    protected ?Address $address = null;

    public function getName(): ?Name
    {
        return $this->name;
    }

    public function setName(?Name $name): void
    {
        $this->name = $name;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): void
    {
        $this->address = $address;
    }
}
