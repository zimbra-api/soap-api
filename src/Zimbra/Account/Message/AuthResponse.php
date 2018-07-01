<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlValue;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\AuthAttrs;
use Zimbra\Account\Struct\AuthPrefs;
use Zimbra\Account\Struct\Pref;
use Zimbra\Account\Struct\Session;
use Zimbra\Soap\Response;

/**
 * AuthResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="AuthResponse", namespace="urn:zimbraAccount")
 */
class AuthResponse extends Response
{
    /**
     * @Accessor(getter="getAuthToken", setter="setAuthToken")
     * @SerializedName("authToken")
     * @Type("string")
     * @XmlElement(cdata = false, namespace="urn:zimbraAccount")
     */
    private $_authToken;

    /**
     * @Accessor(getter="getLifetime", setter="setLifetime")
     * @SerializedName("lifetime")
     * @Type("integer")
     * @XmlElement(cdata = false, namespace="urn:zimbraAccount")
     */
    private $_lifetime;

    /**
     * @Accessor(getter="getTrustLifetime", setter="setTrustLifetime")
     * @SerializedName("trustLifetime")
     * @Type("integer")
     * @XmlElement(cdata = false, namespace="urn:zimbraAccount")
     */
    private $_trustLifetime;

    /**
     * @Accessor(getter="getSession", setter="setSession")
     * @SerializedName("session")
     * @Type("Zimbra\Account\Struct\Session")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    private $_session;

    /**
     * @Accessor(getter="getRefer", setter="setRefer")
     * @SerializedName("refer")
     * @Type("string")
     * @XmlElement(cdata = false, namespace="urn:zimbraAccount")
     */
    private $_refer;

    /**
     * @Accessor(getter="getSkin", setter="setSkin")
     * @SerializedName("skin")
     * @Type("string")
     * @XmlElement(cdata = false, namespace="urn:zimbraAccount")
     */
    private $_skin;

    /**
     * @Accessor(getter="getCsrfToken", setter="setCsrfToken")
     * @SerializedName("csrfToken")
     * @Type("string")
     * @XmlElement(cdata = false, namespace="urn:zimbraAccount")
     */
    private $_csrfToken;

    /**
     * @Accessor(getter="getDeviceId", setter="setDeviceId")
     * @SerializedName("deviceId")
     * @Type("string")
     * @XmlElement(cdata = false, namespace="urn:zimbraAccount")
     */
    private $_deviceId;

    /**
     * @Accessor(getter="getTrustedToken", setter="setTrustedToken")
     * @SerializedName("trustedToken")
     * @Type("string")
     * @XmlElement(cdata = false, namespace="urn:zimbraAccount")
     */
    private $_trustedToken;

    /**
     * @Accessor(getter="getZmgProxy", setter="setZmgProxy")
     * @SerializedName("zmgProxy")
     * @Type("bool")
     * @XmlAttribute()
     */
    private $_zmgProxy;

    /**
     * @Accessor(getter="getPrefs", setter="setPrefs")
     * @SerializedName("prefs")
     * @Type("Zimbra\Account\Struct\AuthPrefs")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    private $_prefs;

    /**
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @SerializedName("attrs")
     * @Type("Zimbra\Account\Struct\AuthAttrs")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    private $_attrs;

    /**
     * @Accessor(getter="getTwoFactorAuthRequired", setter="setTwoFactorAuthRequired")
     * @SerializedName("twoFactorAuthRequired")
     * @Type("bool")
     * @XmlElement(cdata = false, namespace="urn:zimbraAccount")
     */
    private $_twoFactorAuthRequired;

    /**
     * @Accessor(getter="getTrustedDevicesEnabled", setter="setTrustedDevicesEnabled")
     * @SerializedName("trustedDevicesEnabled")
     * @Type("bool")
     * @XmlElement(cdata = false, namespace="urn:zimbraAccount")
     */
    private $_trustedDevicesEnabled;

