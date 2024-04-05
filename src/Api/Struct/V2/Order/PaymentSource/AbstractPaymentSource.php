<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPalApp\Api\Struct\V2\Order\PaymentSource;

use OpenApi\Attributes as OA;
use Swag\PayPalApp\Api\Struct\PayPalApiStruct;
use Swag\PayPalApp\Api\Struct\V2\Order\PaymentSource\Common\ExperienceContext;

abstract class AbstractPaymentSource extends PayPalApiStruct
{
    #[OA\Property(ref: ExperienceContext::class)]
    protected ExperienceContext $experienceContext;

    public function getExperienceContext(): ExperienceContext
    {
        return $this->experienceContext;
    }

    public function setExperienceContext(ExperienceContext $experienceContext): void
    {
        $this->experienceContext = $experienceContext;
    }
}
