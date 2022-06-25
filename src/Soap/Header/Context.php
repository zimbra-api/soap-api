<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Header;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Common\Struct\AuthTokenControl;

/**
 * Header context class
 *
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 */
class Context
{
    /**
     * @Accessor(getter="getHopCount", setter="setHopCount")
     * @SerializedName("hops")
     * @Type("integer")
     * @XmlAttribute
     */
    private $hopCount;

    /**
     * @Accessor(getter="getAuthToken", setter="setAuthToken")
     * @SerializedName("authToken")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbra")
     */
    private $authToken;

    /**
     * @Accessor(getter="getSession", setter="setSession")
     * @SerializedName("session")
     * @Type("Zimbra\Soap\Header\SessionInfo")
     * @XmlElement(namespace="urn:zimbra")
     */
    private ?SessionInfo $session = NULL;

    /**
     * @Accessor(getter="getLegacySessionId", setter="setLegacySessionId")
     * @SerializedName("sessionId")
     * @Type("Zimbra\Soap\Header\SessionInfo")
     * @XmlElement(namespace="urn:zimbra")
     */
    private ?SessionInfo $legacySessionId = NULL;

    /**
     * @Accessor(getter="getNoSession", setter="setNoSession")
     * @SerializedName("nosession")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbra")
     */
    private $noSession;

    /**
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Soap\Header\AccountInfo")
     * @XmlElement(namespace="urn:zimbra")
     */
    private ?AccountInfo $account = NULL;

    /**
     * @Accessor(getter="getChange", setter="setChange")
     * @SerializedName("change")
     * @Type("Zimbra\Soap\Header\ChangeInfo")
     * @XmlElement(namespace="urn:zimbra")
     */
    private ?ChangeInfo $change = NULL;

    /**
     * @Accessor(getter="getTargetServer", setter="setTargetServer")
     * @SerializedName("targetServer")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbra")
     */
    private $targetServer;

    /**
     * @Accessor(getter="getUserAgent", setter="setUserAgent")
     * @SerializedName("userAgent")
     * @Type("Zimbra\Soap\Header\UserAgentInfo")
     * @XmlElement(namespace="urn:zimbra")
     */
    private ?UserAgentInfo $userAgent = NULL;

    /**
     * @Accessor(getter="getAuthTokenControl", setter="setAuthTokenControl")
     * @SerializedName("authTokenControl")
     * @Type("Zimbra\Common\Struct\AuthTokenControl")
     * @XmlElement(namespace="urn:zimbra")
     */
    private ?AuthTokenControl $authTokenControl = NULL;

    /**
     * @Accessor(getter="getFormat", setter="setFormat")
     * @SerializedName("format")
     * @Type("Zimbra\Soap\Header\FormatInfo")
     * @XmlElement(namespace="urn:zimbra")
     */
    private ?FormatInfo $format = NULL;

    /**
     * @Accessor(getter="getNotify", setter="setNotify")
     * @SerializedName("notify")
     * @Type("Zimbra\Soap\Header\NotifyInfo")
     * @XmlElement(namespace="urn:zimbra")
     */
    private ?NotifyInfo $notify = NULL;

    /**
     * @Accessor(getter="getNoNotify", setter="setNoNotify")
     * @SerializedName("nonotify")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbra")
     */
    private $noNotify;

    /**
     * @Accessor(getter="getNoQualify", setter="setNoQualify")
     * @SerializedName("noqualify")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbra")
     */
    private $noQualify;

    /**
     * @Accessor(getter="getVia", setter="setVia")
     * @SerializedName("via")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbra")
     */
    private $via;

    /**
     * @Accessor(getter="getSoapRequestId", setter="setSoapRequestId")
     * @SerializedName("soapId")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbra")
     */
    private $soapRequestId;

    /**
     * @Accessor(getter="getCsrfToken", setter="setCsrfToken")
     * @SerializedName("csrfToken")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbra")
     */
    private $csrfToken;

    /**
     * Constructor method for Context
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
     * Gets number of times this request has been proxied
     *
     * @return int
     */
    public function getHopCount(): ?int
    {
        return $this->hopCount;
    }

    /**
     * Sets number of times this request has been proxied
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
     * Gets auth token
     *
     * @return string
     */
    public function getAuthToken(): ?string
    {
        return $this->authToken;
    }

    /**
     * Sets auth token
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
     * Gets session info
     *
     * @return SessionInfo
     */
    public function getSession(): ?SessionInfo
    {
        return $this->session;
    }

    /**
     * Sets session info
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
     * Gets session id
     *
     * @return SessionInfo
     */
    public function getLegacySessionId(): ?SessionInfo
    {
        return $this->legacySessionId;
    }

    /**
     * Sets session id
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
     * Gets no session
     *
     * @return string
     */
    public function getNoSession(): ?string
    {
        return $this->noSession;
    }

    /**
     * Sets no session
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
     * Gets account info
     *
     * @return AccountInfo
     */
    public function getAccount(): ?AccountInfo
    {
        return $this->account;
    }

    /**
     * Sets account info
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
     * Gets change
     *
     * @return ChangeInfo
     */
    public function getChange(): ?ChangeInfo
    {
        return $this->change;
    }

    /**
     * Sets change
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
     * Gets target server
     *
     * @return string
     */
    public function getTargetServer(): ?string
    {
        return $this->targetServer;
    }

    /**
     * Sets target server
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
     * Gets user agent
     *
     * @return UserAgentInfo
     */
    public function getUserAgent(): ?UserAgentInfo
    {
        return $this->userAgent;
    }

    /**
     * Sets user agent
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
     * Gets auth token control information
     *
     * @return AuthTokenControl
     */
    public function getAuthTokenControl(): ?AuthTokenControl
    {
        return $this->authTokenControl;
    }

    /**
     * Sets auth token control information
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
     * Gets desired response format information
     *
     * @return FormatInfo
     */
    public function getFormat(): ?FormatInfo
    {
        return $this->format;
    }

    /**
     * Sets desired response format information
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
     * Gets information about which notifications have already been received
     *
     * @return NotifyInfo
     */
    public function getNotify(): ?NotifyInfo
    {
        return $this->notify;
    }

    /**
     * Sets information about which notifications have already been received
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
     * Gets no notify
     *
     * @return string
     */
    public function getNoNotify(): ?string
    {
        return $this->noNotify;
    }

    /**
     * Sets no notify
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
     * Gets no qualify
     *
     * @return string
     */
    public function getNoQualify(): ?string
    {
        return $this->noQualify;
    }

    /**
     * Sets no qualify
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
     * Gets information on where the request has come from
     *
     * @return string
     */
    public function getVia(): ?string
    {
        return $this->via;
    }

    /**
     * Sets information on where the request has come from
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
     * Gets SOAP request ID
     *
     * @return string
     */
    public function getSoapRequestId(): ?string
    {
        return $this->soapRequestId;
    }

    /**
     * Sets SOAP request ID
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
     * Gets CSRF token
     *
     * @return string
     */
    public function getCsrfToken(): ?string
    {
        return $this->csrfToken;
    }

    /**
     * Sets CSRF token
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
