<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};
use Zimbra\Common\Struct\IdAndType;

/**
 * WaitSetInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class WaitSetInfo
{
    /**
     * WaitSet ID
     * @Accessor(getter="getWaitSetId", setter="setWaitSetId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $waitSetId;

    /**
     * WaitSet owner account ID
     * @Accessor(getter="getOwner", setter="setOwner")
     * @SerializedName("owner")
     * @Type("string")
     * @XmlAttribute
     */
    private $owner;

    /**
     * Default interest types: comma-separated list.
     * all: all types (equiv to "f,m,c,a,t,d") 
     * @Accessor(getter="getDefaultInterests", setter="setDefaultInterests")
     * @SerializedName("defTypes")
     * @Type("string")
     * @XmlAttribute
     */
    private $defaultInterests;

    /**
     * Last access date
     * @Accessor(getter="getLastAccessDate", setter="setLastAccessDate")
     * @SerializedName("ld")
     * @Type("integer")
     * @XmlAttribute
     */
    private $lastAccessDate;

    /**
     * Error information
     * @Accessor(getter="getErrors", setter="setErrors")
     * @SerializedName("errors")
     * @Type("array<Zimbra\Common\Struct\IdAndType>")
     * @XmlList(inline=false, entry="error", namespace="urn:zimbraAdmin")
     */
    private $errors = [];

    /**
     * Comma separated list of account IDs
     * @Accessor(getter="getSignalledAccounts", setter="setSignalledAccounts")
     * @SerializedName("ready")
     * @Type("Zimbra\Admin\Struct\AccountsAttrib")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?AccountsAttrib $signalledAccounts = NULL;

    /**
     * CB sequence number
     * @Accessor(getter="getCbSeqNo", setter="setCbSeqNo")
     * @SerializedName("cbSeqNo")
     * @Type("string")
     * @XmlAttribute
     */
    private $cbSeqNo;

    /**
     * Current sequence number
     * @Accessor(getter="getCurrentSeqNo", setter="setCurrentSeqNo")
     * @SerializedName("currentSeqNo")
     * @Type("string")
     * @XmlAttribute
     */
    private $currentSeqNo;

    /**
     * Next sequence number
     * @Accessor(getter="getNextSeqNo", setter="setNextSeqNo")
     * @SerializedName("nextSeqNo")
     * @Type("string")
     * @XmlAttribute
     */
    private $nextSeqNo;

    /**
     * Buffered commit information
     * @Accessor(getter="getBufferedCommits", setter="setBufferedCommits")
     * @SerializedName("buffered")
     * @Type("array<Zimbra\Admin\Struct\BufferedCommitInfo>")
     * @XmlList(inline=false, entry="commit", namespace="urn:zimbraAdmin")
     */
    private $bufferedCommits = [];

    /**
     * Session information
     * @Accessor(getter="getSessions", setter="setSessions")
     * @SerializedName("session")
     * @Type("array<Zimbra\Admin\Struct\SessionForWaitSet>")
     * @XmlList(inline=true, entry="session", namespace="urn:zimbraAdmin")
     */
    private $sessions = [];

    /**
     * Constructor method for WaitSetInfo
     * 
     * @param string $waitSetId
     * @param string $owner
     * @param string $defaultInterests
     * @param int    $lastAccessDate
     * @param array $errors
     * @param string $signalledAccounts
     * @param string $cbSeqNo
     * @param string $currentSeqNo
     * @param string $nextSeqNo
     * @param array $bufferedCommits
     * @param array $sessions
     * @return self
     */
    public function __construct(
        string $waitSetId,
        string $owner,
        string $defaultInterests,
        int $lastAccessDate,
        array $errors = [],
        ?AccountsAttrib $signalledAccounts = NULL,
        ?string $cbSeqNo = NULL,
        ?string $currentSeqNo = NULL,
        ?string $nextSeqNo = NULL,
        array $bufferedCommits = [],
        array $sessions = []
    )
    {
        $this->setWaitSetId($waitSetId)
             ->setOwner($owner)
             ->setDefaultInterests($defaultInterests)
             ->setLastAccessDate($lastAccessDate)
             ->setErrors($errors)
             ->setBufferedCommits($bufferedCommits)
             ->setSessions($sessions);
        if ($signalledAccounts instanceof AccountsAttrib) {
            $this->setSignalledAccounts($signalledAccounts);
        }
        if (NULL !== $cbSeqNo) {
            $this->setCbSeqNo($cbSeqNo);
        }
        if (NULL !== $currentSeqNo) {
            $this->setCurrentSeqNo($currentSeqNo);
        }
        if (NULL !== $nextSeqNo) {
            $this->setNextSeqNo($nextSeqNo);
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
     * Sets owner
     *
     * @return string
     */
    public function getOwner(): string
    {
        return $this->owner;
    }

    /**
     * Sets owner
     *
     * @param  string $owner
     * @return self
     */
    public function setOwner(string $owner): self
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * Sets defaultInterests
     *
     * @return string
     */
    public function getDefaultInterests(): string
    {
        return $this->defaultInterests;
    }

    /**
     * Sets defaultInterests
     *
     * @param  int $defaultInterests
     * @return self
     */
    public function setDefaultInterests(string $defaultInterests): self
    {
        $this->defaultInterests = $defaultInterests;
        return $this;
    }

    /**
     * Gets lastAccessDate
     *
     * @return int
     */
    public function getLastAccessDate(): int
    {
        return $this->lastAccessDate;
    }

    /**
     * Sets lastAccessDate
     *
     * @param  int $lastAccessDate
     * @return self
     */
    public function setLastAccessDate(int $lastAccessDate): self
    {
        $this->lastAccessDate = $lastAccessDate;
        return $this;
    }

    /**
     * Gets signalledAccounts
     *
     * @return AccountsAttrib
     */
    public function getSignalledAccounts(): ?AccountsAttrib
    {
        return $this->signalledAccounts;
    }

    /**
     * Sets signalledAccounts
     *
     * @param  AccountsAttrib $signalledAccounts
     * @return self
     */
    public function setSignalledAccounts(AccountsAttrib $signalledAccounts): self
    {
        $this->signalledAccounts = $signalledAccounts;
        return $this;
    }

    /**
     * Gets cbSeqNo
     *
     * @return string
     */
    public function getCbSeqNo(): ?string
    {
        return $this->cbSeqNo;
    }

    /**
     * Sets cbSeqNo
     *
     * @param  string $cbSeqNo
     * @return self
     */
    public function setCbSeqNo(string $cbSeqNo): self
    {
        $this->cbSeqNo = $cbSeqNo;
        return $this;
    }

    /**
     * Gets changedFolders
     *
     * @return string
     */
    public function getCurrentSeqNo(): ?string
    {
        return $this->currentSeqNo;
    }

    /**
     * Sets currentSeqNo
     *
     * @param  string $currentSeqNo
     * @return self
     */
    public function setCurrentSeqNo(string $currentSeqNo): self
    {
        $this->currentSeqNo = $currentSeqNo;
        return $this;
    }

    /**
     * Gets nextSeqNo
     *
     * @return string
     */
    public function getNextSeqNo(): ?string
    {
        return $this->nextSeqNo;
    }

    /**
     * Sets nextSeqNo
     *
     * @param  string $nextSeqNo
     * @return self
     */
    public function setNextSeqNo(string $nextSeqNo): self
    {
        $this->nextSeqNo = $nextSeqNo;
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

    /**
     * Sets error information
     *
     * @param  array $errors
     * @return self
     */
    public function setErrors(array $errors): self
    {
        $this->errors = array_filter($errors, static fn ($error) => $error instanceof IdAndType);
        return $this;
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
     * Gets buffered commit information
     *
     * @return array
     */
    public function getBufferedCommits(): array
    {
        return $this->bufferedCommits;
    }

    /**
     * Sets buffered commit information
     *
     * @param  array $commits
     * @return self
     */
    public function setBufferedCommits(array $commits): self
    {
        $this->bufferedCommits = array_filter($commits, static fn ($commit) => $commit instanceof BufferedCommitInfo);
        return $this;
    }

    /**
     * Add buffered commit information
     *
     * @param  BufferedCommitInfo $commit
     * @return self
     */
    public function addBufferedCommit(BufferedCommitInfo $commit): self
    {
        $this->bufferedCommits[] = $commit;
        return $this;
    }

    /**
     * Gets session information
     *
     * @return array
     */
    public function getSessions(): array
    {
        return $this->sessions;
    }

    /**
     * Sets session information
     *
     * @param  array $sessions
     * @return self
     */
    public function setSessions(array $sessions): self
    {
        $this->sessions = array_filter($sessions, static fn ($session) => $session instanceof SessionForWaitSet);
        return $this;
    }

    /**
     * Add session information
     *
     * @param  SessionForWaitSet $session
     * @return self
     */
    public function addSession(SessionForWaitSet $session): self
    {
        $this->sessions[] = $session;
        return $this;
    }
}
