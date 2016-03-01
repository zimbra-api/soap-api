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
use Zimbra\Mail\Struct\ExpandedRecurrenceComponent;
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
    private $_timezones;

    /**
     * Expanded recurrences
     * @var TypedSequence<ExpandedRecurrenceComponent>
     */
    private $_components;

    /**
     * Freebusy user specifications
     * @var TypedSequence<FreeBusyUserSpec>
     */
    private $_freebusyUsers;

    /**
     * Constructor method for CheckRecurConflicts
     * @param  int $s Start time in millis.  If not specified, defaults to current time
     * @param  int $e End time in millis.  If not specified, unlimited
     * @param  bool $all Set this to get all instances, even those without conflicts. By default only instances that have conflicts are returned.
     * @param  string $excludeUid UID of appointment to exclude from free/busy search
     * @param  array $timezones Timezones
     * @param  array $component Expanded recurrences
     * @param  array $users Freebusy user specifications
     * @return self
     */
    public function __construct(
        $s = null,
        $e = null,
        $all = null,
        $excludeUid = null,
        array $timezones = [],
        array $component = [],
        array $users = []
    )
    {
        parent::__construct();
        if(null !== $s)
        {
            $this->setProperty('s', (int) $s);
        }
        if(null !== $e)
        {
            $this->setProperty('e', (int) $e);
        }
        if(null !== $all)
        {
            $this->setProperty('all', (bool) $all);
        }
        if(null !== $excludeUid)
        {
            $this->setProperty('excludeUid', trim($excludeUid));
        }

        $this->setTimezones($timezones)
            ->setComponents($component)
            ->setFreebusyUsers($users);
        $this->on('before', function(Base $sender)
        {
            if($sender->getTimezones()->count())
            {
                $sender->setChild('tz', $sender->getTimezones()->all());
            }
            if($sender->getComponents()->count())
            {
                foreach ($sender->getComponents()->all() as $component)
                {
                    if($component instanceof ExpandedRecurrenceCancel)
                    {
                        $this->setChild('cancel', $component);
                    }
                    if($component instanceof ExpandedRecurrenceInvite)
                    {
                        $this->setChild('comp', $component);
                    }
                    if($component instanceof ExpandedRecurrenceException)
                    {
                        $this->setChild('except', $component);
                    }
                }
            }
            if($sender->getFreebusyUsers()->count())
            {
                $sender->setChild('usr', $sender->getFreebusyUsers()->all());
            }
        });
    }

    /**
     * Add timezone
     *
     * @param  CalTZInfo $tz
     * @return self
     */
    public function addTimezone(CalTZInfo $tz)
    {
        $this->_timezones->add($tz);
        return $this;
    }

    /**
     * Sets timezone sequence
     *
     * @param  array $timezones
     * @return self
     */
    public function setTimezones(array $timezones)
    {
        $this->_timezones = new TypedSequence('Zimbra\Mail\Struct\CalTZInfo', $timezones);
        return $this;
    }

    /**
     * Gets timezone sequence
     *
     * @return Sequence
     */
    public function getTimezones()
    {
        return $this->_timezones;
    }

    /**
     * Add expanded recurrence
     *
     * @param  ExpandedRecurrenceComponent $component
     * @return self
     */
    public function addComponent(ExpandedRecurrenceComponent $component)
    {
        $this->_components->add($component);
        return $this;
    }

    /**
     * Sets expanded recurrence sequence
     *
     * @param  array $components
     * @return self
     */
    public function setComponents(array $components)
    {
        $this->_components = new TypedSequence('Zimbra\Mail\Struct\ExpandedRecurrenceComponent', $components);
        return $this;
    }

    /**
     * Gets expanded recurrence sequence
     *
     * @return Sequence
     */
    public function getComponents()
    {
        return $this->_components;
    }

    /**
     * Add freebusy user
     *
     * @param  FreeBusyUserSpec $usr
     * @return self
     */
    public function addFreebusyUser(FreeBusyUserSpec $usr)
    {
        $this->_freebusyUsers->add($usr);
        return $this;
    }

    /**
     * Sets freebusy user sequence
     *
     * @param  array $users
     * @return self
     */
    public function setFreebusyUsers(array $users)
    {
        $this->_freebusyUsers = new TypedSequence('Zimbra\Mail\Struct\FreeBusyUserSpec', $users);
        return $this;
    }

    /**
     * Gets freebusy user sequence
     *
     * @return Sequence
     */
    public function getFreebusyUsers()
    {
        return $this->_freebusyUsers;
    }

    /**
     * Gets start time in millis
     *
     * @return int
     */
    public function getStartTime()
    {
        return $this->getProperty('s');
    }

    /**
     * Sets start time in millis
     *
     * @param  int $s
     *     If not specified, defaults to current time
     * @return self
     */
    public function setStartTime($s)
    {
        return $this->setProperty('s', (int) $s);
    }

    /**
     * Gets end time in millis
     *
     * @return int
     */
    public function getEndTime()
    {
        return $this->getProperty('e');
    }

    /**
     * Sets end time in millis
     *
     * @param  int $e
     *     If not specified, unlimited
     * @return self
     */
    public function setEndTime($e)
    {
        return $this->setProperty('e', (int) $e);
    }

    /**
     * Gets all
     *
     * @return bool
     */
    public function getAllInstances()
    {
        return $this->getProperty('all');
    }

    /**
     * Sets all
     *
     * @param  bool $all
     *     Set this to get all instances, even those without conflicts.
     *     By default only instances that have conflicts are returned.
     * @return self
     */
    public function setAllInstances($all)
    {
        return $this->setProperty('all', (bool) $all);
    }

    /**
     * Gets exclude uid
     *
     * @return string
     */
    public function getExcludeUid()
    {
        return $this->getProperty('excludeUid');
    }

    /**
     * Sets exclude uid
     *
     * @param  string $excludeUid
     *     UID of appointment to exclude from free/busy search
     * @return self
     */
    public function setExcludeUid($excludeUid)
    {
        return $this->setProperty('excludeUid', trim($excludeUid));
    }
}
