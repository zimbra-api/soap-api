<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Request;

use Zimbra\Account\Struct\AuthAttrs;
use Zimbra\Account\Struct\AuthPrefs;
use Zimbra\Account\Struct\AuthToken;
use Zimbra\Account\Struct\PreAuth;
use Zimbra\Struct\AccountSelector as Account;

/**
 * Auth request class
 * Authenticate for an account.
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class Auth extends Base
{
    /**
     * Constructor method for authRequest
     * @param  Account   $account Specifies the account to authenticate against
     * @param  string    $password Password to use in conjunction with an account
     * @param  PreAuth   $preauth The preauth
     * @param  AuthToken $authToken An authToken can be passed instead of account/password/preauth to validate an existing auth token.
     * @param  string    $virtualHost If specified (in conjunction with by="name"), virtual-host is used to determine the domain of the account name, if it does not include a domain component.
     * @param  AuthPrefs $prefs Preference
     * @param  AuthAttrs $attrs The attributes
     * @param  string    $requestedSkin The requestedSkin. If specified the name of the skin requested by the client.
     * @param  string    $twoFactorCode The TOTP code used for two-factor authentication
     * @param  string    $trustedDeviceToken Whether the client represents a trusted device
     * @param  string    $deviceId Unique device identifier; used to verify trusted mobile devices
     * @param  bool      $persistAuthTokenCookie Controls whether the auth token cookie in the response should be persisted when the browser exits.
     * @param  bool      $csrfTokenSecured Controls whether the client supports CSRF token.
     * @param  bool      $deviceTrusted Whether the client represents a trusted device
     * @param  bool      $generateDeviceId
     * @return self
     */
    public function __construct(
        Account $account = null,
        $password = null,
        PreAuth $preauth = null,
        AuthToken $authToken = null,
        $virtualHost = null,
        AuthPrefs $prefs = null,
        AuthAttrs $attrs = null,
        $requestedSkin = null,
        $twoFactorCode = null,
        $trustedDeviceToken = null,
        $deviceId = null,
        $persistAuthTokenCookie = null,
        $csrfTokenSecured = null,
        $deviceTrusted = null,
        $generateDeviceId = null
    )
    {
        parent::__construct();
        if($account instanceof Account)
        {
            $this->setChild('account', $account);
        }
        if(null !== $password)
        {
            $this->setChild('password', trim($password));
        }
        if($preauth instanceof PreAuth)
        {
            $this->setChild('preauth', $preauth);
        }
        if($authToken instanceof AuthToken)
        {
            $this->setChild('authToken', $authToken);
        }
        if(null !== $virtualHost)
        {
            $this->setChild('virtualHost', trim($virtualHost));
        }
        if($prefs instanceof AuthPrefs)
        {
            $this->setChild('prefs', $prefs);
        }
        else
        {
            $this->setChild('prefs', new AuthPrefs());
        }
        if($attrs instanceof AuthAttrs)
        {
            $this->setChild('attrs', $attrs);
        }
        else
        {
            $this->setChild('attrs', new AuthAttrs());
        }
        if(null !== $requestedSkin)
        {
            $this->setChild('requestedSkin', trim($requestedSkin));
        }
        if(null !== $twoFactorCode)
        {
            $this->setChild('twoFactorCode', trim($twoFactorCode));
        }
        if(null !== $trustedDeviceToken)
        {
            $this->setChild('trustedToken', trim($trustedDeviceToken));
        }
        if(null !== $deviceId)
        {
            $this->setChild('deviceId', trim($deviceId));
        }
        if(null !== $persistAuthTokenCookie)
        {
            $this->setProperty('persistAuthTokenCookie', (bool) $persistAuthTokenCookie);
        }
        if(null !== $csrfTokenSecured)
        {
            $this->setProperty('csrfTokenSecured', (bool) $csrfTokenSecured);
        }
        if(null !== $deviceTrusted)
        {
            $this->setProperty('deviceTrusted', (bool) $deviceTrusted);
        }
        if(null !== $generateDeviceId)
        {
            $this->setProperty('generateDeviceId', (bool) $generateDeviceId);
        }
    }

    /**
     * Gets the account
     *
     * @return Account
     */
    public function getAccount()
    {
        return $this->getChild('account');
    }

    /**
     * Sets the account
     *
     * @param  Account $account
     * @return self
     */
    public function setAccount(Account $account)
    {
        return $this->setChild('account', $account);
    }

    /**
     * Gets password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->getChild('password');
    }

    /**
     * Sets password
     *
     * @param  string $password
     * @return self
     */
    public function setPassword($password)
    {
        return $this->setChild('password', trim($password));
    }

    /**
     * Gets the preauth
     *
     * @return PreAuth
     */
    public function getPreAuth()
    {
        return $this->getChild('preauth');
    }

    /**
     * Sets the preauth
     *
     * @param  PreAuth $preauth
     * @return self
     */
    public function setPreAuth(PreAuth $preauth)
    {
        return $this->setChild('preauth', $preauth);
    }

    /**
     * Gets the auth token
     *
     * @return AuthToken
     */
    public function getAuthToken()
    {
        return $this->getChild('authToken');
    }

    /**
     * Sets the auth token
     *
     * @param  AuthToken $authToken
     * @return self
     */
    public function setAuthToken(AuthToken $authToken)
    {
        return $this->setChild('authToken', $authToken);
    }

    /**
     * Gets virtual host
     *
     * @return string
     */
    public function getVirtualHost()
    {
        return $this->getChild('virtualHost');
    }

    /**
     * Sets virtual host
     *
     * @param  string $virtualHost
     * @return self
     */
    public function setVirtualHost($virtualHost)
    {
        return $this->setChild('virtualHost', trim($virtualHost));
    }

    /**
     * Gets the preference settings
     *
     * @return AuthPrefs
     */
    public function getPrefs()
    {
        return $this->getChild('prefs');
    }

    /**
     * Sets the preference settings
     *
     * @param  AuthPrefs $prefs
     * @return self
     */
    public function setPrefs(AuthPrefs $prefs)
    {
        return $this->setChild('prefs', $prefs);
    }

    /**
     * Gets the attribute settings
     *
     * @return AuthAttrs
     */
    public function getAttrs()
    {
        return $this->getChild('attrs');
    }

    /**
     * Sets the attribute settings
     *
     * @param  AuthAttrs $attrs
     * @return self
     */
    public function setAttrs(AuthAttrs $attrs)
    {
        return $this->setChild('attrs', $attrs);
    }

    /**
     * Gets the name of the skin requested
     *
     * @return string
     */
    public function getRequestedSkin()
    {
        return $this->getChild('requestedSkin');
    }

    /**
     * Sets the name of the skin requested
     *
     * @param  string $requestedSkin
     * @return self
     */
    public function setRequestedSkin($requestedSkin)
    {
        return $this->setChild('requestedSkin', trim($requestedSkin));
    }

    /**
     * Gets two-factor code
     *
     * @return string
     */
    public function getTwoFactorCode()
    {
        return $this->getChild('twoFactorCode');
    }

    /**
     * Sets two-factor code
     *
     * @param  string $twoFactorCode
     * @return self
     */
    public function setTwoFactorCode($twoFactorCode)
    {
        return $this->setChild('twoFactorCode', trim($twoFactorCode));
    }

    /**
     * Gets whether the client represents a trusted device
     *
     * @return string
     */
    public function getTrustedDeviceToken()
    {
        return $this->getChild('trustedToken');
    }

    /**
     * Sets whether the client represents a trusted device
     *
     * @param  string $trustedDeviceToken
     * @return self
     */
    public function setTrustedDeviceToken($trustedDeviceToken)
    {
        return $this->setChild('trustedToken', trim($trustedDeviceToken));
    }

    /**
     * Gets unique device identifier; used to verify trusted mobile devices
     *
     * @return string
     */
    public function getDeviceId()
    {
        return $this->getChild('deviceId');
    }

    /**
     * Sets unique device identifier; used to verify trusted mobile devices
     *
     * @param  string $deviceId
     * @return self
     */
    public function setDeviceId($deviceId)
    {
        return $this->setChild('deviceId', trim($deviceId));
    }

    /**
     * Gets controls whether the auth token cookie
     *
     * @return bool
     */
    public function getPersistAuthTokenCookie()
    {
        return $this->getProperty('persistAuthTokenCookie');
    }

    /**
     * Sets controls whether the auth token cookie
     *
     * @param  bool $persistAuthTokenCookie
     * @return self
     */
    public function setPersistAuthTokenCookie($persistAuthTokenCookie)
    {
        return $this->setProperty('persistAuthTokenCookie', (bool) $persistAuthTokenCookie);
    }

    /**
     * Gets controls whether the client supports CSRF token
     *
     * @return bool
     */
    public function getCsrfTokenSecured()
    {
        return $this->getProperty('csrfTokenSecured');
    }

    /**
     * Sets controls whether the client supports CSRF token
     *
     * @param  bool $csrfTokenSecured
     * @return self
     */
    public function setCsrfTokenSecured($csrfTokenSecured)
    {
        return $this->setProperty('csrfTokenSecured', (bool) $csrfTokenSecured);
    }

    /**
     * Gets whether the client represents a trusted device
     *
     * @return bool
     */
    public function getDeviceTrusted()
    {
        return $this->getProperty('deviceTrusted');
    }

    /**
     * Sets whether the client represents a trusted device
     *
     * @param  bool $deviceTrusted
     * @return self
     */
    public function setDeviceTrusted($deviceTrusted)
    {
        return $this->setProperty('deviceTrusted', (bool) $deviceTrusted);
    }

    /**
     * Gets generate device Id
     *
     * @return bool
     */
    public function getGenerateDeviceId()
    {
        return $this->getProperty('generateDeviceId');
    }

    /**
     * Sets generate device Id
     *
     * @param  bool $deviceTrusted
     * @return self
     */
    public function setGenerateDeviceId($generateDeviceId)
    {
        return $this->setProperty('generateDeviceId', (bool) $generateDeviceId);
    }
}
