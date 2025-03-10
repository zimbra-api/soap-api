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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlElement,
    XmlList
};
use Zimbra\Common\Enum\{
    FreeBusyStatus,
    InviteClass,
    InviteStatus,
    Transparency
};
use Zimbra\Common\Struct\{
    AlarmInfoInterface,
    CalendarAttendeeInterface,
    CalOrganizerInterface,
    DtTimeInfoInterface,
    DurationInfoInterface,
    ExceptionRecurIdInfoInterface,
    GeoInfoInterface,
    InviteComponentInterface,
    RecurrenceInfoInterface,
    XPropInterface
};

/**
 * InviteComponent struct class
 * Invitation Component
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class InviteComponent extends InviteComponentCommon implements
    InviteComponentInterface
{
    /**
     * Categories - for iCalendar CATEGORY properties
     *
     * @var array
     */
    #[Accessor(getter: "getCategories", setter: "setCategories")]
    #[Type("array<string>")]
    #[XmlList(inline: true, entry: "category", namespace: "urn:zimbraMail")]
    private array $categories = [];

    /**
     * Comments - for iCalendar COMMENT properties
     *
     * @var array
     */
    #[Accessor(getter: "getComments", setter: "setComments")]
    #[Type("array<string>")]
    #[XmlList(inline: true, entry: "comment", namespace: "urn:zimbraMail")]
    private array $comments = [];

    /**
     * Contacts - for iCalendar CONTACT properties
     *
     * @var array
     */
    #[Accessor(getter: "getContacts", setter: "setContacts")]
    #[Type("array<string>")]
    #[XmlList(inline: true, entry: "contact", namespace: "urn:zimbraMail")]
    private array $contacts = [];

    /**
     * for iCalendar GEO property
     *
     * @var GeoInfoInterface
     */
    #[Accessor(getter: "getGeo", setter: "setGeo")]
    #[SerializedName("geo")]
    #[Type(GeoInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?GeoInfoInterface $geo;

    /**
     * Attendees
     *
     * @var array
     */
    #[Accessor(getter: "getAttendees", setter: "setAttendees")]
    #[Type("array<Zimbra\Mail\Struct\CalendarAttendee>")]
    #[XmlList(inline: true, entry: "at", namespace: "urn:zimbraMail")]
    private array $attendees = [];

    /**
     * Alarm information
     *
     * @var array
     */
    #[Accessor(getter: "getAlarms", setter: "setAlarms")]
    #[Type("array<Zimbra\Mail\Struct\AlarmInfo>")]
    #[XmlList(inline: true, entry: "alarm", namespace: "urn:zimbraMail")]
    private array $alarms = [];

    /**
     * XPROP properties
     *
     * @var array
     */
    #[Accessor(getter: "getXProps", setter: "setXProps")]
    #[Type("array<Zimbra\Mail\Struct\XProp>")]
    #[XmlList(inline: true, entry: "xprop", namespace: "urn:zimbraMail")]
    private array $xProps = [];

    /**
     * First few bytes of the message (probably between 40 and 100 bytes)
     *
     * @var string
     */
    #[Accessor(getter: "getFragment", setter: "setFragment")]
    #[SerializedName("fr")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraMail")]
    private ?string $fragment = null;

    /**
     * Present if noBlob is set and invite has a plain text description
     *
     * @var string
     */
    #[Accessor(getter: "getDescription", setter: "setDescription")]
    #[SerializedName("desc")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraMail")]
    private ?string $description = null;

    /**
     * Present if noBlob is set and invite has an HTML description
     *
     * @var string
     */
    #[Accessor(getter: "getHtmlDescription", setter: "setHtmlDescription")]
    #[SerializedName("descHtml")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraMail")]
    private ?string $htmlDescription = null;

    /**
     * Organizer
     *
     * @var CalOrganizerInterface
     */
    #[Accessor(getter: "getOrganizer", setter: "setOrganizer")]
    #[SerializedName("or")]
    #[Type(CalOrganizer::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?CalOrganizerInterface $organizer;

    /**
     * Recurrence information
     *
     * @var RecurrenceInfoInterface
     */
    #[Accessor(getter: "getRecurrence", setter: "setRecurrence")]
    #[SerializedName("recur")]
    #[Type(RecurrenceInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?RecurrenceInfoInterface $recurrence;

    /**
     * Recurrence id, if this is an exception
     *
     * @var ExceptionRecurIdInfoInterface
     */
    #[Accessor(getter: "getExceptionId", setter: "setExceptionId")]
    #[SerializedName("exceptId")]
    #[Type(ExceptionRecurIdInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?ExceptionRecurIdInfoInterface $exceptionId;

    /**
     * Start date-time (required)
     *
     * @var DtTimeInfoInterface
     */
    #[Accessor(getter: "getDtStart", setter: "setDtStart")]
    #[SerializedName("s")]
    #[Type(DtTimeInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?DtTimeInfoInterface $dtStart;

    /**
     * End date-time
     *
     * @var DtTimeInfoInterface
     */
    #[Accessor(getter: "getDtEnd", setter: "setDtEnd")]
    #[SerializedName("e")]
    #[Type(DtTimeInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?DtTimeInfoInterface $dtEnd;

    /**
     * Duration
     *
     * @var DurationInfoInterface
     */
    #[Accessor(getter: "getDuration", setter: "setDuration")]
    #[SerializedName("dur")]
    #[Type(DurationInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?DurationInfoInterface $duration;

    /**
     * Constructor
     *
     * @param  string $method
     * @param  int $componentNum
     * @param  bool $rsvp
     * @param  string $priority
     * @param  string $name
     * @param  string $location
     * @param  string $percentComplete
     * @param  string $completed
     * @param  bool $noBlob
     * @param  FreeBusyStatus $freeBusyActual
     * @param  FreeBusyStatus $freeBusy
     * @param  Transparency $transparency
     * @param  bool $isOrganizer
     * @param  string $xUid
     * @param  string $uid
     * @param  int $sequence
     * @param  int $dateTime
     * @param  string $calItemId
     * @param  string $deprecatedApptId
     * @param  string $calItemFolder
     * @param  InviteStatus $status
     * @param  InviteClass $calClass
     * @param  string $url
     * @param  bool $isException
     * @param  string $recurIdZ
     * @param  bool $isAllDay
     * @param  bool $isDraft
     * @param  bool $neverSent
     * @param  string $changes
     * @param  array $categories
     * @param  array $comments
     * @param  array $contacts
     * @param  GeoInfoInterface $geo
     * @param  array $attendees
     * @param  array $alarms
     * @param  array $xProps
     * @param  string $fragment
     * @param  string $description
     * @param  string $htmlDescription
     * @param  CalOrganizerInterface $organizer
     * @param  RecurrenceInfoInterface $recurrence
     * @param  ExceptionRecurIdInfoInterface $exceptionId
     * @param  DtTimeInfoInterface $dtStart
     * @param  DtTimeInfoInterface $dtEnd
     * @param  DurationInfoInterface $duration
     * @return self
     */
    public function __construct(
        ?string $method = null,
        ?int $componentNum = null,
        ?bool $rsvp = null,
        ?string $priority = null,
        ?string $name = null,
        ?string $location = null,
        ?string $percentComplete = null,
        ?string $completed = null,
        ?bool $noBlob = null,
        ?FreeBusyStatus $freeBusyActual = null,
        ?FreeBusyStatus $freeBusy = null,
        ?Transparency $transparency = null,
        ?bool $isOrganizer = null,
        ?string $xUid = null,
        ?string $uid = null,
        ?int $sequence = null,
        ?int $dateTime = null,
        ?string $calItemId = null,
        ?string $deprecatedApptId = null,
        ?string $calItemFolder = null,
        ?InviteStatus $status = null,
        ?InviteClass $calClass = null,
        ?string $url = null,
        ?bool $isException = null,
        ?string $recurIdZ = null,
        ?bool $isAllDay = null,
        ?bool $isDraft = null,
        ?bool $neverSent = null,
        ?string $changes = null,
        array $categories = [],
        array $comments = [],
        array $contacts = [],
        ?GeoInfoInterface $geo = null,
        array $attendees = [],
        array $alarms = [],
        array $xProps = [],
        ?string $fragment = null,
        ?string $description = null,
        ?string $htmlDescription = null,
        ?CalOrganizerInterface $organizer = null,
        ?RecurrenceInfoInterface $recurrence = null,
        ?ExceptionRecurIdInfoInterface $exceptionId = null,
        ?DtTimeInfoInterface $dtStart = null,
        ?DtTimeInfoInterface $dtEnd = null,
        ?DurationInfoInterface $duration = null
    ) {
        parent::__construct(
            $method,
            $componentNum,
            $rsvp,
            $priority,
            $name,
            $location,
            $percentComplete,
            $completed,
            $noBlob,
            $freeBusyActual,
            $freeBusy,
            $transparency,
            $isOrganizer,
            $xUid,
            $uid,
            $sequence,
            $dateTime,
            $calItemId,
            $deprecatedApptId,
            $calItemFolder,
            $status,
            $calClass,
            $url,
            $isException,
            $recurIdZ,
            $isAllDay,
            $isDraft,
            $neverSent,
            $changes
        );
        $this->setCategories($categories)
            ->setComments($comments)
            ->setContacts($contacts)
            ->setAttendees($attendees)
            ->setAlarms($alarms)
            ->setXProps($xProps);
        $this->geo = $geo;
        $this->organizer = $organizer;
        $this->recurrence = $recurrence;
        $this->exceptionId = $exceptionId;
        $this->dtStart = $dtStart;
        $this->dtEnd = $dtEnd;
        $this->duration = $duration;
        if (null !== $fragment) {
            $this->setFragment($fragment);
        }
        if (null !== $description) {
            $this->setDescription($description);
        }
        if (null !== $htmlDescription) {
            $this->setHtmlDescription($htmlDescription);
        }
    }

    /**
     * Get categories
     *
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * Set categories
     *
     * @param  array $categories
     * @return self
     */
    public function setCategories(array $categories): self
    {
        $this->categories = array_unique($categories);
        return $this;
    }

    /**
     * add category
     *
     * @param  string $category
     * @return self
     */
    public function addCategory(string $category): self
    {
        $category = trim($category);
        if (!in_array($category, $this->categories)) {
            $this->categories[] = $category;
        }
        return $this;
    }

    /**
     * Get comments
     *
     * @return array
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    /**
     * Set comments
     *
     * @param  array $comments
     * @return self
     */
    public function setComments(array $comments): self
    {
        $this->comments = array_unique($comments);
        return $this;
    }

    /**
     * add comment
     *
     * @param  string $comment
     * @return self
     */
    public function addComment(string $comment): self
    {
        $comment = trim($comment);
        if (!in_array($comment, $this->comments)) {
            $this->comments[] = $comment;
        }
        return $this;
    }

    /**
     * Get contacts
     *
     * @return array
     */
    public function getContacts(): array
    {
        return $this->contacts;
    }

    /**
     * Set contacts
     *
     * @param  array $contacts
     * @return self
     */
    public function setContacts(array $contacts): self
    {
        $this->contacts = array_unique($contacts);
        return $this;
    }

    /**
     * add contact
     *
     * @param  string $contact
     * @return self
     */
    public function addContact(string $contact): self
    {
        $contact = trim($contact);
        if (!in_array($contact, $this->contacts)) {
            $this->contacts[] = $contact;
        }
        return $this;
    }

    /**
     * Get fragment
     *
     * @return string
     */
    public function getFragment(): ?string
    {
        return $this->fragment;
    }

    /**
     * Set fragment
     *
     * @param  string $fragment
     * @return self
     */
    public function setFragment(string $fragment): self
    {
        $this->fragment = $fragment;
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param  string $description
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get htmlDescription
     *
     * @return string
     */
    public function getHtmlDescription(): ?string
    {
        return $this->htmlDescription;
    }

    /**
     * Set htmlDescription
     *
     * @param  string $htmlDescription
     * @return self
     */
    public function setHtmlDescription(string $htmlDescription): self
    {
        $this->htmlDescription = $htmlDescription;
        return $this;
    }

    /**
     * Get geo
     *
     * @return GeoInfoInterface
     */
    public function getGeo(): ?GeoInfoInterface
    {
        return $this->geo;
    }

    /**
     * Set geo
     *
     * @param  GeoInfoInterface $geo
     * @return self
     */
    public function setGeo(GeoInfoInterface $geo): self
    {
        $this->geo = $geo;
        return $this;
    }

    /**
     * Set attendees
     *
     * @param  array $attendees
     * @return self
     */
    public function setAttendees(array $attendees): self
    {
        $this->attendees = array_filter(
            $attendees,
            static fn($attendee) => $attendee instanceof
                CalendarAttendeeInterface
        );
        return $this;
    }

    /**
     * Get attendees
     *
     * @return array
     */
    public function getAttendees(): array
    {
        return $this->attendees;
    }

    /**
     * Add attendee
     *
     * @param  CalendarAttendeeInterface $attendee
     * @return self
     */
    public function addAttendee(CalendarAttendeeInterface $attendee): self
    {
        $this->attendees[] = $attendee;
        return $this;
    }

    /**
     * Set alarms
     *
     * @param  array $alarms
     * @return self
     */
    public function setAlarms(array $alarms): self
    {
        $this->alarms = array_filter(
            $alarms,
            static fn($alarm) => $alarm instanceof AlarmInfoInterface
        );
        return $this;
    }

    /**
     * Get alarms
     *
     * @return array
     */
    public function getAlarms(): array
    {
        return $this->alarms;
    }

    /**
     * Add alarm
     *
     * @param  AlarmInfoInterface $alarm
     * @return self
     */
    public function addAlarm(AlarmInfoInterface $alarm): self
    {
        $this->alarms[] = $alarm;
        return $this;
    }

    /**
     * Set xProps
     *
     * @param  array $xProps
     * @return self
     */
    public function setXProps(array $xProps): self
    {
        $this->xProps = array_filter(
            $xProps,
            static fn($xProp) => $xProp instanceof XPropInterface
        );
        return $this;
    }

    /**
     * Get xProps
     *
     * @return array
     */
    public function getXProps(): array
    {
        return $this->xProps;
    }

    /**
     * Add xProp
     *
     * @param  XPropInterface $xProp
     * @return self
     */
    public function addXProp(XPropInterface $xProp): self
    {
        $this->xProps[] = $xProp;
        return $this;
    }

    /**
     * Get organizer
     *
     * @return CalOrganizerInterface
     */
    public function getOrganizer(): ?CalOrganizerInterface
    {
        return $this->organizer;
    }

    /**
     * Set organizer
     *
     * @param  CalOrganizerInterface $organizer
     * @return self
     */
    public function setOrganizer(CalOrganizerInterface $organizer): self
    {
        $this->organizer = $organizer;
        return $this;
    }

    /**
     * Get recurrence
     *
     * @return RecurrenceInfoInterface
     */
    public function getRecurrence(): ?RecurrenceInfoInterface
    {
        return $this->recurrence;
    }

    /**
     * Set recurrence
     *
     * @param  RecurrenceInfoInterface $recurrence
     * @return self
     */
    public function setRecurrence(RecurrenceInfoInterface $recurrence): self
    {
        $this->recurrence = $recurrence;
        return $this;
    }

    /**
     * Get exceptionId
     *
     * @return ExceptionRecurIdInfoInterface
     */
    public function getExceptionId(): ?ExceptionRecurIdInfoInterface
    {
        return $this->exceptionId;
    }

    /**
     * Set exceptionId
     *
     * @param  ExceptionRecurIdInfoInterface $exceptionId
     * @return self
     */
    public function setExceptionId(
        ExceptionRecurIdInfoInterface $exceptionId
    ): self {
        $this->exceptionId = $exceptionId;
        return $this;
    }

    /**
     * Get dtStart
     *
     * @return DtTimeInfoInterface
     */
    public function getDtStart(): ?DtTimeInfoInterface
    {
        return $this->dtStart;
    }

    /**
     * Set dtStart
     *
     * @param  DtTimeInfoInterface $dtStart
     * @return self
     */
    public function setDtStart(DtTimeInfoInterface $dtStart): self
    {
        $this->dtStart = $dtStart;
        return $this;
    }

    /**
     * Get dtEnd
     *
     * @return DtTimeInfoInterface
     */
    public function getDtEnd(): ?DtTimeInfoInterface
    {
        return $this->dtEnd;
    }

    /**
     * Set dtEnd
     *
     * @param  DtTimeInfoInterface $dtEnd
     * @return self
     */
    public function setDtEnd(DtTimeInfoInterface $dtEnd): self
    {
        $this->dtEnd = $dtEnd;
        return $this;
    }

    /**
     * Get duration
     *
     * @return DurationInfoInterface
     */
    public function getDuration(): ?DurationInfoInterface
    {
        return $this->duration;
    }

    /**
     * Set duration
     *
     * @param  DurationInfoInterface $duration
     * @return self
     */
    public function setDuration(DurationInfoInterface $duration): self
    {
        $this->duration = $duration;
        return $this;
    }
}
