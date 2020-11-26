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
use Zimbra\Account\Struct\{Attr, AuthAttrs, AuthPrefs, AuthToken, PreAuth, Pref};
use Zimbra\Soap\Request;
use Zimbra\Struct\AccountSelector;

/**
 * AuthRequest class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="AuthRequest")
 */
class AuthRequest extends Request
{
    /**
     * Controls whether the auth token cookie in the response should be persisted when the browser exits.
     * @Accessor(getter="getPersistAuthTokenCookie", setter="setPersistAuthTokenCookie")
     * @SerializedName("persistAuthTokenCookie")
     * @Type("bool")
     * @XmlAttribute
     */
    private $persistAuthTokenCookie;

    /**
     * Controls whether the client supports CSRF token
     * @Accessor(getter="getCsrfSupported", setter="setCsrfSupported")
     * @SerializedName("csrfTokenSecured")
     * @Type("bool")
     * @XmlAttribute
     */
    private $csrfSupported;

    /**
     * Specifies the account to authenticate against
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Struct\AccountSelector")
     * @XmlElement
     */
    private $account;

    /**
     * Password to use in conjunction with an account
     * @Accessor(getter="getPassword", setter="setPassword")
     * @SerializedName("password")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $password;

    /**
     * RecoveryCode to use in conjunction with an account in case of forgot password flow.
     * @Accessor(getter="getRecoveryCode", setter="setRecoveryCode")
     * @SerializedName("recoveryCode")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $recoveryCode;

    /**
     * The preauth
     * @Accessor(getter="getPreauth", setter="setPreauth")
     * @SerializedName("preauth")
     * @Type("Zimbra\Account\Struct\PreAuth")
     * @XmlElement
     */
    private $preauth;

    /**
     * An authToken can be passed instead of account/password/preauth to validate an existing auth token.
     * @Accessor(getter="getAuthToken", setter="setAuthToken")
     * @SerializedName("authToken")
     * @Type("Zimbra\Account\Struct\AuthToken")
     * @XmlElement
     */
    private $authToken;

    /**
     * JWT auth token
     * @Accessor(getter="getJwtToken", setter="setJwtToken")
     * @SerializedName("jwtToken")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $jwtToken;

    /**
     * If specified (in conjunction with by="name"), virtual-host is used to determine the domain of the account name, if it does not include a domain component.
     * @Accessor(getter="getVirtualHost", setter="setVirtualHost")
     * @SerializedName("virtualHost")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $virtualHost;

    /**
     * Requested preference settings.
     * @Accessor(getter="getPrefs", setter="setPrefs")
     * @SerializedName("prefs")
     * @Type("Zimbra\Account\Struct\AuthPrefs")
     * @XmlElement
     */
    private $prefs;

    /**
     * Requested attribute settings. Only attributes that are allowed to be returned by GetInfo will be returned by this call
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @SerializedName("attrs")
     * @Type("Zimbra\Account\Struct\AuthAttrs")
     * @XmlElement
     */
    private $attrs;

    /**
     * The requestedSkin. If specified the name of the skin requested by the client.
     * @Accessor(getter="getRequestedSkin", setter="setRequestedSkin")
     * @SerializedName("requestedSkin")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $requestedSkin;

    /**
     * The TOTP code used for two-factor authentication
     * @Accessor(getter="getTwoFactorCode", setter="setTwoFactorCode")
     * @SerializedName("twoFactorCode")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $twoFactorCode;

    /**
     * Whether the client represents a trusted device
     * @Accessor(getter="getDeviceTrusted", setter="setDeviceTrusted")
     * @SerializedName("deviceTrusted")
     * @Type("bool")
     * @XmlAttribute
     */
    private $deviceTrusted;

    /**
     * Whether the client represents a trusted device
     * @Accessor(getter="getTrustedDeviceToken", setter="setTrustedDeviceToken")
     * @SerializedName("trustedDeviceToken")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $trustedDeviceToken;

    /**
     * Unique device identifier; used to verify trusted mobile devices
     * @Accessor(getter="getDeviceId", setter="setDeviceId")
     * @SerializedName("deviceId")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $deviceId;

    /**
     * @Accessor(getter="getGenerateDeviceId", setter="setGenerateDeviceId")
     * @SerializedName("generateDeviceId")
     * @Type("bool")
     * @XmlAttribute
     */
    private $generateDeviceId;

    /**
     * type of token to be returned, it can be auth or jwt
     * @Accessor(getter="getTokenType", setter="setTokenType")
     * @SerializedName("tokenType")
     * @Type("string")
     * @XmlAttribute
     */
    private $tokenType;

