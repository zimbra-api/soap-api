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
use Zimbra\Soap\Struct\LoggerInfo as Logger;

/**
 * RemoveAccountLogger class
 * Removes one or more custom loggers.
 * If both the account and logger are specified, removes the given account logger if it exists.
 * If only the account is specified or the category is "all", removes all custom loggers from that account.
 * If only the logger is specified, removes that custom logger from all accounts.
 * If neither element is specified, removes all custom loggers from all accounts on the server that receives the request.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class RemoveAccountLogger extends Request
{
    /**
     * Use to select account
     * @var AccountSelector
     */
    private $_account;

    /**
     * Logger category
     * @var Logger
     */
    private $_logger;

    /**
     * Constructor method for RemoveAccountLogger
     * @param  Account $account
     * @param  Logger $logger
     * @return self
     */
    public function __construct(Account $account = null, Logger $logger = null)
    {
        parent::__construct();
        if($account instanceof Account)
        {
            $this->_account = $account;
        }
        if($logger instanceof Logger)
        {
            $this->_logger = $logger;
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
     * Gets or sets logger
     *
     * @param  Logger $logger
     * @return Logger|self
     */
    public function logger(Logger $logger = null)
    {
        if(null === $logger)
        {
            return $this->_logger;
        }
        $this->_logger = $logger;
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
        if($this->_logger instanceof Logger)
        {
            $this->array += $this->_logger->toArray();
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
        if($this->_logger instanceof Logger)
        {
            $this->xml->append($this->_logger->toXml());
        }
        return parent::toXml();
    }
}
