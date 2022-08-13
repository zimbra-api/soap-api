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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class InviteComponentCommon implements InviteComponentCommonInterface
{
    /**
     * Method
     * 
     * @Accessor(getter="getMethod", setter="setMethod")
     * @SerializedName("method")
     * @Type("string")
     * @XmlAttribute
     */
    private $method;

    /**
     * Component number of the invite
     * 
     * @Accessor(getter="getComponentNum", setter="setComponentNum")
     * @SerializedName("compNum")
     * @Type("int")
     * @XmlAttribute
     */
    private $componentNum;

    /**
     * RSVP flag.  Set if response requested, unset if no response requested
     * 
     * @Accessor(getter="getRsvp", setter="setRsvp")
     * @SerializedName("rsvp")
     * @Type("bool")
     * @XmlAttribute
     */
    private $rsvp;

    /**
     * Priority (0 - 9; default = 0)
     * 
     * @Accessor(getter="getPriority", setter="setPriority")
     * @SerializedName("priority")
     * @Type("string")
     * @XmlAttribute
     */
    private $priority;

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
     * Percent complete for VTODO (0 - 100; default = 0)
     * 
     * @Accessor(getter="getPercentComplete", setter="setPercentComplete")
     * @SerializedName("percentComplete")
     * @Type("string")
     * @XmlAttribute
     */
    private $percentComplete;

    /**
     * VTODO COMPLETED DATE-TIME in format: yyyyMMddThhmmssZ
     * 
     * @Accessor(getter="getCompleted", setter="setCompleted")
     * @SerializedName("completed")
     * @Type("string")
     * @XmlAttribute
     */
    private $completed;

    /**
     * Set if invite has no blob data, i.e. all data is in db metadata
     * 
     * @Accessor(getter="getNoBlob", setter="setNoBlob")
     * @SerializedName("noBlob")
     * @Type("bool")
     * @XmlAttribute
     */
    private $noBlob;

    /**
     * The "actual" free-busy status of this invite (ie what the client should display).
     * Valid values - F|B|T|U.  i.e. Free, Busy (default), busy-Tentative, OutOfOffice (busy-unavailable)
     * 
     * @Accessor(getter="getFreeBusyActual", setter="setFreeBusyActual")
     * @SerializedName("fba")
     * @Type("Enum<Zimbra\Common\Enum\FreeBusyStatus>")
     * @XmlAttribute
     * @var FreeBusyStatus
     */
    private $freeBusyActual;

    /**
     * FreeBusy setting F|B|T|U
     * i.e. Free, Busy (default), busy-Tentative, OutOfOffice (busy-unavailable)
     * 
     * @Accessor(getter="getFreeBusy", setter="setFreeBusy")
     * @SerializedName("fb")
     * @Type("Enum<Zimbra\Common\Enum\FreeBusyStatus>")
     * @XmlAttribute
     * @var FreeBusyStatus
     */
    private $freeBusy;

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
     * Am I the organizer?  [default 0 (false)]
     * 
     * @Accessor(getter="getIsOrganizer", setter="setIsOrganizer")
     * @SerializedName("isOrg")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isOrganizer;

    /**
     * x_uid
     * 
     * @Accessor(getter="getXUid", setter="setXUid")
     * @SerializedName("x_uid")
     * @Type("string")
     * @XmlAttribute
     */
    private $xUid;

    /**
     * UID to use when creating appointment.  Optional: client can request the UID to use
     * 
     * @Accessor(getter="getUid", setter="setUid")
     * @SerializedName("uid")
     * @Type("string")
     * @XmlAttribute
     */
    private $uid;

    /**
     * Sequence number (default = 0)
     * 
     * @Accessor(getter="getSequence", setter="setSequence")
     * @SerializedName("seq")
     * @Type("int")
     * @XmlAttribute
     */
    private $sequence;

    /**
     * Date - used for zdsync
     * 
     * @Accessor(getter="getDateTime", setter="setDateTime")
     * @SerializedName("d")
     * @Type("int")
     * @XmlAttribute
     */
    private $dateTime;

    /**
     * Mail item ID of appointment
     * 
     * @Accessor(getter="getCalItemId", setter="setCalItemId")
     * @SerializedName("calItemId")
     * @Type("string")
     * @XmlAttribute
     */
    private $calItemId;

    /**
     * Appointment ID (deprecated)
     * 
     * @Accessor(getter="getDeprecatedApptId", setter="setDeprecatedApptId")
     * @SerializedName("apptId")
     * @Type("string")
     * @XmlAttribute
     */
    private $deprecatedApptId;

    /**
     * Folder of appointment
     * 
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
     * URL
     * 
     * @Accessor(getter="getUrl", setter="setUrl")
     * @SerializedName("url")
     * @Type("string")
     * @XmlAttribute
     */
    private $url;

    /**
     * Set if this is invite is an exception
     * 
     * @Accessor(getter="getIsException", setter="setIsException")
     * @SerializedName("ex")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isException;

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
     * Set if is an all day appointment
     * 
     * @Accessor(getter="getIsAllDay", setter="setIsAllDay")
     * @SerializedName("allDay")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isAllDay;

    /**
     * Set if invite has changes that haven't been sent to attendees; for organizer only
     * 
     * @Accessor(getter="getIsDraft", setter="setIsDraft")
     * @SerializedName("draft")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isDraft;

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
     * Comma-separated list of changed data in an updated invite.
     * Possible values are "subject", "location", "time" (start time, end time, or duration), and "recurrence".
     * 
     * @Accessor(getter="getChanges", setter="setChanges")
     * @SerializedName("changes")
     * @Type("string")
     * @XmlAttribute
     */
    private $changes;

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
        ?string $method = NULL,
        ?int $componentNum = NULL,
        ?bool $rsvp = NULL,
        ?string $priority = NULL,
        ?string $name = NULL,
        ?string $location = NULL,
        ?string $percentComplete = NULL,
        ?string $completed = NULL,
        ?bool $noBlob = NULL,
        ?FreeBusyStatus $freeBusyActual = NULL,
        ?FreeBusyStatus $freeBusy = NULL,
        ?Transparency $transparency = NULL,
        ?bool $isOrganizer = NULL,
        ?string $xUid = NULL,
        ?string $uid = NULL,
        ?int $sequence = NULL,
        ?int $dateTime = NULL,
        ?string $calItemId = NULL,
        ?string $deprecatedApptId = NULL,
        ?string $calItemFolder = NULL,
        ?InviteStatus $status = NULL,
        ?InviteClass $calClass = NULL,
        ?string $url = NULL,
        ?bool $isException = NULL,
        ?string $recurIdZ = NULL,
        ?bool $isAllDay = NULL,
        ?bool $isDraft = NULL,
        ?bool $neverSent = NULL,
        ?string $changes = NULL
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
        if (NULL !== $priority) {
            $this->setPriority($priority);
        }
        if (NULL !== $name) {
            $this->setName($name);
        }
        if (NULL !== $location) {
            $this->setLocation($location);
        }
        if (NULL !== $percentComplete) {
            $this->setPercentComplete($percentComplete);
        }
        if (NULL !== $completed) {
            $this->setCompleted($completed);
        }
        if (NULL !== $noBlob) {
            $this->setNoBlob($noBlob);
        }
        if ($freeBusyActual instanceof FreeBusyStatus) {
            $this->setFreeBusyActual($freeBusyActual);
        }
        if ($freeBusy instanceof FreeBusyStatus) {
            $this->setFreeBusy($freeBusy);
        }
        if ($transparency instanceof Transparency) {
            $this->setTransparency($transparency);
        }
        if (NULL !== $isOrganizer) {
            $this->setIsOrganizer($isOrganizer);
        }
        if (NULL !== $xUid) {
            $this->setXUid($xUid);
        }
        if (NULL !== $uid) {
            $this->setUid($uid);
        }
        if (NULL !== $sequence) {
            $this->setSequence($sequence);
        }
        if (NULL !== $dateTime) {
            $this->setDateTime($dateTime);
        }
        if (NULL !== $calItemId) {
            $this->setCalItemId($calItemId);
        }
        if (NULL !== $deprecatedApptId) {
            $this->setDeprecatedApptId($deprecatedApptId);
        }
        if (NULL !== $calItemFolder) {
            $this->setCalItemFolder($calItemFolder);
        }
        if ($status instanceof InviteStatus) {
            $this->setStatus($status);
        }
        if ($calClass instanceof InviteClass) {
            $this->setCalClass($calClass);
        }
        if (NULL !== $url) {
            $this->setUrl($url);
        }
        if (NULL !== $isException) {
            $this->setIsException($isException);
        }
        if (NULL !== $recurIdZ) {
            $this->setRecurIdZ($recurIdZ);
        }
        if (NULL !== $isAllDay) {
            $this->setIsAllDay($isAllDay);
        }
        if (NULL !== $isDraft) {
            $this->setIsDraft($isDraft);
        }
        if (NULL !== $neverSent) {
            $this->setNeverSent($neverSent);
        }
        if (NULL !== $changes) {
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
        foreach (explode(',', $changes) as $change) {
            if (InviteChange::isValid($change)) {
                $validChanges[] = $change;
            }
        }
        $this->changes = implode(',', $validChanges);
        return $this;
    }
}
