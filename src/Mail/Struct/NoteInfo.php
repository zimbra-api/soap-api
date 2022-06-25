<?php declare(strict_types=1);
/**
 * This file is name of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};
use Zimbra\Common\Text;

/**
 * NoteInfo class
 * A Note info
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class NoteInfo
{
    /**
     * The id
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Revision
     * @Accessor(getter="getRevision", setter="setRevision")
     * @SerializedName("rev")
     * @Type("integer")
     * @XmlAttribute
     */
    private $revision;

    /**
     * Folder ID
     * @Accessor(getter="getFolder", setter="setFolder")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     */
    private $folder;

    /**
     * Date
     * @Accessor(getter="getDate", setter="setDate")
     * @SerializedName("d")
     * @Type("integer")
     * @XmlAttribute
     */
    private $date;

    /**
     * Flags
     * @Accessor(getter="getFlags", setter="setFlags")
     * @SerializedName("f")
     * @Type("string")
     * @XmlAttribute
     */
    private $flags;

    /**
     * Tags - Comma separated list of integers.  DEPRECATED - use "tn" instead
     * @Accessor(getter="getTags", setter="setTags")
     * @SerializedName("t")
     * @Type("string")
     * @XmlAttribute
     */
    private $tags;

    /**
     * Comma-separated list of tag names
     * @Accessor(getter="getTagNames", setter="setTagNames")
     * @SerializedName("tn")
     * @Type("string")
     * @XmlAttribute
     */
    private $tagNames;

    /**
     * Bounds - x,y[width,height] where x,y,width and height are all integers
     * @Accessor(getter="getBounds", setter="setBounds")
     * @SerializedName("pos")
     * @Type("string")
     * @XmlAttribute
     */
    private $bounds;

    /**
     * color numeric; range 0-127; defaults to 0 if not present; client can display only 0-7
     * @Accessor(getter="getColor", setter="setColor")
     * @SerializedName("color")
     * @Type("integer")
     * @XmlAttribute
     */
    private $color;

    /**
     * RGB color in format #rrggbb where r,g and b are hex digits
     * @Accessor(getter="getRgb", setter="setRgb")
     * @SerializedName("rgb")
     * @Type("string")
     * @XmlAttribute
     */
    private $rgb;

    /**
     * Modified date in seconds
     * @Accessor(getter="getChangeDate", setter="setChangeDate")
     * @SerializedName("md")
     * @Type("integer")
     * @XmlAttribute
     */
    private $changeDate;

    /**
     * Modified sequence
     * @Accessor(getter="getModifiedSequence", setter="setModifiedSequence")
     * @SerializedName("ms")
     * @Type("integer")
     * @XmlAttribute
     */
    private $modifiedSequence;

    /**
     * Content
     * @Accessor(getter="getContent", setter="setContent")
     * @SerializedName("content")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $content;

    /**
     * Custom metadata information
     * @Accessor(getter="getMetadatas", setter="setMetadatas")
     * @SerializedName("meta")
     * @Type("array<Zimbra\Mail\Struct\MailCustomMetadata>")
     * @XmlList(inline=true, entry="meta")
     */
    private $metadatas = [];

    /**
     * Constructor method for NoteInfo
     *
     * @param  string $id
     * @param  int $revision
     * @return self
     */
    public function __construct(
        ?string $id = NULL,
        ?int $revision = NULL,
        ?string $folder = NULL,
        ?int $date = NULL,
        ?string $flags = NULL,
        ?string $tags = NULL,
        ?string $tagNames = NULL,
        ?string $bounds = NULL,
        ?int $color = NULL,
        ?string $rgb = NULL,
        ?int $changeDate = NULL,
        ?int $modifiedSequence = NULL,
        ?string $content = NULL,
        array $metadatas = []
    )
    {
        $this->setMetadatas($metadatas);
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $revision) {
            $this->setRevision($revision);
        }
        if (NULL !== $folder) {
            $this->setFolder($folder);
        }
        if (NULL !== $date) {
            $this->setDate($date);
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
        if (NULL !== $bounds) {
            $this->setBounds($bounds);
        }
        if (NULL !== $color) {
            $this->setColor($color);
        }
        if (NULL !== $rgb) {
            $this->setRgb($rgb);
        }
        if (NULL !== $changeDate) {
            $this->setChangeDate($changeDate);
        }
        if (NULL !== $modifiedSequence) {
            $this->setModifiedSequence($modifiedSequence);
        }
        if (NULL !== $content) {
            $this->setContent($content);
        }
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Sets id
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
     * Gets tags
     *
     * @return string
     */
    public function getTags(): ?string
    {
        return $this->tags;
    }

    /**
     * Sets tags
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
     * Gets tagNames
     *
     * @return string
     */
    public function getTagNames(): ?string
    {
        return $this->tagNames;
    }

    /**
     * Sets tagNames
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
     * Gets folder
     *
     * @return string
     */
    public function getFolder(): ?string
    {
        return $this->folder;
    }

    /**
     * Sets folder
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
     * Gets bounds
     *
     * @return string
     */
    public function getBounds(): ?string
    {
        return $this->bounds;
    }

    /**
     * Sets bounds
     *
     * @param  string $bounds
     * @return self
     */
    public function setBounds(string $bounds): self
    {
        $this->bounds = $bounds;
        return $this;
    }

    /**
     * Gets flags
     *
     * @return string
     */
    public function getFlags(): ?string
    {
        return $this->flags;
    }

    /**
     * Sets flags
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
     * Gets color
     *
     * @return int
     */
    public function getColor(): ?int
    {
        return $this->color;
    }

    /**
     * Sets color
     *
     * @param  int $color
     * @return self
     */
    public function setColor(int $color): self
    {
        $this->color = in_array($color, range(0, 127)) ? $color : 0;
        return $this;
    }

    /**
     * Gets rgb
     *
     * @return string
     */
    public function getRgb(): ?string
    {
        return $this->rgb;
    }

    /**
     * Sets rgb
     *
     * @param  string $rgb
     * @return self
     */
    public function setRgb(string $rgb): self
    {
        if (Text::isRgb($rgb)) {
            $this->rgb = $rgb;
        }
        return $this;
    }

    /**
     * Gets date
     *
     * @return int
     */
    public function getDate(): ?int
    {
        return $this->date;
    }

    /**
     * Sets date
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
     * Gets revision
     *
     * @return int
     */
    public function getRevision(): ?int
    {
        return $this->revision;
    }

    /**
     * Sets revision
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
     * Gets modifiedSequence
     *
     * @return int
     */
    public function getModifiedSequence(): ?int
    {
        return $this->modifiedSequence;
    }

    /**
     * Sets modifiedSequence
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
     * Gets changeDate
     *
     * @return int
     */
    public function getChangeDate(): ?int
    {
        return $this->changeDate;
    }

    /**
     * Sets changeDate
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
     * Gets content
     *
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Sets content
     *
     * @param  string $content
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Sets metadatas
     *
     * @param  array $metadatas
     * @return self
     */
    public function setMetadatas(array $metadatas): self
    {
        $this->metadatas = array_filter($metadatas, static fn ($metadata) => $metadata instanceof MailCustomMetadata);
        return $this;
    }

    /**
     * Gets metadatas
     *
     * @return array
     */
    public function getMetadatas(): array
    {
        return $this->metadatas;
    }

    /**
     * Add metadata
     *
     * @param  MailCustomMetadata $metadata
     * @return self
     */
    public function addMetadata(MailCustomMetadata $metadata): self
    {
        $this->metadatas[] = $metadata;
        return $this;
    }
}
