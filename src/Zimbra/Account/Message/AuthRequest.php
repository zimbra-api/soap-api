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
use Zimbra\Account\Struct\AuthToken;
use Zimbra\Account\Struct\PreAuth;
use Zimbra\Account\Struct\Pref;
use Zimbra\Soap\ClientInterface;
use Zimbra\Soap\Request;
use Zimbra\Struct\AccountSelector;

/**
 * AuthRequest class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="AuthRequest")
 */
class AuthRequest extends Request
{
    /**
     * @Accessor(getter="getPersistAuthTokenCookie", setter="setPersistAuthTokenCookie")
     * @SerializedName("persistAuthTokenCookie")
     * @Type("bool")
     * @XmlAttribute
     */
    private $_persistAuthTokenCookie;

    /**
     * @Accessor(getter="getCsrfSupported", setter="setCsrfSupported")
     * @SerializedName("csrfTokenSecured")
     * @Type("bool")
     * @XmlAttribute
     */
    private $_csrfSupported;

    /**
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Struct\AccountSelector")
     * @XmlElement
     */
    private $_account;

    /**
     * @Accessor(getter="getPassword", setter="setPassword")
     * @SerializedName("password")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $_password;

    /**
     * @Accessor(getter="getPreauth", setter="setPreauth")
     * @SerializedName("preauth")
     * @Type("Zimbra\Account\Struct\PreAuth")
     * @XmlElement
     */
    private $_preauth;

    /**
     * @Accessor(getter="getAuthToken", setter="setAuthToken")
     * @SerializedName("authToken")
     * @Type("Zimbra\Account\Struct\AuthToken")
     * @XmlElement
     */
    private $_authToken;

    /**
     * @Accessor(getter="getVirtualHost", setter="setVirtualHost")
     * @SerializedName("virtualHost")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $_virtualHost;

    /**
     * @Accessor(getter="getPrefs", setter="setPrefs")
     * @SerializedName("prefs")
     * @Type("Zimbra\Account\Struct\AuthPrefs")
     * @XmlElement
     */
    private $_prefs;

    /**
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @SerializedName("attrs")
     * @Type("Zimbra\Account\Struct\AuthAttrs")
     * @XmlElement
     */
    private $_attrs;

    /**
     * @Accessor(getter="getRequestedSkin", setter="setRequestedSkin")
     * @SerializedName("requestedSkin")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $_requestedSkin;

    /**
     * @Accessor(getter="getTwoFactorCode", setter="setTwoFactorCode")
     * @SerializedName("twoFactorCode")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $_twoFactorCode;

    /**
     * @Accessor(getter="getDeviceTrusted", setter="setDeviceTrusted")
     * @SerializedName("deviceTrusted")
     * @Type("bool")
     * @XmlAttribute
     */
    private $_deviceTrusted;

    /**
     * @Accessor(getter="getTrustedDeviceToken", setter="setTrustedDeviceToken")
     * @SerializedName("trustedDeviceToken")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $_trustedDeviceToken;

    /**
     * @Accessor(getter="getDeviceId", setter="setDeviceId")
     * @SerializedName("deviceId")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $_deviceId;

    /**
     * @Accessor(getter="getGenerateDeviceId", setter="setGenerateDeviceId")
     * @SerializedName("generateDeviceId")
     * @Type("bool")
     * @XmlAttribute
     */
    private $_generateDeviceId;