    /**
     * Constructor method for AuthRequest
     * @param  Account   $account
     * @param  string    $password
     * @param  string    $recoveryCode
     * @param  PreAuth   $preauth
     * @param  AuthToken $authToken
     * @param  string    $jwtToken
     * @param  string    $virtualHost
     * @param  AuthPrefs $prefs
     * @param  AuthAttrs $attrs
     * @param  string    $requestedSkin
     * @param  bool      $persistAuthTokenCookie
     * @param  bool      $csrfSupported
     * @param  string    $twoFactorCode
     * @param  bool      $deviceTrusted
     * @param  string    $trustedDeviceToken
     * @param  string    $deviceId
     * @param  bool      $generateDeviceId
     * @param  string    $tokenType
     * @return self
     */
    public function __construct(
        AccountSelector $account = NULL,
        $password = NULL,
        $recoveryCode = NULL,
        PreAuth $preauth = NULL,
        AuthToken $authToken = NULL,
        $jwtToken = NULL,
        $virtualHost = NULL,
        AuthPrefs $prefs = NULL,
        AuthAttrs $attrs = NULL,
        $requestedSkin = NULL,
        $persistAuthTokenCookie = NULL,
        $csrfSupported = NULL,
        $twoFactorCode = NULL,
        $deviceTrusted = NULL,
        $trustedDeviceToken = NULL,
        $deviceId = NULL,
        $generateDeviceId = NULL,
        $tokenType = NULL
    )
    {
        if($account instanceof AccountSelector) {
            $this->setAccount($account);
        }
        if(NULL !== $password) {
            $this->setPassword($password);
        }
        if(NULL !== $recoveryCode) {
            $this->setRecoveryCode($recoveryCode);
        }
        if($preauth instanceof PreAuth) {
            $this->setPreauth($preauth);
        }
        if($authToken instanceof AuthToken) {
            $this->setAuthToken($authToken);
        }
        if(NULL !== $jwtToken) {
            $this->setJwtToken($jwtToken);
        }
        if(NULL !== $virtualHost) {
            $this->setVirtualHost($virtualHost);
        }
        if($prefs instanceof AuthPrefs) {
            $this->setPrefs($prefs);
        }
        if($attrs instanceof AuthAttrs) {
            $this->setAttrs($attrs);
        }
        if(NULL !== $requestedSkin) {
            $this->setRequestedSkin($requestedSkin);
        }
        if(NULL !== $persistAuthTokenCookie) {
            $this->setPersistAuthTokenCookie($persistAuthTokenCookie);
        }
        if(NULL !== $csrfSupported) {
            $this->setCsrfSupported($csrfSupported);
        }
        if(NULL !== $twoFactorCode) {
            $this->setTwoFactorCode($twoFactorCode);
        }
        if(NULL !== $deviceTrusted) {
            $this->setDeviceTrusted($deviceTrusted);
        }
        if(NULL !== $trustedDeviceToken) {
            $this->setTrustedDeviceToken($trustedDeviceToken);
        }
        if(NULL !== $deviceId) {
            $this->setDeviceId($deviceId);
        }
        if(NULL !== $generateDeviceId) {
            $this->setGenerateDeviceId($generateDeviceId);
        }
        if(NULL !== $tokenType) {
            $this->setTokenType($tokenType);
        }
    }

    /**
     * Gets controls whether the auth token cookie
     *
     * @return bool
     */
    public function getPersistAuthTokenCookie(): ?bool
    {
        return $this->persistAuthTokenCookie;
    }

    /**
     * Sets controls whether the auth token cookie
     *
     * @param  bool $persistAuthTokenCookie
     * @return self
     */
    public function setPersistAuthTokenCookie(bool $persistAuthTokenCookie): self
    {
        $this->persistAuthTokenCookie = $persistAuthTokenCookie;
        return $this;
    }

    /**
     * Gets controls whether the client supports CSRF token
     *
     * @return bool
     */
    public function getCsrfSupported(): ?bool
    {
        return $this->csrfSupported;
    }

    /**
     * Sets controls whether the client supports CSRF token
     *
     * @param  bool $csrfSupported
     * @return self
     */
    public function setCsrfSupported(bool $csrfSupported): self
    {
        $this->csrfSupported = $csrfSupported;
        return $this;
    }

    /**
     * Gets the account to authenticate against
     *
     * @return AccountSelector
     */
    public function getAccount(): ?AccountSelector
    {
        return $this->account;
    }

    /**
     * Sets the account to authenticate against
     *
     * @param  AccountSelector $account
     * @return self
     */
    public function setAccount(AccountSelector $account): self
    {
        $this->account = $account;
        return $this;
    }

    /**
     * Gets password to use in conjunction with an account
     *
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Sets password to use in conjunction with an account
     *
     * @param  string $password
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Gets recoveryCode to use in conjunction with an account in case of forgot password flow.
     *
     * @return string
     */
    public function getRecoveryCode(): ?string
    {
        return $this->recoveryCode;
    }

