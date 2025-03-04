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
     * Valid values: NE|AC|TE|DE|DG|CO|IN|WE|DF
     * Meanings:
     * "NE"eds-action, "TE"ntative, "AC"cept, "DE"clined, "DG" (delegated), "CO"mpleted (todo), "IN"-process (todo),
     * "WA"iting (custom value only for todo), "DF" (deferred; custom value only for todo)
     *
     * @var ParticipationStatus
     */
    #[Accessor(getter: "getPartStat", setter: "setPartStat")]
    #[SerializedName("ptst")]
    #[XmlAttribute]
    private ?ParticipationStatus $partStat;

    /**
     * Recurrence-id string in UTC timezone
     *
     * @var string
     */
    #[Accessor(getter: "getRecurIdZ", setter: "setRecurIdZ")]
    #[SerializedName("ridZ")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $recurIdZ = null;

    /**
     * Offset from GMT in milliseconds for start time in the time zone of the instance;
     * this is useful because the instance time zone may not be the same as the time zone of the requesting client;
     * when rendering an all-day appointment, the client must shift the appointment by the difference between the instance
     * time zone and its local time zone to determine the correct date to render the all-day block
     *
     * @var int
     */
    #[Accessor(getter: "getTzOffset", setter: "setTzOffset")]
    #[SerializedName("tzo")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $tzOffset = null;

    /**
     * Actual free-busy status: Free, Busy, busy-Tentative, busy-Unavailable (a.k.a. OutOfOffice)
     * While free-busy status is simply a property of an event that is set during creation/update, "actual" free-busy
     * status is the true free-busy state that depends on appt/invite free-busy, event scheduling status
     * (confirmed vs. tentative vs. cancel), and more importantly, the attendee's participation status. For example,
     * actual free-busy is busy-Tentative for an event with Busy free-busy value until the attendee has acted on the invite.
     *
     * @var FreeBusyStatus
     */
    #[Accessor(getter: "getFreeBusyActual", setter: "setFreeBusyActual")]
    #[SerializedName("fba")]
    #[XmlAttribute]
    private ?FreeBusyStatus $freeBusyActual;

    /**
     * Percent complete - only for tasks
     *
     * @var string
     */
    #[
        Accessor(
            getter: "getTaskPercentComplete",
            setter: "setTaskPercentComplete"
        )
    ]
    #[SerializedName("percentComplete")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $taskPercentComplete = null;

    /**
     * If set, this is a recurring appointment
     *
     * @var bool
     */
    #[Accessor(getter: "getIsRecurring", setter: "setIsRecurring")]
    #[SerializedName("recur")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $isRecurring = null;

    /**
     * If set, this is a recurring appointment with exceptions
     *
     * @var bool
     */
    #[Accessor(getter: "getHasExceptions", setter: "setHasExceptions")]
    #[SerializedName("hasEx")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $hasExceptions = null;

    /**
     * Priority
     *
     * @var string
     */
    #[Accessor(getter: "getPriority", setter: "setPriority")]
    #[SerializedName("priority")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $priority = null;

    /**
     * Intended Free/Busy
     *
     * @var FreeBusyStatus
     */
    #[Accessor(getter: "getFreeBusyIntended", setter: "setFreeBusyIntended")]
    #[SerializedName("fb")]
    #[XmlAttribute]
    private ?FreeBusyStatus $freeBusyIntended;

    /**
     * Transparency - O|T.  i.e. Opaque or Transparent
     *
     * @var Transparency
     */
    #[Accessor(getter: "getTransparency", setter: "setTransparency")]
    #[SerializedName("transp")]
    #[XmlAttribute]
    private ?Transparency $transparency;

    /**
     * Name
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $name = null;

    /**
     * Location
     *
     * @var string
     */
    #[Accessor(getter: "getLocation", setter: "setLocation")]
    #[SerializedName("loc")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $location = null;

    /**
     * If set, this appointment has other attendees
     *
     * @var bool
     */
    #[Accessor(getter: "getHasOtherAttendees", setter: "setHasOtherAttendees")]
    #[SerializedName("otherAtt")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $hasOtherAttendees = null;

    /**
     * Set if has alarm
     *
     * @var bool
     */
    #[Accessor(getter: "getHasAlarm", setter: "setHasAlarm")]
    #[SerializedName("alarm")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $hasAlarm = null;

    /**
     * Default invite "am I organizer" flag
     *
     * @var bool
     */
    #[Accessor(getter: "getIsOrganizer", setter: "setIsOrganizer")]
    #[SerializedName("isOrg")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $isOrganizer = null;

    /**
     * Default invite mail item ID
     *
     * @var string
     */
    #[Accessor(getter: "getInvId", setter: "setInvId")]
    #[SerializedName("invId")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $invId = null;

    /**
     * Default invite component number
     *
     * @var int
     */
    #[Accessor(getter: "getComponentNum", setter: "setComponentNum")]
    #[SerializedName("compNum")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $componentNum = null;

    /**
     * Status - TENT|CONF|CANC|NEED|COMP|INPR|WAITING|DEFERRED
     * i.e. TENTative, CONFirmed, CANCelled, COMPleted, INPRogress, WAITING, DEFERRED
     * where waiting and Deferred are custom values not found in the iCalendar spec.
     *
     * @var InviteStatus
     */
    #[Accessor(getter: "getStatus", setter: "setStatus")]
    #[SerializedName("status")]
    #[XmlAttribute]
    private ?InviteStatus $status;

    /**
     * Class = PUB|PRI|CON.  i.e. PUBlic (default), PRIvate, CONfidential
     *
     * @var InviteClass
     */
    #[Accessor(getter: "getCalClass", setter: "setCalClass")]
    #[SerializedName("class")]
    #[XmlAttribute]
    private ?InviteClass $calClass;

    /**
     * If set, this is an "all day" appointment
     *
     * @var bool
     */
    #[Accessor(getter: "getAllDay", setter: "setAllDay")]
    #[SerializedName("allDay")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $allDay = null;

    /**
     * Set if invite has changes that haven't been sent to attendees; for organizer only
     *
     * @var bool
     */
    #[Accessor(getter: "getDraft", setter: "setDraft")]
    #[SerializedName("draft")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $draft = null;

    /**
     * Set if attendees were never notified of this invite; for organizer only
     *
     * @var bool
     */
    #[Accessor(getter: "getNeverSent", setter: "setNeverSent")]
    #[SerializedName("neverSent")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $neverSent = null;

    /**
     * Due date in milliseconds. For tasks only
     *
     * @var int
     */
    #[Accessor(getter: "getTaskDueDate", setter: "setTaskDueDate")]
    #[SerializedName("dueDate")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $taskDueDate = null;

    /**
     * Similar to the "tzo" attribute but for "dueDate". "tzoDue" can be different from
     * "tzo" if start date and due date lie on different sides of a daylight savings transition
     *
     * @var int
     */
    #[Accessor(getter: "getTaskTzOffsetDue", setter: "setTaskTzOffsetDue")]
    #[SerializedName("tzoDue")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $taskTzOffsetDue = null;

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
        ?ParticipationStatus $partStat = null,
        ?string $recurIdZ = null,
        ?int $tzOffset = null,
        ?FreeBusyStatus $freeBusyActual = null,
        ?string $taskPercentComplete = null,
        ?bool $isRecurring = null,
        ?bool $hasExceptions = null,
        ?string $priority = null,
        ?FreeBusyStatus $freeBusyIntended = null,
        ?Transparency $transparency = null,
        ?string $name = null,
        ?string $location = null,
        ?bool $hasOtherAttendees = null,
        ?bool $hasAlarm = null,
        ?bool $isOrganizer = null,
        ?string $invId = null,
        ?int $componentNum = null,
        ?InviteStatus $status = null,
        ?InviteClass $calClass = null,
        ?bool $allDay = null,
        ?bool $draft = null,
        ?bool $neverSent = null,
        ?int $taskDueDate = null,
        ?int $taskTzOffsetDue = null
    ) {
        $this->partStat = $partStat;
        $this->freeBusyActual = $freeBusyActual;
        $this->freeBusyIntended = $freeBusyIntended;
        $this->transparency = $transparency;
        $this->status = $status;
        $this->calClass = $calClass;
        if (null !== $recurIdZ) {
            $this->setRecurIdZ($recurIdZ);
        }
        if (null !== $tzOffset) {
            $this->setTzOffset($tzOffset);
        }
        if (null !== $taskPercentComplete) {
            $this->setTaskPercentComplete($taskPercentComplete);
        }
        if (null !== $isRecurring) {
            $this->setIsRecurring($isRecurring);
        }
        if (null !== $hasExceptions) {
            $this->setHasExceptions($hasExceptions);
        }
        if (null !== $priority) {
            $this->setPriority($priority);
        }
        if (null !== $name) {
            $this->setName($name);
        }
        if (null !== $location) {
            $this->setLocation($location);
        }
        if (null !== $hasOtherAttendees) {
            $this->setHasOtherAttendees($hasOtherAttendees);
        }
        if (null !== $hasAlarm) {
            $this->setHasAlarm($hasAlarm);
        }
        if (null !== $isOrganizer) {
            $this->setIsOrganizer($isOrganizer);
        }
        if (null !== $invId) {
            $this->setInvId($invId);
        }
        if (null !== $componentNum) {
            $this->setComponentNum($componentNum);
        }
        if (null !== $allDay) {
            $this->setAllDay($allDay);
        }
        if (null !== $draft) {
            $this->setDraft($draft);
        }
        if (null !== $neverSent) {
            $this->setNeverSent($neverSent);
        }
        if (null !== $taskDueDate) {
            $this->setTaskDueDate($taskDueDate);
        }
        if (null !== $taskTzOffsetDue) {
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
