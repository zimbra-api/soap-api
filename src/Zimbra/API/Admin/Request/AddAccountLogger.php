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
 * AddAccountLogger class
 * Changes logging settings on a per-account basis
 * Adds a custom logger for the given account and log category.
 * The logger stays in effect only during the lifetime of the current server instance.
 * If the request is sent to a server other than the one that the account resides on, it is proxied to the correct server.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AddAccountLogger extends Request
{
    /**
     * Logger category
     * @var Logger
     */
    private $_logger;

    /**
     * Use to select account
     * @var AccountSelector
     */
    private $_account;

    /**
     * Constructor method for AddAccountLogger
     * @param  Logger $logger
     * @param  Account $account
     * @return self
     */
    public function __construct(Logger $logger, Account $account = null)
    {
        parent::__construct();
        $this->_logger = $logger;
        if($account instanceof Account)
        {
            $this->_account = $account;
        }
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
        $this->array = $this->_logger->toArray();
        if($this->_account instanceof Account)
        {
            $this->array += $this->_account->toArray();
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
        $this->xml->append($this->_logger->toXml());
        if($this->_account instanceof Account)
        {
            $this->xml->append($this->_account->toXml());
        }
        return parent::toXml();
    }
}
