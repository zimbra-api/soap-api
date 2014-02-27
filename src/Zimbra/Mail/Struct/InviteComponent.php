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

use PhpCollection\Sequence;
use Zimbra\Common\TypedSequence;
use Zimbra\Enum\FreeBusyStatus;
use Zimbra\Enum\Transparency;
use Zimbra\Enum\InviteStatus;
use Zimbra\Enum\InviteClass;
use Zimbra\Enum\InviteChange;

/**
 * InviteComponent struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
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
     * @param GeoInfo $geo for iCalendar GEO property
     * @param array  $at
     * @param array  $alarm
     * @param array  $xprop
     * @param string $fr Fragment
     * @param string $desc Description
     * @param string $descHtml Html description
     * @param CalOrganizer $or Organizer
     * @param RecurrenceInfo $recur Recurrence information
     * @param ExceptionRecurIdInfo $exceptId RECURRENCE-ID, if this is an exception
     * @param DtTimeInfo $s Start date-time
     * @param DtTimeInfo $e End date-time
     * @param DurationInfo $dur Duration
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

        $this->_category = new Sequence();
        foreach ($category as $value)
        {
            $value = trim($value);
            if(!$this->_category->contains($value))
            {
                $this->_category->add($value);
            }
        }
        $this->_comment = new Sequence();
        foreach ($comment as $value)
        {
            $value = trim($value);
            if(!$this->_comment->contains($value))
            {
                $this->_comment->add($value);
            }
        }
        $this->_contact = new Sequence();
        foreach ($contact as $value)
        {
            $value = trim($value);
            if(!$this->_contact->contains($value))
            {
                $this->_contact->add($value);
            }
        }
        if($geo instanceof GeoInfo)
        {
            $this->child('geo', $geo);
        }
        $this->_at = new TypedSequence('Zimbra\Mail\Struct\CalendarAttendee', $at);
        $this->_alarm = new TypedSequence('Zimbra\Mail\Struct\AlarmInfo', $alarm);
        $this->_xprop = new TypedSequence('Zimbra\Mail\Struct\XProp', $xprop);
        if(null !== $fr)
        {
            $this->child('fr', trim($fr));
        }
        if(null !== $desc)
        {
            $this->child('desc', trim($desc));
        }
        if(null !== $descHtml)
        {
            $this->child('descHtml', trim($descHtml));
        }
        if($or instanceof CalOrganizer)
        {
            $this->child('or', $or);
        }
        if($recur instanceof RecurrenceInfo)
        {
            $this->child('recur', $recur);
        }
        if($exceptId instanceof ExceptionRecurIdInfo)
        {
            $this->child('exceptId', $exceptId);
        }
        if($s instanceof DtTimeInfo)
        {
            $this->child('s', $s);
        }
        if($e instanceof DtTimeInfo)
        {
            $this->child('e', $e);
        }
        if($dur instanceof DurationInfo)
        {
            $this->child('dur', $dur);
        }

        $this->on('before', function(InviteComponentCommon $sender)
        {
            if($sender->category()->count())
            {
                $sender->child('category', $sender->category()->all());
            }
            if($sender->comment()->count())
            {
                $sender->child('comment', $sender->comment()->all());
            }
            if($sender->contact()->count())
            {
                $sender->child('contact', $sender->contact()->all());
            }
            if($sender->at()->count())
            {
                $sender->child('at', $sender->at()->all());
            }
            if($sender->alarm()->count())
            {
                $sender->child('alarm', $sender->alarm()->all());
            }
            if($sender->xprop()->count())
            {
                $sender->child('xprop', $sender->xprop()->all());
            }
        });
    }

    /**
     * Add a category
     *
     * @param  string $category
     * @return self
     */
    public function addCategory($category)
    {
        $this->_category->add(trim($category));
        return $this;
    }

    /**
     * Gets category sequence
     *
     * @return Sequence
     */
    public function category()
    {
        return $this->_category;
    }

    /**
     * Add an comment
     *
     * @param  string $comment
     * @return self
     */
    public function addComment($comment)
    {
        $this->_comment->add(trim($comment));
        return $this;
    }

    /**
     * Gets comment sequence
     *
     * @return Sequence
     */
    public function comment()
    {
        return $this->_comment;
    }

    /**
     * Add a contact
     *
     * @param  string $contact
     * @return self
     */
    public function addContact($contact)
    {
        $this->_contact->add(trim($contact));
        return $this;
    }

    /**
     * Gets contact sequence
     *
     * @return Sequence
     */
    public function contact()
    {
        return $this->_contact;
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
            return $this->child('geo');
        }
        return $this->child('geo', $geo);
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
            return $this->child('fr');
        }
        return $this->child('fr', trim($fr));
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
        return $this->child('desc', $desc);
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
            return $this->child('descHtml');
        }
        return $this->child('descHtml', trim($descHtml));
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
            return $this->child('or');
        }
        return $this->child('or', $or);
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
            return $this->child('recur');
        }
        return $this->child('recur', $recur);
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
            return $this->child('exceptId');
        }
        return $this->child('exceptId', $exceptId);
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
            return $this->child('s');
        }
        return $this->child('s', $s);
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
            return $this->child('e');
        }
        return $this->child('e', $e);
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
            return $this->child('dur');
        }
        return $this->child('dur', $dur);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'comp')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'comp')
    {
        return parent::toXml($name);
    }
}
