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
use Zimbra\Soap\Struct\DistListSelector as DistList;

/**
 * GetAdminConsoleUIComp class
 * Returns the union of the zimbraAdminConsoleUIComponents values on the specified account/dl entry and that on all admin groups the entry belongs to.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAdminConsoleUIComp extends Request
{
    /**
     * Account
     * @var Account
     */
    private $_account;

    /**
     * Distribution List
     * @var DistList
     */
    private $_dl;

    /**
     * Constructor method for GetAdminConsoleUIComp
     * @param  Account $account
     * @param  DistList $dl
     * @return self
     */
    public function __construct(Account $account = null, DistList $dl = null)
    {
        parent::__construct();
        if($account instanceof Account)
        {
            $this->_account = $account;
        }
        if($dl instanceof DistList)
        {
            $this->_dl = $dl;
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
     * Gets or sets dl
     *
     * @param  DistList $dl
     * @return DistList|self
     */
    public function dl(DistList $dl = null)
    {
        if(null === $dl)
        {
            return $this->_dl;
        }
        $this->_dl = $dl;
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
        if($this->_dl instanceof DistList)
        {
            $this->array += $this->_dl->toArray();
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
        if($this->_dl instanceof DistList)
        {
            $this->xml->append($this->_dl->toXml());
        }
        return parent::toXml();
    }
}
