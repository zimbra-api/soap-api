<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Account\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\AccountSelector as Account;
use Zimbra\Soap\Struct\PreAuth;
use Zimbra\Soap\Struct\AuthToken;
use Zimbra\Soap\Struct\Pref;
use Zimbra\Soap\Struct\Attr;

/**
 * Auth request class
 * Authenticate for an account.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Auth extends Request
{
    /**
     * Specifies the account to authenticate against
     * @var Account
     */
    private $_account;

    /**
     * Password to use in conjunction with an account
     * @var string
     */
    private $_password;

    /**
     * The preauth
     * @var PreAuth
     */
    private $_preauth;

    /**
     * An authToken can be passed instead of account/password/preauth to validate an existing auth token.
     * @var AuthToken
     */
    private $_authToken;

    /**
     * If specified (in conjunction with by="name"), virtual-host is used to determine the domain of the account name, if it does not include a domain component.
     * @var string
     */
    private $_virtualHost;

    /**
     * Preference
     * @var array of Pref
     */
    private $_prefs = array();

    /**
     * The attributes
     * @var array of Attr
     */
    private $_attrs = array();

    /**
     * The requestedSkin
     * If specified the name of the skin requested by the client
     * @var string
     */
    private $_requestedSkin;

    /**
     * Controls whether the auth token cookie in the response should be persisted when the browser exits.
     * @var bool
     */
    private $_persistAuthTokenCookie;

    /**
     * Constructor method for authRequest
     * @param  Account   $account
     * @param  string    $password
     * @param  PreAuth   $preauth
     * @param  AuthToken $authToken
     * @param  string    $virtualHost
     * @param  array     $prefs
     * @param  array     $attrs
     * @param  string    $requestedSkin
     * @param  bool      $persistAuthTokenCookie
     * @return self
     */
    public function __construct(
        Account $account = null,
        $password = null,
        PreAuth $preauth = null,
        AuthToken $authToken = null,
        $virtualHost = null,
        array $prefs = array(),
        array $attrs = array(),
        $requestedSkin = null,
        $persistAuthTokenCookie = null
    )
    {
        parent::__construct();
        if($account instanceof Account)
        {
            $this->_account = $account;
        }
        $this->_password = trim($password);
        if($preauth instanceof PreAuth)
        {
            $this->_preauth = $preauth;
        }
        if($authToken instanceof AuthToken)
        {
            $this->_authToken = $authToken;
        }
        $this->_virtualHost = trim($virtualHost);
        $this->prefs($prefs);
        $this->attrs($attrs);
        $this->_requestedSkin = trim($requestedSkin);
        if(null !== $persistAuthTokenCookie)
        {
            $this->_persistAuthTokenCookie = (bool) $persistAuthTokenCookie;
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
            return $this->_account;
        }
        $this->_account = $account;
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
     * Gets or sets preauth
     *
     * @param  PreAuth $preauth
     * @return PreAuth|self
     */
    public function preauth(PreAuth $preauth = null)
    {
        if(null === $preauth)
        {
            return $this->_preauth;
        }
        $this->_preauth = $preauth;
        return $this;
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
            return $this->_authToken;
        }
        $this->_authToken = $authToken;
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
     * Add a pref
     *
     * @param  Pref $pref
     * @return Auth
     */
    public function addPref(Pref $pref)
    {
        $this->_prefs[] = $pref;
        return $this;
    }

    /**
     * Gets or sets prefs
     *
     * @param  array $prefs
     * @return array|self
     */
    public function prefs(array $prefs = null)
    {
        if(null === $prefs)
        {
            return $this->_prefs;
        }
        $this->_prefs = array();
        foreach ($prefs as $pref)
        {
            if($pref instanceof Pref)
            {
                $this->_prefs[] = $pref;
            }
        }
        return $this;
    }

    /**
     * Add an attr
     *
     * @param  Attr $attr
     * @return Auth
     */
    public function addAttr(Attr $attr)
    {
        $this->_attrs[] = $attr;
        return $this;
    }

    /**
     * Gets or sets attrs
     *
     * @param  array $attrs
     * @return array|self
     */
    public function attrs(array $attrs = null)
    {
        if(null === $attrs)
        {
            return $this->_attrs;
        }
        $this->_attrs = array();
        foreach ($attrs as $attr)
        {
            if($attr instanceof Attr)
            {
                $this->_attrs[] = $attr;
            }
        }
        return $this;
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
            return $this->_requestedSkin;
        }
        $this->_requestedSkin = trim($requestedSkin);
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
        $this->array = array();
        if($this->_account instanceof Account)
        {
            $this->array += $this->_account->toArray();
        }
        if(!empty($this->_password))
        {
            $this->array['password'] = $this->_password;
        }
        if($this->_preauth instanceof PreAuth)
        {
            $this->array += $this->_preauth->toArray();
        }
        if($this->_authToken instanceof AuthToken)
        {
            $this->array += $this->_authToken->toArray();
        }
        if(!empty($this->_virtualHost))
        {
            $this->array['virtualHost'] = $this->_virtualHost;
        }
        if(count($this->_prefs))
        {
            $this->array['prefs']['pref'] = array();
            foreach ($this->_prefs as $pref)
            {
                $prefArr = $pref->toArray();
                $this->array['prefs']['pref'][] = $prefArr['pref'];
            }
        }
        if(count($this->_attrs))
        {
            $this->array['attrs']['attr'] = array();
            foreach ($this->_attrs as $attr)
            {
                $attrArr = $attr->toArray();
                $this->array['attrs']['attr'][] = $attrArr['attr'];
            }
        }
        if(!empty($this->_requestedSkin))
        {
            $this->array['requestedSkin'] = $this->_requestedSkin;
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
        if($this->_account instanceof Account)
        {
            $this->xml->append($this->_account->toXml());
        }
        if(!empty($this->_password))
        {
            $this->xml->addChild('password', $this->_password);
        }
        if($this->_preauth instanceof PreAuth)
        {
            $this->xml->append($this->_preauth->toXml());
        }
        if($this->_authToken instanceof AuthToken)
        {
            $this->xml->append($this->_authToken->toXml());
        }
        if(!empty($this->_virtualHost))
        {
            $this->xml->addChild('virtualHost', $this->_virtualHost);
        }
        if(count($this->_prefs))
        {
            $child = $this->xml->addChild('prefs', null);
            foreach ($this->_prefs as $pref)
            {
                $child->append($pref->toXml());
            }
        }
        if(count($this->_attrs))
        {
            $child = $this->xml->addChild('attrs', null);
            foreach ($this->_attrs as $attr)
            {
                $child->append($attr->toXml());
            }
        }
        if(!empty($this->_requestedSkin))
        {
            $this->xml->addChild('requestedSkin', $this->_requestedSkin);
        }
        if(is_bool($this->_persistAuthTokenCookie))
        {
            $this->xml->addAttribute('persistAuthTokenCookie', $this->_persistAuthTokenCookie ? 1 : 0);
        }
        return parent::toXml();
    }
}
