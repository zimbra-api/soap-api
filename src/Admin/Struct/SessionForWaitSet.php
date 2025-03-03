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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};

/**
 * SessionForWaitSet struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SessionForWaitSet
{
    /**
     * Account ID
     *
     * @var string
     */
    #[Accessor(getter: "getAccount", setter: "setAccount")]
    #[SerializedName("account")]
    #[Type("string")]
    #[XmlAttribute]
    private string $account;

    /**
     * Interest types - Either all or some combination of the letters:
     * mcatd Which stand for Message, Contact, Appointment, Task and Document respectively
     *
     * @var string
     */
    #[Accessor(getter: "getInterests", setter: "setInterests")]
    #[SerializedName("types")]
    #[Type("string")]
    #[XmlAttribute]
    private string $interests;

    /**
     * Last known sync token
     *
     * @var string
     */
    #[Accessor(getter: "getToken", setter: "setToken")]
    #[SerializedName("token")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $token = null;

    /**
     * Mailbox sync token
     *
     * @var int
     */
    #[Accessor(getter: "getMboxSyncToken", setter: "setMboxSyncToken")]
    #[SerializedName("mboxSyncToken")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $mboxSyncToken = null;

    /**
     * @var int
     */
    #[Accessor(getter: "getMboxSyncTokenDiff", setter: "setMboxSyncTokenDiff")]
    #[SerializedName("mboxSyncTokenDiff")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $mboxSyncTokenDiff = null;

    /**
     * Account ID stored in WaitSetAccount object.  Differs from account value.
     *
     * @var string
     */
    #[Accessor(getter: "getAcctIdError", setter: "setAcctIdError")]
    #[SerializedName("acctIdError")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $acctIdError = null;

    /**
     * WaitSet session Information
     *
     * @var WaitSetSessionInfo
     */
    #[Accessor(getter: "getWaitSetSession", setter: "setWaitSetSession")]
    #[SerializedName("WaitSetSession")]
    #[Type(WaitSetSessionInfo::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?WaitSetSessionInfo $waitSetSession;

    /**
     * Constructor
     *
     * @param string $account
     * @param string $interests
     * @param string $token
     * @param int    $mboxSyncToken
     * @param int    $mboxSyncTokenDiff
     * @param string $acctIdError
     * @param WaitSetSessionInfo $waitSetSession
     * @return self
     */
    public function __construct(
        string $account = "",
        string $interests = "",
        ?string $token = null,
        ?int $mboxSyncToken = null,
        ?int $mboxSyncTokenDiff = null,
        ?string $acctIdError = null,
        ?WaitSetSessionInfo $waitSetSession = null
    ) {
        $this->setAccount($account)->setInterests($interests);
        if (null !== $token) {
            $this->setToken($token);
        }
        if (null !== $mboxSyncToken) {
            $this->setMboxSyncToken($mboxSyncToken);
        }
        if (null !== $mboxSyncTokenDiff) {
            $this->setMboxSyncTokenDiff($mboxSyncTokenDiff);
        }
        if (null !== $acctIdError) {
            $this->setAcctIdError($acctIdError);
        }
        $this->waitSetSession = $waitSetSession;
    }

    /**
     * Get account
     *
     * @return string
     */
    public function getAccount(): string
    {
        return $this->account;
    }

    /**
     * Set account
     *
     * @param  string $account
     * @return self
     */
    public function setAccount(string $account): self
    {
        $this->account = $account;
        return $this;
    }

    /**
     * Get mboxSyncTokenDiff
     *
     * @return int
     */
    public function getMboxSyncTokenDiff(): ?int
    {
        return $this->mboxSyncTokenDiff;
    }

    /**
     * Set mboxSyncTokenDiff
     *
     * @param  int $mboxSyncTokenDiff
     * @return self
     */
    public function setMboxSyncTokenDiff(int $mboxSyncTokenDiff): self
    {
        $this->mboxSyncTokenDiff = $mboxSyncTokenDiff;
        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Set token
     *
     * @param  string $token
     * @return self
     */
    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Get waitSetSession
     *
     * @return WaitSetSessionInfo
     */
    public function getWaitSetSession(): ?WaitSetSessionInfo
    {
        return $this->waitSetSession;
    }

    /**
     * Set waitSetSession
     *
     * @param  WaitSetSessionInfo $waitSetSession
     * @return self
     */
    public function setWaitSetSession(WaitSetSessionInfo $waitSetSession): self
    {
        $this->waitSetSession = $waitSetSession;
        return $this;
    }

    /**
     * Set interests
     *
     * @return string
     */
    public function getInterests(): ?string
    {
        return $this->interests;
    }

    /**
     * Set interests
     *
     * @param  string $interests
     * @return self
     */
    public function setInterests(string $interests): self
    {
        $this->interests = $interests;
        return $this;
    }

    /**
     * Set mboxSyncToken
     *
     * @return int
     */
    public function getMboxSyncToken(): ?int
    {
        return $this->mboxSyncToken;
    }

    /**
     * Set mboxSyncToken
     *
     * @param  int $mboxSyncToken
     * @return self
     */
    public function setMboxSyncToken(int $mboxSyncToken): self
    {
        $this->mboxSyncToken = $mboxSyncToken;
        return $this;
    }

    /**
     * Get acctIdError
     *
     * @return string
     */
    public function getAcctIdError(): ?string
    {
        return $this->acctIdError;
    }

    /**
     * Set acctIdError
     *
     * @param  string $acctIdError
     * @return self
     */
    public function setAcctIdError(string $acctIdError): self
    {
        $this->acctIdError = $acctIdError;
        return $this;
    }
}
