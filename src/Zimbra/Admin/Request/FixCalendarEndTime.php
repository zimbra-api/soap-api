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
 * FixCalendarEndTime request class
 * Fix Calendar End Times.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class FixCalendarEndTime extends Base
{
    /**
     * Accounts
     * @var TypedSequence<NamedElement>
     */
    private $_account;

    /**
     * Constructor method for FixCalendarEndTime
     * @param  bool $sync Sync flag
     * @param  array $account Accounts
     * @return self
     */
    public function __construct($sync = null, array $account = array())
    {
        parent::__construct();
        if(null !== $sync)
        {
            $this->property('sync', (bool) $sync);
        }
        $this->_account = new TypedSequence('Zimbra\Struct\NamedElement', $account);

        $this->on('before', function(Base $sender)
        {
            if($sender->account()->count())
            {
                $sender->child('account', $sender->account()->all());
            }
        });
    }

    /**
     * Gets or sets sync
     *
     * @param  bool $sync
     * @return bool|self
     */
    public function sync($sync = null)
    {
        if(null === $sync)
        {
            return $this->property('sync');
        }
        return $this->property('sync', (bool) $sync);
    }

    /**
     * Add an account
     *
     * @param  Account $attr
     * @return self
     */
    public function addAccount(Account $account)
    {
        $this->_account->add($account);
        return $this;
    }

    /**
     * Gets account equence
     *
     * @return Sequence
     */
    public function account()
    {
        return $this->_account;
    }
}
