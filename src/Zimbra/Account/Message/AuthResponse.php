<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};
use Zimbra\Account\Struct\{Attr, AuthAttrs, AuthPrefs, Pref, Session};
use Zimbra\Soap\ResponseInterface;

/**
 * AuthResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="AuthResponse")
 */
class AuthResponse implements ResponseInterface
{
    /**
     * @Accessor(getter="getAuthToken", setter="setAuthToken")
     * @SerializedName("authToken")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $authToken;

    /**
     * @Accessor(getter="getLifetime", setter="setLifetime")
     * @SerializedName("lifetime")
     * @Type("integer")
     * @XmlElement(cdata = false)
     */
    private $lifetime;

    /**
     * @Accessor(getter="getTrustLifetime", setter="setTrustLifetime")
     * @SerializedName("trustLifetime")
     * @Type("integer")
     * @XmlElement(cdata = false)
     */
    private $trustLifetime;

    /**
     * @Accessor(getter="getSession", setter="setSession")
     * @SerializedName("session")
     * @Type("Zimbra\Account\Struct\Session")
     * @XmlElement
     */
    private $session;

    /**
     * @Accessor(getter="getRefer", setter="setRefer")
     * @SerializedName("refer")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $refer;

    /**
     * @Accessor(getter="getSkin", setter="setSkin")
     * @SerializedName("skin")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $skin;

    /**
     * @Accessor(getter="getCsrfToken", setter="setCsrfToken")
     * @SerializedName("csrfToken")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $csrfToken;

    /**
     * @Accessor(getter="getDeviceId", setter="setDeviceId")
     * @SerializedName("deviceId")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $deviceId;

    /**
     * @Accessor(getter="getTrustedToken", setter="setTrustedToken")
     * @SerializedName("trustedToken")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $trustedToken;

    /**
     * @Accessor(getter="getZmgProxy", setter="setZmgProxy")
     * @SerializedName("zmgProxy")
     * @Type("bool")
     * @XmlAttribute
     */
    private $zmgProxy;

    /**
     * @Accessor(getter="getPrefs", setter="setPrefs")
     * @SerializedName("prefs")
     * @Type("Zimbra\Account\Struct\AuthPrefs")
     * @XmlElement
     */
    private $prefs;

    /**
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @SerializedName("attrs")
     * @Type("Zimbra\Account\Struct\AuthAttrs")
     * @XmlElement
     */
    private $attrs;

    /**
     * @Accessor(getter="getTwoFactorAuthRequired", setter="setTwoFactorAuthRequired")
     * @SerializedName("twoFactorAuthRequired")
     * @Type("bool")
     * @XmlElement(cdata = false)
     */
    private $twoFactorAuthRequired;

    /**
     * @Accessor(getter="getTrustedDevicesEnabled", setter="setTrustedDevicesEnabled")
     * @SerializedName("trustedDevicesEnabled")
     * @Type("bool")
     * @XmlElement(cdata = false)
     */
    private $trustedDevicesEnabled;

