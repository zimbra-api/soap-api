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
     * Sync flag
     * @var bool
     */
    private $_sync;

    /**
     * Fix appts/tasks that have instances after this time
     * default = January 1, 2008 00:00:00 in GMT+13:00 timezone.
     * @var int
     */
    private $_after;

    /**
     * Accounts
     * @var TypedSequence<NamedElement>
     */
    private $_account;

    /**
     * Fixup rules
     * @var TzFixup
     */
    private $_tzfixup;

    /**
     * Constructor method for FixCalendarTZ
     * @param  bool  $sync
     * @param  int   $after
     * @param  array $account
     * @param  array $tzfixup
     * @return self
     */
    public function __construct(
        array $account = array(),
        TzFixup $tzfixup = null,
        $sync = null,
        $after = null
    )
    {
        parent::__construct();
        if($tzfixup instanceof TzFixup)
        {
            $this->child('tzfixup', $tzfixup);
        }
        if(null !== $sync)
        {
            $this->property('sync', (bool) $sync);
        }
        if(null !== $after)
        {
            $this->property('after', (int) $after);
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
     * Add an account
     *
     * @param  NamedElement $account
     * @return self
     */
    public function addAccount(NamedElement $account)
    {
        $this->_account->add($account);
        return $this;
    }

    /**
     * Gets account sequence
     *
     * @return Sequence
     */
    public function account()
    {
        return $this->_account;
    }

    /**
     * Gets or sets tzfixup
     *
     * @param  TzFixup $tzfixup
     * @return TzFixup|self
     */
    public function tzfixup(TzFixup $tzfixup = null)
    {
        if(null === $tzfixup)
        {
            return $this->child('tzfixup');
        }
        return $this->child('tzfixup', $tzfixup);
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
     * Gets or sets after
     *
     * @param  int $after
     * @return int|self
     */
    public function after($after = null)
    {
        if(null === $after)
        {
            return $this->property('after');
        }
        return $this->property('after', (int) $after);
    }
}