    /**
     * Constructor method for AuthRequest
     * @return self
     */
    public function __construct(
        $authToken = NULL,
        $lifetime = NULL,
        Session $session = NULL,
        $refer = NULL,
        $skin = NULL,
        $csrfToken = NULL,
        $deviceId = NULL,
        $trustedToken = NULL,
        $trustLifetime = NULL,
        $zmgProxy = NULL,
        AuthPrefs $prefs = NULL,
        AuthAttrs $attrs = NULL,
        $twoFactorAuthRequired = NULL,
        $trustedDevicesEnabled = NULL
    )
    {
        if(NULL !== $authToken) {
            $this->setAuthToken($authToken);
        }
        if(NULL !== $lifetime) {
            $this->setLifetime($lifetime);
        }
        if($session instanceof Session) {
            $this->setSession($session);
        }
        if(NULL !== $refer) {
            $this->setRefer($refer);
        }
        if(NULL !== $skin) {
            $this->setSkin($skin);
        }
        if(NULL !== $csrfToken) {
            $this->setCsrfToken($csrfToken);
        }
        if(NULL !== $deviceId) {
            $this->setDeviceId($deviceId);
        }
        if(NULL !== $trustedToken) {
            $this->setTrustedToken($trustedToken);
        }
        if(NULL !== $trustLifetime) {
            $this->setTrustLifetime($trustLifetime);
        }
        if(NULL !== $zmgProxy) {
            $this->setZmgProxy($zmgProxy);
        }
        if($prefs instanceof AuthPrefs) {
            $this->setPrefs($prefs);
        }
        if($attrs instanceof AuthAttrs) {
            $this->setAttrs($attrs);
        }
        if(NULL !== $twoFactorAuthRequired) {
            $this->setTwoFactorAuthRequired($twoFactorAuthRequired);
        }
        if(NULL !== $trustedDevicesEnabled) {
            $this->setTrustedDevicesEnabled($trustedDevicesEnabled);
        }
    }

    /**
     * Gets the authorization token
     *
     * @return string
     */
    public function getAuthToken()
    {
        return $this->_authToken;
    }

    /**
     * Sets the authorization token
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
     * Gets life time for the authorization
     *
     * @return int
     */
    public function getLifetime()
    {
        return $this->_lifetime;
    }

    /**
     * Sets life time for the authorization
     *
     * @param  int $lifetime
     * @return self
     */
    public function setLifetime($lifetime)
    {
        $this->_lifetime = (int) $lifetime;
        return $this;
    }

    /**
     * Gets trust lifetime, if a trusted token is issued
     *
     * @return int
     */
    public function getTrustLifetime()
    {
        return $this->_trustLifetime;
    }

    /**
     * Sets trust lifetime, if a trusted token is issued
     *
     * @param  int $trustLifetime
     * @return self
     */
    public function setTrustLifetime($trustLifetime)
    {
        $this->_trustLifetime = (int) $trustLifetime;
        return $this;
    }

    /**
     * Gets session information
     *
     * @return Session
     */
    public function getSession()
    {
        return $this->_session;
    }

    /**
     * Sets session information
     *
     * @param  Session $session
     * @return self
     */
    public function setSession(Session $session)
    {
        $this->_session = $session;
        return $this;
    }

    /**
     * Gets host additional SOAP requests should be directed to.
     *
     * @return string
     */
    public function getRefer()
    {
        return $this->_refer;
    }

    /**
     * Sets host additional SOAP requests should be directed to.
     *
     * @param  string $refer
     * @return self
     */
    public function setRefer($refer)
    {
        $this->_refer = trim($refer);
        return $this;
    }

    /**
     * Gets the name of the skin to use, if requestedSkin specified
     *
     * @return string
     */
    public function getSkin()
    {
        return $this->_skin;
    }

    /**
     * Sets the name of the skin to use, if requestedSkin specified
     *
     * @param  string $skin
     * @return self
     */
    public function setSkin($skin)
    {
        $this->_skin = trim($skin);
        return $this;
    }

    /**
     * Gets the CSRF token, if client is CSRF token enabled
     *
     * @return string
     */
    public function getCsrfToken()
    {
        return $this->_csrfToken;
    }

    /**
     * Sets the CSRF token, if client is CSRF token enabled
     *
     * @param  string $csrfToken
     * @return self
     */
    public function setCsrfToken($csrfToken)
    {
        $this->_csrfToken = trim($csrfToken);
        return $this;
    }

