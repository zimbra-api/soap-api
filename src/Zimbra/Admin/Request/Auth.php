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

use Zimbra\Soap\Request;
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
     * @param bool    $persistAuthTokenCookie Controls whether the auth authToken cookie in the response should be persisted when the browser exits.
     * @return self
     */
    public function __construct(
        $name = null,
        $password = null,
        $authToken = null,
        Account $account = null,
        $virtualHost = null,
        $persistAuthTokenCookie = null)
    {
        parent::__construct();
        if(null !== $name)
        {
            $this->property('name', trim($name));
        }
        if(null !== $password)
        {
            $this->property('password', trim($password));
        }
        if(null !== $authToken)
        {
            $this->child('authToken', trim($authToken));
        }
        if($account instanceof Account)
        {
            $this->child('account', $account);
        }
        if(null !== $virtualHost)
        {
            $this->child('virtualHost', trim($virtualHost));
        }
        if(null !== $persistAuthTokenCookie)
        {
            $this->property('persistAuthTokenCookie', (bool) $persistAuthTokenCookie);
        }
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->property('name');
        }
        return $this->property('name', trim($name));
    }

    /**
     * Gets or sets password
     *
     * @param  string $password
     * @return string|self
     */
    public function password($password = null)
    {
        if(null === $password)
        {
            return $this->property('password');
        }
        return $this->property('password', trim($password));
    }

    /**
     * Gets or sets authToken
     *
     * @param  string $authToken
     * @return string|self
     */
    public function authToken($authToken = null)
    {
        if(null === $authToken)
        {
            return $this->child('authToken');
        }
        return $this->child('authToken', trim($authToken));
    }

    /**
     * Gets or sets account
     *
     * @param  Account $account
     * @return Account|self
     */
    public function account(Account $account = null)
    {
        if(null === $account)
        {
            return $this->child('account');
        }
        return $this->child('account', $account);
    }

    /**
     * Gets or sets virtualHost
     *
     * @param  string $virtualHost
     * @return string|self
     */
    public function virtualHost($virtualHost = null)
    {
        if(null === $virtualHost)
        {
            return $this->child('virtualHost');
        }
        return $this->child('virtualHost', trim($virtualHost));
    }

    /**
     * Gets or sets persistAuthTokenCookie
     *
     * @param  bool $persistAuthTokenCookie
     * @return bool|self
     */
    public function persistAuthTokenCookie($persistAuthTokenCookie = null)
    {
        if(null === $persistAuthTokenCookie)
        {
            return $this->property('persistAuthTokenCookie');
        }
        return $this->property('persistAuthTokenCookie', (bool) $persistAuthTokenCookie);
    }
}
