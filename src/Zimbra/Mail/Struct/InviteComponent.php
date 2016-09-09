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
    private $_categories;

    /**
     * Comments - for iCalendar COMMENT properties
     * @var array
     */
    private $_comments;

    /**
     * Contacts - for iCalendar CONTACT properties
     * @var array
     */
    private $_contacts;

    /**
     * Attendees
     * @var TypedSequence
     */
    private $_attendees;

    /**
     * Alarm information
     * @var TypedSequence
     */
    private $_alarms;

    /**
     * iCalender XPROP properties 
     * @var TypedSequence
     */
    private $_xprops;

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
     * @param int    $date
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
     * @param array  $changes
     * @param array  $categories
     * @param array  $comments
     * @param array  $contacts
     * @param GeoInfo $geo for iCalendar GEO property
     * @param array  $attendees
     * @param array  $alarms
     * @param array  $xprops
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
        $method = null,
        $compNum = null,
        $rsvp = null,
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
        $date = null,
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
        array $changes = [],
        array $categories = [],
        array $comments = [],
        array $contacts = [],
        GeoInfo $geo = null,
        array $attendees = [],
        array $alarms = [],
        array $xprops = [],
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
            $date,
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
            $changes
        );

        if($geo instanceof GeoInfo)
        {
            $this->setChild('geo', $geo);
        }
        if(null !== $fr)
        {
            $this->setChild('fr', trim($fr));
        }
        if(null !== $desc)
        {
            $this->setChild('desc', trim($desc));
        }
        if(null !== $descHtml)
        {
            $this->setChild('descHtml', trim($descHtml));
        }
        if($or instanceof CalOrganizer)
        {
            $this->setChild('or', $or);
        }
        if($recur instanceof RecurrenceInfo)
        {
            $this->setChild('recur', $recur);
        }
        if($exceptId instanceof ExceptionRecurIdInfo)
        {
            $this->setChild('exceptId', $exceptId);
        }
        if($s instanceof DtTimeInfo)
        {
            $this->setChild('s', $s);
        }
        if($e instanceof DtTimeInfo)
        {
            $this->setChild('e', $e);
        }
        if($dur instanceof DurationInfo)
        {
            $this->setChild('dur', $dur);
        }

        $this->setCategories($categories)
            ->setComments($comments)
            ->setContacts($contacts)
            ->setAttendees($attendees)
            ->setAlarms($alarms)
            ->setXProps($xprops);
        $this->on('before', function(InviteComponentCommon $sender)
        {
            if($sender->getCategories()->count())
            {
                $sender->setChild('category', $sender->getCategories()->all());
            }
            if($sender->getComments()->count())
            {
                $sender->setChild('comment', $sender->getComments()->all());
            }
            if($sender->getContacts()->count())
            {
                $sender->setChild('contact', $sender->getContacts()->all());
            }
            if($sender->getAttendees()->count())
            {
                $sender->setChild('at', $sender->getAttendees()->all());
            }
            if($sender->getAlarms()->count())
            {
                $sender->setChild('alarm', $sender->getAlarms()->all());
            }
            if($sender->getXProps()->count())
            {
                $sender->setChild('xprop', $sender->getXProps()->all());
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
        $this->_categories->add(trim($category));
        return $this;
    }

    /**
     * Sets category sequence
     *
     * @param  array $categories
     * @return self
     */
    public function setCategories(array $categories)
    {
        $this->_categories = new Sequence();
        foreach ($categories as $value)
        {
            $value = trim($value);
            if(!$this->_categories->contains($value))
            {
                $this->_categories->add($value);
            }
        }
        return $this;
    }

    /**
     * Gets category sequence
     *
     * @return Sequence
     */
    public function getCategories()
    {
        return $this->_categories;
    }

    /**
     * Add an comment
     *
     * @param  string $comment
     * @return self
     */
    public function addComment($comment)
    {
        $this->_comments->add(trim($comment));
        return $this;
    }

    /**
     * Sets comment sequence
     *
     * @param  array $comments
     * @return self
     */
    public function setComments(array $comments)
    {
        $this->_comments = new Sequence();
        foreach ($comments as $value)
        {
            $value = trim($value);
            if(!$this->_comments->contains($value))
            {
                $this->_comments->add($value);
            }
        }
        return $this;
    }

    /**
     * Gets comment sequence
     *
     * @return Sequence
     */
    public function getComments()
    {
        return $this->_comments;
    }

    /**
     * Add a contact
     *
     * @param  string $contact
     * @return self
     */
    public function addContact($contact)
    {
        $this->_contacts->add(trim($contact));
        return $this;
    }

    /**
     * Sets contact sequence
     *
     * @param  array $contacts
     * @return self
     */
    public function setContacts(array $contacts)
    {
        $this->_contacts = new Sequence();
        foreach ($contacts as $value)
        {
            $value = trim($value);
            if(!$this->_contacts->contains($value))
            {
                $this->_contacts->add($value);
            }
        }
        return $this;
    }

    /**
     * Gets contact sequence
     *
     * @return Sequence
     */
    public function getContacts()
    {
        return $this->_contacts;
    }

    /**
     * Gets geo
     *
     * @return GeoInfo
     */
    public function getGeo()
    {
        return $this->getChild('geo');
    }

    /**
     * Sets geo
     *
     * @param  GeoInfo $geo
     * @return self
     */
    public function setGeo(GeoInfo $geo)
    {
        return $this->setChild('geo', $geo);
    }

    /**
     * Add an attendee
     *
     * @param  CalendarAttendee $attendee
     * @return self
     */
    public function addAttendee(CalendarAttendee $attendee)
    {
        $this->_attendees->add($attendee);
        return $this;
    }

    /**
     * Set sequence of attendee
     *
     * @param  array $attendees
     * @return self
     */
    public function setAttendees(array $attendees)
    {
        $this->_attendees = new TypedSequence('Zimbra\Mail\Struct\CalendarAttendee', $attendees);
        return $this;
    }

    /**
     * Get sequence of attendee
     *
     * @return Sequence
     */
    public function getAttendees()
    {
        return $this->_attendees;
    }

    /**
     * Add an alarm
     *
     * @param  AlarmInfo $alarm
     * @return self
     */
    public function addAlarm(AlarmInfo $alarm)
    {
        $this->_alarms->add($alarm);
        return $this;
    }

    /**
     * Set sequence of alarm
     *
     * @param  array $alarms
     * @return self
     */
    public function setAlarms(array $alarms)
    {
        $this->_alarms = new TypedSequence('Zimbra\Mail\Struct\AlarmInfo', $alarms);
        return $this;
    }

    /**
     * Get sequence of alarm
     *
     * @return Sequence
     */
    public function getAlarms()
    {
        return $this->_alarms;
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
     * Set sequence of xprop
     *
     * @param  array $xprops
     * @return self
     */
    public function setXProps(array $xprops)
    {
        $this->_xprops = new TypedSequence('Zimbra\Mail\Struct\XProp', $xprops);
        return $this;
    }

    /**
     * Get sequence of xprop
     *
     * @return Sequence
     */
    public function getXProps()
    {
        return $this->_xprops;
    }

    /**
     * Gets fragment
     *
     * @return string
     */
    public function getFragment()
    {
        return $this->getChild('fr');
    }

    /**
     * Sets fragment
     *
     * @param  string $fr
     * @return self
     */
    public function setFragment($fr)
    {
        return $this->setChild('fr', trim($fr));
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
     * Gets HTML description
     *
     * @return string
     */
    public function getHtmlDescription()
    {
        return $this->getChild('descHtml');
    }

    /**
     * Sets HTML description
     *
     * @param  string $descHtml
     * @return self
     */
    public function setHtmlDescription($descHtml)
    {
        return $this->setChild('descHtml', trim($descHtml));
    }

    /**
     * Gets organizer
     *
     * @return CalOrganizer
     */
    public function getOrganizer()
    {
        return $this->getChild('or');
    }

    /**
     * Sets organizer
     *
     * @param  CalOrganizer $or
     * @return self
     */
    public function setOrganizer(CalOrganizer $or)
    {
        return $this->setChild('or', $or);
    }

    /**
     * Gets recurrence information
     *
     * @return RecurrenceInfo
     */
    public function getRecurrence()
    {
        return $this->getChild('recur');
    }

    /**
     * Sets recurrence information
     *
     * @param  RecurrenceInfo $recur
     * @return self
     */
    public function setRecurrence(RecurrenceInfo $recur)
    {
        return $this->setChild('recur', $recur);
    }

    /**
     * Gets exception Id
     *
     * @return ExceptionRecurIdInfo
     */
    public function getExceptionId()
    {
        return $this->getChild('exceptId');
    }

    /**
     * Sets exception Id
     *
     * @param  ExceptionRecurIdInfo $exceptId
     * @return self
     */
    public function setExceptionId(ExceptionRecurIdInfo $exceptId)
    {
        return $this->setChild('exceptId', $exceptId);
    }

    /**
     * Gets start date-time
     *
     * @return DtTimeInfo
     */
    public function getDtStart()
    {
        return $this->getChild('s');
    }

    /**
     * Sets start date-time
     *
     * @param  DtTimeInfo $s
     * @return self
     */
    public function setDtStart(DtTimeInfo $s)
    {
        return $this->setChild('s', $s);
    }

    /**
     * Gets end date-time
     *
     * @return DtTimeInfo
     */
    public function getDtEnd()
    {
        return $this->getChild('e');
    }

    /**
     * Sets end date-time
     *
     * @param  DtTimeInfo $e
     * @return self
     */
    public function setDtEnd(DtTimeInfo $e)
    {
        return $this->setChild('e', $e);
    }

    /**
     * Gets duration
     *
     * @return DurationInfo
     */
    public function getDuration()
    {
        return $this->getChild('dur');
    }

    /**
     * Sets duration
     *
     * @param  DurationInfo $dur
     * @return self
     */
    public function setDuration(DurationInfo $dur)
    {
        return $this->setChild('dur', $dur);
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
