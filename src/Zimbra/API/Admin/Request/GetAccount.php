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
 * GetAccount class
 * Get attributes related to an account.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAccount extends Request
{
    /**
     * Flag whether or not to apply class of service (COS) rules
     * @var bool
     */
    private $_applyCos;

    /**
     * Comma separated list of attributes
     * @var string
     */
    private $_attrs;

    /**
     * Account
     * @var Account
     */
    private $_account;

    /**
     * Constructor method for GetAccount
     * @param  Account $account
     * @param  bool $applyCos
     * @param  string $attrs
     * @return self
     */
    public function __construct(Account $account = null, $applyCos = null, $attrs = null)
    {
        parent::__construct();
        if($account instanceof Account)
        {
            $this->_account = $account;
        }
        if(null !== $applyCos)
        {
            $this->_applyCos = (bool) $applyCos;
        }
		$this->_attrs = trim($attrs);
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
     * Gets or sets applyCos
     *
     * @param  bool $applyCos
     * @return bool|self
     */
    public function applyCos($applyCos = null)
    {
        if(null === $applyCos)
        {
            return $this->_applyCos;
        }
        $this->_applyCos = (bool) $applyCos;
        return $this;
    }

    /**
     * Gets or sets attrs
     *
     * @param  string $attrs
     * @return string|self
     */
    public function attrs($attrs = null)
    {
        if(null === $attrs)
        {
            return $this->_attrs;
        }
        $this->_attrs = trim($attrs);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if($this->_account instanceof Account)
        {
            $this->array += $this->_account->toArray();
        }
        if(is_bool($this->_applyCos))
        {
            $this->array['applyCos'] = $this->_applyCos ? 1 : 0;
        }
        if(!empty($this->_attrs))
        {
            $this->array['attrs'] = $this->_attrs;
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
        if(is_bool($this->_applyCos))
        {
            $this->xml->addAttribute('applyCos', $this->_applyCos ? 1 : 0);
        }
        if(!empty($this->_attrs))
        {
            $this->xml->addAttribute('attrs', $this->_attrs);
        }
        return parent::toXml();
    }
}
