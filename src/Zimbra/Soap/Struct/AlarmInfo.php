<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;
use Zimbra\Utils\TypedSequence;
use Zimbra\Soap\Enum\AlarmAction;

/**
 * AlarmInfo struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AlarmInfo
{
    /**
     * Alarm action
     * Possible values: 
     * DISPLAY|AUDIO|EMAIL|PROCEDURE|X_YAHOO_CALENDAR_ACTION_IM|X_YAHOO_CALENDAR_ACTION_MOBILE
     * @var AlarmAction
     */
    private $_action;

    /**
     * Alarm trigger information
     * @var AlarmTriggerInfo
     */
    private $_trigger;

    /**
     * Alarm repeat information 
     * @var DurationInfo
     */
    private $_repeat;

    /**
     * Alarm description
     * @var string
     */
    private $_desc;

    /**
     * Information on attachment
     * @var CalendarAttach
     */
    private $_attach;

    /**
     * Alarm summary
     * @var string
     */
    private $_summary;

    /**
     * Attendee information 
     * @var TypedSequence of CalendarAttendee
     */
    private $_at;

    /**
     * Non-standard properties
     * @var TypedSequence of XProp
     */
    private $_xprop;

    /**
     * Constructor method for AlarmInfo
     * @param  AlarmAction $action
     * @param  AlarmTriggerInfo $trigger
     * @param  DurationInfo $repeat
     * @param  string $desc
     * @param  CalendarAttach $attach
     * @param  string $summary
     * @param  array $ats
     * @param  array $xprops
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
        $this->_action = $action;
        if($trigger instanceof AlarmTriggerInfo)
        {
            $this->_trigger = $trigger;
        }
        if($repeat instanceof DurationInfo)
        {
            $this->_repeat = $repeat;
        }
        $this->_desc = trim($desc);
        if($attach instanceof CalendarAttach)
        {
            $this->_attach = $attach;
        }
        $this->_summary = trim($summary);
        $this->_at = new TypedSequence('Zimbra\Soap\Struct\CalendarAttendee', $ats);
        $this->_xprop = new TypedSequence('Zimbra\Soap\Struct\XProp', $xprops);
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
            return $this->_action;
        }
        $this->_action = $action;
        return $this;
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
            return $this->_trigger;
        }
        $this->_trigger = $trigger;
        return $this;
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
            return $this->_repeat;
        }
        $this->_repeat = $repeat;
        return $this;
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
            return $this->_desc;
        }
        $this->_desc = trim($desc);
        return $this;
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
            return $this->_attach;
        }
        $this->_attach = $attach;
        return $this;
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
            return $this->_summary;
        }
        $this->_summary = trim($summary);
        return $this;
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
        $name = !empty($name) ? $name : 'alarm';
        $arr = array(
            'action' => (string) $this->_action,
        );
        if($this->_trigger instanceof AlarmTriggerInfo)
        {
            $arr += $this->_trigger->toArray('trigger');
        }
        if($this->_repeat instanceof DurationInfo)
        {
            $arr += $this->_repeat->toArray('repeat');
        }
        if(!empty($this->_desc))
        {
            $arr['desc'] = $this->_desc;
        }
        if($this->_attach instanceof CalendarAttach)
        {
            $arr += $this->_attach->toArray('attach');
        }
        if(!empty($this->_summary))
        {
            $arr['summary'] = $this->_summary;
        }
        if(count($this->_at))
        {
            $arr['at'] = array();
            foreach ($this->_at as $at)
            {
                $atArr = $at->toArray('at');
                $arr['at'][] = $atArr['at'];
            }
        }
        if(count($this->_xprop))
        {
            $arr['xprop'] = array();
            foreach ($this->_xprop as $xprop)
            {
                $xpropArr = $xprop->toArray('xprop');
                $arr['xprop'][] = $xpropArr['xprop'];
            }
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'alarm')
    {
        $name = !empty($name) ? $name : 'alarm';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('action', (string) $this->_action);
        if($this->_trigger instanceof AlarmTriggerInfo)
        {
            $xml->append($this->_trigger->toXml('trigger'));
        }
        if($this->_repeat instanceof DurationInfo)
        {
            $xml->append($this->_repeat->toXml('repeat'));
        }
        if(!empty($this->_desc))
        {
            $xml->addChild('desc', $this->_desc);
        }
        if($this->_attach instanceof CalendarAttach)
        {
            $xml->append($this->_attach->toXml('attach'));
        }
        if(!empty($this->_summary))
        {
            $xml->addChild('summary', $this->_summary);
        }
        foreach ($this->_at as $at)
        {
            $xml->append($at->toXml('at'));
        }
        foreach ($this->_xprop as $xprop)
        {
            $xml->append($xprop->toXml('xprop'));
        }
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
