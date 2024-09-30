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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement,
    XmlList
};
use Zimbra\Account\Struct\{Attr, Pref, Session};
use Zimbra\Common\Struct\SoapResponse;

/**
 * AuthResponse class
 * Response to account authentication request.
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AuthResponse extends SoapResponse
{
    /**
     * The authorization token
     *
     * @var string
     */
    #[Accessor(getter: "getAuthToken", setter: "setAuthToken")]
    #[SerializedName("authToken")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private $authToken;

    /**
     * Life time for the authorization
     *
     * @var int
     */
    #[Accessor(getter: "getLifetime", setter: "setLifetime")]
    #[SerializedName("lifetime")]
    #[Type("int")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private $lifetime;

    /**
     * Trust lifetime, if a trusted token is issued
     *
     * @var int
     */
    #[Accessor(getter: "getTrustLifetime", setter: "setTrustLifetime")]
    #[SerializedName("trustLifetime")]
    #[Type("int")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private $trustLifetime;

    /**
     * Session information
     *
     * @var Session
     */
    #[Accessor(getter: "getSession", setter: "setSession")]
    #[SerializedName("session")]
    #[Type(Session::class)]
    #[XmlElement(namespace: "urn:zimbraAccount")]
    private ?Session $session;

    /**
     * host additional SOAP requests should be directed to.
     * Always returned, might be same as original host request was sent to.
     *
     * @var string
     */
    #[Accessor(getter: "getRefer", setter: "setRefer")]
    #[SerializedName("refer")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private $refer;

    /**
     * if requestedSkin specified, the name of the skin to use Always returned, might be same as original host request was sent to.
     *
     * @var string
     */
    #[Accessor(getter: "getSkin", setter: "setSkin")]
    #[SerializedName("skin")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private $skin;

    /**
     * If client is CSRF token enabled , the CSRF token Returned only when client says it is CSRF enabled.
     *
     * @var string
     */
    #[Accessor(getter: "getCsrfToken", setter: "setCsrfToken")]
    #[SerializedName("csrfToken")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private $csrfToken;

    /**
     * Random secure device ID generated for the requesting device
     *
     * @var string
     */
    #[Accessor(getter: "getDeviceId", setter: "setDeviceId")]
    #[SerializedName("deviceId")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private $deviceId;

    /**
     * Trusted device token
     *
     * @var string
     */
    #[Accessor(getter: "getTrustedToken", setter: "setTrustedToken")]
    #[SerializedName("trustedToken")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private $trustedToken;

    /**
     * Indicates whether the authentication account acts as a "Proxy" to a Zimbra account on another system.
     *
     * @var bool
     */
    #[Accessor(getter: "getZmgProxy", setter: "setZmgProxy")]
    #[SerializedName("zmgProxy")]
    #[Type("bool")]
    #[XmlAttribute]
    private $zmgProxy;

    /**
     * Prefs
     *
     * @var array
     */
    #[Accessor(getter: "getPrefs", setter: "setPrefs")]
    #[SerializedName("prefs")]
    #[Type("array<Zimbra\Account\Struct\Pref>")]
    #[XmlElement(namespace: "urn:zimbraAccount")]
    #[XmlList(inline: false, entry: "pref", namespace: "urn:zimbraAccount")]
    private $prefs = [];

    /**
     * Attributes
     *
     * @var array
     */
    #[Accessor(getter: "getAttrs", setter: "setAttrs")]
    #[SerializedName("attrs")]
    #[Type("array<Zimbra\Account\Struct\Attr>")]
    #[XmlElement(namespace: "urn:zimbraAccount")]
    #[XmlList(inline: false, entry: "attr", namespace: "urn:zimbraAccount")]
    private $attrs = [];

    /**
     * Two factor auth required
     *
     * @var bool
     */
    #[
        Accessor(
            getter: "getTwoFactorAuthRequired",
            setter: "setTwoFactorAuthRequired"
        )
    ]
    #[SerializedName("twoFactorAuthRequired")]
    #[Type("bool")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private $twoFactorAuthRequired;

    /**
     * Trusted devices enabled
     *
     * @var bool
     */
    #[
        Accessor(
            getter: "getTrustedDevicesEnabled",
            setter: "setTrustedDevicesEnabled"
        )
    ]
    #[SerializedName("trustedDevicesEnabled")]
    #[Type("bool")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private $trustedDevicesEnabled;

    /**
     * Constructor
     *
     * @param  string  $authToken
     * @param  int     $lifetime
     * @param  Session $session
     * @param  string  $refer
     * @param  string  $skin
     * @param  string  $csrfToken
     * @param  string  $deviceId
     * @param  string  $trustedToken
     * @param  int     $trustLifetime
     * @param  bool    $zmgProxy
     * @param  array   $prefs
     * @param  array   $attrs
     * @param  bool    $twoFactorAuthRequired
     * @param  bool    $trustedDevicesEnabled
     * @return self
     */
    public function __construct(
        ?string $authToken = null,
        ?int $lifetime = null,
        ?Session $session = null,
        ?string $refer = null,
        ?string $skin = null,
        ?string $csrfToken = null,
        ?string $deviceId = null,
        ?string $trustedToken = null,
        ?int $trustLifetime = null,
        ?bool $zmgProxy = null,
        array $prefs = [],
        array $attrs = [],
        ?bool $twoFactorAuthRequired = null,
        ?bool $trustedDevicesEnabled = null
    ) {
        $this->session = $session;
        $this->setPrefs($prefs)->setAttrs($attrs);
        if (null !== $authToken) {
            $this->setAuthToken($authToken);
        }
        if (null !== $lifetime) {
            $this->setLifetime($lifetime);
        }
        if (null !== $refer) {
            $this->setRefer($refer);
        }
        if (null !== $skin) {
            $this->setSkin($skin);
        }
        if (null !== $csrfToken) {
            $this->setCsrfToken($csrfToken);
        }
        if (null !== $deviceId) {
            $this->setDeviceId($deviceId);
        }
        if (null !== $trustedToken) {
            $this->setTrustedToken($trustedToken);
        }
        if (null !== $trustLifetime) {
            $this->setTrustLifetime($trustLifetime);
        }
        if (null !== $zmgProxy) {
            $this->setZmgProxy($zmgProxy);
        }
        if (null !== $twoFactorAuthRequired) {
            $this->setTwoFactorAuthRequired($twoFactorAuthRequired);
        }
        if (null !== $trustedDevicesEnabled) {
            $this->setTrustedDevicesEnabled($trustedDevicesEnabled);
        }
    }

    /**
     * Get the authorization token
     *
     * @return string
     */
    public function getAuthToken(): ?string
    {
        return $this->authToken;
    }

    /**
     * Set the authorization token
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
     * Get life time for the authorization
     *
     * @return int
     */
    public function getLifetime(): ?int
    {
        return $this->lifetime;
    }

    /**
     * Set life time for the authorization
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
     * Get trust lifetime, if a trusted token is issued
     *
     * @return int
     */
    public function getTrustLifetime(): ?int
    {
        return $this->trustLifetime;
    }

    /**
     * Set trust lifetime, if a trusted token is issued
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
     * Get session information
     *
     * @return Session
     */
    public function getSession(): ?Session
    {
        return $this->session;
    }

    /**
     * Set session information
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
     * Get host additional SOAP requests should be directed to.
     *
     * @return string
     */
    public function getRefer(): ?string
    {
        return $this->refer;
    }

    /**
     * Set host additional SOAP requests should be directed to.
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
     * Get the name of the skin to use, if requestedSkin specified
     *
     * @return string
     */
    public function getSkin(): ?string
    {
        return $this->skin;
    }

    /**
     * Set the name of the skin to use, if requestedSkin specified
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
     * Get the CSRF token, if client is CSRF token enabled
     *
     * @return string
     */
    public function getCsrfToken(): ?string
    {
        return $this->csrfToken;
    }

    /**
     * Set the CSRF token, if client is CSRF token enabled
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
     * Get random secure device ID generated for the requesting device
     *
     * @return string
     */
    public function getDeviceId(): ?string
    {
        return $this->deviceId;
    }

    /**
     * Set random secure device ID generated for the requesting device
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
     * Get trusted device token
     *
     * @return string
     */
    public function getTrustedToken(): ?string
    {
        return $this->trustedToken;
    }

    /**
     * Set trusted device token
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
     * Get indicates whether the authentication account acts as a "Proxy" to a Zimbra account on another system.
     *
     * @return bool
     */
    public function getZmgProxy(): ?bool
    {
        return $this->zmgProxy;
    }

    /**
     * Set indicates whether the authentication account acts as a "Proxy" to a Zimbra account on another system.
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
     * Get requested preference settings
     *
     * @return array
     */
    public function getPrefs(): array
    {
        return $this->prefs;
    }

    /**
     * Set requested preference settings
     *
     * @param  array $prefs
     * @return self
     */
    public function setPrefs(array $prefs): self
    {
        $this->prefs = array_filter(
            $prefs,
            static fn($pref) => $pref instanceof Pref
        );
        return $this;
    }

    /**
     * Get requested attribute settings
     *
     * @return array
     */
    public function getAttrs(): array
    {
        return $this->attrs;
    }

    /**
     * Set requested attribute settings
     *
     * @param  array $attrs
     * @return self
     */
    public function setAttrs(array $attrs): self
    {
        $this->attrs = array_filter(
            $attrs,
            static fn($attr) => $attr instanceof Attr
        );
        return $this;
    }

    /**
     * Get two factor auth required
     *
     * @return bool
     */
    public function getTwoFactorAuthRequired(): ?bool
    {
        return $this->twoFactorAuthRequired;
    }

    /**
     * Set two factor auth required
     *
     * @param  bool $twoFactorAuthRequired
     * @return self
     */
    public function setTwoFactorAuthRequired(bool $twoFactorAuthRequired): self
    {
        $this->twoFactorAuthRequired = $twoFactorAuthRequired;
        return $this;
    }

    /**
     * Get trusted devices enabled
     *
     * @return bool
     */
    public function getTrustedDevicesEnabled(): ?bool
    {
        return $this->trustedDevicesEnabled;
    }

    /**
     * Set trusted devices enabled
     *
     * @param  bool $trustedDevicesEnabled
     * @return self
     */
    public function setTrustedDevicesEnabled(bool $trustedDevicesEnabled): self
    {
        $this->trustedDevicesEnabled = $trustedDevicesEnabled;
        return $this;
    }
}
