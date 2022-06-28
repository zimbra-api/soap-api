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
use Zimbra\Common\Struct\{Id, WaitSetAddSpec};
use Zimbra\Soap\{EnvelopeInterface, Request};

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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AdminWaitSetRequest extends Request
{
    /**
     * Waitset ID
     * @Accessor(getter="getWaitSetId", setter="setWaitSetId")
     * @SerializedName("waitSet")
     * @Type("string")
     * @XmlAttribute
     */
    private $waitSetId;

    /**
     * Last known sequence number
     * @Accessor(getter="getLastKnownSeqNo", setter="setLastKnownSeqNo")
     * @SerializedName("seq")
     * @Type("string")
     * @XmlAttribute
     */
    private $lastKnownSeqNo;

    /**
     * Flag whether or not to block until some account has new data
     * @Accessor(getter="getBlock", setter="setBlock")
     * @SerializedName("block")
     * @Type("bool")
     * @XmlAttribute
     */
    private $block;

    /**
     * If true, WaitSetResponse will include details of Pending Modifications.
     * @Accessor(getter="getExpand", setter="setExpand")
     * @SerializedName("expand")
     * @Type("bool")
     * @XmlAttribute
     */
    private $expand;

    /**
     * Default interest types: comma-separated list
     * @Accessor(getter="getDefaultInterests", setter="setDefaultInterests")
     * @SerializedName("defTypes")
     * @Type("string")
     * @XmlAttribute
     */
    private $defaultInterests;

    /**
     * Timeout length
     * @Accessor(getter="getTimeout", setter="setTimeout")
     * @SerializedName("timeout")
     * @Type("int")
     * @XmlAttribute
     */
    private $timeout;

    /**
     * Waitsets to add
     * @Accessor(getter="getAddAccounts", setter="setAddAccounts")
     * @SerializedName("add")
     * @Type("array<Zimbra\Common\Struct\WaitSetAddSpec>")
     * @XmlList(inline=false, entry="a", namespace="urn:zimbraAdmin")
     */
    private $addAccounts = [];

    /**
     * Waitsets to update
     * @Accessor(getter="getUpdateAccounts", setter="setUpdateAccounts")
     * @SerializedName("update")
     * @Type("array<Zimbra\Common\Struct\WaitSetAddSpec>")
     * @XmlList(inline=false, entry="a", namespace="urn:zimbraAdmin")
     */
    private $updateAccounts = [];

    /**
     * Waitsets to remove
     * @Accessor(getter="getRemoveAccounts", setter="setRemoveAccounts")
     * @SerializedName("remove")
     * @Type("array<Zimbra\Common\Struct\Id>")
     * @XmlList(inline=false, entry="a", namespace="urn:zimbraAdmin")
     */
    private $removeAccounts = [];

    /**
     * Constructor method for AdminWaitSetRequest
     * 
     * @param string  $waitSetId
     * @param string  $lastKnownSeqNo
     * @param bool  $block
     * @param bool  $expand
     * @param string  $defaultInterests
     * @param int  $timeout
     * @param array  $addAccounts
     * @param array  $updateAccounts
     * @param array  $removeAccounts
     * @return self
     */
    public function __construct(
        string $waitSetId = '',
        string $lastKnownSeqNo = '',
        ?bool $block = NULL,
        ?bool $expand = NULL,
        ?string $defaultInterests = NULL,
        ?int $timeout = NULL,
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
        if (NULL !== $expand) {
            $this->setExpand($expand);
        }
        if (NULL !== $defaultInterests) {
            $this->setDefaultInterests($defaultInterests);
        }
        if (NULL !== $timeout) {
            $this->setTimeout($timeout);
        }
    }

    /**
     * Gets Waitset ID
     *
     * @return string
     */
    public function getWaitSetId(): ?string
    {
        return $this->waitSetId;
    }

    /**
     * Sets Waitset ID
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
     * Gets last known sequence number
     *
     * @return string
     */
    public function getLastKnownSeqNo(): ?string
    {
        return $this->lastKnownSeqNo;
    }

    /**
     * Sets last known sequence number
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
     * Gets block
     *
     * @return bool
     */
    public function getBlock(): ?bool
    {
        return $this->block;
    }

    /**
     * Sets block
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
     * Gets expand
     *
     * @return bool
     */
    public function getExpand(): ?bool
    {
        return $this->expand;
    }

    /**
     * Sets expand
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
     * Gets defaultInterests
     *
     * @return string
     */
    public function getDefaultInterests(): ?string
    {
        return $this->defaultInterests;
    }

    /**
     * Sets defaultInterests
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
     * Gets timeout
     *
     * @return int
     */
    public function getTimeout(): ?int
    {
        return $this->timeout;
    }

    /**
     * Sets timeout
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
     * Gets Waitsets to add.
     *
     * @return array
     */
    public function getAddAccounts(): array
    {
        return $this->addAccounts;
    }

    /**
     * Sets Waitsets to add.
     *
     * @param  array $accounts
     * @return self
     */
    public function setAddAccounts(array $accounts): self
    {
        $this->addAccounts = array_filter($accounts, static fn ($account) => $account instanceof WaitSetAddSpec);
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
     * Gets Waitsets to update.
     *
     * @return array
     */
    public function getUpdateAccounts(): array
    {
        return $this->updateAccounts;
    }

    /**
     * Sets Waitsets to update.
     *
     * @param  array $accounts
     * @return self
     */
    public function setUpdateAccounts(array $accounts): self
    {
        $this->updateAccounts = array_filter($accounts, static fn ($account) => $account instanceof WaitSetAddSpec);
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
     * Gets Waitsets to remove.
     *
     * @return array
     */
    public function getRemoveAccounts(): array
    {
        return $this->removeAccounts;
    }

    /**
     * Sets Waitsets to remove.
     *
     * @param  array $removeAccounts
     * @return self
     */
    public function setRemoveAccounts(array $accounts): self
    {
        $this->removeAccounts = array_filter($accounts, static fn ($account) => $account instanceof Id);
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
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new AdminWaitSetEnvelope(
            new AdminWaitSetBody($this)
        );
    }
}
