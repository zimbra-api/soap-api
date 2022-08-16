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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SessionForWaitSet
{
    /**
     * Account ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getAccount', setter: 'setAccount')]
    #[SerializedName(name: 'account')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $account;

    /**
     * Interest types - Either all or some combination of the letters: 
     * mcatd Which stand for Message, Contact, Appointment, Task and Document respectively
     * 
     * @var string
     */
    #[Accessor(getter: 'getInterests', setter: 'setInterests')]
    #[SerializedName(name: 'types')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $interests;

    /**
     * Last known sync token
     * 
     * @var string
     */
    #[Accessor(getter: 'getToken', setter: 'setToken')]
    #[SerializedName(name: 'token')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $token;

    /**
     * Mailbox sync token
     * 
     * @var int
     */
    #[Accessor(getter: 'getMboxSyncToken', setter: 'setMboxSyncToken')]
    #[SerializedName(name: 'mboxSyncToken')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $mboxSyncToken;

    /**
     * @var int
     */
    #[Accessor(getter: 'getMboxSyncTokenDiff', setter: 'setMboxSyncTokenDiff')]
    #[SerializedName(name: 'mboxSyncTokenDiff')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $mboxSyncTokenDiff;

    /**
     * Account ID stored in WaitSetAccount object.  Differs from account value.
     * 
     * @var string
     */
    #[Accessor(getter: 'getAcctIdError', setter: 'setAcctIdError')]
    #[SerializedName(name: 'acctIdError')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $acctIdError;

    /**
     * WaitSet session Information
     * 
     * @var WaitSetSessionInfo
     */
    #[Accessor(getter: 'getWaitSetSession', setter: 'setWaitSetSession')]
    #[SerializedName(name: 'WaitSetSession')]
    #[Type(name: WaitSetSessionInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $waitSetSession;

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
