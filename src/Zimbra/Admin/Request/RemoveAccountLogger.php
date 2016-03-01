<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Admin\Struct\LoggerInfo as Logger;
use Zimbra\Struct\AccountSelector as Account;

/**
 * RemoveAccountLogger request class
 * Removes one or more custom loggers.
 * If both the account and logger are specified, removes the given account logger if it exists.
 * If only the account is specified or the category is "all", removes all custom loggers from that account.
 * If only the logger is specified, removes that custom logger from all accounts.
 * If neither element is specified, removes all custom loggers from all accounts on the server that receives the request.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RemoveAccountLogger extends Base
{
    /**
     * Constructor method for RemoveAccountLogger
     * @param  Account $account Use to select account
     * @param  Logger $logger Logger category
     * @param  string $id  Deprecated - use account instead
     * @return self
     */
    public function __construct(Account $account = null, Logger $logger = null, $id = null)
    {
        parent::__construct();
        if($account instanceof Account)
        {
            $this->setChild('account', $account);
        }
        if($logger instanceof Logger)
        {
            $this->setChild('logger', $logger);
        }
        if(null !== $id)
        {
            $this->setChild('id', trim($id));
        }
    }

    /**
     * Gets the logger.
     *
     * @return Logger
     */
    public function getLogger()
    {
        return $this->getChild('logger');
    }

    /**
     * Sets the logger.
     *
     * @param  Logger $logger
     * @return self
     */
    public function setLogger(Logger $logger)
    {
        return $this->setChild('logger', $logger);
    }

    /**
     * Sets the account.
     *
     * @return Account
     */
    public function getAccount()
    {
        return $this->getChild('account');
    }

    /**
     * Sets the account.
     *
     * @param  Account $account
     * @return self
     */
    public function setAccount(Account $account)
    {
        return $this->setChild('account', $account);
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getChild('id');
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setChild('id', trim($id));
    }
}
