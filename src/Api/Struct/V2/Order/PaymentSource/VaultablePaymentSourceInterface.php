<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V2\Order\PaymentSource;

use Swag\PayPalApp\Api\Struct\V2\Order\PaymentSource\Common\Attributes;

interface VaultablePaymentSourceInterface
{
    public function getAttributes(): ?Attributes;

    public function setAttributes(?Attributes $attributes): void;

    public function getVaultIdentifier(): string;
}