    /**
     * Constructor method for AuthRequest
     * @param  Account   $account Specifies the account to authenticate against
     * @param  string    $password Password to use in conjunction with an account
     * @param  PreAuth   $preauth The preauth
     * @param  AuthToken $authToken An authToken can be passed instead of account/password/preauth to validate an existing auth token.
     * @param  string    $virtualHost If specified (in conjunction with by="name"), virtual-host is used to determine the domain of the account name, if it does not include a domain component.
     * @param  AuthPrefs $prefs Preference
     * @param  AuthAttrs $attrs The attributes
     * @param  string    $requestedSkin The requestedSkin. If specified the name of the skin requested by the client.
     * @param  bool      $csrfTokenSecured Controls whether the client supports CSRF token.
     * @return self
     */
    public function __construct(
        AccountSelector $account = NULL,
        $password = NULL,
        PreAuth $preauth = NULL,
        AuthToken $authToken = NULL,
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
        $generateDeviceId = NULL
    )
    {
        parent::__construct();
        if($account instanceof AccountSelector) {
            $this->setAccount($account);
        }
        if(NULL !== $password) {
            $this->setPassword($password);
        }
        if($preauth instanceof PreAuth) {
            $this->setPreauth($preauth);
        }
        if($authToken instanceof AuthToken) {
            $this->setAuthToken($authToken);
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
    }

    /**
     * Gets controls whether the auth token cookie
     *
     * @return bool
     */
    public function getPersistAuthTokenCookie()
    {
        return $this->_persistAuthTokenCookie;
    }

    /**
     * Sets controls whether the auth token cookie
     *
     * @param  bool $persistAuthTokenCookie
     * @return self
     */
    public function setPersistAuthTokenCookie($persistAuthTokenCookie)
    {
        $this->_persistAuthTokenCookie = (bool) $persistAuthTokenCookie;
        return $this;
    }

    /**
     * Gets controls whether the client supports CSRF token
     *
     * @return bool
     */
    public function getCsrfSupported()
    {
        return $this->_csrfSupported;
    }

    /**
     * Sets controls whether the client supports CSRF token
     *
     * @param  bool $csrfSupported
     * @return self
     */
    public function setCsrfSupported($csrfSupported)
    {
        $this->_csrfSupported = (bool) $csrfSupported;
        return $this;
    }

    /**
     * Gets the account to authenticate against
     *
     * @return AccountSelector
     */
    public function getAccount()
    {
        return $this->_account;
    }

    /**
     * Sets the account to authenticate against
     *
     * @param  AccountSelector $account
     * @return self
     */
    public function setAccount(AccountSelector $account)
    {
        $this->_account = $account;
        return $this;
    }

    /**
     * Gets password to use in conjunction with an account
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * Sets password to use in conjunction with an account
     *
     * @param  string $password
     * @return self
     */
    public function setPassword($password)
    {
        $this->_password = trim($password);
        return $this;
    }

    /**
     * Gets preauth
     *
     * @return PreAuth
     */
    public function getPreauth()
    {
        return $this->_preauth;
    }

    /**
     * Sets preauth
     *
     * @param  PreAuth $preauth
     * @return self
     */
    public function setPreauth(PreAuth $preauth)
    {
        $this->_preauth = $preauth;
        return $this;
    }

    /**
     * Gets auth token
     *
     * @return AuthToken
     */
    public function getAuthToken()
    {
        return $this->_authToken;
    }

    /**
     * Sets auth token
     *
     * @param  AuthToken $preauth
     * @return self
     */
    public function setAuthToken(AuthToken $authToken)
    {
        $this->_authToken = $authToken;
        return $this;
    }

    /**
     * Gets virtual host
     *
     * @return string
     */
    public function getVirtualHost()
    {
        return $this->_virtualHost;
    }

    /**
     * Sets virtual host
     *
     * @param  string $virtualHost
     * @return self
     */
    public function setVirtualHost($virtualHost)
    {
        $this->_virtualHost = trim($virtualHost);
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
     * @param  AuthPrefs|array $attrs
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
     * Gets name of the skin requested by the client
     *
     * @return string
     */
    public function getRequestedSkin()
    {
        return $this->_requestedSkin;
    }

    /**
     * Sets name of the skin requested by the client
     *
     * @param  string $requestedSkin
     * @return self
     */
    public function setRequestedSkin($requestedSkin)
    {
        $this->_requestedSkin = trim($requestedSkin);
        return $this;
    }

    /**
     * Gets the TOTP code used for two-factor authentication
     *
     * @return string
     */
    public function getTwoFactorCode()
    {
        return $this->_twoFactorCode;
    }

    /**
     * Sets the TOTP code used for two-factor authentication
     *
     * @param  string $twoFactorCode
     * @return self
     */
    public function setTwoFactorCode($twoFactorCode)
    {
        $this->_twoFactorCode = trim($twoFactorCode);
        return $this;
    }

    /**
     * Gets trusted device flag
     *
     * @return bool
     */
    public function getDeviceTrusted()
    {
        return $this->_deviceTrusted;
    }

    /**
     * Sets trusted device flag
     *
     * @param  bool $deviceTrusted
     * @return self
     */
    public function setDeviceTrusted($deviceTrusted)
    {
        $this->_deviceTrusted = (bool) $deviceTrusted;
        return $this;
    }

    /**
     * Gets trusted device token
     *
     * @return string
     */
    public function getTrustedDeviceToken()
    {
        return $this->_trustedDeviceToken;
    }

    /**
     * Sets trusted device token
     *
     * @param  string $trustedDeviceToken
     * @return self
     */
    public function setTrustedDeviceToken($trustedDeviceToken)
    {
        $this->_trustedDeviceToken = trim($trustedDeviceToken);
        return $this;
    }

    /**
     * Gets device identifier
     *
     * @return string
     */
    public function getDeviceId()
    {
        return $this->_deviceId;
    }

    /**
     * Sets device identifier
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
     * Gets generate device id
     *
     * @return bool
     */
    public function getGenerateDeviceId()
    {
        return $this->_generateDeviceId;
    }

    /**
     * Sets generate device id
     *
     * @param  bool $generateDeviceId
     * @return self
     */
    public function setGenerateDeviceId($generateDeviceId)
    {
        $this->_generateDeviceId = (bool) $generateDeviceId;
        return $this;
    }

    public function execute(ClientInterface $client)
    {
        $requestEnvelope = new AuthEnvelope();
        $requestEnvelope->setBody(new AuthBody($this));
        $response = $client->doRequest(
            $this->getSerializer()->serialize($requestEnvelope, 'xml')
        );
        $responseEnvelope = $this->getSerializer()->deserialize(
            (string) $response->getBody(),
            'Zimbra\Account\Message\AuthEnvelope', 'xml'
        );
        return $responseEnvelope->getBody()->getResponse();
    }
}
