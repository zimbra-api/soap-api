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
use Zimbra\Common\Struct\{IdAndType, WaitSetResp};
use Zimbra\Mail\Struct\AccountWithModifications;
use Zimbra\Soap\ResponseInterface;

/**
 * WaitSetResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class WaitSetResponse implements WaitSetResp, ResponseInterface
{
    /**
     * WaitSet ID
     * 
     * @Accessor(getter="getWaitSetId", setter="setWaitSetId")
     * @SerializedName("waitSet")
     * @Type("string")
     * @XmlAttribute
     */
    private $waitSetId;

    /**
     * 1(true) if canceled
     * 
     * @Accessor(getter="getCanceled", setter="setCanceled")
     * @SerializedName("canceled")
     * @Type("bool")
     * @XmlAttribute
     */
    private $canceled;

    /**
     * Sequence number
     * 
     * @Accessor(getter="getSeqNo", setter="setSeqNo")
     * @SerializedName("seq")
     * @Type("string")
     * @XmlAttribute
     */
    private $seqNo;

    /**
     * Information on signaled accounts.
     * If folder IDs are included then changes only affect those folders.
     * 
     * @Accessor(getter="getSignalledAccounts", setter="setSignalledAccounts")
     * @Type("array<Zimbra\Mail\Struct\AccountWithModifications>")
     * @XmlList(inline=true, entry="a", namespace="urn:zimbraMail")
     */
    private $signalledAccounts = [];

    /**
     * Error information
     * 
     * @Accessor(getter="getErrors", setter="setErrors")
     * @Type("array<Zimbra\Common\Struct\IdAndType>")
     * @XmlList(inline=true, entry="error", namespace="urn:zimbraMail")
     */
    private $errors = [];

    /**
     * Constructor method for WaitSetResponse
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
     * Gets waitSetId
     *
     * @return string
     */
    public function getWaitSetId(): string
    {
        return $this->waitSetId;
    }

    /**
     * Sets waitSetId
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
     * Gets canceled
     *
     * @return bool
     */
    public function getCanceled(): ?bool
    {
        return $this->canceled;
    }

    /**
     * Sets canceled
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
     * Gets seqNo
     *
     * @return string
     */
    public function getSeqNo(): ?string
    {
        return $this->seqNo;
    }

    /**
     * Sets seqNo
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
     * Add signalled account
     *
     * @param  AccountWithModifications $account
     * @return self
     */
    public function addSignalledAccount(AccountWithModifications $account): self
    {
        $this->signalledAccounts[] = $account;
        return $this;
    }

    /**
     * Sets signalledAccounts
     *
     * @param  array $accounts
     * @return self
     */
    public function setSignalledAccounts(array $accounts = []): self
    {
        $this->signalledAccounts = array_filter($accounts, static fn ($account) => $account instanceof AccountWithModifications);
        return $this;
    }

    /**
     * Gets signalledAccounts
     *
     * @return array
     */
    public function getSignalledAccounts(): array
    {
        return $this->signalledAccounts;
    }

    /**
     * Add error
     *
     * @param  IdAndType $error
     * @return self
     */
    public function addError(IdAndType $error): self
    {
        $this->errors[] = $error;
        return $this;
    }

    /**
     * Sets errors
     *
     * @param  array $errors
     * @return self
     */
    public function setErrors(array $errors = []): self
    {
        $this->errors = array_filter($errors, static fn ($error) => $error instanceof IdAndType);
        return $this;
    }

    /**
     * Gets errors
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}