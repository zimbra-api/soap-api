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

/**
 * InviteComponentWithGroupInfo struct class
 * Invitation Component
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class InviteComponentWithGroupInfo extends InviteComponentCommon
{
	/**
	 * Categories - for iCalendar CATEGORY properties
	 * @Accessor(getter="getCategories", setter="setCategories")
	 * @SerializedName("category")
	 * @Type("array<string>")
	 * @XmlList(inline = true, entry = "category")
	 */
	private $categories = [];

	/**
	 * Comments - for iCalendar COMMENT properties
	 * @Accessor(getter="getComments", setter="setComments")
	 * @SerializedName("comment")
	 * @Type("array<string>")
	 * @XmlList(inline = true, entry = "comment")
	 */
	private $comments = [];

	/**
	 * Contacts - for iCalendar CONTACT properties
	 * @Accessor(getter="getContacts", setter="setContacts")
	 * @SerializedName("contact")
	 * @Type("array<string>")
	 * @XmlList(inline = true, entry = "contact")
	 */
	private $contacts = [];

	/**
	 * for iCalendar GEO property
	 * @Accessor(getter="getGeo", setter="setGeo")
	 * @SerializedName("geo")
	 * @Type("App\Libraries\Zimbra\Mail\Type\GeoInfo")
	 * @XmlElement
	 */
	private ?GeoInfo $geo = NULL;

	/**
	 * Attendees
	 * @Accessor(getter="getAttendees", setter="setAttendees")
	 * @SerializedName("at")
	 * @Type("array<App\Libraries\Zimbra\Mail\Type\CalendarAttendee>")
	 * @XmlList(inline = true, entry = "at")
	 */
	private $attendees = [];

	/**
	 * Alarm information
	 * @Accessor(getter="getAlarms", setter="setAlarms")
	 * @SerializedName("alarm")
	 * @Type("array<App\Libraries\Zimbra\Mail\Type\AlarmInfo>")
	 * @XmlList(inline = true, entry = "alarm")
	 */
	private $alarms = [];

	/**
	 * XPROP properties
	 * @Accessor(getter="getXProps", setter="setXProps")
	 * @SerializedName("xprop")
	 * @Type("array<App\Libraries\Zimbra\Mail\Type\XProp>")
	 * @XmlList(inline = true, entry = "xprop")
	 */
	private $xProps = [];

	/**
	 * First few bytes of the message (probably between 40 and 100 bytes)
	 * @Accessor(getter="getFragment", setter="setFragment")
	 * @SerializedName("fr")
	 * @Type("string")
	 * @XmlElement(cdata = false)
	 */
	private $fragment;

	/**
	 * Present if noBlob is set and invite has a plain text description
	 * @Accessor(getter="getDescription", setter="setDescription")
	 * @SerializedName("desc")
	 * @Type("string")
	 * @XmlElement(cdata = false)
	 */
	private $description;

	/**
	 * Present if noBlob is set and invite has an HTML description
	 * @Accessor(getter="getHtmlDescription", setter="setHtmlDescription")
	 * @SerializedName("descHtml")
	 * @Type("string")
	 * @XmlElement(cdata = false)
	 */
	private $htmlDescription;

	/**
	 * Organizer
	 * @Accessor(getter="getOrganizer", setter="setOrganizer")
	 * @SerializedName("or")
	 * @Type("App\Libraries\Zimbra\Mail\Type\CalOrganizer")
	 * @XmlElement
	 */
	private ?CalOrganizer $organizer = NULL;

	/**
	 * Recurrence information
	 * @Accessor(getter="getRecurrence", setter="setRecurrence")
	 * @SerializedName("recur")
	 * @Type("App\Libraries\Zimbra\Mail\Type\RecurrenceInfo")
	 * @XmlElement
	 */
	private ?RecurrenceInfo $recurrence = NULL;

	/**
	 * Recurrence id, if this is an exception
	 * @Accessor(getter="getExceptionId", setter="setExceptionId")
	 * @SerializedName("exceptId")
	 * @Type("App\Libraries\Zimbra\Mail\Type\ExceptionRecurIdInfo")
	 * @XmlElement
	 */
	private ?ExceptionRecurIdInfo $exceptionId = NULL;

	/**
	 * Start date-time (required)
	 * @Accessor(getter="getDtStart", setter="setDtStart")
	 * @SerializedName("s")
	 * @Type("App\Libraries\Zimbra\Mail\Type\DtTimeInfo")
	 * @XmlElement
	 */
	private ?DtTimeInfo $dtStart = NULL;

	/**
	 * End date-time
	 * @Accessor(getter="getDtEnd", setter="setDtEnd")
	 * @SerializedName("e")
	 * @Type("App\Libraries\Zimbra\Mail\Type\DtTimeInfo")
	 * @XmlElement
	 */
	private ?DtTimeInfo $dtEnd = NULL;

	/**
	 * Duration
	 * @Accessor(getter="getDuration", setter="setDuration")
	 * @SerializedName("dur")
	 * @Type("App\Libraries\Zimbra\Mail\Type\DurationInfo")
	 * @XmlElement
	 */
	private ?DurationInfo $duration = NULL;

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
	 * @return GeoInfo
	 */
	public function getGeo(): ?GeoInfo
	{
		return $this->geo;
	}

	/**
	 * Sets geo
	 *
	 * @param  GeoInfo $geo
	 * @return self
	 */
	public function setGeo(GeoInfo $geo): self
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
		$this->attendees = [];
		foreach ($attendees as $attendee) {
			if ($attendee instanceof CalendarAttendee) {
				$this->attendees[] = $attendee;
			}
		}
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
	 * @param  CalendarAttendee $attendee
	 * @return self
	 */
	public function addAttendee(CalendarAttendee $attendee): self
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
		$this->alarms = [];
		foreach ($alarms as $alarm) {
			if ($alarm instanceof AlarmInfo) {
				$this->alarms[] = $alarm;
			}
		}
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
	 * @param  AlarmInfo $alarm
	 * @return self
	 */
	public function addAlarm(AlarmInfo $alarm): self
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
		$this->xProps = [];
		foreach ($xProps as $xProp) {
			if ($xProp instanceof XProp) {
				$this->xProps[] = $xProp;
			}
		}
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
	 * @param  XProp $xProp
	 * @return self
	 */
	public function addXProp(XProp $xProp): self
	{
		$this->xProps[] = $xProp;
		return $this;
	}

	/**
	 * Gets organizer
	 *
	 * @return CalOrganizer
	 */
	public function getOrganizer(): ?CalOrganizer
	{
		return $this->organizer;
	}

	/**
	 * Sets organizer
	 *
	 * @param  CalOrganizer $organizer
	 * @return self
	 */
	public function setOrganizer(CalOrganizer $organizer): self
	{
		$this->organizer = $organizer;
		return $this;
	}

	/**
	 * Gets recurrence
	 *
	 * @return RecurrenceInfo
	 */
	public function getRecurrence(): ?RecurrenceInfo
	{
		return $this->recurrence;
	}

	/**
	 * Sets recurrence
	 *
	 * @param  RecurrenceInfo $recurrence
	 * @return self
	 */
	public function setRecurrence(RecurrenceInfo $recurrence): self
	{
		$this->recurrence = $recurrence;
		return $this;
	}

	/**
	 * Gets exceptionId
	 *
	 * @return ExceptionRecurIdInfo
	 */
	public function getExceptionId(): ?ExceptionRecurIdInfo
	{
		return $this->exceptionId;
	}

	/**
	 * Sets exceptionId
	 *
	 * @param  ExceptionRecurIdInfo $exceptionId
	 * @return self
	 */
	public function setExceptionId(ExceptionRecurIdInfo $exceptionId): self
	{
		$this->exceptionId = $exceptionId;
		return $this;
	}

	/**
	 * Gets dtStart
	 *
	 * @return DtTimeInfo
	 */
	public function getDtStart(): ?DtTimeInfo
	{
		return $this->dtStart;
	}

	/**
	 * Sets dtStart
	 *
	 * @param  DtTimeInfo $dtStart
	 * @return self
	 */
	public function setDtStart(DtTimeInfo $dtStart): self
	{
		$this->dtStart = $dtStart;
		return $this;
	}

	/**
	 * Gets dtEnd
	 *
	 * @return DtTimeInfo
	 */
	public function getDtEnd(): ?DtTimeInfo
	{
		return $this->dtEnd;
	}

	/**
	 * Sets dtEnd
	 *
	 * @param  DtTimeInfo $dtEnd
	 * @return self
	 */
	public function setDtEnd(DtTimeInfo $dtEnd): self
	{
		$this->dtEnd = $dtEnd;
		return $this;
	}

	/**
	 * Gets duration
	 *
	 * @return DurationInfo
	 */
	public function getDuration(): ?DurationInfo
	{
		return $this->duration;
	}

	/**
	 * Sets duration
	 *
	 * @param  DurationInfo $duration
	 * @return self
	 */
	public function setDuration(DurationInfo $duration): self
	{
		$this->duration = $duration;
		return $this;
	}
}
