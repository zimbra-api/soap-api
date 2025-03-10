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
    InviteChange,
    InviteClass,
    InviteStatus,
    Transparency
};
use Zimbra\Common\Struct\InviteComponentCommonInterface;

/**
 * InviteComponentCommon struct class
 * Invite component common information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class InviteComponentCommon implements InviteComponentCommonInterface
{
    /**
     * Method
     *
     * @var string
     */
    #[Accessor(getter: "getMethod", setter: "setMethod")]
    #[SerializedName("method")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $method = null;

    /**
     * Component number of the invite
     *
     * @var int
     */
    #[Accessor(getter: "getComponentNum", setter: "setComponentNum")]
    #[SerializedName("compNum")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $componentNum = null;

    /**
     * RSVP flag.  Set if response requested, unset if no response requested
     *
     * @var bool
     */
    #[Accessor(getter: "getRsvp", setter: "setRsvp")]
    #[SerializedName("rsvp")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $rsvp = null;

    /**
     * Priority (0 - 9; default = 0)
     *
     * @var string
     */
    #[Accessor(getter: "getPriority", setter: "setPriority")]
    #[SerializedName("priority")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $priority = null;

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
     * Percent complete for VTODO (0 - 100; default = 0)
     *
     * @var string
     */
    #[Accessor(getter: "getPercentComplete", setter: "setPercentComplete")]
    #[SerializedName("percentComplete")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $percentComplete = null;

    /**
     * VTODO COMPLETED DATE-TIME in format: yyyyMMddThhmmssZ
     *
     * @var string
     */
    #[Accessor(getter: "getCompleted", setter: "setCompleted")]
    #[SerializedName("completed")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $completed = null;

    /**
     * Set if invite has no blob data, i.e. all data is in db metadata
     *
     * @var bool
     */
    #[Accessor(getter: "getNoBlob", setter: "setNoBlob")]
    #[SerializedName("noBlob")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $noBlob = null;

    /**
     * The "actual" free-busy status of this invite (ie what the client should display).
     * Valid values - F|B|T|U.  i.e. Free, Busy (default), busy-Tentative, OutOfOffice (busy-unavailable)
     *
     * @var FreeBusyStatus
     */
    #[Accessor(getter: "getFreeBusyActual", setter: "setFreeBusyActual")]
    #[SerializedName("fba")]
    #[XmlAttribute]
    private ?FreeBusyStatus $freeBusyActual;

    /**
     * FreeBusy setting F|B|T|U
     * i.e. Free, Busy (default), busy-Tentative, OutOfOffice (busy-unavailable)
     *
     * @var FreeBusyStatus
     */
    #[Accessor(getter: "getFreeBusy", setter: "setFreeBusy")]
    #[SerializedName("fb")]
    #[XmlAttribute]
    private ?FreeBusyStatus $freeBusy;

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
     * Am I the organizer?  [default 0 (false)]
     *
     * @var bool
     */
    #[Accessor(getter: "getIsOrganizer", setter: "setIsOrganizer")]
    #[SerializedName("isOrg")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $isOrganizer = null;

    /**
     * x uid
     *
     * @var string
     */
    #[Accessor(getter: "getXUid", setter: "setXUid")]
    #[SerializedName("x_uid")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $xUid = null;

    /**
     * UID to use when creating appointment.  Optional: client can request the UID to use
     *
     * @var string
     */
    #[Accessor(getter: "getUid", setter: "setUid")]
    #[SerializedName("uid")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $uid = null;

    /**
     * Sequence number (default = 0)
     *
     * @var int
     */
    #[Accessor(getter: "getSequence", setter: "setSequence")]
    #[SerializedName("seq")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $sequence = null;

    /**
     * Date - used for zdsync
     *
     * @var int
     */
    #[Accessor(getter: "getDateTime", setter: "setDateTime")]
    #[SerializedName("d")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $dateTime = null;

    /**
     * Mail item ID of appointment
     *
     * @var string
     */
    #[Accessor(getter: "getCalItemId", setter: "setCalItemId")]
    #[SerializedName("calItemId")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $calItemId = null;

    /**
     * Appointment ID (deprecated)
     *
     * @var string
     */
    #[Accessor(getter: "getDeprecatedApptId", setter: "setDeprecatedApptId")]
    #[SerializedName("apptId")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $deprecatedApptId = null;

    /**
     * Folder of appointment
     *
     * @var string
     */
    #[Accessor(getter: "getCalItemFolder", setter: "setCalItemFolder")]
    #[SerializedName("ciFolder")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $calItemFolder = null;

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
     * URL
     *
     * @var string
     */
    #[Accessor(getter: "getUrl", setter: "setUrl")]
    #[SerializedName("url")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $url = null;

    /**
     * Set if this is invite is an exception
     *
     * @var bool
     */
    #[Accessor(getter: "getIsException", setter: "setIsException")]
    #[SerializedName("ex")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $isException = null;

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
     * Set if is an all day appointment
     *
     * @var bool
     */
    #[Accessor(getter: "getIsAllDay", setter: "setIsAllDay")]
    #[SerializedName("allDay")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $isAllDay = null;

    /**
     * Set if invite has changes that haven't been sent to attendees; for organizer only
     *
     * @var bool
     */
    #[Accessor(getter: "getIsDraft", setter: "setIsDraft")]
    #[SerializedName("draft")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $isDraft = null;

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
     * Comma-separated list of changed data in an updated invite.
     * Possible values are "subject", "location", "time" (start time, end time, or duration), and "recurrence".
     *
     * @var string
     */
    #[Accessor(getter: "getChanges", setter: "setChanges")]
    #[SerializedName("changes")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $changes = null;

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
        ?string $changes = null
    ) {
        $this->freeBusyActual = $freeBusyActual;
        $this->freeBusy = $freeBusy;
        $this->transparency = $transparency;
        $this->status = $status;
        $this->calClass = $calClass;
        if (null !== $method) {
            $this->setMethod($method);
        }
        if (null !== $componentNum) {
            $this->setComponentNum($componentNum);
        }
        if (null !== $rsvp) {
            $this->setRsvp($rsvp);
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
        if (null !== $percentComplete) {
            $this->setPercentComplete($percentComplete);
        }
        if (null !== $completed) {
            $this->setCompleted($completed);
        }
        if (null !== $noBlob) {
            $this->setNoBlob($noBlob);
        }
        if (null !== $isOrganizer) {
            $this->setIsOrganizer($isOrganizer);
        }
        if (null !== $xUid) {
            $this->setXUid($xUid);
        }
        if (null !== $uid) {
            $this->setUid($uid);
        }
        if (null !== $sequence) {
            $this->setSequence($sequence);
        }
        if (null !== $dateTime) {
            $this->setDateTime($dateTime);
        }
        if (null !== $calItemId) {
            $this->setCalItemId($calItemId);
        }
        if (null !== $deprecatedApptId) {
            $this->setDeprecatedApptId($deprecatedApptId);
        }
        if (null !== $calItemFolder) {
            $this->setCalItemFolder($calItemFolder);
        }
        if (null !== $url) {
            $this->setUrl($url);
        }
        if (null !== $isException) {
            $this->setIsException($isException);
        }
        if (null !== $recurIdZ) {
            $this->setRecurIdZ($recurIdZ);
        }
        if (null !== $isAllDay) {
            $this->setIsAllDay($isAllDay);
        }
        if (null !== $isDraft) {
            $this->setIsDraft($isDraft);
        }
        if (null !== $neverSent) {
            $this->setNeverSent($neverSent);
        }
        if (null !== $changes) {
            $this->setChanges($changes);
        }
    }

    /**
     * Get the method
     *
     * @return string
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * Set the method
     *
     * @param  string $method
     * @return self
     */
    public function setMethod(string $method): self
    {
        $this->method = $method;
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
     * Get the rsvp
     *
     * @return bool
     */
    public function getRsvp(): ?bool
    {
        return $this->rsvp;
    }

    /**
     * Set the rsvp
     *
     * @param  bool $rsvp
     * @return self
     */
    public function setRsvp(bool $rsvp): self
    {
        $this->rsvp = $rsvp;
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
     * Get the percentComplete
     *
     * @return string
     */
    public function getPercentComplete(): ?string
    {
        return $this->percentComplete;
    }

    /**
     * Set the percentComplete
     *
     * @param  string $percentComplete
     * @return self
     */
    public function setPercentComplete(string $percentComplete): self
    {
        $this->percentComplete = $percentComplete;
        return $this;
    }

    /**
     * Get the completed
     *
     * @return string
     */
    public function getCompleted(): ?string
    {
        return $this->completed;
    }

    /**
     * Set the completed
     *
     * @param  string $completed
     * @return self
     */
    public function setCompleted(string $completed): self
    {
        $this->completed = $completed;
        return $this;
    }

    /**
     * Get the noBlob
     *
     * @return bool
     */
    public function getNoBlob(): ?bool
    {
        return $this->noBlob;
    }

    /**
     * Set the noBlob
     *
     * @param  bool $noBlob
     * @return self
     */
    public function setNoBlob(bool $noBlob): self
    {
        $this->noBlob = $noBlob;
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
     * Get the freeBusy
     *
     * @return FreeBusyStatus
     */
    public function getFreeBusy(): ?FreeBusyStatus
    {
        return $this->freeBusy;
    }

    /**
     * Set the freeBusy
     *
     * @param  FreeBusyStatus $freeBusy
     * @return self
     */
    public function setFreeBusy(FreeBusyStatus $freeBusy): self
    {
        $this->freeBusy = $freeBusy;
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
     * Get the xUid
     *
     * @return string
     */
    public function getXUid(): ?string
    {
        return $this->xUid;
    }

    /**
     * Set the xUid
     *
     * @param  string $xUid
     * @return self
     */
    public function setXUid(string $xUid): self
    {
        $this->xUid = $xUid;
        return $this;
    }

    /**
     * Get the uid
     *
     * @return string
     */
    public function getUid(): ?string
    {
        return $this->uid;
    }

    /**
     * Set the uid
     *
     * @param  string $uid
     * @return self
     */
    public function setUid(string $uid): self
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * Get the sequence
     *
     * @return int
     */
    public function getSequence(): ?int
    {
        return $this->sequence;
    }

    /**
     * Set the sequence
     *
     * @param  int $sequence
     * @return self
     */
    public function setSequence(int $sequence): self
    {
        $this->sequence = $sequence;
        return $this;
    }

    /**
     * Get the dateTime
     *
     * @return int
     */
    public function getDateTime(): ?int
    {
        return $this->dateTime;
    }

    /**
     * Set the dateTime
     *
     * @param  int $dateTime
     * @return self
     */
    public function setDateTime(int $dateTime): self
    {
        $this->dateTime = $dateTime;
        return $this;
    }

    /**
     * Get the calItemId
     *
     * @return string
     */
    public function getCalItemId(): ?string
    {
        return $this->calItemId;
    }

    /**
     * Set the calItemId
     *
     * @param  string $calItemId
     * @return self
     */
    public function setCalItemId(string $calItemId): self
    {
        $this->calItemId = $calItemId;
        return $this;
    }

    /**
     * Get the deprecatedApptId
     *
     * @return string
     */
    public function getDeprecatedApptId(): ?string
    {
        return $this->deprecatedApptId;
    }

    /**
     * Set the deprecatedApptId
     *
     * @param  string $deprecatedApptId
     * @return self
     */
    public function setDeprecatedApptId(string $deprecatedApptId): self
    {
        $this->deprecatedApptId = $deprecatedApptId;
        return $this;
    }

    /**
     * Get the calItemFolder
     *
     * @return string
     */
    public function getCalItemFolder(): ?string
    {
        return $this->calItemFolder;
    }

    /**
     * Set the calItemFolder
     *
     * @param  string $calItemFolder
     * @return self
     */
    public function setCalItemFolder(string $calItemFolder): self
    {
        $this->calItemFolder = $calItemFolder;
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
     * Get the url
     *
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * Set the url
     *
     * @param  string $url
     * @return self
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Get the isException
     *
     * @return bool
     */
    public function getIsException(): ?bool
    {
        return $this->isException;
    }

    /**
     * Set the isException
     *
     * @param  bool $isException
     * @return self
     */
    public function setIsException(bool $isException): self
    {
        $this->isException = $isException;
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
     * Get the isAllDay
     *
     * @return bool
     */
    public function getIsAllDay(): ?bool
    {
        return $this->isAllDay;
    }

    /**
     * Set the isAllDay
     *
     * @param  bool $isAllDay
     * @return self
     */
    public function setIsAllDay(bool $isAllDay): self
    {
        $this->isAllDay = $isAllDay;
        return $this;
    }

    /**
     * Get the isDraft
     *
     * @return bool
     */
    public function getIsDraft(): ?bool
    {
        return $this->isDraft;
    }

    /**
     * Set the isDraft
     *
     * @param  bool $isDraft
     * @return self
     */
    public function setIsDraft(bool $isDraft): self
    {
        $this->isDraft = $isDraft;
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

    /**
     * Get the changes
     *
     * @return string
     */
    public function getChanges(): ?string
    {
        return $this->changes;
    }

    /**
     * Set the changes
     *
     * @param  string $changes
     * @return self
     */
    public function setChanges(string $changes): self
    {
        $validChanges = [];
        foreach (explode(",", $changes) as $change) {
            if (InviteChange::tryFrom($change)) {
                $validChanges[] = $change;
            }
        }
        $this->changes = implode(",", $validChanges);
        return $this;
    }
}
