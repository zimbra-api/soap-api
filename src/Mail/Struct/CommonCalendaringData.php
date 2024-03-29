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
     * @var string
     */
    #[Accessor(getter: 'getXUid', setter: 'setXUid')]
    #[SerializedName('x_uid')]
    #[Type('string')]
    #[XmlAttribute]
    private $xUid;

    /**
     * iCalendar UID
     * 
     * @var string
     */
    #[Accessor(getter: 'getUid', setter: 'setUid')]
    #[SerializedName('uid')]
    #[Type('string')]
    #[XmlAttribute]
    private $uid;

    /**
     * Flags
     * 
     * @var string
     */
    #[Accessor(getter: 'getFlags', setter: 'setFlags')]
    #[SerializedName('f')]
    #[Type('string')]
    #[XmlAttribute]
    private $flags;

    /**
     * Tags - Comma separated list of ints.  DEPRECATED - use "tn" instead
     * 
     * @var string
     */
    #[Accessor(getter: 'getTags', setter: 'setTags')]
    #[SerializedName('t')]
    #[Type('string')]
    #[XmlAttribute]
    private $tags;

    /**
     * Comma separated list of tag names
     * 
     * @var string
     */
    #[Accessor(getter: 'getTagNames', setter: 'setTagNames')]
    #[SerializedName('tn')]
    #[Type('string')]
    #[XmlAttribute]
    private $tagNames;

    /**
     * Folder ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getFolderId', setter: 'setFolderId')]
    #[SerializedName('l')]
    #[Type('string')]
    #[XmlAttribute]
    private $folderId;

    /**
     * Size
     * 
     * @var int
     */
    #[Accessor(getter: 'getSize', setter: 'setSize')]
    #[SerializedName('s')]
    #[Type('int')]
    #[XmlAttribute]
    private $size;

    /**
     * Modified date in seconds
     * 
     * @var int
     */
    #[Accessor(getter: 'getChangeDate', setter: 'setChangeDate')]
    #[SerializedName('md')]
    #[Type('int')]
    #[XmlAttribute]
    private $changeDate;

    /**
     * Modified sequence
     * 
     * @var int
     */
    #[Accessor(getter: 'getModifiedSequence', setter: 'setModifiedSequence')]
    #[SerializedName('ms')]
    #[Type('int')]
    #[XmlAttribute]
    private $modifiedSequence;

    /**
     * Revision number
     * 
     * @var int
     */
    #[Accessor(getter: 'getRevision', setter: 'setRevision')]
    #[SerializedName('rev')]
    #[Type('int')]
    #[XmlAttribute]
    private $revision;

    /**
     * Appointment ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName('id')]
    #[Type('string')]
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
        string $xUid = NULL,
        string $uid = NULL,
        ?string $flags = NULL,
        ?string $tags = NULL,
        ?string $tagNames = NULL,
        ?string $folderId = NULL,
        ?int $size = NULL,
        ?int $changeDate = NULL,
        ?int $modifiedSequence = NULL,
        ?int $revision = NULL,
        ?string $id = NULL,
        ?int $duration = NULL,
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
        if (NULL !== $xUid) {
            $this->setXUid($xUid);
        }
        if (NULL !== $uid) {
            $this->setUid($uid);
        }
        if (NULL !== $flags) {
            $this->setFlags($flags);
        }
        if (NULL !== $tags) {
            $this->setTags($tags);
        }
        if (NULL !== $tagNames) {
            $this->setTagNames($tagNames);
        }
        if (NULL !== $folderId) {
            $this->setFolderId($folderId);
        }
        if (NULL !== $size) {
            $this->setSize($size);
        }
        if (NULL !== $changeDate) {
            $this->setChangeDate($changeDate);
        }
        if (NULL !== $modifiedSequence) {
            $this->setModifiedSequence($modifiedSequence);
        }
        if (NULL !== $revision) {
            $this->setRevision($revision);
        }
        if (NULL !== $id) {
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
