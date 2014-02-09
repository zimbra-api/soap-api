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
            $this->child('account', $account);
        }
        if($logger instanceof Logger)
        {
            $this->child('logger', $logger);
        }
        if(null !== $id)
        {
            $this->child('id', trim($id));
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
            return $this->child('account');
        }
        return $this->child('account', $account);
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
            return $this->child('logger');
        }
        return $this->child('logger', $logger);
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->child('id');
        }
        return $this->child('id', trim($id));
    }
}
