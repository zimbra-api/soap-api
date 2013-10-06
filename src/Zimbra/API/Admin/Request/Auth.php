<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\AccountSelector as Account;

/**
 * Auth class
 * Authenticate for administration
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Auth extends Request
{
    /**
     * An authToken can be passed instead of account/password/name to validate an existing auth token.
     * @var string
     */
    private $_authToken;

    /**
     * The account
     * @var AccountSelector
     */
    private $_account;

    /**
     * Virtual host
     * @var string
     */
    private $_virtualHost;

    /**
     * Controls whether the auth token cookie in the response should be persisted when the browser exits.
     * @var boolean
     */
    private $_persistAuthTokenCookie;

    /**
     * Name. Only one of {auth-name} or <account> can be specified
     * @var string
     */
    private $_name;

    /**
     * Password - must be present if not using AuthToken
     * @var string
     */
    private $_password;

    /**
     * Constructor method for Auth
     * @param string $name
     * @param string $password
     * @param string $authToken
     * @param Account $account
     * @param string $virtualHost
     * @param bool   $persistAuthTokenCookie
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
        $this->_name = trim($name);
        $this->_password = trim($password);
        $this->_authToken = trim($authToken);
        if($account instanceof Account)
        {
            $this->_account = $account;
        }
        $this->_virtualHost = trim($virtualHost);
        if(null !== $persistAuthTokenCookie)
        {
            $this->_persistAuthTokenCookie = (bool) $persistAuthTokenCookie;
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
            return $this->_name;
        }
        $this->_name = trim($name);
        return $this;
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
            return $this->_password;
        }
        $this->_password = trim($password);
        return $this;
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
            return $this->_authToken;
        }
        $this->_authToken = trim($authToken);
        return $this;
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
            return $this->_account;
        }
        $this->_account = $account;
        return $this;
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
            return $this->_virtualHost;
        }
        $this->_virtualHost = trim($virtualHost);
        return $this;
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
            return $this->_persistAuthTokenCookie;
        }
        $this->_persistAuthTokenCookie = (bool) $persistAuthTokenCookie;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(!empty($this->_name))
        {
            $this->array['name'] = $this->_name;
        }
        if(!empty($this->_password))
        {
            $this->array['password'] = $this->_password;
        }
        if(!empty($this->_authToken))
        {
            $this->array['authToken'] = $this->_authToken;
        }
        if($this->_account instanceof Account)
        {
            $this->array += $this->_account->toArray();
        }
        if(!empty($this->_virtualHost))
        {
            $this->array['virtualHost'] = $this->_virtualHost;
        }
        if(is_bool($this->_persistAuthTokenCookie))
        {
            $this->array['persistAuthTokenCookie'] = $this->_persistAuthTokenCookie ? 1 : 0;
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if(!empty($this->_name))
        {
            $this->xml->addAttribute('name', $this->_name);
        }
        if(!empty($this->_password))
        {
            $this->xml->addAttribute('password', $this->_password);
        }
        if(!empty($this->_authToken))
        {
            $this->xml->addChild('authToken', $this->_authToken);
        }
        if($this->_account instanceof Account)
        {
            $this->xml->append($this->_account->toXml());
        }
        if(!empty($this->_virtualHost))
        {
            $this->xml->addChild('virtualHost', $this->_virtualHost);
        }
        if(is_bool($this->_persistAuthTokenCookie))
        {
            $this->xml->addAttribute('persistAuthTokenCookie', $this->_persistAuthTokenCookie ? 1 : 0);
        }
        return parent::toXml();
    }
}
