<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Common\TypedSequence;
use Zimbra\Enum\AlarmAction;
use Zimbra\Struct\Base;

/**
 * AlarmInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AlarmInfo extends Base
{
    /**
     * Attendee information 
     * @var TypedSequence<CalendarAttendee>
     */
    private $_attendees;

    /**
     * Non-standard properties
     * @var TypedSequence<XProp>
     */
    private $_xprops;

    /**
     * Constructor method for AlarmInfo
     * @param  AlarmAction $action Alarm action
     * @param  AlarmTriggerInfo $trigger Alarm trigger information
     * @param  DurationInfo $repeat Alarm repeat information 
     * @param  string $description Alarm description
     * @param  CalendarAttach $attach Information on attachment
     * @param  string $summary Alarm summary
     * @param  array $ats Attendee information 
     * @param  array $xprops Non-standard properties
     * @return self
     */
    public function __construct(
        AlarmAction $action,
        AlarmTriggerInfo $trigger = null,
        DurationInfo $repeat = null,
        $description = null,
        CalendarAttach $attach = null,
        $summary = null,
        array $ats = [],
        array $xprops = []
    )
    {
        parent::__construct();
        $this->setProperty('action', $action);
        if($trigger instanceof AlarmTriggerInfo)
        {
            $this->setChild('trigger', $trigger);
        }
        if($repeat instanceof DurationInfo)
        {
            $this->setChild('repeat', $repeat);
        }
        if(null !== $description)
        {
            $this->setChild('desc', trim($description));
        }
        if($attach instanceof CalendarAttach)
        {
            $this->setChild('attach', $attach);
        }
        if(null !== $summary)
        {
            $this->setChild('summary', trim($summary));
        }
        $this->setAttendees($ats)->setXProps($xprops);

        $this->on('before', function(Base $sender)
        {
            if($sender->getAttendees()->count())
            {
                $sender->setChild('at', $sender->getAttendees()->all());
            }
            if($sender->getXProps()->count())
            {
                $sender->setChild('xprop', $sender->getXProps()->all());
            }
        });
    }

    /**
     * Gets alarm action
     *
     * @return AlarmAction
     */
    public function getAction()
    {
        return $this->getProperty('action');
    }

    /**
     * Sets alarm action
     *
     * @param  AlarmAction $action
     * @return self
     */
    public function setAction(AlarmAction $action)
    {
        return $this->setProperty('action', $action);
    }

    /**
     * Gets alarm trigger
     *
     * @return AlarmTriggerInfo
     */
    public function getTrigger()
    {
        return $this->getChild('trigger');
    }

    /**
     * Sets alarm trigger
     *
     * @param  AlarmTriggerInfo $trigger
     * @return self
     */
    public function setTrigger(AlarmTriggerInfo $trigger)
    {
        return $this->setChild('trigger', $trigger);
    }

    /**
     * Gets alarm repeat information
     *
     * @return DurationInfo
     */
    public function getRepeat()
    {
        return $this->getChild('repeat');
    }

    /**
     * Sets alarm repeat information
     *
     * @param  DurationInfo $repeat
     * @return self
     */
    public function setRepeat(DurationInfo $repeat)
    {
        return $this->setChild('repeat', $repeat);
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->getChild('desc');
    }

    /**
     * Sets description
     *
     * @param  string $description
     * @return self
     */
    public function setDescription($description)
    {
        return $this->setChild('desc', trim($description));
    }

    /**
     * Gets attach
     *
     * @return CalendarAttach
     */
    public function getAttach()
    {
        return $this->getChild('attach');
    }

    /**
     * Sets attach
     *
     * @param  CalendarAttach $attach
     * @return self
     */
    public function setAttach(CalendarAttach $attach)
    {
        return $this->setChild('attach', $attach);
    }

    /**
     * Gets summary
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->getChild('summary');
    }

    /**
     * Sets summary
     *
     * @param  string $summary
     * @return self
     */
    public function setSummary($summary)
    {
        return $this->setChild('summary', trim($summary));
    }

    /**
     * Add an attendee
     *
     * @param  CalendarAttendee $at
     * @return self
     */
    public function addAttendee(CalendarAttendee $at)
    {
        $this->_attendees->add($at);
        return $this;
    }

    /**
     * Sets attendee sequence
     *
     * @param  array $ats
     * @return self
     */
    function setAttendees(array $ats)
    {
        $this->_attendees = new TypedSequence('Zimbra\Mail\Struct\CalendarAttendee', $ats);
        return $this;
    }

    /**
     * Gets attendee sequence
     *
     * @return Sequence
     */
    public function getAttendees()
    {
        return $this->_attendees;
    }

    /**
     * Add a xprop
     *
     * @param  XProp $xprop
     * @return self
     */
    public function addXProp(XProp $xprop)
    {
        $this->_xprops->add($xprop);
        return $this;
    }

    /**
     * Sets xprop sequence
     *
     * @param  array $xprops
     * @return self
     */
    function setXProps(array $xprops)
    {
        $this->_xprops = new TypedSequence('Zimbra\Mail\Struct\XProp', $xprops);
        return $this;
    }

    /**
     * Gets xprop sequence
     *
     * @return Sequence
     */
    public function getXProps()
    {
        return $this->_xprops;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'alarm')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'alarm')
    {
        return parent::toXml($name);
    }
}
