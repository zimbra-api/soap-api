<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct\Header;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Common\Struct\AuthTokenControl;

/**
 * Header context class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class Context
{
    /**
     * @var int
     */
    #[Accessor(getter: 'getHopCount', setter: 'setHopCount')]
    #[SerializedName('hops')]
    #[Type('int')]
    #[XmlAttribute]
    private $hopCount;

    /**
     * @var string
     */
    #[Accessor(getter: 'getAuthToken', setter: 'setAuthToken')]
    #[SerializedName('authToken')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbra')]
    private $authToken;

    /**
     * @var SessionInfo
     */
    #[Accessor(getter: 'getSession', setter: 'setSession')]
    #[SerializedName('session')]
    #[Type(SessionInfo::class)]
    #[XmlElement(namespace: 'urn:zimbra')]
    private $session;

    /**
     * @var SessionInfo
     */
    #[Accessor(getter: 'getLegacySessionId', setter: 'setLegacySessionId')]
    #[SerializedName('sessionId')]
    #[Type(SessionInfo::class)]
    #[XmlElement(namespace: 'urn:zimbra')]
    private $legacySessionId;

    /**
     * @var string
     */
    #[Accessor(getter: 'getNoSession', setter: 'setNoSession')]
    #[SerializedName('nosession')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbra')]
    private $noSession;

    /**
     * @var AccountInfo
     */
    #[Accessor(getter: 'getAccount', setter: 'setAccount')]
    #[SerializedName('account')]
    #[Type(AccountInfo::class)]
    #[XmlElement(namespace: 'urn:zimbra')]
    private $account;

    /**
     * @var ChangeInfo
     */
    #[Accessor(getter: 'getChange', setter: 'setChange')]
    #[SerializedName('change')]
    #[Type(ChangeInfo::class)]
    #[XmlElement(namespace: 'urn:zimbra')]
    private $change;

    /**
     * @var string
     */
    #[Accessor(getter: 'getTargetServer', setter: 'setTargetServer')]
    #[SerializedName('targetServer')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbra')]
    private $targetServer;

    /**
     * @var UserAgentInfo
     */
    #[Accessor(getter: 'getUserAgent', setter: 'setUserAgent')]
    #[SerializedName('userAgent')]
    #[Type(UserAgentInfo::class)]
    #[XmlElement(namespace: 'urn:zimbra')]
    private $userAgent;

    /**
     * @var AuthTokenControl
     */
    #[Accessor(getter: 'getAuthTokenControl', setter: 'setAuthTokenControl')]
    #[SerializedName('authTokenControl')]
    #[Type(AuthTokenControl::class)]
    #[XmlElement(namespace: 'urn:zimbra')]
    private $authTokenControl;

    /**
     * @var FormatInfo
     */
    #[Accessor(getter: 'getFormat', setter: 'setFormat')]
    #[SerializedName('format')]
    #[Type(FormatInfo::class)]
    #[XmlElement(namespace: 'urn:zimbra')]
    private $format;

    /**
     * @var NotifyInfo
     */
    #[Accessor(getter: 'getNotify', setter: 'setNotify')]
    #[SerializedName('notify')]
    #[Type(NotifyInfo::class)]
    #[XmlElement(namespace: 'urn:zimbra')]
    private $notify;

    /**
     * @var string
     */
    #[Accessor(getter: 'getNoNotify', setter: 'setNoNotify')]
    #[SerializedName('nonotify')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbra')]
    private $noNotify;

    /**
     * @var string
     */
    #[Accessor(getter: 'getNoQualify', setter: 'setNoQualify')]
    #[SerializedName('noqualify')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbra')]
    private $noQualify;

    /**
     * @var string
     */
    #[Accessor(getter: 'getVia', setter: 'setVia')]
    #[SerializedName('via')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbra')]
    private $via;

    /**
     * @var string
     */
    #[Accessor(getter: 'getSoapRequestId', setter: 'setSoapRequestId')]
    #[SerializedName('soapId')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbra')]
    private $soapRequestId;

    /**
     * @var string
     */
    #[Accessor(getter: 'getCsrfToken', setter: 'setCsrfToken')]
    #[SerializedName('csrfToken')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbra')]
    private $csrfToken;

    /**
     * Constructor
     * 
     * @param int $hopCount
     * @param string $authToken
     * @param SessionInfo $session
     * @param SessionInfo $legacySessionId
     * @param string $noSession
     * @param AccountInfo $account
     * @param ChangeInfo $change
     * @param string $targetServer
     * @param UserAgentInfo $userAgent
     * @param AuthTokenControl $authTokenControl
     * @param FormatInfo $format
     * @param NotifyInfo $notify
     * @param string $noNotify
     * @param string $noQualify
     * @param string $via
     * @param string $soapRequestId
     * @param string $csrfToken
     * @return self
     */
    public function __construct(
        ?int $hopCount = NULL,
        ?string $authToken = NULL,
        ?SessionInfo $session = NULL,
        ?SessionInfo $legacySessionId = NULL,
        ?string $noSession = NULL,
        ?AccountInfo $account = NULL,
        ?ChangeInfo $change = NULL,
        ?string $targetServer = NULL,
        ?UserAgentInfo $userAgent = NULL,
        ?AuthTokenControl $authTokenControl = NULL,
        ?FormatInfo $format = NULL,
        ?NotifyInfo $notify = NULL,
        ?string $noNotify = NULL,
        ?string $noQualify = NULL,
        ?string $via = NULL,
        ?string $soapRequestId = NULL,
        ?string $csrfToken = NULL
    )
    {
        if (NULL !== $hopCount) {
            $this->setHopCount($hopCount);
        }
        if (NULL !== $authToken) {
            $this->setAuthToken($authToken);
        }
        if ($session instanceof SessionInfo) {
            $this->setSession($session);
        }
        if ($legacySessionId instanceof SessionInfo) {
            $this->setLegacySessionId($legacySessionId);
        }
        if (NULL !== $noSession) {
            $this->setNoSession($noSession);
        }
        if ($account instanceof AccountInfo) {
            $this->setAccount($account);
        }
        if ($change instanceof ChangeInfo) {
            $this->setChange($change);
        }
        if (NULL !== $targetServer) {
            $this->setTargetServer($targetServer);
        }
        if ($userAgent instanceof UserAgentInfo) {
            $this->setUserAgent($userAgent);
        }
        if ($authTokenControl instanceof AuthTokenControl) {
            $this->setAuthTokenControl($authTokenControl);
        }
        if ($format instanceof FormatInfo) {
            $this->setFormat($format);
        }
        if ($notify instanceof NotifyInfo) {
            $this->setNotify($notify);
        }
        if (NULL !== $noNotify) {
            $this->setNoNotify($noNotify);
        }
        if (NULL !== $noQualify) {
            $this->setNoQualify($noQualify);
        }
        if (NULL !== $via) {
            $this->setVia($via);
        }
        if (NULL !== $soapRequestId) {
            $this->setSoapRequestId($soapRequestId);
        }
        if (NULL !== $csrfToken) {
            $this->setCsrfToken($csrfToken);
        }
    }

    /**
     * Get number of times this request has been proxied
     *
     * @return int
     */
    public function getHopCount(): ?int
    {
        return $this->hopCount;
    }

    /**
     * Set number of times this request has been proxied
     *
     * @param  int $hopCount
     * @return self
     */
    public function setHopCount($hopCount): self
    {
        $this->hopCount = (int) $hopCount;
        return $this;
    }

    /**
     * Get auth token
     *
     * @return string
     */
    public function getAuthToken(): ?string
    {
        return $this->authToken;
    }

    /**
     * Set auth token
     *
     * @param  string $authToken
     * @return self
     */
    public function setAuthToken(string $authToken): self
    {
        $this->authToken = $authToken;
        return $this;
    }

    /**
     * Get session info
     *
     * @return SessionInfo
     */
    public function getSession(): ?SessionInfo
    {
        return $this->session;
    }

    /**
     * Set session info
     *
     * @param  SessionInfo $session
     * @return self
     */
    public function setSession(SessionInfo $session): self
    {
        $this->session = $session;
        return $this;
    }

    /**
     * Get session id
     *
     * @return SessionInfo
     */
    public function getLegacySessionId(): ?SessionInfo
    {
        return $this->legacySessionId;
    }

    /**
     * Set session id
     *
     * @param  SessionInfo $sessionId
     * @return self
     */
    public function setLegacySessionId(SessionInfo $sessionId): self
    {
        $this->legacySessionId = $sessionId;
        return $this;
    }

    /**
     * Get no session
     *
     * @return string
     */
    public function getNoSession(): ?string
    {
        return $this->noSession;
    }

    /**
     * Set no session
     *
     * @param  string $noSession
     * @return self
     */
    public function setNoSession(string $noSession): self
    {
        $this->noSession = $noSession;
        return $this;
    }

    /**
     * Get account info
     *
     * @return AccountInfo
     */
    public function getAccount(): ?AccountInfo
    {
        return $this->account;
    }

    /**
     * Set account info
     *
     * @param  AccountInfo $account
     * @return self
     */
    public function setAccount(AccountInfo $account): self
    {
        $this->account = $account;
        return $this;
    }

    /**
     * Get change
     *
     * @return ChangeInfo
     */
    public function getChange(): ?ChangeInfo
    {
        return $this->change;
    }

    /**
     * Set change
     *
     * @param  ChangeInfo $change
     * @return self
     */
    public function setChange(ChangeInfo $change): self
    {
        $this->change = $change;
        return $this;
    }

    /**
     * Get target server
     *
     * @return string
     */
    public function getTargetServer(): ?string
    {
        return $this->targetServer;
    }

    /**
     * Set target server
     *
     * @param  string $targetServer
     * @return self
     */
    public function setTargetServer(string $targetServer): self
    {
        $this->targetServer = $targetServer;
        return $this;
    }

    /**
     * Get user agent
     *
     * @return UserAgentInfo
     */
    public function getUserAgent(): ?UserAgentInfo
    {
        return $this->userAgent;
    }

    /**
     * Set user agent
     *
     * @param  UserAgentInfo $userAgent
     * @return self
     */
    public function setUserAgent(UserAgentInfo $userAgent): self
    {
        $this->userAgent = $userAgent;
        return $this;
    }

    /**
     * Get auth token control information
     *
     * @return AuthTokenControl
     */
    public function getAuthTokenControl(): ?AuthTokenControl
    {
        return $this->authTokenControl;
    }

    /**
     * Set auth token control information
     *
     * @param  AuthTokenControl $authTokenControl
     * @return self
     */
    public function setAuthTokenControl(AuthTokenControl $authTokenControl): self
    {
        $this->authTokenControl = $authTokenControl;
        return $this;
    }

    /**
     * Get desired response format information
     *
     * @return FormatInfo
     */
    public function getFormat(): ?FormatInfo
    {
        return $this->format;
    }

    /**
     * Set desired response format information
     *
     * @param  FormatInfo $format
     * @return self
     */
    public function setFormat(FormatInfo $format): self
    {
        $this->format = $format;
        return $this;
    }

    /**
     * Get information about which notifications have already been received
     *
     * @return NotifyInfo
     */
    public function getNotify(): ?NotifyInfo
    {
        return $this->notify;
    }

    /**
     * Set information about which notifications have already been received
     *
     * @param  NotifyInfo $notify
     * @return self
     */
    public function setNotify(NotifyInfo $notify): self
    {
        $this->notify = $notify;
        return $this;
    }

    /**
     * Get no notify
     *
     * @return string
     */
    public function getNoNotify(): ?string
    {
        return $this->noNotify;
    }

    /**
     * Set no notify
     *
     * @param  string $noNotify
     * @return self
     */
    public function setNoNotify(string $noNotify): self
    {
        $this->noNotify = $noNotify;
        return $this;
    }

    /**
     * Get no qualify
     *
     * @return string
     */
    public function getNoQualify(): ?string
    {
        return $this->noQualify;
    }

    /**
     * Set no qualify
     *
     * @param  string $noQualify
     * @return self
     */
    public function setNoQualify(string $noQualify): self
    {
        $this->noQualify = $noQualify;
        return $this;
    }

    /**
     * Get information on where the request has come from
     *
     * @return string
     */
    public function getVia(): ?string
    {
        return $this->via;
    }

    /**
     * Set information on where the request has come from
     *
     * @param  string $via
     * @return self
     */
    public function setVia(string $via): self
    {
        $this->via = $via;
        return $this;
    }

    /**
     * Get SOAP request ID
     *
     * @return string
     */
    public function getSoapRequestId(): ?string
    {
        return $this->soapRequestId;
    }

    /**
     * Set SOAP request ID
     *
     * @param  string $soapRequestId
     * @return self
     */
    public function setSoapRequestId(string $soapRequestId): self
    {
        $this->soapRequestId = $soapRequestId;
        return $this;
    }

    /**
     * Get CSRF token
     *
     * @return string
     */
    public function getCsrfToken(): ?string
    {
        return $this->csrfToken;
    }

    /**
     * Set CSRF token
     *
     * @param  string $csrfToken
     * @return self
     */
    public function setCsrfToken(string $csrfToken): self
    {
        $this->csrfToken = $csrfToken;
        return $this;
    }
}
