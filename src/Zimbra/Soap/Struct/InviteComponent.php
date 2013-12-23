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
use Zimbra\Soap\Enum\FreeBusyStatus;
use Zimbra\Soap\Enum\Transparency;
use Zimbra\Soap\Enum\InviteStatus;
use Zimbra\Soap\Enum\InviteClass;
use Zimbra\Soap\Enum\InviteChange;
use Zimbra\Utils\TypedSequence;

/**
 * InviteComponent struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class InviteComponent extends InviteComponentCommon
{
    /**
     * Categories - for iCalendar CATEGORY properties
     * @var array
     */
    private $_category;

    /**
     * Comments - for iCalendar COMMENT properties
     * @var array
     */
    private $_comment;

    /**
     * Contacts - for iCalendar CONTACT properties
     * @var array
     */
    private $_contact;

    /**
     * for iCalendar GEO property
     * @var GeoInfo
     */
    private $_geo;

    /**
     * Attendees
     * @var TypedSequence
     */
    private $_at;

    /**
     * Alarm information
     * @var TypedSequence
     */
    private $_alarm;

    /**
     * iCalender XPROP properties 
     * @var TypedSequence
     */
    private $_xprop;

    /**
     * Fragment
     * First few bytes of the message (probably between 40 and 100 bytes)
     * @var string
     */
    private $_fr;

    /**
     * Description
     * Present if noBlob is set and invite has a plain text description
     * @var string
     */
    private $_desc;

    /**
     * Html description
     * Present if noBlob is set and invite has an HTML description
     * @var string
     */
    private $_descHtml;

    /**
     * Organizer
     * @var CalOrganizer
     */
    private $_or;

    /**
     * Recurrence information
     * @var RecurrenceInfo
     */
    private $_recur;

    /**
     * RECURRENCE-ID, if this is an exception
     * @var ExceptionRecurIdInfo
     */
    private $_exceptId;

    /**
     * Start date-time
     * @var DtTimeInfo
     */
    private $_s;

    /**
     * End date-time
     * @var DtTimeInfo
     */
    private $_e;

    /**
     * Duration
     * @var DurationInfo
     */
    private $_dur;

    /**
     * Constructor method for InviteComponent
     *
     * @param string $method
     * @param int    $compNum
     * @param bool   $rsvp
     * @param int    $priority
     * @param string $name
     * @param string $loc
     * @param int    $percentComplete
     * @param string $completed
     * @param bool   $noBlob
     * @param FreeBusyStatus $fba
     * @param FreeBusyStatus $fb
     * @param Transparency $transp
     * @param bool   $isOrg
     * @param string $x_uid
     * @param string $uid
     * @param int    $seq
     * @param int    $d
     * @param string $calItemId
     * @param string $apptId
     * @param string $ciFolder
     * @param InviteStatus $status
     * @param InviteClass $class
     * @param string $url
     * @param bool   $ex
     * @param string $ridZ
     * @param bool   $allDay
     * @param bool   $draft
     * @param bool   $neverSent
     * @param array  $change
     * @param array  $category
     * @param array  $comment
     * @param array  $contact
     * @param GeoInfo $geo
     * @param array  $at
     * @param array  $alarm
     * @param array  $xprop
     * @param string $fr
     * @param string $desc
     * @param string $descHtml
     * @param CalOrganizer $or
     * @param RecurrenceInfo $recur
     * @param ExceptionRecurIdInfo $exceptId
     * @param DtTimeInfo $s
     * @param DtTimeInfo $e
     * @param DurationInfo $dur
     */
    public function __construct(
        $method,
        $compNum,
        $rsvp,
        $priority = null,
        $name = null,
        $loc = null,
        $percentComplete = null,
        $completed = null,
        $noBlob = null,
        FreeBusyStatus $fba = null,
        FreeBusyStatus $fb = null,
        Transparency $transp = null,
        $isOrg = null,
        $x_uid = null,
        $uid = null,
        $seq = null,
        $d = null,
        $calItemId = null,
        $apptId = null,
        $ciFolder = null,
        InviteStatus $status = null,
        InviteClass $class = null,
        $url = null,
        $ex = null,
        $ridZ = null,
        $allDay = null,
        $draft = null,
        $neverSent = null,
        array $change = array(),
        array $category = array(),
        array $comment = array(),
        array $contact = array(),
        GeoInfo $geo = null,
        array $at = array(),
        array $alarm = array(),
        array $xprop = array(),
        $fr = null,
        $desc = null,
        $descHtml = null,
        CalOrganizer $or = null,
        RecurrenceInfo $recur = null,
        ExceptionRecurIdInfo $exceptId = null,
        DtTimeInfo $s = null,
        DtTimeInfo $e = null,
        DurationInfo $dur = null
    )
    {
        parent::__construct(
            $method,
            $compNum,
            $rsvp,
            $priority,
            $name,
            $loc,
            $percentComplete,
            $completed,
            $noBlob,
            $fba,
            $fb,
            $transp,
            $isOrg,
            $x_uid,
            $uid,
            $seq,
            $d,
            $calItemId,
            $apptId,
            $ciFolder,
            $status,
            $class,
            $url,
            $ex,
            $ridZ,
            $allDay,
            $draft,
            $neverSent,
            $change
        );

        $this->_category = array();
        foreach ($category as $value)
        {
            $value = trim($value);
            if(!in_array($value, $this->_category))
            {
                $this->_category[] = $value;
            }
        }
        $this->_comment = array();
        foreach ($comment as $value)
        {
            $value = trim($value);
            if(!in_array($value, $this->_comment))
            {
                $this->_comment[] = $value;
            }
        }
        $this->_contact = array();
        foreach ($contact as $value)
        {
            $value = trim($value);
            if(!in_array($value, $this->_contact))
            {
                $this->_contact[] = $value;
            }
        }
        if($geo instanceof GeoInfo)
        {
            $this->_geo = $geo;
        }
        $this->_at = new TypedSequence('Zimbra\Soap\Struct\CalendarAttendee', $at);
        $this->_alarm = new TypedSequence('Zimbra\Soap\Struct\AlarmInfo', $alarm);
        $this->_xprop = new TypedSequence('Zimbra\Soap\Struct\XProp', $xprop);
        $this->_fr = trim($fr);
        $this->_desc = trim($desc);
        $this->_descHtml = trim($descHtml);
        if($or instanceof CalOrganizer)
        {
            $this->_or = $or;
        }
        if($recur instanceof RecurrenceInfo)
        {
            $this->_recur = $recur;
        }
        if($exceptId instanceof ExceptionRecurIdInfo)
        {
            $this->_exceptId = $exceptId;
        }
        if($s instanceof DtTimeInfo)
        {
            $this->_s = $s;
        }
        if($e instanceof DtTimeInfo)
        {
            $this->_e = $e;
        }
        if($dur instanceof DurationInfo)
        {
            $this->_dur = $dur;
        }
    }

    /**
     * Gets or sets category
     *
     * @param  array $category
     * @return array|self
     */
    public function category(array $category = null)
    {
        if(null === $category)
        {
            return $this->_category;
        }
        $this->_category = array();
        foreach ($category as $value)
        {
            $value = trim($value);
            if(!in_array($value, $this->_category))
            {
                $this->_category[] = $value;
            }
        }
        return $this;
    }

    /**
     * Gets or sets comment
     *
     * @param  array $comment
     * @return array|self
     */
    public function comment(array $comment = null)
    {
        if(null === $comment)
        {
            return $this->_comment;
        }
        $this->_comment = array();
        foreach ($comment as $value)
        {
            $value = trim($value);
            if(!in_array($value, $this->_comment))
            {
                $this->_comment[] = $value;
            }
        }
        return $this;
    }

    /**
     * Gets or sets contact
     *
     * @param  array $contact
     * @return array|self
     */
    public function contact(array $contact = null)
    {
        if(null === $contact)
        {
            return $this->_contact;
        }
        $this->_contact = array();
        foreach ($contact as $value)
        {
            $value = trim($value);
            if(!in_array($value, $this->_contact))
            {
                $this->_contact[] = $value;
            }
        }
        return $this;
    }

    /**
     * Gets or sets geo
     *
     * @param  GeoInfo $geo
     * @return GeoInfo|self
     */
    public function geo(GeoInfo $geo = null)
    {
        if(null === $geo)
        {
            return $this->_geo;
        }
        $this->_geo = $geo;
        return $this;
    }

    /**
     * Add an attendee
     *
     * @param  CalendarAttendee $change
     * @return self
     */
    public function addAt(CalendarAttendee $at)
    {
        $this->_at->add($at);
        return $this;
    }

    /**
     * Get sequence of at
     *
     * @return Sequence
     */
    public function at()
    {
        return $this->_at;
    }

    /**
     * Add an alarm
     *
     * @param  AlarmInfo $change
     * @return self
     */
    public function addAlarm(AlarmInfo $alarm)
    {
        $this->_alarm->add($alarm);
        return $this;
    }

    /**
     * Get sequence of alarm
     *
     * @return Sequence
     */
    public function alarm()
    {
        return $this->_alarm;
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
     * Get sequence of xprop
     *
     * @return Sequence
     */
    public function xprop()
    {
        return $this->_xprop;
    }

    /**
     * Gets or sets fr
     *
     * @param  string $fr
     * @return string|self
     */
    public function fr($fr = null)
    {
        if(null === $fr)
        {
            return $this->_fr;
        }
        $this->_fr = trim($fr);
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
     * Gets or sets descHtml
     *
     * @param  string $descHtml
     * @return string|self
     */
    public function descHtml($descHtml = null)
    {
        if(null === $descHtml)
        {
            return $this->_descHtml;
        }
        $this->_descHtml = trim($descHtml);
        return $this;
    }

    /**
     * Gets or sets or
     *
     * @param  CalOrganizer $or
     * @return CalOrganizer|self
     */
    public function org(CalOrganizer $or = null)
    {
        if(null === $or)
        {
            return $this->_or;
        }
        $this->_or = $or;
        return $this;
    }

    /**
     * Gets or sets recur
     *
     * @param  RecurrenceInfo $recur
     * @return RecurrenceInfo|self
     */
    public function recur(RecurrenceInfo $recur = null)
    {
        if(null === $recur)
        {
            return $this->_recur;
        }
        $this->_recur = $recur;
        return $this;
    }

    /**
     * Gets or sets exceptId
     *
     * @param  ExceptionRecurIdInfo $exceptId
     * @return ExceptionRecurIdInfo|self
     */
    public function exceptId(ExceptionRecurIdInfo $exceptId = null)
    {
        if(null === $exceptId)
        {
            return $this->_exceptId;
        }
        $this->_exceptId = $exceptId;
        return $this;
    }

    /**
     * Gets or sets s
     *
     * @param  DtTimeInfo $s
     * @return DtTimeInfo|self
     */
    public function s(DtTimeInfo $s = null)
    {
        if(null === $s)
        {
            return $this->_s;
        }
        $this->_s = $s;
        return $this;
    }

    /**
     * Gets or sets e
     *
     * @param  DtTimeInfo $e
     * @return DtTimeInfo|self
     */
    public function e(DtTimeInfo $e = null)
    {
        if(null === $e)
        {
            return $this->_e;
        }
        $this->_e = $e;
        return $this;
    }

    /**
     * Gets or sets dur
     *
     * @param  DurationInfo $dur
     * @return DurationInfo|self
     */
    public function dur(DurationInfo $dur = null)
    {
        if(null === $dur)
        {
            return $this->_dur;
        }
        $this->_dur = $dur;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'comp')
    {
        $name = !empty($name) ? $name : 'comp';
        $arr = parent::toArray($name);
        if(count($this->_category))
        {
            $arr[$name]['category'] = $this->_category;
        }
        if(count($this->_comment))
        {
            $arr[$name]['comment'] = $this->_comment;
        }
        if(count($this->_contact))
        {
            $arr[$name]['contact'] = $this->_contact;
        }
        if($this->_geo instanceof GeoInfo)
        {
            $arr[$name] += $this->_geo->toArray('geo');
        }
        if(count($this->_at))
        {
            $arr[$name]['at'] = array();
            foreach ($this->_at as $at)
            {
                $atArr = $at->toArray('at');
                $arr[$name]['at'][] = $atArr['at'];
            }
        }
        if(count($this->_alarm))
        {
            $arr[$name]['alarm'] = array();
            foreach ($this->_alarm as $alarm)
            {
                $alarmArr = $alarm->toArray('alarm');
                $arr[$name]['alarm'][] = $alarmArr['alarm'];
            }
        }
        if(count($this->_xprop))
        {
            $arr[$name]['xprop'] = array();
            foreach ($this->_xprop as $xprop)
            {
                $xpropArr = $xprop->toArray('xprop');
                $arr[$name]['xprop'][] = $xpropArr['xprop'];
            }
        }
        if(!empty($this->_fr))
        {
            $arr[$name]['fr'] = $this->_fr;
        }
        if(!empty($this->_desc))
        {
            $arr[$name]['desc'] = $this->_desc;
        }
        if(!empty($this->_descHtml))
        {
            $arr[$name]['descHtml'] = $this->_descHtml;
        }
        if($this->_or instanceof CalOrganizer)
        {
            $arr[$name] += $this->_or->toArray('or');
        }
        if($this->_recur instanceof RecurrenceInfo)
        {
            $arr[$name] += $this->_recur->toArray('recur');
        }
        if($this->_exceptId instanceof ExceptionRecurIdInfo)
        {
            $arr[$name] += $this->_exceptId->toArray('exceptId');
        }
        if($this->_s instanceof DtTimeInfo)
        {
            $arr[$name] += $this->_s->toArray('s');
        }
        if($this->_e instanceof DtTimeInfo)
        {
            $arr[$name] += $this->_e->toArray('e');
        }
        if($this->_dur instanceof DurationInfo)
        {
            $arr[$name] += $this->_dur->toArray('dur');
        }

        return $arr;
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'comp')
    {
        $name = !empty($name) ? $name : 'comp';
        $xml = parent::toXml($name);

        foreach ($this->_category as $category)
        {
            $xml->addChild('category', $category);
        }
        foreach ($this->_comment as $comment)
        {
            $xml->addChild('comment', $comment);
        }
        foreach ($this->_contact as $contact)
        {
            $xml->addChild('contact', $contact);
        }
        if($this->_geo instanceof GeoInfo)
        {
            $xml->append($this->_geo->toXml('geo'));
        }
        if(count($this->_at))
        {
            foreach ($this->_at as $at)
            {
                $xml->append($at->toXml('at'));
            }
        }
        if(count($this->_alarm))
        {
            foreach ($this->_alarm as $alarm)
            {
                $xml->append($alarm->toXml('alarm'));
            }
        }
        if(count($this->_xprop))
        {
            foreach ($this->_xprop as $xprop)
            {
                $xml->append($xprop->toXml('xprop'));
            }
        }
        if(!empty($this->_fr))
        {
            $xml->addChild('fr', $this->_fr);
        }
        if(!empty($this->_desc))
        {
            $xml->addChild('desc', $this->_desc);
        }
        if(!empty($this->_descHtml))
        {
            $xml->addChild('descHtml', $this->_descHtml);
        }
        if($this->_or instanceof CalOrganizer)
        {
            $xml->append($this->_or->toXml('or'));
        }
        if($this->_recur instanceof RecurrenceInfo)
        {
            $xml->append($this->_recur->toXml('recur'));
        }
        if($this->_exceptId instanceof ExceptionRecurIdInfo)
        {
            $xml->append($this->_exceptId->toXml('exceptId'));
        }
        if($this->_s instanceof DtTimeInfo)
        {
            $xml->append($this->_s->toXml('s'));
        }
        if($this->_e instanceof DtTimeInfo)
        {
            $xml->append($this->_e->toXml('e'));
        }
        if($this->_dur instanceof DurationInfo)
        {
            $xml->append($this->_dur->toXml('dur'));
        }

        return $xml;
    }
}
