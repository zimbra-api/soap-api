<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Header;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlValue;
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Struct\AuthTokenControl;

/**
 * Header context class
 *
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="context", namespace="urn:zimbra")
 */
class Context
{
    /**
     * @Accessor(getter="getHopCount", setter="setHopCount")
     * @SerializedName("hops")
     * @Type("integer")
     * @XmlAttribute
     */
    private $_hopCount;

    /**
     * @Accessor(getter="getAuthToken", setter="setAuthToken")
     * @SerializedName("authToken")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbra")
     */
    private $_authToken;

    /**
     * @Accessor(getter="getSession", setter="setSession")
     * @SerializedName("session")
     * @Type("Zimbra\Soap\Header\SessionInfo")
     * @XmlElement(namespace="urn:zimbra")
     */
    private $_session;

    /**
     * @Accessor(getter="getLegacySessionId", setter="setLegacySessionId")
     * @SerializedName("sessionId")
     * @Type("Zimbra\Soap\Header\SessionInfo")
     * @XmlElement(namespace="urn:zimbra")
     */
    private $_legacySessionId;

    /**
     * @Accessor(getter="getNoSession", setter="setNoSession")
     * @SerializedName("nosession")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbra")
     */
    private $_noSession;

    /**
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Soap\Header\AccountInfo")
     * @XmlElement(namespace="urn:zimbra")
     */
    private $_account;

    /**
     * @Accessor(getter="getChange", setter="setChange")
     * @SerializedName("change")
     * @Type("Zimbra\Soap\Header\ChangeInfo")
     * @XmlElement(namespace="urn:zimbra")
     */
    private $_change;

    /**
     * @Accessor(getter="getTargetServer", setter="setTargetServer")
     * @SerializedName("targetServer")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbra")
     */
    private $_targetServer;

    /**
     * @Accessor(getter="getUserAgent", setter="setUserAgent")
     * @SerializedName("userAgent")
     * @Type("Zimbra\Soap\Header\UserAgentInfo")
     * @XmlElement(namespace="urn:zimbra")
     */
    private $_userAgent;

    /**
     * @Accessor(getter="getAuthTokenControl", setter="setAuthTokenControl")
     * @SerializedName("authTokenControl")
     * @Type("Zimbra\Struct\AuthTokenControl")
     * @XmlElement(namespace="urn:zimbra")
     */
    private $_authTokenControl;

    /**
     * @Accessor(getter="getFormat", setter="setFormat")
     * @SerializedName("format")
     * @Type("Zimbra\Soap\Header\FormatInfo")
     * @XmlElement(namespace="urn:zimbra")
     */
    private $_format;

    /**
     * @Accessor(getter="getNotify", setter="setNotify")
     * @SerializedName("notify")
     * @Type("Zimbra\Soap\Header\NotifyInfo")
     * @XmlElement(namespace="urn:zimbra")
     */
    private $_notify;

    /**
     * @Accessor(getter="getNoNotify", setter="setNoNotify")
     * @SerializedName("nonotify")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbra")
     */
    private $_noNotify;

    /**
     * @Accessor(getter="getNoQualify", setter="setNoQualify")
     * @SerializedName("noqualify")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbra")
     */
    private $_noQualify;

    /**
     * @Accessor(getter="getVia", setter="setVia")
     * @SerializedName("via")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbra")
     */
    private $_via;

    /**
     * @Accessor(getter="getSoapRequestId", setter="setSoapRequestId")
     * @SerializedName("soapId")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbra")
     */
    private $_soapRequestId;

    /**
     * @Accessor(getter="getCsrfToken", setter="setCsrfToken")
     * @SerializedName("csrfToken")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbra")
     */
    private $_csrfToken;

