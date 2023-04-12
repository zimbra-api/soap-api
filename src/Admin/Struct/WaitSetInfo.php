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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class WaitSetInfo
{
    /**
     * WaitSet ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getWaitSetId', setter: 'setWaitSetId')]
    #[SerializedName('id')]
    #[Type('string')]
    #[XmlAttribute]
    private $waitSetId;

    /**
     * WaitSet owner account ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getOwner', setter: 'setOwner')]
    #[SerializedName('owner')]
    #[Type('string')]
    #[XmlAttribute]
    private $owner;

    /**
     * Default interest types: comma-separated list.
     * all: all types (equiv to "f,m,c,a,t,d") 
     * 
     * @var string
     */
    #[Accessor(getter: 'getDefaultInterests', setter: 'setDefaultInterests')]
    #[SerializedName('defTypes')]
    #[Type('string')]
    #[XmlAttribute]
    private $defaultInterests;

    /**
     * Last access date
     * 
     * @var int
     */
    #[Accessor(getter: 'getLastAccessDate', setter: 'setLastAccessDate')]
    #[SerializedName('ld')]
    #[Type('int')]
    #[XmlAttribute]
    private $lastAccessDate;

    /**
     * Error information
     * 
     * @var array
     */
    #[Accessor(getter: 'getErrors', setter: 'setErrors')]
    #[SerializedName('errors')]
    #[Type('array<Zimbra\Common\Struct\IdAndType>')]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    #[XmlList(inline: false, entry: 'error', namespace: 'urn:zimbraAdmin')]
    private $errors = [];

    /**
     * Comma separated list of account IDs
     * 
     * @var AccountsAttrib
     */
    #[Accessor(getter: 'getSignalledAccounts', setter: 'setSignalledAccounts')]
    #[SerializedName('ready')]
    #[Type(AccountsAttrib::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $signalledAccounts;

    /**
     * CB sequence number
     * 
     * @var string
     */
    #[Accessor(getter: 'getCbSeqNo', setter: 'setCbSeqNo')]
    #[SerializedName('cbSeqNo')]
    #[Type('string')]
    #[XmlAttribute]
    private $cbSeqNo;

    /**
     * Current sequence number
     * 
     * @var string
     */
    #[Accessor(getter: 'getCurrentSeqNo', setter: 'setCurrentSeqNo')]
    #[SerializedName('currentSeqNo')]
    #[Type('string')]
    #[XmlAttribute]
    private $currentSeqNo;

    /**
     * Next sequence number
     * 
     * @var string
     */
    #[Accessor(getter: 'getNextSeqNo', setter: 'setNextSeqNo')]
    #[SerializedName('nextSeqNo')]
    #[Type('string')]
    #[XmlAttribute]
    private $nextSeqNo;

    /**
     * Buffered commit information
     * 
     * @var array
     */
    #[Accessor(getter: 'getBufferedCommits', setter: 'setBufferedCommits')]
    #[SerializedName('buffered')]
    #[Type('array<Zimbra\Admin\Struct\BufferedCommitInfo>')]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    #[XmlList(inline: false, entry: 'commit', namespace: 'urn:zimbraAdmin')]
    private $bufferedCommits = [];

    /**
     * Session information
     * 
     * @var array
     */
    #[Accessor(getter: 'getSessions', setter: 'setSessions')]
    #[Type('array<Zimbra\Admin\Struct\SessionForWaitSet>')]
    #[XmlList(inline: true, entry: 'session', namespace: 'urn:zimbraAdmin')]
    private $sessions = [];

    /**
     * Constructor
     * 
     * @param string $waitSetId
     * @param string $owner
     * @param string $defaultInterests
     * @param int    $lastAccessDate
     * @param array $errors
     * @param AccountsAttrib $signalledAccounts
     * @param string $cbSeqNo
     * @param string $currentSeqNo
     * @param string $nextSeqNo
     * @param array $bufferedCommits
     * @param array $sessions
     * @return self
     */
    public function __construct(
        string $waitSetId = '',
        string $owner = '',
        string $defaultInterests = '',
        int $lastAccessDate = 0,
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
     * Set owner
     *
     * @return string
     */
    public function getOwner(): string
    {
        return $this->owner;
    }

    /**
     * Set owner
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
     * Set defaultInterests
     *
     * @return string
     */
    public function getDefaultInterests(): string
    {
        return $this->defaultInterests;
    }

    /**
     * Set defaultInterests
     *
     * @param  string $defaultInterests
     * @return self
     */
    public function setDefaultInterests(string $defaultInterests): self
    {
        $this->defaultInterests = $defaultInterests;
        return $this;
    }

    /**
     * Get lastAccessDate
     *
     * @return int
     */
    public function getLastAccessDate(): int
    {
        return $this->lastAccessDate;
    }

    /**
     * Set lastAccessDate
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
     * Get signalledAccounts
     *
     * @return AccountsAttrib
     */
    public function getSignalledAccounts(): ?AccountsAttrib
    {
        return $this->signalledAccounts;
    }

    /**
     * Set signalledAccounts
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
     * Get cbSeqNo
     *
     * @return string
     */
    public function getCbSeqNo(): ?string
    {
        return $this->cbSeqNo;
    }

    /**
     * Set cbSeqNo
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
     * Get changedFolders
     *
     * @return string
     */
    public function getCurrentSeqNo(): ?string
    {
        return $this->currentSeqNo;
    }

    /**
     * Set currentSeqNo
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
     * Get nextSeqNo
     *
     * @return string
     */
    public function getNextSeqNo(): ?string
    {
        return $this->nextSeqNo;
    }

    /**
     * Set nextSeqNo
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
     * Get error information
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Set error information
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
     * Get buffered commit information
     *
     * @return array
     */
    public function getBufferedCommits(): array
    {
        return $this->bufferedCommits;
    }

    /**
     * Set buffered commit information
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
     * Get session information
     *
     * @return array
     */
    public function getSessions(): array
    {
        return $this->sessions;
    }

    /**
     * Set session information
     *
     * @param  array $sessions
     * @return self
     */
    public function setSessions(array $sessions): self
    {
        $this->sessions = array_filter($sessions, static fn ($session) => $session instanceof SessionForWaitSet);
        return $this;
    }
}
