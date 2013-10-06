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

/**
 * GetAccountInfo class
 * Get Information about an account
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAccountInfo extends Request
{
    /**
     * Use to identify the account
     * @var Account
     */
    private $_account;

    /**
     * Constructor method for GetAccountInfo
     * @param  Account $account
     * @return self
     */
    public function __construct(Account $account)
    {
        parent::__construct();
        $this->_account = $account;
    }

    /**
     * Gets or sets account
     *
     * @param  Account $account
     * @return Account|GetAccountInfo
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
        $this->array = $this->_account->toArray();
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_account->toXml());
        return parent::toXml();
    }
}
