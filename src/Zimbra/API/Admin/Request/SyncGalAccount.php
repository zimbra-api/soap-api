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
use Zimbra\Soap\Struct\SyncGalAccountSpec as Account;

/**
 * SyncGalAccount class
 * Sync GalAccount.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SyncGalAccount extends Request
{
    /**
     * SyncGalAccount data source specifications.
     * @var Account
     */
    private $_account;

    /**
     * Constructor method for SyncGalAccount
     * @param  Account $account
     * @return self
     */
    public function __construct(Account $account = null)
    {
        parent::__construct();
        if($account instanceof Account)
        {
            $this->_account = $account;
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
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if($this->_account instanceof Account)
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
        if($this->_account instanceof Account)
        {
            $this->xml->append($this->_account->toXml('account'));
        }
        return parent::toXml();
    }
}