    /**
     * Constructor method for Context
     * @return self
     */
    public function __construct(
        $hopCount = NULL,
        $authToken = NULL,
        SessionInfo $session = NULL,
        SessionInfo $legacySessionId = NULL,
        $noSession = NULL,
        AccountInfo $account = NULL,
        ChangeInfo $change = NULL,
        $targetServer = NULL,
        UserAgentInfo $userAgent = NULL,
        AuthTokenControl $authTokenControl = NULL,
        FormatInfo $format = NULL,
        NotifyInfo $notify = NULL,
        $noNotify = NULL,
        $noQualify = NULL,
        $via = NULL,
        $soapRequestId = NULL,
        $csrfToken = NULL
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
     * @return string
     */
    public function getHopCount()
    {
        return $this->_hopCount;
    }

    /**
     * Sets number of times this request has been proxied
     *
     * @param  int $hopCount
     * @return self
     */
    public function setHopCount($hopCount)
    {
        $this->_hopCount = (int) $hopCount;
        return $this;
    }

    /**
     * Gets auth token
     *
     * @return string
     */
    public function getAuthToken()
    {
        return $this->_authToken;
    }

    /**
     * Sets auth token
     *
     * @param  string $authToken
     * @return self
     */
    public function setAuthToken($authToken)
    {
        $this->_authToken = trim($authToken);
        return $this;
    }

    /**
     * Gets session info
     *
     * @return HeaderSessionInfo
     */
    public function getSession()
    {
        return $this->_session;
    }

    /**
     * Sets session info
     *
     * @param  SessionInfo $session
     * @return self
     */
    public function setSession(SessionInfo $session)
    {
        $this->_session = $session;
        return $this;
    }

    /**
     * Gets session id
     *
     * @return SessionInfo
     */
    public function getLegacySessionId()
    {
        return $this->_legacySessionId;
    }

    /**
     * Sets session id
     *
     * @param  SessionInfo $sessionId
     * @return self
     */
    public function setLegacySessionId(SessionInfo $sessionId)
    {
        $this->_legacySessionId = $sessionId;
        return $this;
    }

    /**
     * Gets no session
     *
     * @return string
     */
    public function getNoSession()
    {
        return $this->_noSession;
    }

    /**
     * Sets no session
     *
     * @param  string $noSession
     * @return self
     */
    public function setNoSession($noSession)
    {
        $this->_noSession = trim($noSession);
        return $this;
    }

    /**
     * Gets account info
     *
     * @return HeaderAccountInfo
     */
    public function getAccount()
    {
        return $this->_account;
    }

    /**
     * Sets account info
     *
     * @param  AccountInfo $account
     * @return self
     */
    public function setAccount(AccountInfo $account)
    {
        $this->_account = $account;
        return $this;
    }

    /**
     * Gets change
     *
     * @return HeaderChangeInfo
     */
    public function getChange()
    {
        return $this->_change;
    }

    /**
     * Sets change
     *
     * @param  ChangeInfo $change
     * @return self
     */
    public function setChange(ChangeInfo $change)
    {
        $this->_change = $change;
        return $this;
    }

    /**
     * Gets target server
     *
     * @return string
     */
    public function getTargetServer()
    {
        return $this->_targetServer;
    }

    /**
     * Sets target server
     *
     * @param  string $targetServer
     * @return self
     */
    public function setTargetServer($targetServer)
    {
        $this->_targetServer = trim($targetServer);
        return $this;
    }

    /**
     * Gets user agent
     *
     * @return UserAgentInfo
     */
    public function getUserAgent()
    {
        return $this->_userAgent;
    }

    /**
     * Sets user agent
     *
     * @param  UserAgentInfo $userAgent
     * @return self
     */
    public function setUserAgent(UserAgentInfo $userAgent)
    {
        $this->_userAgent = $userAgent;
        return $this;
    }

    /**
     * Gets auth token control information
     *
     * @return AuthTokenControl
     */
    public function getAuthTokenControl()
    {
        return $this->_authTokenControl;
    }

    /**
     * Sets auth token control information
     *
     * @param  AuthTokenControl $authTokenControl
     * @return self
     */
    public function setAuthTokenControl(AuthTokenControl $authTokenControl)
    {
        $this->_authTokenControl = $authTokenControl;
        return $this;
    }

    /**
     * Gets desired response format information
     *
     * @return FormatInfo
     */
    public function getFormat()
    {
        return $this->_format;
    }

    /**
     * Sets desired response format information
     *
     * @param  FormatInfo $format
     * @return self
     */
    public function setFormat(FormatInfo $format)
    {
        $this->_format = $format;
        return $this;
    }

    /**
     * Gets information about which notifications have already been received
     *
     * @return NotifyInfo
     */
    public function getNotify()
    {
        return $this->_notify;
    }

    /**
     * Sets information about which notifications have already been received
     *
     * @param  NotifyInfo $notify
     * @return self
     */
    public function setNotify(NotifyInfo $notify)
    {
        $this->_notify = $notify;
        return $this;
    }

    /**
     * Gets no notify
     *
     * @return string
     */
    public function getNoNotify()
    {
        return $this->_noNotify;
    }

    /**
     * Sets no notify
     *
     * @param  string $noNotify
     * @return self
     */
    public function setNoNotify($noNotify)
    {
        $this->_noNotify = trim($noNotify);
        return $this;
    }

    /**
     * Gets no qualify
     *
     * @return string
     */
    public function getNoQualify()
    {
        return $this->_noQualify;
    }

    /**
     * Sets no qualify
     *
     * @param  string $noQualify
     * @return self
     */
    public function setNoQualify($noQualify)
    {
        $this->_noQualify = trim($noQualify);
        return $this;
    }

    /**
     * Gets information on where the request has come from
     *
     * @return string
     */
    public function getVia()
    {
        return $this->_via;
    }

    /**
     * Sets information on where the request has come from
     *
     * @param  string $via
     * @return self
     */
    public function setVia($via)
    {
        $this->_via = trim($via);
        return $this;
    }

    /**
     * Gets SOAP request ID
     *
     * @return string
     */
    public function getSoapRequestId()
    {
        return $this->_soapRequestId;
    }

    /**
     * Sets SOAP request ID
     *
     * @param  string $soapRequestId
     * @return self
     */
    public function setSoapRequestId($soapRequestId)
    {
        $this->_soapRequestId = trim($soapRequestId);
        return $this;
    }

    /**
     * Gets CSRF token
     *
     * @return string
     */
    public function getCsrfToken()
    {
        return $this->_csrfToken;
    }

    /**
     * Sets CSRF token
     *
     * @param  string $csrfToken
     * @return self
     */
    public function setCsrfToken($csrfToken)
    {
        $this->_csrfToken = trim($csrfToken);
        return $this;
    }
}
