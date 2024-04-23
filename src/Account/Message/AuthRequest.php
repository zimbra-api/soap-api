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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};
use Zimbra\Account\Struct\{Attr, AuthToken, PreAuth, Pref};
use Zimbra\Common\Struct\{AccountSelector, SoapEnvelopeInterface, SoapRequest};

/**
 * AuthRequest class
 * 
 * Authenticate for an account
 * when specifying an account, one of <password> or <preauth> or <recoveryCode> must be specified. See preauth.txt for a discussion of preauth.
 * An authToken can be passed instead of account/password/preauth to validate an existing auth token.
 * If {verifyAccount}="1", <account> is required and the account in the auth token is compared to the named account.
 * Mismatch results in auth failure.
 * An external app that relies on ZCS for user identification can use this to test if the auth token provided by the user belongs to that user.
 * If {verifyAccount}="0" (default), only the auth token is verified and any <account> element specified is ignored. 
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AuthRequest extends SoapRequest
{
    /**
     * Controls whether the auth token cookie in the response should be persisted when the browser exits.
     * - 0: (default) the cookie will be deleted when the Web browser exits.
     * - 1: The "Expires" attribute of the cookie will be set per rfc6265.
     * 
     * @var bool
     */
    #[Accessor(getter: 'getPersistAuthTokenCookie', setter: 'setPersistAuthTokenCookie')]
    #[SerializedName('persistAuthTokenCookie')]
    #[Type('bool')]
    #[XmlAttribute]
    private $persistAuthTokenCookie;

    /**
     * Controls whether the client supports CSRF token
     * - 0: (default) Client does not support CSRF token
     * - 1: The client supports CSRF token.
     * 
     * @var bool
     */
    #[Accessor(getter: 'getCsrfSupported', setter: 'setCsrfSupported')]
    #[SerializedName('csrfTokenSecured')]
    #[Type('bool')]
    #[XmlAttribute]
    private $csrfSupported;

    /**
     * Specifies the account to authenticate against
     * 
     * @var AccountSelector
     */
    #[Accessor(getter: 'getAccount', setter: 'setAccount')]
    #[SerializedName('account')]
    #[Type(AccountSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private ?AccountSelector $account;

    /**
     * Password to use in conjunction with an account
     * 
     * @var string
     */
    #[Accessor(getter: 'getPassword', setter: 'setPassword')]
    #[SerializedName('password')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraAccount')]
    private $password;

    /**
     * RecoveryCode to use in conjunction with an account in case of forgot password flow.
     * 
     * @var string
     */
    #[Accessor(getter: 'getRecoveryCode', setter: 'setRecoveryCode')]
    #[SerializedName('recoveryCode')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraAccount')]
    private $recoveryCode;

    /**
     * The preauth
     * 
     * @var PreAuth
     */
    #[Accessor(getter: 'getPreauth', setter: 'setPreauth')]
    #[SerializedName('preauth')]
    #[Type(PreAuth::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private ?PreAuth $preauth;

    /**
     * An authToken can be passed instead of account/password/preauth to validate an existing auth token.
     * 
     * @var AuthToken
     */
    #[Accessor(getter: 'getAuthToken', setter: 'setAuthToken')]
    #[SerializedName('authToken')]
    #[Type(AuthToken::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private ?AuthToken $authToken;

    /**
     * JWT auth token
     * 
     * @var string
     */
    #[Accessor(getter: 'getJwtToken', setter: 'setJwtToken')]
    #[SerializedName('jwtToken')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraAccount')]
    private $jwtToken;

    /**
     * If specified (in conjunction with by="name"), virtual-host is used to determine the domain of the account name, if it does not include a domain component.
     * 
     * @var string
     */
    #[Accessor(getter: 'getVirtualHost', setter: 'setVirtualHost')]
    #[SerializedName('virtualHost')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraAccount')]
    private $virtualHost;

    /**
     * Requested preference settings.
     * 
     * @var array
     */
    #[Accessor(getter: 'getPrefs', setter: 'setPrefs')]
    #[SerializedName('prefs')]
    #[Type('array<Zimbra\Account\Struct\Pref>')]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    #[XmlList(inline: false, entry: 'pref', namespace: 'urn:zimbraAccount')]
    private $prefs = [];

    /**
     * Requested attribute settings.
     * Only attributes that are allowed to be returned by GetInfo will be returned by this call
     * 
     * @var array
     */
    #[Accessor(getter: 'getAttrs', setter: 'setAttrs')]
    #[SerializedName('attrs')]
    #[Type('array<Zimbra\Account\Struct\Attr>')]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    #[XmlList(inline: false, entry: 'attr', namespace: 'urn:zimbraAccount')]
    private $attrs = [];

    /**
     * The requestedSkin. If specified the name of the skin requested by the client.
     * 
     * @var string
     */
    #[Accessor(getter: 'getRequestedSkin', setter: 'setRequestedSkin')]
    #[SerializedName('requestedSkin')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraAccount')]
    private $requestedSkin;

    /**
     * The TOTP code used for two-factor authentication
     * 
     * @var string
     */
    #[Accessor(getter: 'getTwoFactorCode', setter: 'setTwoFactorCode')]
    #[SerializedName('twoFactorCode')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraAccount')]
    private $twoFactorCode;

    /**
     * Whether the client represents a trusted device
     * 
     * @var bool
     */
    #[Accessor(getter: 'getDeviceTrusted', setter: 'setDeviceTrusted')]
    #[SerializedName('deviceTrusted')]
    #[Type('bool')]
    #[XmlAttribute]
    private $deviceTrusted;

    /**
     * Whether the client represents a trusted device
     * 
     * @var string
     */
    #[Accessor(getter: 'getTrustedDeviceToken', setter: 'setTrustedDeviceToken')]
    #[SerializedName('trustedToken')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraAccount')]
    private $trustedDeviceToken;

    /**
     * Unique device identifier; used to verify trusted mobile devices
     * 
     * @var string
     */
    #[Accessor(getter: 'getDeviceId', setter: 'setDeviceId')]
    #[SerializedName('deviceId')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraAccount')]
    private $deviceId;

    /**
     * Generate device id
     * 
     * @var bool
     */
    #[Accessor(getter: 'getGenerateDeviceId', setter: 'setGenerateDeviceId')]
    #[SerializedName('generateDeviceId')]
    #[Type('bool')]
    #[XmlAttribute]
    private $generateDeviceId;

    /**
     * Type of token to be returned, it can be auth or jwt
     * 
     * @var string
     */
    #[Accessor(getter: 'getTokenType', setter: 'setTokenType')]
    #[SerializedName('tokenType')]
    #[Type('string')]
    #[XmlAttribute]
    private $tokenType;

    /**
     * if true SameSite=Strict cookie will not be added in AuthToken
     * 
     * @var bool
     */
    #[Accessor(getter: 'getIgnoreSameSite', setter: 'setIgnoreSameSite')]
    #[SerializedName('ignoreSameSite')]
    #[Type('bool')]
    #[XmlAttribute]
    private $ignoreSameSite;

    /**
     * Constructor
     *
     * @param  AccountSelector $account
     * @param  string    $password
     * @param  string    $recoveryCode
     * @param  PreAuth   $preauth
     * @param  AuthToken $authToken
     * @param  string    $jwtToken
     * @param  string    $virtualHost
     * @param  array $prefs
     * @param  array $attrs
     * @param  string    $requestedSkin
     * @param  bool      $persistAuthTokenCookie
     * @param  bool      $csrfSupported
     * @param  string    $twoFactorCode
     * @param  bool      $deviceTrusted
     * @param  string    $trustedDeviceToken
     * @param  string    $deviceId
     * @param  bool      $generateDeviceId
     * @param  string    $tokenType
     * @param  bool      $ignoreSameSite
     * @return self
     */
    public function __construct(
        ?AccountSelector $account = null,
        ?string $password = null,
        ?string $recoveryCode = null,
        ?PreAuth $preauth = null,
        ?AuthToken $authToken = null,
        ?string $jwtToken = null,
        ?string $virtualHost = null,
        array $prefs = [],
        array $attrs = [],
        ?string $requestedSkin = null,
        ?bool $persistAuthTokenCookie = null,
        ?bool $csrfSupported = null,
        ?string $twoFactorCode = null,
        ?bool $deviceTrusted = null,
        ?string $trustedDeviceToken = null,
        ?string $deviceId = null,
        ?bool $generateDeviceId = null,
        ?string $tokenType = null,
        ?bool $ignoreSameSite = null
    )
    {
        $this->setPrefs($prefs)
             ->setAttrs($attrs);
        $this->account = $account;
        $this->preauth = $preauth;
        $this->authToken = $authToken;
        if(null !== $password) {
            $this->setPassword($password);
        }
        if(null !== $recoveryCode) {
            $this->setRecoveryCode($recoveryCode);
        }
        if(null !== $jwtToken) {
            $this->setJwtToken($jwtToken);
        }
        if(null !== $virtualHost) {
            $this->setVirtualHost($virtualHost);
        }
        if(null !== $requestedSkin) {
            $this->setRequestedSkin($requestedSkin);
        }
        if(null !== $persistAuthTokenCookie) {
            $this->setPersistAuthTokenCookie($persistAuthTokenCookie);
        }
        if(null !== $csrfSupported) {
            $this->setCsrfSupported($csrfSupported);
        }
        if(null !== $twoFactorCode) {
            $this->setTwoFactorCode($twoFactorCode);
        }
        if(null !== $deviceTrusted) {
            $this->setDeviceTrusted($deviceTrusted);
        }
        if(null !== $trustedDeviceToken) {
            $this->setTrustedDeviceToken($trustedDeviceToken);
        }
        if(null !== $deviceId) {
            $this->setDeviceId($deviceId);
        }
        if(null !== $generateDeviceId) {
            $this->setGenerateDeviceId($generateDeviceId);
        }
        if(null !== $tokenType) {
            $this->setTokenType($tokenType);
        }
        if(null !== $ignoreSameSite) {
            $this->setIgnoreSameSite($ignoreSameSite);
        }
    }

    /**
     * Get controls whether the auth token cookie
     *
     * @return bool
     */
    public function getPersistAuthTokenCookie(): ?bool
    {
        return $this->persistAuthTokenCookie;
    }

    /**
     * Set controls whether the auth token cookie
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
     * Get controls whether the client supports CSRF token
     *
     * @return bool
     */
    public function getCsrfSupported(): ?bool
    {
        return $this->csrfSupported;
    }

    /**
     * Set controls whether the client supports CSRF token
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
     * Get the account to authenticate against
     *
     * @return AccountSelector
     */
    public function getAccount(): ?AccountSelector
    {
        return $this->account;
    }

    /**
     * Set the account to authenticate against
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
     * Get password to use in conjunction with an account
     *
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set password to use in conjunction with an account
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
     * Get recoveryCode to use in conjunction with an account in case of forgot password flow.
     *
     * @return string
     */
    public function getRecoveryCode(): ?string
    {
        return $this->recoveryCode;
    }

    /**
     * Set recoveryCode to use in conjunction with an account in case of forgot password flow.
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
     * Get preauth
     *
     * @return PreAuth
     */
    public function getPreauth(): ?PreAuth
    {
        return $this->preauth;
    }

    /**
     * Set preauth
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
     * Get auth token
     *
     * @return AuthToken
     */
    public function getAuthToken(): ?AuthToken
    {
        return $this->authToken;
    }

    /**
     * Set auth token
     *
     * @param  AuthToken $authToken
     * @return self
     */
    public function setAuthToken(AuthToken $authToken): self
    {
        $this->authToken = $authToken;
        return $this;
    }

    /**
     * Get jwt token
     *
     * @return string
     */
    public function getJwtToken(): ?string
    {
        return $this->jwtToken;
    }

    /**
     * Set jwt token
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
     * Get virtual host
     *
     * @return string
     */
    public function getVirtualHost(): ?string
    {
        return $this->virtualHost;
    }

    /**
     * Set virtual host
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
            $prefs, static fn ($pref) => $pref instanceof Pref
        );
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
        $this->prefs[] = $pref;
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
            $attrs, static fn ($attr) => $attr instanceof Attr
        );
        return $this;
    }

    /**
     * Add an attr
     *
     * @param  Attr $attr
     * @return self
     */
    public function addAttr(Attr $attr): self
    {
        $this->attrs[] = $attr;
        return $this;
    }

    /**
     * Get name of the skin requested by the client
     *
     * @return string
     */
    public function getRequestedSkin(): ?string
    {
        return $this->requestedSkin;
    }

    /**
     * Set name of the skin requested by the client
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
     * Get the TOTP code used for two-factor authentication
     *
     * @return string
     */
    public function getTwoFactorCode(): ?string
    {
        return $this->twoFactorCode;
    }

    /**
     * Set the TOTP code used for two-factor authentication
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
     * Get trusted device flag
     *
     * @return bool
     */
    public function getDeviceTrusted(): ?bool
    {
        return $this->deviceTrusted;
    }

    /**
     * Set trusted device flag
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
     * Get trusted device token
     *
     * @return string
     */
    public function getTrustedDeviceToken(): ?string
    {
        return $this->trustedDeviceToken;
    }

    /**
     * Set trusted device token
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
     * Get device identifier
     *
     * @return string
     */
    public function getDeviceId(): ?string
    {
        return $this->deviceId;
    }

    /**
     * Set device identifier
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
     * Get generate device id
     *
     * @return bool
     */
    public function getGenerateDeviceId(): ?bool
    {
        return $this->generateDeviceId;
    }

    /**
     * Set generate device id
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
     * Get type of token to be returned, it can be auth or jwt
     *
     * @return string
     */
    public function getTokenType(): ?string
    {
        return $this->tokenType;
    }

    /**
     * Set type of token to be returned, it can be auth or jwt
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
     * Get ignore same site
     *
     * @return bool
     */
    public function getIgnoreSameSite(): ?bool
    {
        return $this->ignoreSameSite;
    }

    /**
     * Set ignore same site
     *
     * @param  bool $ignoreSameSite
     * @return self
     */
    public function setIgnoreSameSite(bool $ignoreSameSite): self
    {
        $this->ignoreSameSite = $ignoreSameSite;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new AuthEnvelope(
            new AuthBody($this)
        );
    }
}
