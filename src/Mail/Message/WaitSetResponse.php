<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Mail\Struct\AccountWithModifications;
use Zimbra\Common\Struct\{IdAndType, SoapResponse, WaitSetResp};

/**
 * WaitSetResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class WaitSetResponse extends SoapResponse implements WaitSetResp
{
    /**
     * WaitSet ID
     * 
     * @Accessor(getter="getWaitSetId", setter="setWaitSetId")
     * @SerializedName("waitSet")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getWaitSetId', setter: 'setWaitSetId')]
    #[SerializedName('waitSet')]
    #[Type('string')]
    #[XmlAttribute]
    private $waitSetId;

    /**
     * 1(true) if canceled
     * 
     * @Accessor(getter="getCanceled", setter="setCanceled")
     * @SerializedName("canceled")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getCanceled', setter: 'setCanceled')]
    #[SerializedName('canceled')]
    #[Type('bool')]
    #[XmlAttribute]
    private $canceled;

    /**
     * Sequence number
     * 
     * @Accessor(getter="getSeqNo", setter="setSeqNo")
     * @SerializedName("seq")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getSeqNo', setter: 'setSeqNo')]
    #[SerializedName('seq')]
    #[Type('string')]
    #[XmlAttribute]
    private $seqNo;

    /**
     * Information on signaled accounts.
     * If folder IDs are included then changes only affect those folders.
     * 
     * @Accessor(getter="getSignalledAccounts", setter="setSignalledAccounts")
     * @Type("array<Zimbra\Mail\Struct\AccountWithModifications>")
     * @XmlList(inline=true, entry="a", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getSignalledAccounts', setter: 'setSignalledAccounts')]
    #[Type('array<Zimbra\Mail\Struct\AccountWithModifications>')]
    #[XmlList(inline: true, entry: 'a', namespace: 'urn:zimbraMail')]
    private $signalledAccounts = [];

    /**
     * Error information
     * 
     * @Accessor(getter="getErrors", setter="setErrors")
     * @Type("array<Zimbra\Common\Struct\IdAndType>")
     * @XmlList(inline=true, entry="error", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getErrors', setter: 'setErrors')]
    #[Type('array<Zimbra\Common\Struct\IdAndType>')]
    #[XmlList(inline: true, entry: 'error', namespace: 'urn:zimbraMail')]
    private $errors = [];

    /**
     * Constructor
     *
     * @param  string $waitSetId
     * @param  bool $canceled
     * @param  string $seqNo
     * @param  array $signalledAccounts
     * @param  array $errors
     * @return self
     */
    public function __construct(
        string $waitSetId = '',
        ?bool $canceled = NULL,
        ?string $seqNo = NULL,
        array $signalledAccounts = [],
        array $errors = []
    )
    {
        $this->setWaitSetId($waitSetId)
             ->setSignalledAccounts($signalledAccounts)
             ->setErrors($errors);
        if (NULL !== $canceled) {
            $this->setCanceled($canceled);
        }
        if (NULL !== $seqNo) {
            $this->setSeqNo($seqNo);
        }
    }

    /**
     * Get waitSetId
     *
     * @return string
     */
    public function getWaitSetId(): string
    {
        return $this->waitSetId;
    }

    /**
     * Set waitSetId
     *
     * @param  string $waitSetId
     * @return self
     */
    public function setWaitSetId(string $waitSetId): self
    {
        $this->waitSetId = $waitSetId;
        return $this;
    }

    /**
     * Get canceled
     *
     * @return bool
     */
    public function getCanceled(): ?bool
    {
        return $this->canceled;
    }

    /**
     * Set canceled
     *
     * @param  bool $canceled
     * @return self
     */
    public function setCanceled(bool $canceled): self
    {
        $this->canceled = $canceled;
        return $this;
    }

    /**
     * Get seqNo
     *
     * @return string
     */
    public function getSeqNo(): ?string
    {
        return $this->seqNo;
    }

    /**
     * Set seqNo
     *
     * @param  string $seqNo
     * @return self
     */
    public function setSeqNo(string $seqNo): self
    {
        $this->seqNo = $seqNo;
        return $this;
    }

    /**
     * Set signalledAccounts
     *
     * @param  array $accounts
     * @return self
     */
    public function setSignalledAccounts(array $accounts = []): self
    {
        $this->signalledAccounts = array_filter(
            $accounts, static fn ($account) => $account instanceof AccountWithModifications
        );
        return $this;
    }

    /**
     * Get signalledAccounts
     *
     * @return array
     */
    public function getSignalledAccounts(): array
    {
        return $this->signalledAccounts;
    }

    /**
     * Set errors
     *
     * @param  array $errors
     * @return self
     */
    public function setErrors(array $errors = []): self
    {
        $this->errors = array_filter(
            $errors, static fn ($error) => $error instanceof IdAndType
        );
        return $this;
    }

    /**
     * Get errors
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
