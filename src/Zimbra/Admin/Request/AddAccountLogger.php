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

use Zimbra\Struct\AccountSelector as Account;
use Zimbra\Admin\Struct\LoggerInfo as Logger;

/**
 * AddAccountLogger request class
 * Changes logging settings on a per-account basis
 * Adds a custom logger for the given account and log category.
 * The logger stays in effect only during the lifetime of the current server instance.
 * If the request is sent to a server other than the one that the account resides on, it is proxied to the correct server.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AddAccountLogger extends Base
{
    /**
     * Constructor method for AddAccountLogger
     * @param  Logger $logger Logger category
     * @param  Account $account Use to select account
     * @return self
     */
    public function __construct(Logger $logger, Account $account = null)
    {
        parent::__construct();
        $this->child('logger', $logger);
        if($account instanceof Account)
        {
            $this->child('account', $account);
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
            return $this->child('logger');
        }
        return $this->child('logger', $logger);
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
}