    /**
     * Sets recoveryCode to use in conjunction with an account in case of forgot password flow.
     *
     * @param  string $recoveryCode
     * @return self
     */
    public function setRecoveryCode(string $recoveryCode): self
    {
        $this->recoveryCode = $recoveryCode;
        return $this;
    }

    /**
     * Gets preauth
     *
     * @return PreAuth
     */
    public function getPreauth(): ?PreAuth
    {
        return $this->preauth;
    }

    /**
     * Sets preauth
     *
     * @param  PreAuth $preauth
     * @return self
     */
    public function setPreauth(PreAuth $preauth): self
    {
        $this->preauth = $preauth;
        return $this;
    }

    /**
     * Gets auth token
     *
     * @return AuthToken
     */
    public function getAuthToken(): ?AuthToken
    {
        return $this->authToken;
    }

    /**
     * Sets auth token
     *
     * @param  AuthToken $preauth
     * @return self
     */
    public function setAuthToken(AuthToken $authToken): self
    {
        $this->authToken = $authToken;
        return $this;
    }

    /**
     * Gets jwt token
     *
     * @return string
     */
    public function getJwtToken(): ?string
    {
        return $this->jwtToken;
    }

    /**
     * Sets jwt token
     *
     * @param  string $jwtToken
     * @return self
     */
    public function setJwtToken(string $jwtToken): self
    {
        $this->jwtToken = $jwtToken;
        return $this;
    }

    /**
     * Gets virtual host
     *
     * @return string
     */
    public function getVirtualHost(): ?string
    {
        return $this->virtualHost;
    }

    /**
     * Sets virtual host
     *
     * @param  string $virtualHost
     * @return self
     */
    public function setVirtualHost(string $virtualHost): self
    {
        $this->virtualHost = $virtualHost;
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
     * @param  AuthPrefs|array $attrs
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
     * Gets name of the skin requested by the client
     *
     * @return string
     */
    public function getRequestedSkin(): ?string
    {
        return $this->requestedSkin;
    }

    /**
     * Sets name of the skin requested by the client
     *
     * @param  string $requestedSkin
     * @return self
     */
    public function setRequestedSkin(string $requestedSkin): self
    {
        $this->requestedSkin = $requestedSkin;
        return $this;
    }

    /**
     * Gets the TOTP code used for two-factor authentication
     *
     * @return string
     */
    public function getTwoFactorCode(): ?string
    {
        return $this->twoFactorCode;
    }

    /**
     * Sets the TOTP code used for two-factor authentication
     *
     * @param  string $twoFactorCode
     * @return self
     */
    public function setTwoFactorCode(string $twoFactorCode): self
    {
        $this->twoFactorCode = $twoFactorCode;
        return $this;
    }

    /**
     * Gets trusted device flag
     *
     * @return bool
     */
    public function getDeviceTrusted(): ?bool
    {
        return $this->deviceTrusted;
    }

    /**
     * Sets trusted device flag
     *
     * @param  bool $deviceTrusted
     * @return self
     */
    public function setDeviceTrusted(bool $deviceTrusted): self
    {
        $this->deviceTrusted = $deviceTrusted;
        return $this;
    }

    /**
     * Gets trusted device token
     *
     * @return string
     */
    public function getTrustedDeviceToken(): ?string
    {
        return $this->trustedDeviceToken;
    }

    /**
     * Sets trusted device token
     *
     * @param  string $trustedDeviceToken
     * @return self
     */
    public function setTrustedDeviceToken(string $trustedDeviceToken): self
    {
        $this->trustedDeviceToken = $trustedDeviceToken;
        return $this;
    }

    /**
     * Gets device identifier
     *
     * @return string
     */
    public function getDeviceId(): ?string
    {
        return $this->deviceId;
    }

    /**
     * Sets device identifier
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
     * Gets generate device id
     *
     * @return bool
     */
    public function getGenerateDeviceId(): ?bool
    {
        return $this->generateDeviceId;
    }

    /**
     * Sets generate device id
     *
     * @param  bool $generateDeviceId
     * @return self
     */
    public function setGenerateDeviceId(bool $generateDeviceId): self
    {
        $this->generateDeviceId = $generateDeviceId;
        return $this;
    }

    /**
     * Gets type of token to be returned, it can be auth or jwt
     *
     * @return string
     */
    public function getTokenType(): ?string
    {
        return $this->tokenType;
    }

    /**
     * Sets type of token to be returned, it can be auth or jwt
     *
     * @param  string $tokenType
     * @return self
     */
    public function setTokenType(string $tokenType): self
    {
        $this->tokenType = $tokenType;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof AuthEnvelope)) {
            $this->envelope = new AuthEnvelope(
                new AuthBody($this)
            );
        }
    }
}
