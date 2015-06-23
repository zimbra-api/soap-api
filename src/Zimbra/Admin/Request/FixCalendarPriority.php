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

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\NamedElement as Account;

/**
 * FixCalendarPriority request class
 * Fix Calendar priority.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class FixCalendarPriority extends Base
{
    /**
     * Accounts
     * @var TypedSequence<NamedElement>
     */
    private $_accounts;

    /**
     * Constructor method for FixCalendarPriority
     * @param  bool  $sync Sync flag
     * @param  array $account Accounts
     * @return self
     */
    public function __construct($sync = null, array $account = [])
    {
        parent::__construct();
        if(null !== $sync)
        {
            $this->setProperty('sync', (bool) $sync);
        }
        $this->setAccounts($account);

        $this->on('before', function(Base $sender)
        {
            if($sender->getAccounts()->count())
            {
                $sender->setChild('account', $sender->getAccounts()->all());
            }
        });
    }

    /**
     * Gets sync
     *
     * @return bool
     */
    public function getSync()
    {
        return $this->getProperty('sync');
    }

    /**
     * Sets sync
     *
     * @param  bool $sync
     * @return self
     */
    public function setSync($sync)
    {
        return $this->setProperty('sync', (bool) $sync);
    }

    /**
     * Add an account
     *
     * @param  Account $attr
     * @return self
     */
    public function addAccount(Account $account)
    {
        $this->_accounts->add($account);
        return $this;
    }

    /**
     * Sets account sequence
     *
     * @param  array $accounts
     * @return self
     */
    public function setAccounts(array $accounts)
    {
        $this->_accounts = new TypedSequence('Zimbra\Struct\NamedElement', $accounts);
        return $this;
    }

    /**
     * Gets account sequence
     *
     * @return Sequence
     */
    public function getAccounts()
    {
        return $this->_accounts;
    }
}
