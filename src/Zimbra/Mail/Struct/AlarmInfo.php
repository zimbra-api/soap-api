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
    private $_at;

    /**
     * Non-standard properties
     * @var TypedSequence<XProp>
     */
    private $_xprop;

    /**
     * Constructor method for AlarmInfo
     * @param  AlarmAction $action Alarm action
     * @param  AlarmTriggerInfo $trigger Alarm trigger information
     * @param  DurationInfo $repeat Alarm repeat information 
     * @param  string $desc Alarm description
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
        $desc = null,
        CalendarAttach $attach = null,
        $summary = null,
        array $ats = array(),
        array $xprops = array()
    )
    {
        parent::__construct();
        $this->property('action', $action);
        if($trigger instanceof AlarmTriggerInfo)
        {
            $this->child('trigger', $trigger);
        }
        if($repeat instanceof DurationInfo)
        {
            $this->child('repeat', $repeat);
        }
        if(null !== $desc)
        {
            $this->child('desc', trim($desc));
        }
        if($attach instanceof CalendarAttach)
        {
            $this->child('attach', $attach);
        }
        if(null !== $summary)
        {
            $this->child('summary', trim($summary));
        }
        $this->_at = new TypedSequence('Zimbra\Mail\Struct\CalendarAttendee', $ats);
        $this->_xprop = new TypedSequence('Zimbra\Mail\Struct\XProp', $xprops);

        $this->addHook(function($sender)
        {
            $sender->child('at', $sender->at()->all());
            $sender->child('xprop', $sender->xprop()->all());
        });
    }

    /**
     * Gets or sets action
     *
     * @param  AlarmAction $action
     * @return AlarmAction|self
     */
    public function action(AlarmAction $action = null)
    {
        if(null === $action)
        {
            return $this->property('action');
        }
        return $this->property('action', $action);
    }

    /**
     * Gets or sets trigger
     *
     * @param  AlarmTriggerInfo $trigger
     * @return AlarmTriggerInfo|self
     */
    public function trigger(AlarmTriggerInfo $trigger = null)
    {
        if(null === $trigger)
        {
            return $this->child('trigger');
        }
        return $this->child('trigger', $trigger);
    }

    /**
     * Gets or sets repeat
     *
     * @param  DurationInfo $repeat
     * @return DurationInfo|self
     */
    public function repeat(DurationInfo $repeat = null)
    {
        if(null === $repeat)
        {
            return $this->child('repeat');
        }
        return $this->child('repeat', $repeat);
    }

    /**
     * Gets or sets desc
     *
     * @param  string $desc
     * @return string|self
     */
    public function desc($desc = null)
    {
        if(null === $desc)
        {
            return $this->child('desc');
        }
        return $this->child('desc', trim($desc));
    }

    /**
     * Gets or sets attach
     *
     * @param  CalendarAttach $attach
     * @return CalendarAttach|self
     */
    public function attach(CalendarAttach $attach = null)
    {
        if(null === $attach)
        {
            return $this->child('attach');
        }
        return $this->child('attach', $attach);
    }

    /**
     * Gets or sets summary
     *
     * @param  string $summary
     * @return string|self
     */
    public function summary($summary = null)
    {
        if(null === $summary)
        {
            return $this->child('summary');
        }
        return $this->child('summary', trim($summary));
    }

    /**
     * Add an attendee
     *
     * @param  CalendarAttendee $at
     * @return self
     */
    public function addAt(CalendarAttendee $at)
    {
        $this->_at->add($at);
        return $this;
    }

    /**
     * Gets attendee sequence
     *
     * @return Sequence
     */
    public function at()
    {
        return $this->_at;
    }

    /**
     * Add a xprop
     *
     * @param  XProp $xprop
     * @return self
     */
    public function addXProp(XProp $xprop)
    {
        $this->_xprop->add($xprop);
        return $this;
    }

    /**
     * Gets xprop sequence
     *
     * @return Sequence
     */
    public function xprop()
    {
        return $this->_xprop;
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
