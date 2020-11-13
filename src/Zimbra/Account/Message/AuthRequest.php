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
 * @XmlRoot(name="AuthRequest", namespace="urn:zimbraAccount")
 */
class AuthRequest extends Request
{
    /**
     * @Accessor(getter="getPersistAuthTokenCookie", setter="setPersistAuthTokenCookie")
     * @SerializedName("persistAuthTokenCookie")
     * @Type("bool")
     * @XmlAttribute
     */
    private $persistAuthTokenCookie;

    /**
     * @Accessor(getter="getCsrfSupported", setter="setCsrfSupported")
     * @SerializedName("csrfTokenSecured")
     * @Type("bool")
     * @XmlAttribute
     */
    private $csrfSupported;

    /**
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Struct\AccountSelector")
     * @XmlElement
     */
    private $account;

    /**
     * @Accessor(getter="getPassword", setter="setPassword")
     * @SerializedName("password")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $password;

    /**
     * @Accessor(getter="getRecoveryCode", setter="setRecoveryCode")
     * @SerializedName("recoveryCode")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $recoveryCode;

    /**
     * @Accessor(getter="getPreauth", setter="setPreauth")
     * @SerializedName("preauth")
     * @Type("Zimbra\Account\Struct\PreAuth")
     * @XmlElement
     */
    private $preauth;

    /**
     * @Accessor(getter="getAuthToken", setter="setAuthToken")
     * @SerializedName("authToken")
     * @Type("Zimbra\Account\Struct\AuthToken")
     * @XmlElement
     */
    private $authToken;

    /**
     * @Accessor(getter="getJwtToken", setter="setJwtToken")
     * @SerializedName("jwtToken")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $jwtToken;

    /**
     * @Accessor(getter="getVirtualHost", setter="setVirtualHost")
     * @SerializedName("virtualHost")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $virtualHost;

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
     * @Accessor(getter="getRequestedSkin", setter="setRequestedSkin")
     * @SerializedName("requestedSkin")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $requestedSkin;

    /**
     * @Accessor(getter="getTwoFactorCode", setter="setTwoFactorCode")
     * @SerializedName("twoFactorCode")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $twoFactorCode;

    /**
     * @Accessor(getter="getDeviceTrusted", setter="setDeviceTrusted")
     * @SerializedName("deviceTrusted")
     * @Type("bool")
     * @XmlAttribute
     */
    private $deviceTrusted;

    /**
     * @Accessor(getter="getTrustedDeviceToken", setter="setTrustedDeviceToken")
     * @SerializedName("trustedDeviceToken")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $trustedDeviceToken;

    /**
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
     * @Accessor(getter="getTokenType", setter="setTokenType")
     * @SerializedName("tokenType")
     * @Type("string")
     * @XmlAttribute
     */
    private $tokenType;

    /**
     * Constructor method for AuthRequest
     * @param  Account   $account Specifies the account to authenticate against
     * @param  string    $password Password to use in conjunction with an account
     * @param  string    $recoveryCode RecoveryCode to use in conjunction with an account in case of forgot password flow.
     * @param  PreAuth   $preauth The preauth
     * @param  AuthToken $authToken An authToken can be passed instead of account/password/preauth to validate an existing auth token.
     * @param  string    $jwtToken JWT auth token
     * @param  string    $virtualHost If specified (in conjunction with by="name"), virtual-host is used to determine the domain of the account name, if it does not include a domain component.
     * @param  AuthPrefs $prefs Requested preference settings.
     * @param  AuthAttrs $attrs Requested attribute settings. Only attributes that are allowed to be returned by GetInfo will be returned by this call
     * @param  string    $requestedSkin The requestedSkin. If specified the name of the skin requested by the client.
     * @param  bool      $persistAuthTokenCookie Controls whether the auth token cookie in the response should be persisted when the browser exits.
     * @param  bool      $csrfSupported Controls whether the client supports CSRF token
     * @param  string    $twoFactorCode The TOTP code used for two-factor authentication
     * @param  bool      $deviceTrusted Whether the client represents a trusted device
     * @param  string    $trustedDeviceToken Whether the client represents a trusted device
     * @param  string    $deviceId Unique device identifier; used to verify trusted mobile devices
     * @param  bool      $generateDeviceId
     * @param  string    $tokenType type of token to be returned, it can be auth or jwt
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
    public function setPersistAuthTokenCookie($persistAuthTokenCookie): self
    {
        $this->persistAuthTokenCookie = (bool) $persistAuthTokenCookie;
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
    public function setCsrfSupported($csrfSupported): self
    {
        $this->csrfSupported = (bool) $csrfSupported;
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
    public function setPassword($password): self
    {
        $this->password = trim($password);
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
    public function setRecoveryCode($recoveryCode): self
    {
        $this->recoveryCode = trim($recoveryCode);
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
    public function setJwtToken($jwtToken): self
    {
        $this->jwtToken = trim($jwtToken);
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
    public function setVirtualHost($virtualHost): self
    {
        $this->virtualHost = trim($virtualHost);
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
    public function setRequestedSkin($requestedSkin): self
    {
        $this->requestedSkin = trim($requestedSkin);
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
    public function setTwoFactorCode($twoFactorCode): self
    {
        $this->twoFactorCode = trim($twoFactorCode);
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
    public function setDeviceTrusted($deviceTrusted): self
    {
        $this->deviceTrusted = (bool) $deviceTrusted;
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
    public function setTrustedDeviceToken($trustedDeviceToken): self
    {
        $this->trustedDeviceToken = trim($trustedDeviceToken);
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
    public function setDeviceId($deviceId): self
    {
        $this->deviceId = trim($deviceId);
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
    public function setGenerateDeviceId($generateDeviceId): self
    {
        $this->generateDeviceId = (bool) $generateDeviceId;
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
    public function setTokenType($tokenType): self
    {
        $this->tokenType = trim($tokenType);
        return $this;
    }

    protected function internalInit()
    {
        $this->envelope = new AuthEnvelope(
            NULL,
            new AuthBody($this)
        );
    }
}