    /**
     * Gets random secure device ID generated for the requesting device
     *
     * @return string
     */
    public function getDeviceId()
    {
        return $this->_deviceId;
    }

    /**
     * Sets random secure device ID generated for the requesting device
     *
     * @param  string $deviceId
     * @return self
     */
    public function setDeviceId($deviceId)
    {
        $this->_deviceId = trim($deviceId);
        return $this;
    }

    /**
     * Gets trusted device token
     *
     * @return string
     */
    public function getTrustedToken()
    {
        return $this->_trustedToken;
    }

    /**
     * Sets trusted device token
     *
     * @param  string $trustedToken
     * @return self
     */
    public function setTrustedToken($trustedToken)
    {
        $this->_trustedToken = trim($trustedToken);
        return $this;
    }

    /**
     * Gets indicates whether the authentication account acts as a "Proxy" to a Zimbra account on another system.
     *
     * @return bool
     */
    public function getZmgProxy()
    {
        return $this->_zmgProxy;
    }

    /**
     * Sets indicates whether the authentication account acts as a "Proxy" to a Zimbra account on another system.
     *
     * @param  bool $zmgProxy
     * @return self
     */
    public function setZmgProxy($zmgProxy)
    {
        $this->_zmgProxy = (bool) $zmgProxy;
        return $this;
    }

    /**
     * Gets requested preference settings
     *
     * @return AuthPrefs
     */
    public function getPrefs()
    {
        return $this->_prefs;
    }

    /**
     * Sets requested preference settings
     *
     * @param  AuthPrefs|array $prefs
     * @return self
     */
    public function setPrefs($prefs)
    {
        if ($prefs instanceof AuthPrefs) {
            $this->_prefs = $prefs;
        }
        elseif(is_array($prefs) || $prefs instanceof Traversable) {
            $this->_prefs = new AuthPrefs($prefs);
        }
        return $this;
    }

    /**
     * Add a pref
     *
     * @param  Pref $pref
     * @return self
     */
    public function addPref(Pref $pref)
    {
        if (!($this->_prefs instanceof AuthPrefs)) {
            $this->_prefs = new AuthPrefs();
        }
        $this->_prefs->addPref($pref);
        return $this;
    }

    /**
     * Gets requested attribute settings
     *
     * @return AuthAttrs
     */
    public function getAttrs()
    {
        return $this->_attrs;
    }

    /**
     * Sets requested attribute settings
     *
     * @param  AuthAttrs|array $attrs
     * @return self
     */
    public function setAttrs($attrs)
    {
        if ($attrs instanceof AuthAttrs) {
            $this->_attrs = $attrs;
        }
        elseif(is_array($attrs) || $attrs instanceof Traversable) {
            $this->_attrs = new AuthAttrs($attrs);
        }
        return $this;
    }

    /**
     * Add an attr
     *
     * @param  Attr $pref
     * @return self
     */
    public function addAttr(Attr $attr)
    {
        if (!($this->_attrs instanceof AuthAttrs)) {
            $this->_attrs = new AuthAttrs();
        }
        $this->_attrs->addAttr($attr);
        return $this;
    }

    /**
     * Gets two factor auth required
     *
     * @return int
     */
    public function getTwoFactorAuthRequired()
    {
        return $this->_twoFactorAuthRequired;
    }

    /**
     * Sets two factor auth required
     *
     * @param  int $twoFactorAuthRequired
     * @return self
     */
    public function setTwoFactorAuthRequired($twoFactorAuthRequired)
    {
        $this->_twoFactorAuthRequired = (bool) $twoFactorAuthRequired;
        return $this;
    }

    /**
     * Gets trusted devices enabled
     *
     * @return int
     */
    public function getTrustedDevicesEnabled()
    {
        return $this->_trustedDevicesEnabled;
    }

    /**
     * Sets trusted devices enabled
     *
     * @param  int $trustedDevicesEnabled
     * @return self
     */
    public function setTrustedDevicesEnabled($trustedDevicesEnabled)
    {
        $this->_trustedDevicesEnabled = (bool) $trustedDevicesEnabled;
        return $this;
    }
}
