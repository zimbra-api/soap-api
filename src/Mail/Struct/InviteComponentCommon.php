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
use Zimbra\Common\Enum\{FreeBusyStatus, InviteChange, InviteClass, InviteStatus, Transparency};
use Zimbra\Common\Struct\InviteComponentCommonInterface;

/**
 * InviteComponentCommon struct class
 * Invite component common information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class InviteComponentCommon implements InviteComponentCommonInterface
{
    /**
     * Method
     * @Accessor(getter="getMethod", setter="setMethod")
     * @SerializedName("method")
     * @Type("string")
     * @XmlAttribute
     */
    private $method;

    /**
     * Component number of the invite
     * @Accessor(getter="getComponentNum", setter="setComponentNum")
     * @SerializedName("compNum")
     * @Type("integer")
     * @XmlAttribute
     */
    private $componentNum;

    /**
     * RSVP flag.  Set if response requested, unset if no response requested
     * @Accessor(getter="getRsvp", setter="setRsvp")
     * @SerializedName("rsvp")
     * @Type("bool")
     * @XmlAttribute
     */
    private $rsvp;

    /**
     * Priority (0 - 9; default = 0)
     * @Accessor(getter="getPriority", setter="setPriority")
     * @SerializedName("priority")
     * @Type("string")
     * @XmlAttribute
     */
    private $priority;

    /**
     * NAME
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Location
     * @Accessor(getter="getLocation", setter="setLocation")
     * @SerializedName("loc")
     * @Type("string")
     * @XmlAttribute
     */
    private $location;

    /**
     * Percent complete for VTODO (0 - 100; default = 0)
     * @Accessor(getter="getPercentComplete", setter="setPercentComplete")
     * @SerializedName("percentComplete")
     * @Type("string")
     * @XmlAttribute
     */
    private $percentComplete;

    /**
     * VTODO COMPLETED DATE-TIME in format: yyyyMMddThhmmssZ
     * @Accessor(getter="getCompleted", setter="setCompleted")
     * @SerializedName("completed")
     * @Type("string")
     * @XmlAttribute
     */
    private $completed;

    /**
     * Set if invite has no blob data, i.e. all data is in db metadata
     * @Accessor(getter="getNoBlob", setter="setNoBlob")
     * @SerializedName("noBlob")
     * @Type("bool")
     * @XmlAttribute
     */
    private $noBlob;

    /**
     * The "actual" free-busy status of this invite (ie what the client should display).
     * Valid values - F|B|T|U.  i.e. Free, Busy (default), busy-Tentative, OutOfOffice (busy-unavailable)
     * @Accessor(getter="getFreeBusyActual", setter="setFreeBusyActual")
     * @SerializedName("fba")
     * @Type("Zimbra\Common\Enum\FreeBusyStatus")
     * @XmlAttribute
     */
    private ?FreeBusyStatus $freeBusyActual = NULL;

    /**
     * FreeBusy setting F|B|T|U
     * i.e. Free, Busy (default), busy-Tentative, OutOfOffice (busy-unavailable)
     * @Accessor(getter="getFreeBusy", setter="setFreeBusy")
     * @SerializedName("fb")
     * @Type("Zimbra\Common\Enum\FreeBusyStatus")
     * @XmlAttribute
     */
    private ?FreeBusyStatus $freeBusy = NULL;

    /**
     * Transparency - O|T.  i.e. Opaque or Transparent
     * @Accessor(getter="getTransparency", setter="setTransparency")
     * @SerializedName("transp")
     * @Type("Zimbra\Common\Enum\Transparency")
     * @XmlAttribute
     */
    private ?Transparency $transparency = NULL;

    /**
     * Am I the organizer?  [default 0 (false)]
     * @Accessor(getter="getIsOrganizer", setter="setIsOrganizer")
     * @SerializedName("isOrg")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isOrganizer;

    /**
     * x_uid
     * @Accessor(getter="getXUid", setter="setXUid")
     * @SerializedName("x_uid")
     * @Type("string")
     * @XmlAttribute
     */
    private $xUid;

    /**
     * UID to use when creating appointment.  Optional: client can request the UID to use
     * @Accessor(getter="getUid", setter="setUid")
     * @SerializedName("uid")
     * @Type("string")
     * @XmlAttribute
     */
    private $uid;

    /**
     * Sequence number (default = 0)
     * @Accessor(getter="getSequence", setter="setSequence")
     * @SerializedName("seq")
     * @Type("integer")
     * @XmlAttribute
     */
    private $sequence;

    /**
     * Date - used for zdsync
     * @Accessor(getter="getDateTime", setter="setDateTime")
     * @SerializedName("d")
     * @Type("integer")
     * @XmlAttribute
     */
    private $dateTime;

    /**
     * Mail item ID of appointment
     * @Accessor(getter="getCalItemId", setter="setCalItemId")
     * @SerializedName("calItemId")
     * @Type("string")
     * @XmlAttribute
     */
    private $calItemId;

    /**
     * Appointment ID (deprecated)
     * @Accessor(getter="getDeprecatedApptId", setter="setDeprecatedApptId")
     * @SerializedName("apptId")
     * @Type("string")
     * @XmlAttribute
     */
    private $deprecatedApptId;

    /**
     * Folder of appointment
     * @Accessor(getter="getCalItemFolder", setter="setCalItemFolder")
     * @SerializedName("ciFolder")
     * @Type("string")
     * @XmlAttribute
     */
    private $calItemFolder;

    /**
     * Status - TENT|CONF|CANC|NEED|COMP|INPR|WAITING|DEFERRED
     * i.e. TENTative, CONFirmed, CANCelled, COMPleted, INPRogress, WAITING, DEFERRED
     * where waiting and Deferred are custom values not found in the iCalendar spec.
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("Zimbra\Common\Enum\InviteStatus")
     * @XmlAttribute
     */
    private ?InviteStatus $status = NULL;

    /**
     * Class = PUB|PRI|CON.  i.e. PUBlic (default), PRIvate, CONfidential
     * @Accessor(getter="getCalClass", setter="setCalClass")
     * @SerializedName("class")
     * @Type("Zimbra\Common\Enum\InviteClass")
     * @XmlAttribute
     */
    private ?InviteClass $calClass = NULL;

    /**
     * URL
     * @Accessor(getter="getUrl", setter="setUrl")
     * @SerializedName("url")
     * @Type("string")
     * @XmlAttribute
     */
    private $url;

    /**
     * Set if this is invite is an exception
     * @Accessor(getter="getIsException", setter="setIsException")
     * @SerializedName("ex")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isException;

    /**
     * Recurrence-id string in UTC timezone
     * @Accessor(getter="getRecurIdZ", setter="setRecurIdZ")
     * @SerializedName("ridZ")
     * @Type("string")
     * @XmlAttribute
     */
    private $recurIdZ;

    /**
     * Set if is an all day appointment
     * @Accessor(getter="getIsAllDay", setter="setIsAllDay")
     * @SerializedName("allDay")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isAllDay;

    /**
     * Set if invite has changes that haven't been sent to attendees; for organizer only
     * @Accessor(getter="getIsDraft", setter="setIsDraft")
     * @SerializedName("draft")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isDraft;

    /**
     * Set if attendees were never notified of this invite; for organizer only
     * @Accessor(getter="getNeverSent", setter="setNeverSent")
     * @SerializedName("neverSent")
     * @Type("bool")
     * @XmlAttribute
     */
    private $neverSent;

    /**
     * Comma-separated list of changed data in an updated invite.
     * Possible values are "subject", "location", "time" (start time, end time, or duration), and "recurrence".
     * @Accessor(getter="getChanges", setter="setChanges")
     * @SerializedName("changes")
     * @Type("string")
     * @XmlAttribute
     */
    private $changes;

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
        if (NULL !== $method) {
            $this->setMethod($method);
        }
        if (NULL !== $componentNum) {
            $this->setComponentNum($componentNum);
        }
        if (NULL !== $rsvp) {
            $this->setRsvp($rsvp);
        }
    }

    /**
     * Gets the method
     *
     * @return string
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * Sets the method
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
     * Gets the componentNum
     *
     * @return int
     */
    public function getComponentNum(): ?int
    {
        return $this->componentNum;
    }

    /**
     * Sets the componentNum
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
     * Gets the rsvp
     *
     * @return bool
     */
    public function getRsvp(): ?bool
    {
        return $this->rsvp;
    }

    /**
     * Sets the rsvp
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
     * Gets the priority
     *
     * @return string
     */
    public function getPriority(): ?string
    {
        return $this->priority;
    }

    /**
     * Sets the priority
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
     * Gets the name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Sets the name
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
     * Gets the location
     *
     * @return string
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * Sets the location
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
     * Gets the percentComplete
     *
     * @return string
     */
    public function getPercentComplete(): ?string
    {
        return $this->percentComplete;
    }

    /**
     * Sets the percentComplete
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
     * Gets the completed
     *
     * @return string
     */
    public function getCompleted(): ?string
    {
        return $this->completed;
    }

    /**
     * Sets the completed
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
     * Gets the noBlob
     *
     * @return bool
     */
    public function getNoBlob(): ?bool
    {
        return $this->noBlob;
    }

    /**
     * Sets the noBlob
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
     * Gets the freeBusyActual
     *
     * @return FreeBusyStatus
     */
    public function getFreeBusyActual(): ?FreeBusyStatus
    {
        return $this->freeBusyActual;
    }

    /**
     * Sets the freeBusyActual
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
     * Gets the freeBusy
     *
     * @return FreeBusyStatus
     */
    public function getFreeBusy(): ?FreeBusyStatus
    {
        return $this->freeBusy;
    }

    /**
     * Sets the freeBusy
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
     * Gets the transparency
     *
     * @return Transparency
     */
    public function getTransparency(): ?Transparency
    {
        return $this->transparency;
    }

    /**
     * Sets the transparency
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
     * Gets the isOrganizer
     *
     * @return bool
     */
    public function getIsOrganizer(): ?bool
    {
        return $this->isOrganizer;
    }

    /**
     * Sets the isOrganizer
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
     * Gets the xUid
     *
     * @return string
     */
    public function getXUid(): ?string
    {
        return $this->xUid;
    }

    /**
     * Sets the xUid
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
     * Gets the uid
     *
     * @return string
     */
    public function getUid(): ?string
    {
        return $this->uid;
    }

    /**
     * Sets the uid
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
     * Gets the sequence
     *
     * @return int
     */
    public function getSequence(): ?int
    {
        return $this->sequence;
    }

    /**
     * Sets the sequence
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
     * Gets the dateTime
     *
     * @return int
     */
    public function getDateTime(): ?int
    {
        return $this->dateTime;
    }

    /**
     * Sets the dateTime
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
     * Gets the calItemId
     *
     * @return string
     */
    public function getCalItemId(): ?string
    {
        return $this->calItemId;
    }

    /**
     * Sets the calItemId
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
     * Gets the deprecatedApptId
     *
     * @return string
     */
    public function getDeprecatedApptId(): ?string
    {
        return $this->deprecatedApptId;
    }

    /**
     * Sets the deprecatedApptId
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
     * Gets the calItemFolder
     *
     * @return string
     */
    public function getCalItemFolder(): ?string
    {
        return $this->calItemFolder;
    }

    /**
     * Sets the calItemFolder
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
     * Gets the status
     *
     * @return InviteStatus
     */
    public function getStatus(): ?InviteStatus
    {
        return $this->status;
    }

    /**
     * Sets the status
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
     * Gets the calClass
     *
     * @return InviteClass
     */
    public function getCalClass(): ?InviteClass
    {
        return $this->calClass;
    }

    /**
     * Sets the calClass
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
     * Gets the url
     *
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * Sets the url
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
     * Gets the isException
     *
     * @return bool
     */
    public function getIsException(): ?bool
    {
        return $this->isException;
    }

    /**
     * Sets the isException
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
     * Gets the recurIdZ
     *
     * @return string
     */
    public function getRecurIdZ(): ?string
    {
        return $this->recurIdZ;
    }

    /**
     * Sets the recurIdZ
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
     * Gets the isAllDay
     *
     * @return bool
     */
    public function getIsAllDay(): ?bool
    {
        return $this->isAllDay;
    }

    /**
     * Sets the isAllDay
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
     * Gets the isDraft
     *
     * @return bool
     */
    public function getIsDraft(): ?bool
    {
        return $this->isDraft;
    }

    /**
     * Sets the isDraft
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
     * Gets the neverSent
     *
     * @return bool
     */
    public function getNeverSent(): ?bool
    {
        return $this->neverSent;
    }

    /**
     * Sets the neverSent
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
     * Gets the changes
     *
     * @return string
     */
    public function getChanges(): ?string
    {
        return $this->changes;
    }

    /**
     * Sets the changes
     *
     * @param  string $changes
     * @return self
     */
    public function setChanges(string $changes): self
    {
        $validChanges = [];
        foreach (explode(',', $changes) as $change) {
            if (InviteChange::isValid($change)) {
                $validChanges[] = $change;
            }
        }
        $this->changes = implode(',', $validChanges);
        return $this;
    }
}
