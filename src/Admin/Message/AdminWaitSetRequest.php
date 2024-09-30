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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement,
    XmlList
};
use Zimbra\Common\Struct\{
    Id,
    SoapEnvelopeInterface,
    SoapRequest,
    WaitSetAddSpec
};

/**
 * AdminWaitSet request class
 * AdminWaitSetRequest optionally modifies the wait set and checks for any notifications.
 * If block=1 and there are no notifications, then this API will BLOCK until there is data.
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
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AdminWaitSetRequest extends SoapRequest
{
    /**
     * Waitset ID
     *
     * @var string
     */
    #[Accessor(getter: "getWaitSetId", setter: "setWaitSetId")]
    #[SerializedName("waitSet")]
    #[Type("string")]
    #[XmlAttribute]
    private $waitSetId;

    /**
     * Last known sequence number
     *
     * @var string
     */
    #[Accessor(getter: "getLastKnownSeqNo", setter: "setLastKnownSeqNo")]
    #[SerializedName("seq")]
    #[Type("string")]
    #[XmlAttribute]
    private $lastKnownSeqNo;

    /**
     * Flag whether or not to block until some account has new data
     *
     * @var bool
     */
    #[Accessor(getter: "getBlock", setter: "setBlock")]
    #[SerializedName("block")]
    #[Type("bool")]
    #[XmlAttribute]
    private $block;

    /**
     * If true, WaitSetResponse will include details of Pending Modifications.
     *
     * @var bool
     */
    #[Accessor(getter: "getExpand", setter: "setExpand")]
    #[SerializedName("expand")]
    #[Type("bool")]
    #[XmlAttribute]
    private $expand;

    /**
     * Default interest types: comma-separated list
     *
     * @var string
     */
    #[Accessor(getter: "getDefaultInterests", setter: "setDefaultInterests")]
    #[SerializedName("defTypes")]
    #[Type("string")]
    #[XmlAttribute]
    private $defaultInterests;

    /**
     * Timeout length
     *
     * @var int
     */
    #[Accessor(getter: "getTimeout", setter: "setTimeout")]
    #[SerializedName("timeout")]
    #[Type("int")]
    #[XmlAttribute]
    private $timeout;

    /**
     * Waitsets to add
     *
     * @var array
     */
    #[Accessor(getter: "getAddAccounts", setter: "setAddAccounts")]
    #[SerializedName("add")]
    #[Type("array<Zimbra\Common\Struct\WaitSetAddSpec>")]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    #[XmlList(inline: false, entry: "a", namespace: "urn:zimbraAdmin")]
    private $addAccounts = [];

    /**
     * Waitsets to update
     *
     * @var array
     */
    #[Accessor(getter: "getUpdateAccounts", setter: "setUpdateAccounts")]
    #[SerializedName("update")]
    #[Type("array<Zimbra\Common\Struct\WaitSetAddSpec>")]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    #[XmlList(inline: false, entry: "a", namespace: "urn:zimbraAdmin")]
    private $updateAccounts = [];

    /**
     * Waitsets to remove
     *
     * @var array
     */
    #[Accessor(getter: "getRemoveAccounts", setter: "setRemoveAccounts")]
    #[SerializedName("remove")]
    #[Type("array<Zimbra\Common\Struct\Id>")]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    #[XmlList(inline: false, entry: "a", namespace: "urn:zimbraAdmin")]
    private $removeAccounts = [];

    /**
     * Constructor
     *
     * @param string $waitSetId
     * @param string $lastKnownSeqNo
     * @param bool   $block
     * @param bool   $expand
     * @param string $defaultInterests
     * @param int    $timeout
     * @param array  $addAccounts
     * @param array  $updateAccounts
     * @param array  $removeAccounts
     * @return self
     */
    public function __construct(
        string $waitSetId = "",
        string $lastKnownSeqNo = "",
        ?bool $block = null,
        ?bool $expand = null,
        ?string $defaultInterests = null,
        ?int $timeout = null,
        array $addAccounts = [],
        array $updateAccounts = [],
        array $removeAccounts = []
    ) {
        $this->setWaitSetId($waitSetId)
            ->setLastKnownSeqNo($lastKnownSeqNo)
            ->setAddAccounts($addAccounts)
            ->setUpdateAccounts($updateAccounts)
            ->setRemoveAccounts($removeAccounts);
        if (null !== $block) {
            $this->setBlock($block);
        }
        if (null !== $expand) {
            $this->setExpand($expand);
        }
        if (null !== $defaultInterests) {
            $this->setDefaultInterests($defaultInterests);
        }
        if (null !== $timeout) {
            $this->setTimeout($timeout);
        }
    }

    /**
     * Get Waitset ID
     *
     * @return string
     */
    public function getWaitSetId(): ?string
    {
        return $this->waitSetId;
    }

    /**
     * Set Waitset ID
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
     * Get last known sequence number
     *
     * @return string
     */
    public function getLastKnownSeqNo(): ?string
    {
        return $this->lastKnownSeqNo;
    }

    /**
     * Set last known sequence number
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
        $this->defaultInterests = $defaultInterests;
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
     * Get Waitsets to add.
     *
     * @return array
     */
    public function getAddAccounts(): array
    {
        return $this->addAccounts;
    }

    /**
     * Set Waitsets to add.
     *
     * @param  array $accounts
     * @return self
     */
    public function setAddAccounts(array $accounts): self
    {
        $this->addAccounts = array_filter(
            $accounts,
            static fn($account) => $account instanceof WaitSetAddSpec
        );
        return $this;
    }

    /**
     * Add WaitSet
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
     * Get Waitsets to update.
     *
     * @return array
     */
    public function getUpdateAccounts(): array
    {
        return $this->updateAccounts;
    }

    /**
     * Set Waitsets to update.
     *
     * @param  array $accounts
     * @return self
     */
    public function setUpdateAccounts(array $accounts): self
    {
        $this->updateAccounts = array_filter(
            $accounts,
            static fn($account) => $account instanceof WaitSetAddSpec
        );
        return $this;
    }

    /**
     * Add Waitsets to update
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
     * Get Waitsets to remove.
     *
     * @return array
     */
    public function getRemoveAccounts(): array
    {
        return $this->removeAccounts;
    }

    /**
     * Set Waitsets to remove.
     *
     * @param  array $accounts
     * @return self
     */
    public function setRemoveAccounts(array $accounts): self
    {
        $this->removeAccounts = array_filter(
            $accounts,
            static fn($account) => $account instanceof Id
        );
        return $this;
    }

    /**
     * Add Waitsets to remove.
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new AdminWaitSetEnvelope(new AdminWaitSetBody($this));
    }
}
