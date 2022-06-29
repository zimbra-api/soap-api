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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Common\Text;

/**
 * CommentInfo class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CommentInfo
{
    /**
     * Item ID of parent
     * @Accessor(getter="getParentId", setter="setParentId")
     * @SerializedName("parentId")
     * @Type("string")
     * @XmlAttribute
     */
    private $parentId;

    /**
     * Item ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Item's UUID - a globally unique identifier
     * @Accessor(getter="getUuid", setter="setUuid")
     * @SerializedName("uuid")
     * @Type("string")
     * @XmlAttribute
     */
    private $uuid;

    /**
     * Creator email address
     * @Accessor(getter="getCreatorEmail", setter="setCreatorEmail")
     * @SerializedName("email")
     * @Type("string")
     * @XmlAttribute
     */
    private $creatorEmail;

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
     * Timestamp
     * @Accessor(getter="getDate", setter="setDate")
     * @SerializedName("d")
     * @Type("integer")
     * @XmlAttribute
     */
    private $date;

    /**
     * metadata and the subject as text
     * @Accessor(getter="getMetadatas", setter="setMetadatas")
     * @Type("array<Zimbra\Mail\Struct\MailCustomMetadata>")
     * @XmlList(inline=true, entry="meta", namespace="urn:zimbraMail")
     */
    private $metadatas = [];

    /**
     * Constructor method for CommentInfo
     *
     * @return self
     */
    public function __construct(
        ?string $parentId = NULL,
        ?string $id = NULL,
        ?string $uuid = NULL,
        ?string $creatorEmail = NULL,
        ?string $flags = NULL,
        ?string $tags = NULL,
        ?string $tagNames = NULL,
        ?int $color = NULL,
        ?string $rgb = NULL,
        ?int $date = NULL,
        array $metadatas = []
    )
    {
        $this->setMetadatas($metadatas);
        if (NULL !== $parentId) {
            $this->setParentId($parentId);
        }
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $uuid) {
            $this->setUuid($uuid);
        }
        if (NULL !== $creatorEmail) {
            $this->setCreatorEmail($creatorEmail);
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
        if (NULL !== $color) {
            $this->setColor($color);
        }
        if (NULL !== $rgb) {
            $this->setRgb($rgb);
        }
        if (NULL !== $date) {
            $this->setDate($date);
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
     * Gets uuid
     *
     * @return string
     */
    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    /**
     * Sets uuid
     *
     * @param  string $uuid
     * @return self
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * Gets parentId
     *
     * @return string
     */
    public function getParentId(): ?string
    {
        return $this->parentId;
    }

    /**
     * Sets parentId
     *
     * @param  string $parentId
     * @return self
     */
    public function setParentId(string $parentId): self
    {
        $this->parentId = $parentId;
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
     * Gets creatorEmail
     *
     * @return string
     */
    public function getCreatorEmail(): ?string
    {
        return $this->creatorEmail;
    }

    /**
     * Sets creatorEmail
     *
     * @param  string $creatorEmail
     * @return self
     */
    public function setCreatorEmail(string $creatorEmail): self
    {
        $this->creatorEmail = $creatorEmail;
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
