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
use Zimbra\Soap\Request;
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
class Auth extends Request
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
     * @param  bool      $persistAuthTokenCookie Controls whether the auth token cookie in the response should be persisted when the browser exits.
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
        $persistAuthTokenCookie = null
    )
    {
        parent::__construct();
        if($account instanceof Account)
        {
            $this->child('account', $account);
        }
        if(null !== $password)
        {
            $this->child('password', trim($password));
        }
        if($preauth instanceof PreAuth)
        {
            $this->child('preauth', $preauth);
        }
        if($authToken instanceof AuthToken)
        {
            $this->child('authToken', $authToken);
        }
        if(null !== $virtualHost)
        {
            $this->child('virtualHost', trim($virtualHost));
        }
        if($prefs instanceof AuthPrefs)
        {
            $this->child('prefs', $prefs);
        }
        else
        {
            $this->child('prefs', new AuthPrefs());
        }
        if($attrs instanceof AuthAttrs)
        {
            $this->child('attrs', $attrs);
        }
        else
        {
            $this->child('attrs', new AuthAttrs());
        }
        if(null !== $requestedSkin)
        {
            $this->child('requestedSkin', trim($requestedSkin));
        }
        if(null !== $persistAuthTokenCookie)
        {
            $this->property('persistAuthTokenCookie', (bool) $persistAuthTokenCookie);
        }
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
     * Gets or sets password
     *
     * @param  string $password
     * @return string|self
     */
    public function password($password = null)
    {
        if(null === $password)
        {
            return $this->child('password');
        }
        return $this->child('password', trim($password));
    }

    /**
     * Gets or sets preauth
     *
     * @param  PreAuth $preauth
     * @return PreAuth|self
     */
    public function preauth(PreAuth $preauth = null)
    {
        if(null === $preauth)
        {
            return $this->child('preauth');
        }
        return $this->child('preauth', $preauth);
    }

    /**
     * Gets or sets authToken
     *
     * @param  AuthToken $authToken
     * @return AuthToken|self
     */
    public function authToken(AuthToken $authToken = null)
    {
        if(null === $authToken)
        {
            return $this->child('authToken');
        }
        return $this->child('authToken', $authToken);
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
     * Gets or sets prefs
     *
     * @param  AuthPrefs $prefs
     * @return AuthPrefs|self
     */
    public function prefs(AuthPrefs $prefs = null)
    {
        if(null === $prefs)
        {
            return $this->child('prefs');
        }
        return $this->child('prefs', $prefs);
    }

    /**
     * Gets or sets attrs
     *
     * @param  AuthAttrs $attrs
     * @return AuthAttrs|self
     */
    public function attrs(AuthAttrs $attrs = null)
    {
        if(null === $attrs)
        {
            return $this->child('attrs');
        }
        return $this->child('attrs', $attrs);
    }

    /**
     * Gets or sets requestedSkin
     *
     * @param  string $requestedSkin
     * @return string|self
     */
    public function requestedSkin($requestedSkin = null)
    {
        if(null === $requestedSkin)
        {
            return $this->child('requestedSkin');
        }
        return $this->child('requestedSkin', trim($requestedSkin));
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
