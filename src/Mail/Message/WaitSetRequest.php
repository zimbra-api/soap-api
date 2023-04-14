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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};
use Zimbra\Common\Enum\InterestType;
use Zimbra\Common\Struct\{Id, SoapEnvelopeInterface, SoapRequest, WaitSetReq, WaitSetAddSpec};

/**
 * WaitSetRequest class
 * WaitSetRequest optionally modifies the wait set and checks for any notifications.
 * If <block> is set and there are no notifications, then this API will BLOCK until there is data.
 * 
 * Client should always set 'seq' to be the highest known value it has received from the server.  The server will use
 * this information to retransmit lost data.
 * 
 * If the client sends a last known sync token then the notification is calculated by comparing the accounts current
 * token with the client's last known.
 * 
 * If the client does not send a last known sync token, then notification is based on change since last Wait
 * (or change since &lt;add> if this is the first time Wait has been called with the account)
 * 
 * The client may specify a custom timeout-length for their request if they know something about the particular
 * underlying network.  The server may or may not honor this request (depending on server configured max/min values).
 * See LocalConfig values:
 * - zimbra_waitset_default_request_timeout,
 * - zimbra_waitset_min_request_timeout,
 * - zimbra_waitset_max_request_timeout,
 * - zimbra_admin_waitset_default_request_timeout,
 * - zimbra_admin_waitset_min_request_timeout, and
 * - zimbra_admin_waitset_max_request_timeout
 * WaitSet: scalable mechanism for listening for changes to one or more accounts
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class WaitSetRequest extends SoapRequest implements WaitSetReq
{
    /**
     * Waitset ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getWaitSetId', setter: 'setWaitSetId')]
    #[SerializedName('waitSet')]
    #[Type('string')]
    #[XmlAttribute]
    private $waitSetId;

    /**
     * Last known lastKnownSeqNo number
     * 
     * @var string
     */
    #[Accessor(getter: 'getLastKnownSeqNo', setter: 'setLastKnownSeqNo')]
    #[SerializedName('seq')]
    #[Type('string')]
    #[XmlAttribute]
    private $lastKnownSeqNo;

    /**
     * Flag whether or not to block until some account has new data
     * 
     * @var bool
     */
    #[Accessor(getter: 'getBlock', setter: 'setBlock')]
    #[SerializedName('block')]
    #[Type('bool')]
    #[XmlAttribute]
    private $block;

    /**
     * Default interest types: comma-separated list.  Currently:
     * f: folders
     * m: messages
     * c: contacts
     * a: appointments
     * t: tasks
     * d: documents
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
     * Timeout length
     * 
     * @var int
     */
    #[Accessor(getter: 'getTimeout', setter: 'setTimeout')]
    #[SerializedName('timeout')]
    #[Type('int')]
    #[XmlAttribute]
    private $timeout;

    /**
     * bool flag. If true, WaitSetResponse will include details of Pending Modifications.
     * 
     * @var bool
     */
    #[Accessor(getter: 'getExpand', setter: 'setExpand')]
    #[SerializedName('expand')]
    #[Type('bool')]
    #[XmlAttribute]
    private $expand;

    /**
     * Waitsets to add
     * 
     * @var array
     */
    #[Accessor(getter: 'getAddAccounts', setter: 'setAddAccounts')]
    #[SerializedName('add')]
    #[Type('array<Zimbra\Common\Struct\WaitSetAddSpec>')]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    #[XmlList(inline: false, entry: 'a', namespace: 'urn:zimbraMail')]
    private $addAccounts = [];

    /**
     * Waitsets to update
     * 
     * @var array
     */
    #[Accessor(getter: 'getUpdateAccounts', setter: 'setUpdateAccounts')]
    #[SerializedName('update')]
    #[Type('array<Zimbra\Common\Struct\WaitSetAddSpec>')]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    #[XmlList(inline: false, entry: 'a', namespace: 'urn:zimbraMail')]
    private $updateAccounts = [];

    /**
     * Waitsets to remove
     * 
     * @var array
     */
    #[Accessor(getter: 'getRemoveAccounts', setter: 'setRemoveAccounts')]
    #[SerializedName('remove')]
    #[Type('array<Zimbra\Common\Struct\Id>')]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    #[XmlList(inline: false, entry: 'a', namespace: 'urn:zimbraMail')]
    private $removeAccounts = [];

    /**
     * Constructor
     *
     * @param  string $waitSetId
     * @param  string $lastKnownSeqNo
     * @param  bool $block
     * @param  string $defaultInterests
     * @param  int $timeout
     * @param  bool $expand
     * @param  array $addAccounts
     * @param  array $updateAccounts
     * @param  array $removeAccounts
     * @return self
     */
    public function __construct(
        string $waitSetId = '',
        string $lastKnownSeqNo = '',
        ?bool $block = NULL,
        ?string $defaultInterests = NULL,
        ?int $timeout = NULL,
        ?bool $expand = NULL,
        array $addAccounts = [],
        array $updateAccounts = [],
        array $removeAccounts = []
    )
    {
        $this->setWaitSetId($waitSetId)
             ->setLastKnownSeqNo($lastKnownSeqNo)
             ->setAddAccounts($addAccounts)
             ->setUpdateAccounts($updateAccounts)
             ->setRemoveAccounts($removeAccounts);
        if (NULL !== $block) {
            $this->setBlock($block);
        }
        if (NULL !== $defaultInterests) {
            $this->setDefaultInterests($defaultInterests);
        }
        if (NULL !== $timeout) {
            $this->setTimeout($timeout);
        }
        if (NULL !== $expand) {
            $this->setExpand($expand);
        }
    }

    /**
     * Get waitSetId
     *
     * @return string
     */
    public function getWaitSetId(): ?string
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
     * Get lastKnownSeqNo
     *
     * @return string
     */
    public function getLastKnownSeqNo(): ?string
    {
        return $this->lastKnownSeqNo;
    }

    /**
     * Set lastKnownSeqNo
     *
     * @param  string $lastKnownSeqNo
     * @return self
     */
    public function setLastKnownSeqNo(string $lastKnownSeqNo): self
    {
        $this->lastKnownSeqNo = $lastKnownSeqNo;
        return $this;
    }

    /**
     * Get block
     *
     * @return bool
     */
    public function getBlock(): ?bool
    {
        return $this->block;
    }

    /**
     * Set block
     *
     * @param  bool $block
     * @return self
     */
    public function setBlock(bool $block): self
    {
        $this->block = $block;
        return $this;
    }

    /**
     * Get defaultInterests
     *
     * @return string
     */
    public function getDefaultInterests(): ?string
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
        $types = array_filter(
            explode(',', $defaultInterests), static fn ($type) => InterestType::tryFrom($type)
        );
        $this->defaultInterests = implode(',', array_unique($types));
        return $this;
    }

    /**
     * Get timeout
     *
     * @return int
     */
    public function getTimeout(): ?int
    {
        return $this->timeout;
    }

    /**
     * Set timeout
     *
     * @param  int $timeout
     * @return self
     */
    public function setTimeout(int $timeout): self
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * Get expand
     *
     * @return bool
     */
    public function getExpand(): ?bool
    {
        return $this->expand;
    }

    /**
     * Set expand
     *
     * @param  bool $expand
     * @return self
     */
    public function setExpand(bool $expand): self
    {
        $this->expand = $expand;
        return $this;
    }

    /**
     * Add add account
     *
     * @param  WaitSetAddSpec $account
     * @return self
     */
    public function addAddAccount(WaitSetAddSpec $account): self
    {
        $this->addAccounts[] = $account;
        return $this;
    }

    /**
     * Set addAccounts
     *
     * @param  array $accounts
     * @return self
     */
    public function setAddAccounts(array $accounts): self
    {
        $this->addAccounts = array_filter(
            $accounts, static fn ($account) => $account instanceof WaitSetAddSpec
        );
        return $this;
    }

    /**
     * Get addAccounts
     *
     * @return array
     */
    public function getAddAccounts(): array
    {
        return $this->addAccounts;
    }

    /**
     * Add update account
     *
     * @param  WaitSetAddSpec $account
     * @return self
     */
    public function addUpdateAccount(WaitSetAddSpec $account): self
    {
        $this->updateAccounts[] = $account;
        return $this;
    }

    /**
     * Set updateAccounts
     *
     * @param  array $accounts
     * @return self
     */
    public function setUpdateAccounts(array $accounts): self
    {
        $this->updateAccounts = array_filter(
            $accounts, static fn ($account) => $account instanceof WaitSetAddSpec
        );
        return $this;
    }

    /**
     * Get updateAccounts
     *
     * @return array
     */
    public function getUpdateAccounts(): array
    {
        return $this->updateAccounts;
    }

    /**
     * Remove account
     *
     * @param  Id $account
     * @return self
     */
    public function addRemoveAccount(Id $account): self
    {
        $this->removeAccounts[] = $account;
        return $this;
    }

    /**
     * Set removeAccounts
     *
     * @param  array $removeAccounts
     * @return self
     */
    public function setRemoveAccounts(array $removeAccounts): self
    {
        $this->removeAccounts = array_filter(
            $removeAccounts, static fn ($account) => $account instanceof Id
        );
        return $this;
    }

    /**
     * Get removeAccounts
     *
     * @return array
     */
    public function getRemoveAccounts(): array
    {
        return $this->removeAccounts;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new WaitSetEnvelope(
            new WaitSetBody($this)
        );
    }
}
