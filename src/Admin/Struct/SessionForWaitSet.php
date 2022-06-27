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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};

/**
 * SessionForWaitSet struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SessionForWaitSet
{
    /**
     * Account ID
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("string")
     * @XmlAttribute
     */
    private $account;

    /**
     * Interest types - Either all or some combination of the letters: 
     * mcatd Which stand for Message, Contact, Appointment, Task and Document respectively
     * @Accessor(getter="getInterests", setter="setInterests")
     * @SerializedName("types")
     * @Type("string")
     * @XmlAttribute
     */
    private $interests;

    /**
     * Last known sync token
     * @Accessor(getter="getToken", setter="setToken")
     * @SerializedName("token")
     * @Type("string")
     * @XmlAttribute
     */
    private $token;

    /**
     * Mailbox sync token
     * @Accessor(getter="getMboxSyncToken", setter="setMboxSyncToken")
     * @SerializedName("mboxSyncToken")
     * @Type("integer")
     * @XmlAttribute
     */
    private $mboxSyncToken;

    /**
     * @Accessor(getter="getMboxSyncTokenDiff", setter="setMboxSyncTokenDiff")
     * @SerializedName("mboxSyncTokenDiff")
     * @Type("integer")
     * @XmlAttribute
     */
    private $mboxSyncTokenDiff;

    /**
     * Account ID stored in WaitSetAccount object.  Differs from account value.
     * @Accessor(getter="getAcctIdError", setter="setAcctIdError")
     * @SerializedName("acctIdError")
     * @Type("string")
     * @XmlAttribute
     */
    private $acctIdError;

    /**
     * WaitSet session Information
     * @Accessor(getter="getWaitSetSession", setter="setWaitSetSession")
     * @SerializedName("WaitSetSession")
     * @Type("Zimbra\Admin\Struct\WaitSetSessionInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?WaitSetSessionInfo $waitSetSession = NULL;

    /**
     * Constructor method for SessionForWaitSet
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
        string $account = '',
        string $interests = '',
        ?string $token = NULL,
        ?int $mboxSyncToken = NULL,
        ?int $mboxSyncTokenDiff = NULL,
        ?string $acctIdError = NULL,
        ?WaitSetSessionInfo $waitSetSession = NULL
    )
    {
        $this->setAccount($account)
             ->setInterests($interests);
        if (NULL !== $token) {
            $this->setToken($token);
        }
        if (NULL !== $mboxSyncToken) {
            $this->setMboxSyncToken($mboxSyncToken);
        }
        if (NULL !== $mboxSyncTokenDiff) {
            $this->setMboxSyncTokenDiff($mboxSyncTokenDiff);
        }
        if (NULL !== $acctIdError) {
            $this->setAcctIdError($acctIdError);
        }
        if ($waitSetSession instanceof WaitSetSessionInfo) {
            $this->setWaitSetSession($waitSetSession);
        }
    }

    /**
     * Gets account
     *
     * @return string
     */
    public function getAccount(): string
    {
        return $this->account;
    }

    /**
     * Sets account
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
     * Gets mboxSyncTokenDiff
     *
     * @return int
     */
    public function getMboxSyncTokenDiff(): ?int
    {
        return $this->mboxSyncTokenDiff;
    }

    /**
     * Sets mboxSyncTokenDiff
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
     * Gets token
     *
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Sets token
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
     * Gets waitSetSession
     *
     * @return WaitSetSessionInfo
     */
    public function getWaitSetSession(): ?WaitSetSessionInfo
    {
        return $this->waitSetSession;
    }

    /**
     * Sets waitSetSession
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
     * Sets interests
     *
     * @return string
     */
    public function getInterests(): ?string
    {
        return $this->interests;
    }

    /**
     * Sets interests
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
     * Sets mboxSyncToken
     *
     * @return int
     */
    public function getMboxSyncToken(): ?int
    {
        return $this->mboxSyncToken;
    }

    /**
     * Sets mboxSyncToken
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
     * Gets acctIdError
     *
     * @return string
     */
    public function getAcctIdError(): ?string
    {
        return $this->acctIdError;
    }

    /**
     * Sets acctIdError
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
