<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Struct\AccountSelector as Account;

/**
 * Auth request class
 * Authenticate for administration
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class Auth extends Base
{
    /**
     * Constructor method for Auth
     * @param string  $name Name. Only one of {auth-name} or <account> can be specified
     * @param string  $password Password - must be present if not using AuthToken
     * @param string  $authToken An authToken can be passed instead of account/password/name to validate an existing auth authToken.
     * @param Account $account The account
     * @param string  $virtualHost Virtual host
     * @param string  $twoFactorCode The TOTP code used for two-factor authentication
     * @param bool    $persistAuthTokenCookie Controls whether the auth authToken cookie in the response should be persisted when the browser exits.
     * @param bool    $csrfSupported Controls whether the client supports CSRF token
     * @return self
     */
    public function __construct(
        $name = null,
        $password = null,
        $authToken = null,
        Account $account = null,
        $virtualHost = null,
        $twoFactorCode = null,
        $persistAuthTokenCookie = null,
        $csrfSupported = null
    )
    {
        parent::__construct();
        if(null !== $name)
        {
            $this->setProperty('name', trim($name));
        }
        if(null !== $password)
        {
            $this->setProperty('password', trim($password));
        }
        if(null !== $authToken)
        {
            $this->setChild('authToken', trim($authToken));
        }
        if($account instanceof Account)
        {
            $this->setChild('account', $account);
        }
        if(null !== $virtualHost)
        {
            $this->setChild('virtualHost', trim($virtualHost));
        }
        if(null !== $twoFactorCode)
        {
            $this->setChild('twoFactorCode', trim($twoFactorCode));
        }
        if(null !== $persistAuthTokenCookie)
        {
            $this->setProperty('persistAuthTokenCookie', (bool) $persistAuthTokenCookie);
        }
        if(null !== $csrfSupported)
        {
            $this->setProperty('csrfSupported', (bool) $csrfSupported);
        }
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->getProperty('password');
    }

    /**
     * Sets password
     *
     * @param  string $password
     * @return self
     */
    public function setPassword($password)
    {
        return $this->setProperty('password', trim($password));
    }

    /**
     * Gets auth token
     *
     * @return string
     */
    public function getAuthToken()
    {
        return $this->getChild('authToken');
    }

    /**
     * Sets auth token
     *
     * @param  string $authToken
     * @return self
     */
    public function setAuthToken($authToken)
    {
        return $this->setChild('authToken', trim($authToken));
    }

    /**
     * Gets the account.
     *
     * @return Account
     */
    public function getAccount()
    {
        return $this->getChild('account');
    }

    /**
     * Sets the account.
     *
     * @param  Account $account
     * @return self
     */
    public function setAccount(Account $account)
    {
        return $this->setChild('account', $account);
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
     * Gets  the TOTP code used for two-factor authentication
     *
     * @return string
     */
    public function getTwoFactorCode()
    {
        return $this->getChild('twoFactorCode');
    }

    /**
     * Sets  the TOTP code used for two-factor authentication
     *
     * @param  string $twoFactorCode
     * @return self
     */
    public function setTwoFactorCode($twoFactorCode)
    {
        return $this->setChild('twoFactorCode', trim($twoFactorCode));
    }

    /**
     * Gets persistAuthTokenCookie flag
     *
     * @return bool
     */
    public function getPersistAuthTokenCookie()
    {
        return $this->getProperty('persistAuthTokenCookie');
    }

    /**
     * Sets persistAuthTokenCookie flag
     *
     * @param  bool $persistAuthTokenCookie
     * @return self
     */
    public function setPersistAuthTokenCookie($persistAuthTokenCookie)
    {
        return $this->setProperty('persistAuthTokenCookie', (bool) $persistAuthTokenCookie);
    }

    /**
     * Gets csrfSupported flag
     *
     * @return bool
     */
    public function getCsrfSupported()
    {
        return $this->getProperty('csrfSupported');
    }

    /**
     * Sets csrfSupported flag
     *
     * @param  bool $csrfSupported
     * @return self
     */
    public function setCsrfSupported($csrfSupported)
    {
        return $this->setProperty('csrfSupported', (bool) $csrfSupported);
    }
}