    /**
     * Constructor method for AuthResponse
     * @param  string $authToken
     * @param  int    $lifetime
     * @param  Session   $session
     * @param  string    $refer
     * @param  string    $skin
     * @param  string    $csrfToken
     * @param  string    $deviceId
     * @param  string    $trustedToken
     * @param  int    $trustLifetime
     * @param  bool    $zmgProxy
     * @param  AuthPrefs $prefs
     * @param  AuthAttrs $attrs
     * @param  bool      $twoFactorAuthRequired
     * @param  bool      $trustedDevicesEnabled
     * @return self
     */
    public function __construct(
        ?string $authToken = NULL,
        ?int $lifetime = NULL,
        ?Session $session = NULL,
        ?string $refer = NULL,
        ?string $skin = NULL,
        ?string $csrfToken = NULL,
        ?string $deviceId = NULL,
        ?string $trustedToken = NULL,
        ?int $trustLifetime = NULL,
        ?bool $zmgProxy = NULL,
        ?AuthPrefs $prefs = NULL,
        ?AuthAttrs $attrs = NULL,
        ?bool $twoFactorAuthRequired = NULL,
        ?bool $trustedDevicesEnabled = NULL
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
    public function getAuthToken(): ?string
    {
        return $this->authToken;
    }

    /**
     * Sets the authorization token
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
     * Gets life time for the authorization
     *
     * @return int
     */
    public function getLifetime(): ?int
    {
        return $this->lifetime;
    }

    /**
     * Sets life time for the authorization
     *
     * @param  int $lifetime
     * @return self
     */
    public function setLifetime(int $lifetime): self
    {
        $this->lifetime = $lifetime;
        return $this;
    }

    /**
     * Gets trust lifetime, if a trusted token is issued
     *
     * @return int
     */
    public function getTrustLifetime(): ?int
    {
        return $this->trustLifetime;
    }

    /**
     * Sets trust lifetime, if a trusted token is issued
     *
     * @param  int $trustLifetime
     * @return self
     */
    public function setTrustLifetime(int $trustLifetime): self
    {
        $this->trustLifetime = $trustLifetime;
        return $this;
    }

    /**
     * Gets session information
     *
     * @return Session
     */
    public function getSession(): ?Session
    {
        return $this->session;
    }

    /**
     * Sets session information
     *
     * @param  Session $session
     * @return self
     */
    public function setSession(Session $session): self
    {
        $this->session = $session;
        return $this;
    }

    /**
     * Gets host additional SOAP requests should be directed to.
     *
     * @return string
     */
    public function getRefer(): ?string
    {
        return $this->refer;
    }

    /**
     * Sets host additional SOAP requests should be directed to.
     *
     * @param  string $refer
     * @return self
     */
    public function setRefer(string $refer): self
    {
        $this->refer = $refer;
        return $this;
    }

    /**
     * Gets the name of the skin to use, if requestedSkin specified
     *
     * @return string
     */
    public function getSkin(): ?string
    {
        return $this->skin;
    }

    /**
     * Sets the name of the skin to use, if requestedSkin specified
     *
     * @param  string $skin
     * @return self
     */
    public function setSkin(string $skin): self
    {
        $this->skin = $skin;
        return $this;
    }

    /**
     * Gets the CSRF token, if client is CSRF token enabled
     *
     * @return string
     */
    public function getCsrfToken(): ?string
    {
        return $this->csrfToken;
    }

    /**
     * Sets the CSRF token, if client is CSRF token enabled
     *
     * @param  string $csrfToken
     * @return self
     */
    public function setCsrfToken(string $csrfToken): self
    {
        $this->csrfToken = $csrfToken;
        return $this;
    }

    /**
     * Gets random secure device ID generated for the requesting device
     *
     * @return string
     */
    public function getDeviceId(): ?string
    {
        return $this->deviceId;
    }

    /**
     * Sets random secure device ID generated for the requesting device
     *
     * @param  string $deviceId
     * @return self
     */
    public function setDeviceId(string $deviceId): self
    {
        $this->deviceId = $deviceId;
        return $this;
    }

    /**
     * Gets trusted device token
     *
     * @return string
     */
    public function getTrustedToken(): ?string
    {
        return $this->trustedToken;
    }

    /**
     * Sets trusted device token
     *
     * @param  string $trustedToken
     * @return self
     */
    public function setTrustedToken(string $trustedToken): self
    {
        $this->trustedToken = $trustedToken;
        return $this;
    }

    /**
     * Gets indicates whether the authentication account acts as a "Proxy" to a Zimbra account on another system.
     *
     * @return bool
     */
    public function getZmgProxy(): ?bool
    {
        return $this->zmgProxy;
    }

    /**
     * Sets indicates whether the authentication account acts as a "Proxy" to a Zimbra account on another system.
     *
     * @param  bool $zmgProxy
     * @return self
     */
    public function setZmgProxy(bool $zmgProxy): self
    {
        $this->zmgProxy = $zmgProxy;
        return $this;
    }

    /**
     * Gets requested preference settings
     *
     * @return AuthPrefs
     */
    public function getPrefs(): ?AuthPrefs
    {
        return $this->prefs;
    }

    /**
     * Sets requested preference settings
     *
     * @param  AuthPrefs|array $prefs
     * @return self
     */
    public function setPrefs($prefs): self
    {
        if ($prefs instanceof AuthPrefs) {
            $this->prefs = $prefs;
        }
        elseif(is_array($prefs) || $prefs instanceof Traversable) {
            $this->prefs = new AuthPrefs($prefs);
        }
        return $this;
    }

    /**
     * Add a pref
     *
     * @param  Pref $pref
     * @return self
     */
    public function addPref(Pref $pref): self
    {
        if (!($this->prefs instanceof AuthPrefs)) {
            $this->prefs = new AuthPrefs();
        }
        $this->prefs->addPref($pref);
        return $this;
    }

    /**
     * Gets requested attribute settings
     *
     * @return AuthAttrs
     */
    public function getAttrs(): ?AuthAttrs
    {
        return $this->attrs;
    }

    /**
     * Sets requested attribute settings
     *
     * @param  AuthAttrs|array $attrs
     * @return self
     */
    public function setAttrs($attrs): self
    {
        if ($attrs instanceof AuthAttrs) {
            $this->attrs = $attrs;
        }
        elseif(is_array($attrs) || $attrs instanceof Traversable) {
            $this->attrs = new AuthAttrs($attrs);
        }
        return $this;
    }

    /**
     * Add an attr
     *
     * @param  Attr $pref
     * @return self
     */
    public function addAttr(Attr $attr): self
    {
        if (!($this->attrs instanceof AuthAttrs)) {
            $this->attrs = new AuthAttrs();
        }
        $this->attrs->addAttr($attr);
        return $this;
    }

    /**
     * Gets two factor auth required
     *
     * @return bool
     */
    public function getTwoFactorAuthRequired(): ?bool
    {
        return $this->twoFactorAuthRequired;
    }

    /**
     * Sets two factor auth required
     *
     * @param  int $twoFactorAuthRequired
     * @return self
     */
    public function setTwoFactorAuthRequired(bool $twoFactorAuthRequired): self
    {
        $this->twoFactorAuthRequired = $twoFactorAuthRequired;
        return $this;
    }

    /**
     * Gets trusted devices enabled
     *
     * @return bool
     */
    public function getTrustedDevicesEnabled(): ?bool
    {
        return $this->trustedDevicesEnabled;
    }

    /**
     * Sets trusted devices enabled
     *
     * @param  int $trustedDevicesEnabled
     * @return self
     */
    public function setTrustedDevicesEnabled(bool $trustedDevicesEnabled): self
    {
        $this->trustedDevicesEnabled = $trustedDevicesEnabled;
        return $this;
    }
}
