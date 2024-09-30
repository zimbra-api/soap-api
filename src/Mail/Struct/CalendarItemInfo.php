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
    XmlAttribute,
    XmlElement,
    XmlList
};

/**
 * CalendarItemInfo class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CalendarItemInfo
{
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
     * Date
     *
     * @Accessor(getter="getDate", setter="setDate")
     * @SerializedName("d")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getDate", setter: "setDate")]
    #[SerializedName("d")]
    #[Type("int")]
    #[XmlAttribute]
    private $date;

    /**
     * Folder ID
     *
     * @Accessor(getter="getFolder", setter="setFolder")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getFolder", setter: "setFolder")]
    #[SerializedName("l")]
    #[Type("string")]
    #[XmlAttribute]
    private $folder;

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
     * Next alarm time
     *
     * @Accessor(getter="getNextAlarm", setter="setNextAlarm")
     * @SerializedName("nextAlarm")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getNextAlarm", setter: "setNextAlarm")]
    #[SerializedName("nextAlarm")]
    #[Type("int")]
    #[XmlAttribute]
    private $nextAlarm;

    /**
     * Has exceptions but no series
     *
     * @Accessor(getter="getOrphan", setter="setOrphan")
     * @SerializedName("orphan")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getOrphan", setter: "setOrphan")]
    #[SerializedName("orphan")]
    #[Type("bool")]
    #[XmlAttribute]
    private $orphan;

    /**
     * Invites
     *
     * @Accessor(getter="getInvites", setter="setInvites")
     * @Type("array<Zimbra\Mail\Struct\Invitation>")
     * @XmlList(inline=true, entry="inv", namespace="urn:zimbraMail")
     *
     * @var array
     */
    #[Accessor(getter: "getInvites", setter: "setInvites")]
    #[Type("array<Zimbra\Mail\Struct\Invitation>")]
    #[XmlList(inline: true, entry: "inv", namespace: "urn:zimbraMail")]
    private $invites = [];

    /**
     * Replies
     *
     * @Accessor(getter="getCalendarReplies", setter="setCalendarReplies")
     * @SerializedName("replies")
     * @Type("array<Zimbra\Mail\Struct\CalendarReply>")
     * @XmlElement(namespace="urn:zimbraMail")
     * @XmlList(inline=false, entry="reply", namespace="urn:zimbraMail")
     *
     * @var array
     */
    #[Accessor(getter: "getCalendarReplies", setter: "setCalendarReplies")]
    #[SerializedName("replies")]
    #[Type("array<Zimbra\Mail\Struct\CalendarReply>")]
    #[XmlElement(namespace: "urn:zimbraMail")]
    #[XmlList(inline: false, entry: "reply", namespace: "urn:zimbraMail")]
    private $calendarReplies = [];

    /**
     * Metadata
     *
     * @Accessor(getter="getMetadatas", setter="setMetadatas")
     * @Type("array<Zimbra\Mail\Struct\MailCustomMetadata>")
     * @XmlList(inline=true, entry="meta", namespace="urn:zimbraMail")
     *
     * @var array
     */
    #[Accessor(getter: "getMetadatas", setter: "setMetadatas")]
    #[Type("array<Zimbra\Mail\Struct\MailCustomMetadata>")]
    #[XmlList(inline: true, entry: "meta", namespace: "urn:zimbraMail")]
    private $metadatas = [];

    /**
     * Constructor
     *
     * @param  string $flags
     * @param  string $tags
     * @param  string $tagNames
     * @param  string $uid
     * @param  string $id
     * @param  int $revision
     * @param  int $size
     * @param  int $date
     * @param  string $folder
     * @param  int $changeDate
     * @param  int $modifiedSequence
     * @param  int $nextAlarm
     * @param  bool $orphan
     * @param  array $invites
     * @param  array $calendarReplies
     * @param  array $metadatas
     * @return self
     */
    public function __construct(
        ?string $flags = null,
        ?string $tags = null,
        ?string $tagNames = null,
        ?string $uid = null,
        ?string $id = null,
        ?int $revision = null,
        ?int $size = null,
        ?int $date = null,
        ?string $folder = null,
        ?int $changeDate = null,
        ?int $modifiedSequence = null,
        ?int $nextAlarm = null,
        ?bool $orphan = null,
        array $invites = [],
        array $calendarReplies = [],
        array $metadatas = []
    ) {
        $this->setInvites($invites)
            ->setCalendarReplies($calendarReplies)
            ->setMetadatas($metadatas);
        if (null !== $flags) {
            $this->setFlags($flags);
        }
        if (null !== $tags) {
            $this->setTags($tags);
        }
        if (null !== $tagNames) {
            $this->setTagNames($tagNames);
        }
        if (null !== $uid) {
            $this->setUid($uid);
        }
        if (null !== $id) {
            $this->setId($id);
        }
        if (null !== $revision) {
            $this->setRevision($revision);
        }
        if (null !== $size) {
            $this->setSize($size);
        }
        if (null !== $date) {
            $this->setDate($date);
        }
        if (null !== $folder) {
            $this->setFolder($folder);
        }
        if (null !== $changeDate) {
            $this->setChangeDate($changeDate);
        }
        if (null !== $modifiedSequence) {
            $this->setModifiedSequence($modifiedSequence);
        }
        if (null !== $nextAlarm) {
            $this->setNextAlarm($nextAlarm);
        }
        if (null !== $orphan) {
            $this->setOrphan($orphan);
        }
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
     * Get uid
     *
     * @return string
     */
    public function getUid(): ?string
    {
        return $this->uid;
    }

    /**
     * Set uid
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
     * Get date
     *
     * @return int
     */
    public function getDate(): ?int
    {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param  int $date
     * @return self
     */
    public function setDate(int $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get folder
     *
     * @return string
     */
    public function getFolder(): ?string
    {
        return $this->folder;
    }

    /**
     * Set folder
     *
     * @param  string $folder
     * @return self
     */
    public function setFolder(string $folder): self
    {
        $this->folder = $folder;
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
     * Get nextAlarm
     *
     * @return int
     */
    public function getNextAlarm(): ?int
    {
        return $this->nextAlarm;
    }

    /**
     * Set nextAlarm
     *
     * @param  int $nextAlarm
     * @return self
     */
    public function setNextAlarm(int $nextAlarm): self
    {
        $this->nextAlarm = $nextAlarm;
        return $this;
    }

    /**
     * Get orphan
     *
     * @return bool
     */
    public function getOrphan(): ?bool
    {
        return $this->orphan;
    }

    /**
     * Set orphan
     *
     * @param  bool $orphan
     * @return self
     */
    public function setOrphan(bool $orphan): self
    {
        $this->orphan = $orphan;
        return $this;
    }

    /**
     * Set invites
     *
     * @param  array $invites
     * @return self
     */
    public function setInvites(array $invites): self
    {
        $this->invites = array_filter(
            $invites,
            static fn($invite) => $invite instanceof Invitation
        );
        return $this;
    }

    /**
     * Get invites
     *
     * @return array
     */
    public function getInvites(): array
    {
        return $this->invites;
    }

    /**
     * Set calendarReplies
     *
     * @param  array $replies
     * @return self
     */
    public function setCalendarReplies(array $replies): self
    {
        $this->calendarReplies = array_filter(
            $replies,
            static fn($reply) => $reply instanceof CalendarReply
        );
        return $this;
    }

    /**
     * Get calendarReplies
     *
     * @return array
     */
    public function getCalendarReplies(): array
    {
        return $this->calendarReplies;
    }

    /**
     * Set metadatas
     *
     * @param  array $metadatas
     * @return self
     */
    public function setMetadatas(array $metadatas): self
    {
        $this->metadatas = array_filter(
            $metadatas,
            static fn($meta) => $meta instanceof MailCustomMetadata
        );
        return $this;
    }

    /**
     * Get metadatas
     *
     * @return array
     */
    public function getMetadatas(): array
    {
        return $this->metadatas;
    }
}
