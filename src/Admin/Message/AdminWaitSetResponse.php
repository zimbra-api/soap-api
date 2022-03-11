<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Mail\Struct\AccountWithModifications;
use Zimbra\Soap\ResponseInterface;
use Zimbra\Struct\IdAndType;

/**
 * AdminWaitSetResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AdminWaitSetResponse implements ResponseInterface
{
    /**
     * WaitSet ID
     * @Accessor(getter="getWaitSetId", setter="setWaitSetId")
     * @SerializedName("waitSet")
     * @Type("string")
     * @XmlAttribute
     */
    private $waitSetId;

    /**
     * canceled flag
     * @Accessor(getter="getCanceled", setter="setCanceled")
     * @SerializedName("canceled")
     * @Type("bool")
     * @XmlAttribute
     */
    private $canceled;

    /**
     * Sequence number
     * @Accessor(getter="getSeqNo", setter="setSeqNo")
     * @SerializedName("seq")
     * @Type("string")
     * @XmlAttribute
     */
    private $seqNo;

    /**
     * Information on signaled accounts.
     * @Accessor(getter="getSignalledAccounts", setter="setSignalledAccounts")
     * @SerializedName("a")
     * @Type("array<Zimbra\Mail\Struct\AccountWithModifications>")
     * @XmlList(inline = true, entry = "a")
     */
    private $signalledAccounts;

    /**
     * Error information
     * @Accessor(getter="getErrors", setter="setErrors")
     * @SerializedName("error")
     * @Type("array<Zimbra\Struct\IdAndType>")
     * @XmlList(inline = true, entry = "error")
     */
    private $errors;

    /**
     * Constructor method for AdminWaitSetResponse
     * 
     * @param string $waitSetId
     * @param bool   $canceled
     * @param string $seqNo
     * @param array  $signalledAccounts
     * @param array  $errors
     * @return self
     */
    public function __construct(
        string $waitSetId, ?bool $canceled = NULL, ?string $seqNo = NULL, array $signalledAccounts = [], array $errors = []
    )
    {
        $this->setWaitSetId($waitSetId);
        if (NULL !== $canceled) {
            $this->setCanceled($canceled);
        }
        if (NULL !== $seqNo) {
            $this->setSeqNo($seqNo);
        }
        $this->setSignalledAccounts($signalledAccounts)
             ->setErrors($errors);
    }

    /**
     * Gets WaitSet ID
     *
     * @return string
     */
    public function getWaitSetId(): ?string
    {
        return $this->waitSetId;
    }

    /**
     * Sets WaitSet ID
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
     * Gets sequence number
     *
     * @return string
     */
    public function getSeqNo(): ?string
    {
        return $this->seqNo;
    }

    /**
     * Sets sequence number
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
     * Add signaled account
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
     * Sets signaled accounts
     *
     * @param array $errors
     * @return self
     */
    public function setSignalledAccounts(array $signalledAccounts): self
    {
        $this->signalledAccounts = [];
        foreach ($signalledAccounts as $account) {
            if ($account instanceof AccountWithModifications) {
                $this->signalledAccounts[] = $account;
            }
        }
        return $this;
    }

    /**
     * Gets signaled account
     *
     * @return array
     */
    public function getSignalledAccounts(): array
    {
        return $this->signalledAccounts;
    }

    /**
     * Add error information
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
     * Sets error information
     *
     * @param array $errors
     * @return self
     */
    public function setErrors(array $errors): self
    {
        $this->errors = [];
        foreach ($errors as $error) {
            if ($error instanceof IdAndType) {
                $this->errors[] = $error;
            }
        }
        return $this;
    }

    /**
     * Gets error information
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
