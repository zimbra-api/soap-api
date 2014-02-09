<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Common\TypedSequence;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\ExpandedRecurrenceCancel;
use Zimbra\Mail\Struct\ExpandedRecurrenceException;
use Zimbra\Mail\Struct\ExpandedRecurrenceInvite;
use Zimbra\Mail\Struct\FreeBusyUserSpec;

/**
 * CheckRecurConflicts request class
 * Check conflicts in recurrence against list of users. 
 * Set all attribute to get all instances, even those without conflicts.
 * By default only instances that have conflicts are returned.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckRecurConflicts extends Base
{
    /**
     * Timezones
     * @var TypedSequence<CalTZInfo>
     */
    private $_tz;

    /**
     * Freebusy user specifications
     * @var TypedSequence<FreeBusyUserSpec>
     */
    private $_usr;

    /**
     * Constructor method for CheckRecurConflicts
     * @param  array $tz
     * @param  ExpandedRecurrenceCancel $cancel
     * @param  ExpandedRecurrenceInvite $comp
     * @param  ExpandedRecurrenceException $except
     * @param  array $usr
     * @param  int $s
     * @param  int $e
     * @param  bool $all
     * @param  string $excludeUid
     * @return self
     */
    public function __construct(
        array $tz = array(),
        ExpandedRecurrenceCancel $cancel = null,
        ExpandedRecurrenceInvite $comp = null,
        ExpandedRecurrenceException $except = null,
        array $usr = array(),
        $s = null,
        $e = null,
        $all = null,
        $excludeUid = null
    )
    {
        parent::__construct();
        $this->_tz = new TypedSequence('Zimbra\Mail\Struct\CalTZInfo', $tz);
        if($cancel instanceof ExpandedRecurrenceCancel)
        {
            $this->child('cancel', $cancel);
        }
        if($comp instanceof ExpandedRecurrenceInvite)
        {
            $this->child('comp', $comp);
        }
        if($except instanceof ExpandedRecurrenceException)
        {
            $this->child('except', $except);
        }
        $this->_usr = new TypedSequence('Zimbra\Mail\Struct\FreeBusyUserSpec', $usr);
        if(null !== $s)
        {
            $this->property('s', (int) $s);
        }
        if(null !== $e)
        {
            $this->property('e', (int) $e);
        }
        if(null !== $all)
        {
            $this->property('all', (bool) $all);
        }
        if(null !== $excludeUid)
        {
            $this->property('excludeUid', trim($excludeUid));
        }

        $this->addHook(function($sender)
        {
            if(count($sender->tz()))
            {
                $sender->child('tz', $sender->tz()->all());
            }
            if(count($sender->usr()))
            {
                $sender->child('usr', $sender->usr()->all());
            }
        });
    }

    /**
     * Add tz
     *
     * @param  CalTZInfo $tz
     * @return self
     */
    public function addTz(CalTZInfo $tz)
    {
        $this->_tz->add($tz);
        return $this;
    }

    /**
     * Gets tz sequence
     *
     * @return Sequence
     */
    public function tz()
    {
        return $this->_tz;
    }

    /**
     * Gets or sets cancel
     *
     * @param  ExpandedRecurrenceCancel $cancel
     * @return ExpandedRecurrenceCancel|self
     */
    public function cancel(ExpandedRecurrenceCancel $cancel = null)
    {
        if(null === $cancel)
        {
            return $this->child('cancel');
        }
        return $this->child('cancel', $cancel);
    }

    /**
     * Gets or sets comp
     *
     * @param  ExpandedRecurrenceInvite $comp
     * @return ExpandedRecurrenceInvite|self
     */
    public function comp(ExpandedRecurrenceInvite $comp = null)
    {
        if(null === $comp)
        {
            return $this->child('comp');
        }
        return $this->child('comp', $comp);
    }

    /**
     * Gets or sets except
     *
     * @param  ExpandedRecurrenceException $except
     * @return ExpandedRecurrenceException|self
     */
    public function except(ExpandedRecurrenceException $except = null)
    {
        if(null === $except)
        {
            return $this->child('except');
        }
        return $this->child('except', $except);
    }

    /**
     * Add usr
     *
     * @param  FreeBusyUserSpec $usr
     * @return self
     */
    public function addUsr(FreeBusyUserSpec $usr)
    {
        $this->_usr->add($usr);
        return $this;
    }

    /**
     * Gets usr sequence
     *
     * @return Sequence
     */
    public function usr()
    {
        return $this->_usr;
    }

    /**
     * Gets or sets s
     * Start time in millis. If not specified, defaults to current time
     *
     * @param  int $s
     * @return int|self
     */
    public function s($s = null)
    {
        if(null === $s)
        {
            return $this->property('s');
        }
        return $this->property('s', (int) $s);
    }

    /**
     * Gets or sets e
     * End time in millis. If not specified, unlimited
     *
     * @param  int $e
     * @return int|self
     */
    public function e($e = null)
    {
        if(null === $e)
        {
            return $this->property('e');
        }
        return $this->property('e', (int) $e);
    }

    /**
     * Gets or sets all
     * Set this to get all instances, even those without conflicts.
     * By default only instances that have conflicts are returned.
     *
     * @param  bool $all
     * @return bool|self
     */
    public function all($all = null)
    {
        if(null === $all)
        {
            return $this->property('all');
        }
        return $this->property('all', (bool) $all);
    }

    /**
     * Gets or sets excludeUid
     * UID of appointment to exclude from free/busy search
     *
     * @param  string $excludeUid
     * @return string|self
     */
    public function excludeUid($excludeUid = null)
    {
        if(null === $excludeUid)
        {
            return $this->property('excludeUid');
        }
        return $this->property('excludeUid', trim($excludeUid));
    }
}
