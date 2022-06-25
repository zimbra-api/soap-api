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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlList};
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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class InviteComponent extends InviteComponentCommon implements InviteComponentInterface
{
    /**
     * Categories - for iCalendar CATEGORY properties
     * @Accessor(getter="getCategories", setter="setCategories")
     * @SerializedName("category")
     * @Type("array<string>")
     * @XmlList(inline=true, entry="category")
     */
    private $categories = [];

    /**
     * Comments - for iCalendar COMMENT properties
     * @Accessor(getter="getComments", setter="setComments")
     * @SerializedName("comment")
     * @Type("array<string>")
     * @XmlList(inline=true, entry="comment")
     */
    private $comments = [];

    /**
     * Contacts - for iCalendar CONTACT properties
     * @Accessor(getter="getContacts", setter="setContacts")
     * @SerializedName("contact")
     * @Type("array<string>")
     * @XmlList(inline=true, entry="contact")
     */
    private $contacts = [];

    /**
     * for iCalendar GEO property
     * @Accessor(getter="getGeo", setter="setGeo")
     * @SerializedName("geo")
     * @Type("Zimbra\Mail\Struct\GeoInfo")
     * @XmlElement
     */
    private ?GeoInfoInterface $geo = NULL;

    /**
     * Attendees
     * @Accessor(getter="getAttendees", setter="setAttendees")
     * @SerializedName("at")
     * @Type("array<Zimbra\Mail\Struct\CalendarAttendee>")
     * @XmlList(inline=true, entry="at")
     */
    private $attendees = [];

    /**
     * Alarm information
     * @Accessor(getter="getAlarms", setter="setAlarms")
     * @SerializedName("alarm")
     * @Type("array<Zimbra\Mail\Struct\AlarmInfo>")
     * @XmlList(inline=true, entry="alarm")
     */
    private $alarms = [];

    /**
     * XPROP properties
     * @Accessor(getter="getXProps", setter="setXProps")
     * @SerializedName("xprop")
     * @Type("array<Zimbra\Mail\Struct\XProp>")
     * @XmlList(inline=true, entry="xprop")
     */
    private $xProps = [];

    /**
     * First few bytes of the message (probably between 40 and 100 bytes)
     * @Accessor(getter="getFragment", setter="setFragment")
     * @SerializedName("fr")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $fragment;

    /**
     * Present if noBlob is set and invite has a plain text description
     * @Accessor(getter="getDescription", setter="setDescription")
     * @SerializedName("desc")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $description;

    /**
     * Present if noBlob is set and invite has an HTML description
     * @Accessor(getter="getHtmlDescription", setter="setHtmlDescription")
     * @SerializedName("descHtml")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $htmlDescription;

    /**
     * Organizer
     * @Accessor(getter="getOrganizer", setter="setOrganizer")
     * @SerializedName("or")
     * @Type("Zimbra\Mail\Struct\CalOrganizer")
     * @XmlElement
     */
    private ?CalOrganizerInterface $organizer = NULL;

    /**
     * Recurrence information
     * @Accessor(getter="getRecurrence", setter="setRecurrence")
     * @SerializedName("recur")
     * @Type("Zimbra\Mail\Struct\RecurrenceInfo")
     * @XmlElement
     */
    private ?RecurrenceInfoInterface $recurrence = NULL;

    /**
     * Recurrence id, if this is an exception
     * @Accessor(getter="getExceptionId", setter="setExceptionId")
     * @SerializedName("exceptId")
     * @Type("Zimbra\Mail\Struct\ExceptionRecurIdInfo")
     * @XmlElement
     */
    private ?ExceptionRecurIdInfoInterface $exceptionId = NULL;

    /**
     * Start date-time (required)
     * @Accessor(getter="getDtStart", setter="setDtStart")
     * @SerializedName("s")
     * @Type("Zimbra\Mail\Struct\DtTimeInfo")
     * @XmlElement
     */
    private ?DtTimeInfoInterface $dtStart = NULL;

    /**
     * End date-time
     * @Accessor(getter="getDtEnd", setter="setDtEnd")
     * @SerializedName("e")
     * @Type("Zimbra\Mail\Struct\DtTimeInfo")
     * @XmlElement
     */
    private ?DtTimeInfoInterface $dtEnd = NULL;

    /**
     * Duration
     * @Accessor(getter="getDuration", setter="setDuration")
     * @SerializedName("dur")
     * @Type("Zimbra\Mail\Struct\DurationInfo")
     * @XmlElement
     */
    private ?DurationInfoInterface $duration = NULL;

    /**
     * Constructor method
     *
     * @param string $method
     * @param int $componentNum
     * @param bool $rsvp
     * @return self
     */
    public function __construct(
        ?string $method = NULL,
        ?int $componentNum = NULL,
        ?bool $rsvp = NULL
    )
    {
        parent::__construct($method, $componentNum, $rsvp);
    }

    /**
     * Gets categories
     *
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * Sets categories
     *
     * @param  array $categories
     * @return self
     */
    public function setCategories(array $categories): self
    {
        $this->categories = [];
        foreach ($categories as $category) {
            $this->addCategory($category);
        }
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
     * Gets comments
     *
     * @return array
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    /**
     * Sets comments
     *
     * @param  array $comments
     * @return self
     */
    public function setComments(array $comments): self
    {
        $this->comments = [];
        foreach ($comments as $comment) {
            $this->addComment($comment);
        }
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
     * Gets contacts
     *
     * @return array
     */
    public function getContacts(): array
    {
        return $this->contacts;
    }

    /**
     * Sets contacts
     *
     * @param  array $contacts
     * @return self
     */
    public function setContacts(array $contacts): self
    {
        $this->contacts = [];
        foreach ($contacts as $contact) {
            $this->addContact($contact);
        }
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
     * Gets fragment
     *
     * @return string
     */
    public function getFragment(): ?string
    {
        return $this->fragment;
    }

    /**
     * Sets fragment
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
     * Gets description
     *
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Sets description
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
     * Gets htmlDescription
     *
     * @return string
     */
    public function getHtmlDescription(): ?string
    {
        return $this->htmlDescription;
    }

    /**
     * Sets htmlDescription
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
     * Gets geo
     *
     * @return GeoInfoInterface
     */
    public function getGeo(): ?GeoInfoInterface
    {
        return $this->geo;
    }

    /**
     * Sets geo
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
     * Sets attendees
     *
     * @param  array $attendees
     * @return self
     */
    public function setAttendees(array $attendees): self
    {
        $this->attendees = array_filter($attendees, static fn ($attendee) => $attendee instanceof CalendarAttendeeInterface);
        return $this;
    }

    /**
     * Gets attendees
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
     * Sets alarms
     *
     * @param  array $alarms
     * @return self
     */
    public function setAlarms(array $alarms): self
    {
        $this->alarms = array_filter($alarms, static fn ($alarm) => $alarm instanceof AlarmInfoInterface);
        return $this;
    }

    /**
     * Gets alarms
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
     * Sets xProps
     *
     * @param  array $xProps
     * @return self
     */
    public function setXProps(array $xProps): self
    {
        $this->xProps = array_filter($xProps, static fn ($xProp) => $xProp instanceof XPropInterface);
        return $this;
    }

    /**
     * Gets xProps
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
     * Gets organizer
     *
     * @return CalOrganizerInterface
     */
    public function getOrganizer(): ?CalOrganizerInterface
    {
        return $this->organizer;
    }

    /**
     * Sets organizer
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
     * Gets recurrence
     *
     * @return RecurrenceInfoInterface
     */
    public function getRecurrence(): ?RecurrenceInfoInterface
    {
        return $this->recurrence;
    }

    /**
     * Sets recurrence
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
     * Gets exceptionId
     *
     * @return ExceptionRecurIdInfoInterface
     */
    public function getExceptionId(): ?ExceptionRecurIdInfoInterface
    {
        return $this->exceptionId;
    }

    /**
     * Sets exceptionId
     *
     * @param  ExceptionRecurIdInfoInterface $exceptionId
     * @return self
     */
    public function setExceptionId(ExceptionRecurIdInfoInterface $exceptionId): self
    {
        $this->exceptionId = $exceptionId;
        return $this;
    }

    /**
     * Gets dtStart
     *
     * @return DtTimeInfoInterface
     */
    public function getDtStart(): ?DtTimeInfoInterface
    {
        return $this->dtStart;
    }

    /**
     * Sets dtStart
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
     * Gets dtEnd
     *
     * @return DtTimeInfoInterface
     */
    public function getDtEnd(): ?DtTimeInfoInterface
    {
        return $this->dtEnd;
    }

    /**
     * Sets dtEnd
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
     * Gets duration
     *
     * @return DurationInfoInterface
     */
    public function getDuration(): ?DurationInfoInterface
    {
        return $this->duration;
    }

    /**
     * Sets duration
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
