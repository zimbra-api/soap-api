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
use Zimbra\Soap\Struct\Names;
use Zimbra\Soap\Struct\Id;

/**
 * PushFreeBusy class
 * Push Free/Busy.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class PushFreeBusy extends Request
{
    /**
     * Domain names specification
     * @var Names
     */
    private $_domain;

    /**
     * Account ID
     * @var Id
     */
    private $_account;

    /**
     * Constructor method for PushFreeBusy
     * @param Names $domain
     * @param Id $account
     * @return self
     */
    public function __construct(Names $domain = null, Id $account = null)
    {
        parent::__construct();
        if($domain instanceof Names)
        {
            $this->_domain = $domain;
        }
        if($account instanceof Id)
        {
            $this->_account = $account;
        }
    }

    /**
     * Gets or sets cos
     *
     * @param  Names $cos
     * @return Names|self
     */
    public function domain(Names $domain = null)
    {
        if(null === $domain)
        {
            return $this->_domain;
        }
        $this->_domain = $domain;
        return $this;
    }

    /**
     * Gets or sets account
     *
     * @param  Id $account
     * @return Id|self
     */
    public function account(Id $account = null)
    {
        if(null === $account)
        {
            return $this->_account;
        }
        $this->_account = $account;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if($this->_domain instanceof Names)
        {
            $this->array += $this->_domain->toArray('domain');
        }
        if($this->_account instanceof Id)
        {
            $this->array += $this->_account->toArray('account');
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
        if($this->_domain instanceof Names)
        {
            $this->xml->append($this->_domain->toXml('domain'));
        }
        if($this->_account instanceof Id)
        {
            $this->xml->append($this->_account->toXml('account'));
        }
        return parent::toXml();
    }
}
