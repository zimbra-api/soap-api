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

use Zimbra\Enum\LockoutOperation;
use Zimbra\Struct\AccountNameSelector as Account;

/**
 * LockoutMailbox request class
 * Puts the mailbox of the specified account into maintenance lockout or removes it from maintenance lockout 
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class LockoutMailbox extends Base
{
    /**
     * Constructor method for LockoutMailbox
     * @param Account $account The account
     * @param LockoutOperation  $operation operation
     * @return self
     */
    public function __construct(Account $account, LockoutOperation $operation = null)
    {
        parent::__construct();
        $this->setChild('account', $account);
        if($operation instanceof LockoutOperation)
        {
            $this->setProperty('op', $operation);
        }
    }

    /**
     * Gets operation
     *
     * @return LockoutOperation
     */
    public function getOperation()
    {
        return $this->getProperty('op');
    }

    /**
     * Sets operation
     *
     * @param  LockoutOperation $operation
     * @return self
     */
    public function setOperation(LockoutOperation $operation)
    {
        return $this->setProperty('op', $operation);
    }

    /**
     * Gets the account.
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
}
