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
 * CommonCalendaringData struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
abstract class CommonCalendaringData extends InstanceDataAttrs
{
    /**
     * x uid
     *
     * @Accessor(getter="getXUid", setter="setXUid")
     * @SerializedName("x_uid")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getXUid", setter: "setXUid")]
    #[SerializedName("x_uid")]
    #[Type("string")]
    #[XmlAttribute]
    private $xUid;

    /**
     * iCalendar UID
     *
     * @Accessor(getter="getUid", setter="setUid")
     * @SerializedName("uid")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getUid", setter: "setUid")]
    #[SerializedName("uid")]
    #[Type("string")]
    #[XmlAttribute]
    private $uid;

    /**
     * Flags
     *
     * @Accessor(getter="getFlags", setter="setFlags")
     * @SerializedName("f")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getFlags", setter: "setFlags")]
    #[SerializedName("f")]
    #[Type("string")]
    #[XmlAttribute]
    private $flags;

    /**
     * Tags - Comma separated list of ints.  DEPRECATED - use "tn" instead
     *
     * @Accessor(getter="getTags", setter="setTags")
     * @SerializedName("t")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getTags", setter: "setTags")]
    #[SerializedName("t")]
    #[Type("string")]
    #[XmlAttribute]
    private $tags;

    /**
     * Comma separated list of tag names
     *
     * @Accessor(getter="getTagNames", setter="setTagNames")
     * @SerializedName("tn")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getTagNames", setter: "setTagNames")]
    #[SerializedName("tn")]
    #[Type("string")]
    #[XmlAttribute]
    private $tagNames;

    /**
     * Folder ID
     *
     * @Accessor(getter="getFolderId", setter="setFolderId")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getFolderId", setter: "setFolderId")]
    #[SerializedName("l")]
    #[Type("string")]
    #[XmlAttribute]
    private $folderId;

    /**
     * Size
     *
     * @Accessor(getter="getSize", setter="setSize")
     * @SerializedName("s")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getSize", setter: "setSize")]
    #[SerializedName("s")]
    #[Type("int")]
    #[XmlAttribute]
    private $size;

    /**
     * Modified date in seconds
     *
     * @Accessor(getter="getChangeDate", setter="setChangeDate")
     * @SerializedName("md")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getChangeDate", setter: "setChangeDate")]
    #[SerializedName("md")]
    #[Type("int")]
    #[XmlAttribute]
    private $changeDate;

    /**
     * Modified sequence
     *
     * @Accessor(getter="getModifiedSequence", setter="setModifiedSequence")
     * @SerializedName("ms")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getModifiedSequence", setter: "setModifiedSequence")]
    #[SerializedName("ms")]
    #[Type("int")]
    #[XmlAttribute]
    private $modifiedSequence;

    /**
     * Revision number
     *
     * @Accessor(getter="getRevision", setter="setRevision")
     * @SerializedName("rev")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getRevision", setter: "setRevision")]
    #[SerializedName("rev")]
    #[Type("int")]
    #[XmlAttribute]
    private $revision;

    /**
     * Appointment ID
     *
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private $id;

    /**
     * Constructor
     *
     * @param  string $xUid
     * @param  string $uid
     * @param  string $flags
     * @param  string $tags
     * @param  string $tagNames
     * @param  string $folderId
     * @param  int $size
     * @param  int $changeDate
     * @param  int $modifiedSequence
     * @param  int $revision
     * @param  string $id
     * @param  int $duration
     * @param  ParticipationStatus $partStat
     * @param  string $recurIdZ
     * @param  int $tzOffset
     * @param  FreeBusyStatus $freeBusyActual
     * @param  string $taskPercentComplete
     * @param  bool $isRecurring
     * @param  bool $hasExceptions
     * @param  string $priority
     * @param  FreeBusyStatus $freeBusyIntended
     * @param  Transparency $transparency
     * @param  string $name
     * @param  string $location
     * @param  bool $hasOtherAttendees
     * @param  bool $hasAlarm
     * @param  bool $isOrganizer
     * @param  string $invId
     * @param  int $componentNum
     * @param  InviteStatus $status
     * @param  InviteClass $calClass
     * @param  bool $allDay
     * @param  bool $draft
     * @param  bool $neverSent
     * @param  int $taskDueDate
     * @param  int $taskTzOffsetDue
     * @return self
     */
    public function __construct(
        string $xUid = null,
        string $uid = null,
        ?string $flags = null,
        ?string $tags = null,
        ?string $tagNames = null,
        ?string $folderId = null,
        ?int $size = null,
        ?int $changeDate = null,
        ?int $modifiedSequence = null,
        ?int $revision = null,
        ?string $id = null,
        ?int $duration = null,
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
        parent::__construct(
            $duration,
            $partStat,
            $recurIdZ,
            $tzOffset,
            $freeBusyActual,
            $taskPercentComplete,
            $isRecurring,
            $hasExceptions,
            $priority,
            $freeBusyIntended,
            $transparency,
            $name,
            $location,
            $hasOtherAttendees,
            $hasAlarm,
            $isOrganizer,
            $invId,
            $componentNum,
            $status,
            $calClass,
            $allDay,
            $draft,
            $neverSent,
            $taskDueDate,
            $taskTzOffsetDue
        );
        if (null !== $xUid) {
            $this->setXUid($xUid);
        }
        if (null !== $uid) {
            $this->setUid($uid);
        }
        if (null !== $flags) {
            $this->setFlags($flags);
        }
        if (null !== $tags) {
            $this->setTags($tags);
        }
        if (null !== $tagNames) {
            $this->setTagNames($tagNames);
        }
        if (null !== $folderId) {
            $this->setFolderId($folderId);
        }
        if (null !== $size) {
            $this->setSize($size);
        }
        if (null !== $changeDate) {
            $this->setChangeDate($changeDate);
        }
        if (null !== $modifiedSequence) {
            $this->setModifiedSequence($modifiedSequence);
        }
        if (null !== $revision) {
            $this->setRevision($revision);
        }
        if (null !== $id) {
            $this->setId($id);
        }
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
     * Get flags
     *
     * @return string
     */
    public function getFlags(): ?string
    {
        return $this->flags;
    }

    /**
     * Set flags
     *
     * @param  string $flags
     * @return self
     */
    public function setFlags(string $flags): self
    {
        $this->flags = $flags;
        return $this;
    }

    /**
     * Get tags
     *
     * @return string
     */
    public function getTags(): ?string
    {
        return $this->tags;
    }

    /**
     * Set tags
     *
     * @param  string $tags
     * @return self
     */
    public function setTags(string $tags): self
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * Get tagNames
     *
     * @return string
     */
    public function getTagNames(): ?string
    {
        return $this->tagNames;
    }

    /**
     * Set tagNames
     *
     * @param  string $tagNames
     * @return self
     */
    public function setTagNames(string $tagNames): self
    {
        $this->tagNames = $tagNames;
        return $this;
    }

    /**
     * Get folderId
     *
     * @return string
     */
    public function getFolderId(): ?string
    {
        return $this->folderId;
    }

    /**
     * Set folderId
     *
     * @param  string $folderId
     * @return self
     */
    public function setFolderId(string $folderId): self
    {
        $this->folderId = $folderId;
        return $this;
    }

    /**
     * Get size
     *
     * @return int
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * Set size
     *
     * @param  int $size
     * @return self
     */
    public function setSize(int $size): self
    {
        $this->size = $size;
        return $this;
    }

    /**
     * Get changeDate
     *
     * @return int
     */
    public function getChangeDate(): ?int
    {
        return $this->changeDate;
    }

    /**
     * Set changeDate
     *
     * @param  int $changeDate
     * @return self
     */
    public function setChangeDate(int $changeDate): self
    {
        $this->changeDate = $changeDate;
        return $this;
    }

    /**
     * Get modifiedSequence
     *
     * @return int
     */
    public function getModifiedSequence(): ?int
    {
        return $this->modifiedSequence;
    }

    /**
     * Set modifiedSequence
     *
     * @param  int $modifiedSequence
     * @return self
     */
    public function setModifiedSequence(int $modifiedSequence): self
    {
        $this->modifiedSequence = $modifiedSequence;
        return $this;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get revision
     *
     * @return int
     */
    public function getRevision(): ?int
    {
        return $this->revision;
    }

    /**
     * Set revision
     *
     * @param  int $revision
     * @return self
     */
    public function setRevision(int $revision): self
    {
        $this->revision = $revision;
        return $this;
    }
}
