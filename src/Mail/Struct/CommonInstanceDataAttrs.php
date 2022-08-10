<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\{
    FreeBusyStatus,
    InviteClass,
    InviteStatus,
    ParticipationStatus,
    Transparency
};

/**
 * CommonInstanceDataAttrs struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CommonInstanceDataAttrs
{
    /**
     * Your iCalendar PTST (Participation status)
     * Valid values: <b>NE|AC|TE|DE|DG|CO|IN|WE|DF</b>
     * Meanings:
     * "NE"eds-action, "TE"ntative, "AC"cept, "DE"clined, "DG" (delegated), "CO"mpleted (todo), "IN"-process (todo),
     * "WA"iting (custom value only for todo), "DF" (deferred; custom value only for todo)
     * 
     * @Accessor(getter="getPartStat", setter="setPartStat")
     * @SerializedName("ptst")
     * @Type("Enum<Zimbra\Common\Enum\ParticipationStatus>")
     * @XmlAttribute
     */
    private $partStat;

    /**
     * Recurrence-id string in UTC timezone
     * 
     * @Accessor(getter="getRecurIdZ", setter="setRecurIdZ")
     * @SerializedName("ridZ")
     * @Type("string")
     * @XmlAttribute
     */
    private $recurIdZ;

    /**
     * Offset from GMT in milliseconds for start time in the time zone of the instance; this
     * is useful because the instance time zone may not be the same as the time zone of the requesting client; when
     * rendering an all-day appointment, the client must shift the appointment by the difference between the instance
     * time zone and its local time zone to determine the correct date to render the all-day block
     * 
     * @Accessor(getter="getTzOffset", setter="setTzOffset")
     * @SerializedName("tzo")
     * @Type("integer")
     * @XmlAttribute
     */
    private $tzOffset;

    /**
     * Actual free-busy status: Free, Busy, busy-Tentative, busy-Unavailable (a.k.a. OutOfOffice)
     * While free-busy status is simply a property of an event that is set during creation/update, "actual" free-busy
     * status is the true free-busy state that depends on appt/invite free-busy, event scheduling status
     * (confirmed vs. tentative vs. cancel), and more importantly, the attendee's participation status.  For example,
     * actual free-busy is busy-Tentative for an event with Busy free-busy value until the attendee has acted on the
     * invite.
     * 
     * @Accessor(getter="getFreeBusyActual", setter="setFreeBusyActual")
     * @SerializedName("fba")
     * @Type("Enum<Zimbra\Common\Enum\FreeBusyStatus>")
     * @XmlAttribute
     * @var FreeBusyStatus
     */
    private $freeBusyActual;

    /**
     * Percent complete - only for tasks
     * 
     * @Accessor(getter="getTaskPercentComplete", setter="setTaskPercentComplete")
     * @SerializedName("percentComplete")
     * @Type("string")
     * @XmlAttribute
     */
    private $taskPercentComplete;

    /**
     * If set, this is a recurring appointment
     * 
     * @Accessor(getter="getIsRecurring", setter="setIsRecurring")
     * @SerializedName("recur")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isRecurring;

    /**
     * If set, this is a recurring appointment with exceptions
     * 
     * @Accessor(getter="getHasExceptions", setter="setHasExceptions")
     * @SerializedName("hasEx")
     * @Type("bool")
     * @XmlAttribute
     */
    private $hasExceptions;

    /**
     * Priority
     * 
     * @Accessor(getter="getPriority", setter="setPriority")
     * @SerializedName("priority")
     * @Type("string")
     * @XmlAttribute
     */
    private $priority;

    /**
     * Intended Free/Busy
     * 
     * @Accessor(getter="getFreeBusyIntended", setter="setFreeBusyIntended")
     * @SerializedName("fb")
     * @Type("Enum<Zimbra\Common\Enum\FreeBusyStatus>")
     * @XmlAttribute
     * @var FreeBusyStatus
     */
    private $freeBusyIntended;

    /**
     * Transparency - O|T.  i.e. Opaque or Transparent
     * 
     * @Accessor(getter="getTransparency", setter="setTransparency")
     * @SerializedName("transp")
     * @Type("Enum<Zimbra\Common\Enum\Transparency>")
     * @XmlAttribute
     * @var Transparency
     */
    private $transparency;

    /**
     * Name
     * 
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Location
     * 
     * @Accessor(getter="getLocation", setter="setLocation")
     * @SerializedName("loc")
     * @Type("string")
     * @XmlAttribute
     */
    private $location;

    /**
     * If set, this appointment has other attendees
     * 
     * @Accessor(getter="getHasOtherAttendees", setter="setHasOtherAttendees")
     * @SerializedName("otherAtt")
     * @Type("bool")
     * @XmlAttribute
     */
    private $hasOtherAttendees;

    /**
     * Set if has alarm
     * 
     * @Accessor(getter="getHasAlarm", setter="setHasAlarm")
     * @SerializedName("alarm")
     * @Type("bool")
     * @XmlAttribute
     */
    private $hasAlarm;

    /**
     * Default invite "am I organizer" flag
     * 
     * @Accessor(getter="getIsOrganizer", setter="setIsOrganizer")
     * @SerializedName("isOrg")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isOrganizer;

    /**
     * Default invite mail item ID
     * 
     * @Accessor(getter="getInvId", setter="setInvId")
     * @SerializedName("invId")
     * @Type("string")
     * @XmlAttribute
     */
    private $invId;

    /**
     * Default invite component number
     * 
     * @Accessor(getter="getComponentNum", setter="setComponentNum")
     * @SerializedName("compNum")
     * @Type("integer")
     * @XmlAttribute
     */
    private $componentNum;

    /**
     * Status - TENT|CONF|CANC|NEED|COMP|INPR|WAITING|DEFERRED
     * i.e. TENTative, CONFirmed, CANCelled, COMPleted, INPRogress, WAITING, DEFERRED
     * where waiting and Deferred are custom values not found in the iCalendar spec.
     * 
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("Enum<Zimbra\Common\Enum\InviteStatus>")
     * @XmlAttribute
     * @var InviteStatus
     */
    private $status;

    /**
     * Class = PUB|PRI|CON.  i.e. PUBlic (default), PRIvate, CONfidential
     * 
     * @Accessor(getter="getCalClass", setter="setCalClass")
     * @SerializedName("class")
     * @Type("Enum<Zimbra\Common\Enum\InviteClass>")
     * @XmlAttribute
     * @var InviteClass
     */
    private $calClass;

    /**
     * If set, this is an "all day" appointment
     * 
     * @Accessor(getter="getAllDay", setter="setAllDay")
     * @SerializedName("allDay")
     * @Type("bool")
     * @XmlAttribute
     */
    private $allDay;

    /**
     * Set if invite has changes that haven't been sent to attendees; for organizer only
     * 
     * @Accessor(getter="getDraft", setter="setDraft")
     * @SerializedName("draft")
     * @Type("bool")
     * @XmlAttribute
     */
    private $draft;

    /**
     * Set if attendees were never notified of this invite; for organizer only
     * 
     * @Accessor(getter="getNeverSent", setter="setNeverSent")
     * @SerializedName("neverSent")
     * @Type("bool")
     * @XmlAttribute
     */
    private $neverSent;

    /**
     * Due date in milliseconds.  For tasks only
     * 
     * @Accessor(getter="getTaskDueDate", setter="setTaskDueDate")
     * @SerializedName("dueDate")
     * @Type("integer")
     * @XmlAttribute
     */
    private $taskDueDate;

    /**
     * Similar to the "tzo" attribute but for "dueDate".  "tzoDue" can be different from
     * "tzo" if start date and due date lie on different sides of a daylight savings transition
     * 
     * @Accessor(getter="getTaskTzOffsetDue", setter="setTaskTzOffsetDue")
     * @SerializedName("tzoDue")
     * @Type("integer")
     * @XmlAttribute
     */
    private $taskTzOffsetDue;

    /**
     * Constructor
     *
     * @param ParticipationStatus $partStat
     * @param string $recurIdZ
     * @param int $tzOffset
     * @param FreeBusyStatus $freeBusyActual
     * @param string $taskPercentComplete
     * @param bool $isRecurring
     * @param bool $hasExceptions
     * @param string $priority
     * @param FreeBusyStatus $freeBusyIntended
     * @param Transparency $transparency
     * @param string $name
     * @param string $location
     * @param bool $hasOtherAttendees
     * @param bool $hasAlarm
     * @param bool $isOrganizer
     * @param string $invId
     * @param int $componentNum
     * @param InviteStatus $status
     * @param InviteClass $calClass
     * @param bool $allDay
     * @param bool $draft
     * @param bool $neverSent
     * @param int $taskDueDate
     * @param int $taskTzOffsetDue
     * @return self
     */
    public function __construct(
        ?ParticipationStatus $partStat = NULL,
        ?string $recurIdZ = NULL,
        ?int $tzOffset = NULL,
        ?FreeBusyStatus $freeBusyActual = NULL,
        ?string $taskPercentComplete = NULL,
        ?bool $isRecurring = NULL,
        ?bool $hasExceptions = NULL,
        ?string $priority = NULL,
        ?FreeBusyStatus $freeBusyIntended = NULL,
        ?Transparency $transparency = NULL,
        ?string $name = NULL,
        ?string $location = NULL,
        ?bool $hasOtherAttendees = NULL,
        ?bool $hasAlarm = NULL,
        ?bool $isOrganizer = NULL,
        ?string $invId = NULL,
        ?int $componentNum = NULL,
        ?InviteStatus $status = NULL,
        ?InviteClass $calClass = NULL,
        ?bool $allDay = NULL,
        ?bool $draft = NULL,
        ?bool $neverSent = NULL,
        ?int $taskDueDate = NULL,
        ?int $taskTzOffsetDue = NULL
    )
    {
        if ($partStat instanceof ParticipationStatus) {
            $this->setPartStat($partStat);
        }
        if (NULL !== $recurIdZ) {
            $this->setRecurIdZ($recurIdZ);
        }
        if (NULL !== $tzOffset) {
            $this->setTzOffset($tzOffset);
        }
        if ($freeBusyActual instanceof FreeBusyStatus) {
            $this->setFreeBusyActual($freeBusyActual);
        }
        if (NULL !== $taskPercentComplete) {
            $this->setTaskPercentComplete($taskPercentComplete);
        }
        if (NULL !== $isRecurring) {
            $this->setIsRecurring($isRecurring);
        }
        if (NULL !== $hasExceptions) {
            $this->setHasExceptions($hasExceptions);
        }
        if (NULL !== $priority) {
            $this->setPriority($priority);
        }
        if ($freeBusyIntended instanceof FreeBusyStatus) {
            $this->setFreeBusyIntended($freeBusyIntended);
        }
        if ($transparency instanceof Transparency) {
            $this->setTransparency($transparency);
        }
        if (NULL !== $name) {
            $this->setName($name);
        }
        if (NULL !== $location) {
            $this->setLocation($location);
        }
        if (NULL !== $hasOtherAttendees) {
            $this->setHasOtherAttendees($hasOtherAttendees);
        }
        if (NULL !== $hasAlarm) {
            $this->setHasAlarm($hasAlarm);
        }
        if (NULL !== $isOrganizer) {
            $this->setIsOrganizer($isOrganizer);
        }
        if (NULL !== $invId) {
            $this->setInvId($invId);
        }
        if (NULL !== $componentNum) {
            $this->setComponentNum($componentNum);
        }
        if ($status instanceof InviteStatus) {
            $this->setStatus($status);
        }
        if ($calClass instanceof InviteClass) {
            $this->setCalClass($calClass);
        }
        if (NULL !== $allDay) {
            $this->setAllDay($allDay);
        }
        if (NULL !== $draft) {
            $this->setDraft($draft);
        }
        if (NULL !== $neverSent) {
            $this->setNeverSent($neverSent);
        }
        if (NULL !== $taskDueDate) {
            $this->setTaskDueDate($taskDueDate);
        }
        if (NULL !== $taskTzOffsetDue) {
            $this->setTaskTzOffsetDue($taskTzOffsetDue);
        }
    }

    /**
     * Get the partStat
     *
     * @return ParticipationStatus
     */
    public function getPartStat(): ?ParticipationStatus
    {
        return $this->partStat;
    }

    /**
     * Set the partStat
     *
     * @param  ParticipationStatus $partStat
     * @return self
     */
    public function setPartStat(ParticipationStatus $partStat): self
    {
        $this->partStat = $partStat;
        return $this;
    }

    /**
     * Get the recurIdZ
     *
     * @return string
     */
    public function getRecurIdZ(): ?string
    {
        return $this->recurIdZ;
    }

    /**
     * Set the recurIdZ
     *
     * @param  string $recurIdZ
     * @return self
     */
    public function setRecurIdZ(string $recurIdZ): self
    {
        $this->recurIdZ = $recurIdZ;
        return $this;
    }

    /**
     * Get the tzOffset
     *
     * @return int
     */
    public function getTzOffset(): ?int
    {
        return $this->tzOffset;
    }

    /**
     * Set the tzOffset
     *
     * @param  int $tzOffset
     * @return self
     */
    public function setTzOffset(int $tzOffset): self
    {
        $this->tzOffset = $tzOffset;
        return $this;
    }

    /**
     * Get the isRecurring
     *
     * @return bool
     */
    public function getIsRecurring(): ?bool
    {
        return $this->isRecurring;
    }

    /**
     * Set the isRecurring
     *
     * @param  bool $isRecurring
     * @return self
     */
    public function setIsRecurring(bool $isRecurring): self
    {
        $this->isRecurring = $isRecurring;
        return $this;
    }

    /**
     * Get the componentNum
     *
     * @return int
     */
    public function getComponentNum(): ?int
    {
        return $this->componentNum;
    }

    /**
     * Set the componentNum
     *
     * @param  int $componentNum
     * @return self
     */
    public function setComponentNum(int $componentNum): self
    {
        $this->componentNum = $componentNum;
        return $this;
    }

    /**
     * Get the priority
     *
     * @return string
     */
    public function getPriority(): ?string
    {
        return $this->priority;
    }

    /**
     * Set the priority
     *
     * @param  string $priority
     * @return self
     */
    public function setPriority(string $priority): self
    {
        $this->priority = $priority;
        return $this;
    }

    /**
     * Get the name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the location
     *
     * @return string
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * Set the location
     *
     * @param  string $location
     * @return self
     */
    public function setLocation(string $location): self
    {
        $this->location = $location;
        return $this;
    }

    /**
     * Get the invId
     *
     * @return string
     */
    public function getInvId(): ?string
    {
        return $this->invId;
    }

    /**
     * Set the invId
     *
     * @param  string $invId
     * @return self
     */
    public function setInvId(string $invId): self
    {
        $this->invId = $invId;
        return $this;
    }

    /**
     * Get the taskPercentComplete
     *
     * @return string
     */
    public function getTaskPercentComplete(): ?string
    {
        return $this->taskPercentComplete;
    }

    /**
     * Set the taskPercentComplete
     *
     * @param  string $taskPercentComplete
     * @return self
     */
    public function setTaskPercentComplete(string $taskPercentComplete): self
    {
        $this->taskPercentComplete = $taskPercentComplete;
        return $this;
    }

    /**
     * Get the hasExceptions
     *
     * @return bool
     */
    public function getHasExceptions(): ?bool
    {
        return $this->hasExceptions;
    }

    /**
     * Set the hasExceptions
     *
     * @param  bool $hasExceptions
     * @return self
     */
    public function setHasExceptions(bool $hasExceptions): self
    {
        $this->hasExceptions = $hasExceptions;
        return $this;
    }

    /**
     * Get the freeBusyActual
     *
     * @return FreeBusyStatus
     */
    public function getFreeBusyActual(): ?FreeBusyStatus
    {
        return $this->freeBusyActual;
    }

    /**
     * Set the freeBusyActual
     *
     * @param  FreeBusyStatus $freeBusyActual
     * @return self
     */
    public function setFreeBusyActual(FreeBusyStatus $freeBusyActual): self
    {
        $this->freeBusyActual = $freeBusyActual;
        return $this;
    }

    /**
     * Get the freeBusyIntended
     *
     * @return FreeBusyStatus
     */
    public function getFreeBusyIntended(): ?FreeBusyStatus
    {
        return $this->freeBusyIntended;
    }

    /**
     * Set the freeBusyIntended
     *
     * @param  FreeBusyStatus $freeBusyIntended
     * @return self
     */
    public function setFreeBusyIntended(FreeBusyStatus $freeBusyIntended): self
    {
        $this->freeBusyIntended = $freeBusyIntended;
        return $this;
    }

    /**
     * Get the transparency
     *
     * @return Transparency
     */
    public function getTransparency(): ?Transparency
    {
        return $this->transparency;
    }

    /**
     * Set the transparency
     *
     * @param  Transparency $transparency
     * @return self
     */
    public function setTransparency(Transparency $transparency): self
    {
        $this->transparency = $transparency;
        return $this;
    }

    /**
     * Get the isOrganizer
     *
     * @return bool
     */
    public function getIsOrganizer(): ?bool
    {
        return $this->isOrganizer;
    }

    /**
     * Set the isOrganizer
     *
     * @param  bool $isOrganizer
     * @return self
     */
    public function setIsOrganizer(bool $isOrganizer): self
    {
        $this->isOrganizer = $isOrganizer;
        return $this;
    }

    /**
     * Get the taskDueDate
     *
     * @return int
     */
    public function getTaskDueDate(): ?int
    {
        return $this->taskDueDate;
    }

    /**
     * Set the taskDueDate
     *
     * @param  int $taskDueDate
     * @return self
     */
    public function setTaskDueDate(int $taskDueDate): self
    {
        $this->taskDueDate = $taskDueDate;
        return $this;
    }

    /**
     * Get the taskTzOffsetDue
     *
     * @return int
     */
    public function getTaskTzOffsetDue(): ?int
    {
        return $this->taskTzOffsetDue;
    }

    /**
     * Set the taskTzOffsetDue
     *
     * @param  int $taskTzOffsetDue
     * @return self
     */
    public function setTaskTzOffsetDue(int $taskTzOffsetDue): self
    {
        $this->taskTzOffsetDue = $taskTzOffsetDue;
        return $this;
    }

    /**
     * Get the status
     *
     * @return InviteStatus
     */
    public function getStatus(): ?InviteStatus
    {
        return $this->status;
    }

    /**
     * Set the status
     *
     * @param  InviteStatus $status
     * @return self
     */
    public function setStatus(InviteStatus $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get the calClass
     *
     * @return InviteClass
     */
    public function getCalClass(): ?InviteClass
    {
        return $this->calClass;
    }

    /**
     * Set the calClass
     *
     * @param  InviteClass $calClass
     * @return self
     */
    public function setCalClass(InviteClass $calClass): self
    {
        $this->calClass = $calClass;
        return $this;
    }

    /**
     * Get the allDay
     *
     * @return bool
     */
    public function getAllDay(): ?bool
    {
        return $this->allDay;
    }

    /**
     * Set the allDay
     *
     * @param  bool $allDay
     * @return self
     */
    public function setAllDay(bool $allDay): self
    {
        $this->allDay = $allDay;
        return $this;
    }

    /**
     * Get the hasOtherAttendees
     *
     * @return bool
     */
    public function getHasOtherAttendees(): ?bool
    {
        return $this->hasOtherAttendees;
    }

    /**
     * Set the hasOtherAttendees
     *
     * @param  bool $hasOtherAttendees
     * @return self
     */
    public function setHasOtherAttendees(bool $hasOtherAttendees): self
    {
        $this->hasOtherAttendees = $hasOtherAttendees;
        return $this;
    }

    /**
     * Get the hasAlarm
     *
     * @return bool
     */
    public function getHasAlarm(): ?bool
    {
        return $this->hasAlarm;
    }

    /**
     * Set the hasAlarm
     *
     * @param  bool $hasAlarm
     * @return self
     */
    public function setHasAlarm(bool $hasAlarm): self
    {
        $this->hasAlarm = $hasAlarm;
        return $this;
    }

    /**
     * Get the draft
     *
     * @return bool
     */
    public function getDraft(): ?bool
    {
        return $this->draft;
    }

    /**
     * Set the draft
     *
     * @param  bool $draft
     * @return self
     */
    public function setDraft(bool $draft): self
    {
        $this->draft = $draft;
        return $this;
    }

    /**
     * Get the neverSent
     *
     * @return bool
     */
    public function getNeverSent(): ?bool
    {
        return $this->neverSent;
    }

    /**
     * Set the neverSent
     *
     * @param  bool $neverSent
     * @return self
     */
    public function setNeverSent(bool $neverSent): self
    {
        $this->neverSent = $neverSent;
        return $this;
    }
}
