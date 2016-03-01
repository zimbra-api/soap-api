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

use Zimbra\Admin\Struct\TzFixup;
use Zimbra\Common\TypedSequence;
use Zimbra\Struct\NamedElement;

/**
 * FixCalendarTZ request class
 * Fix timezone definitions in appointments and tasks to reflect changes in daylight savings time rules in various timezones.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class FixCalendarTZ extends Base
{
    /**
     * Accounts
     * @var TypedSequence<NamedElement>
     */
    private $_accounts;

    /**
     * Constructor method for FixCalendarTZ
     * @param  array $accounts Accounts
     * @param  array $tzfixup Fixup rules
     * @param  bool  $sync Sync flag
     * @param  int   $after Fix appts/tasks that have instances after this time.
     * @return self
     */
    public function __construct(
        array $accounts = [],
        TzFixup $tzfixup = null,
        $sync = null,
        $after = null
    )
    {
        parent::__construct();
        if($tzfixup instanceof TzFixup)
        {
            $this->setChild('tzfixup', $tzfixup);
        }
        if(null !== $sync)
        {
            $this->setProperty('sync', (bool) $sync);
        }
        if(null !== $after)
        {
            $this->setProperty('after', (int) $after);
        }
        $this->setAccounts($accounts);

        $this->on('before', function(Base $sender)
        {
            if($sender->getAccounts()->count())
            {
                $sender->setChild('account', $sender->getAccounts()->all());
            }
        });
    }

    /**
     * Add an account
     *
     * @param  NamedElement $account
     * @return self
     */
    public function addAccount(NamedElement $account)
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

    /**
     * Gets the tzfixup.
     *
     * @return TzFixup
     */
    public function getTzFixup()
    {
        return $this->getChild('tzfixup');
    }

    /**
     * Sets the tzfixup.
     *
     * @param  TzFixup $tzfixup
     * @return self
     */
    public function setTzFixup(TzFixup $tzfixup)
    {
        return $this->setChild('tzfixup', $tzfixup);
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
     * Gets after
     *
     * @return int
     */
    public function getAfter()
    {
        return $this->getProperty('after');
    }

    /**
     * Sets after
     *
     * @param  int $after
     * @return self
     */
    public function setAfter($after)
    {
        return $this->setProperty('after', (int) $after);
    }
}
