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
use Swag\PayPalApp\Api\Struct\V1\Payment\ApplicationContext;
use Swag\PayPalApp\Api\Struct\V1\Payment\Payer;
use Swag\PayPalApp\Api\Struct\V1\Payment\PaymentInstruction;
use Swag\PayPalApp\Api\Struct\V1\Payment\RedirectUrls;
use Swag\PayPalApp\Api\Struct\V1\Payment\TransactionCollection;
use Swag\PayPalApp\Api\Struct\V1\PaymentIntentV1;

#[OA\Schema(schema: 'swag_paypal_v1_payment')]
class Payment extends PayPalApiStruct
{
    public const PAYMENT_INTENT_SALE = 'sale';
    public const PAYMENT_INTENT_AUTHORIZE = 'authorize';
    public const PAYMENT_INTENT_ORDER = 'order';

    #[OA\Property(type: 'string')]
    protected string $id;

    #[OA\Property(type: 'string', default: self::PAYMENT_INTENT_SALE, enum: [self::PAYMENT_INTENT_SALE, self::PAYMENT_INTENT_AUTHORIZE, self::PAYMENT_INTENT_ORDER])]
    protected string $intent = self::PAYMENT_INTENT_SALE;

    #[OA\Property(type: 'string')]
    protected string $state;

    #[OA\Property(type: 'string')]
    protected string $cart;

    #[OA\Property(ref: Payer::class)]
    protected Payer $payer;

    #[OA\Property(type: 'array', items: new OA\Items(ref: Payment\Transaction::class))]
    protected TransactionCollection $transactions;

    #[OA\Property(type: 'string')]
    protected string $createTime;

    #[OA\Property(type: 'string')]
    protected string $updateTime;

    #[OA\Property(type: 'array', items: new OA\Items(ref: Link::class))]
    protected LinkCollection $links;

    #[OA\Property(ref: RedirectUrls::class)]
    protected RedirectUrls $redirectUrls;

    #[OA\Property(ref: ApplicationContext::class)]
    protected ApplicationContext $applicationContext;

    #[OA\Property(ref: PaymentInstruction::class, nullable: true)]
    protected ?PaymentInstruction $paymentInstruction = null;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getIntent(): string
    {
        return $this->intent;
    }

    public function setIntent(string $intent): void
    {
        $this->intent = $intent;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getCart(): string
    {
        return $this->cart;
    }

    public function setCart(string $cart): void
    {
        $this->cart = $cart;
    }

    public function getPayer(): Payer
    {
        return $this->payer;
    }

    public function setPayer(Payer $payer): void
    {
        $this->payer = $payer;
    }

    public function getTransactions(): TransactionCollection
    {
        return $this->transactions;
    }

    public function setTransactions(TransactionCollection $transactions): void
    {
        $this->transactions = $transactions;
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

    public function getRedirectUrls(): RedirectUrls
    {
        return $this->redirectUrls;
    }

    public function setRedirectUrls(RedirectUrls $redirectUrls): void
    {
        $this->redirectUrls = $redirectUrls;
    }

    public function getApplicationContext(): ApplicationContext
    {
        return $this->applicationContext;
    }

    public function setApplicationContext(ApplicationContext $applicationContext): void
    {
        $this->applicationContext = $applicationContext;
    }

    public function getPaymentInstruction(): ?PaymentInstruction
    {
        return $this->paymentInstruction;
    }

    public function setPaymentInstruction(?PaymentInstruction $paymentInstruction): void
    {
        $this->paymentInstruction = $paymentInstruction;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        unset($data['payment_instruction']);

        return $data;
    }
}
