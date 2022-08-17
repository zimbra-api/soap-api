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

/**
 * CommentInfo class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CommentInfo
{
    /**
     * Item ID of parent
     * 
     * @var string
     */
    #[Accessor(getter: 'getParentId', setter: 'setParentId')]
    #[SerializedName(name: 'parentId')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $parentId;

    /**
     * Item ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $id;

    /**
     * Item's UUID - a globally unique identifier
     * 
     * @var string
     */
    #[Accessor(getter: 'getUuid', setter: 'setUuid')]
    #[SerializedName(name: 'uuid')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $uuid;

    /**
     * Creator email address
     * 
     * @var string
     */
    #[Accessor(getter: 'getCreatorEmail', setter: 'setCreatorEmail')]
    #[SerializedName(name: 'email')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $creatorEmail;

    /**
     * Flags
     * 
     * @var string
     */
    #[Accessor(getter: 'getFlags', setter: 'setFlags')]
    #[SerializedName(name: 'f')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $flags;

    /**
     * Tags - Comma separated list of ints.  DEPRECATED - use "tn" instead
     * 
     * @var string
     */
    #[Accessor(getter: 'getTags', setter: 'setTags')]
    #[SerializedName(name: 't')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $tags;

    /**
     * Comma-separated list of tag names
     * 
     * @var string
     */
    #[Accessor(getter: 'getTagNames', setter: 'setTagNames')]
    #[SerializedName(name: 'tn')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $tagNames;

    /**
     * color numeric; range 0-127; defaults to 0 if not present; client can display only 0-7
     * 
     * @var int
     */
    #[Accessor(getter: 'getColor', setter: 'setColor')]
    #[SerializedName(name: 'color')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $color;

    /**
     * RGB color in format #rrggbb where r,g and b are hex digits
     * 
     * @var string
     */
    #[Accessor(getter: 'getRgb', setter: 'setRgb')]
    #[SerializedName(name: 'rgb')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $rgb;

    /**
     * Timestamp
     * 
     * @var int
     */
    #[Accessor(getter: 'getDate', setter: 'setDate')]
    #[SerializedName(name: 'd')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $date;

    /**
     * metadata and the subject as text
     * 
     * @var array
     */
    #[Accessor(getter: 'getMetadatas', setter: 'setMetadatas')]
    #[Type(name: 'array<Zimbra\Mail\Struct\MailCustomMetadata>')]
    #[XmlList(inline: true, entry: 'meta', namespace: 'urn:zimbraMail')]
    private $metadatas = [];

    /**
     * Constructor
     *
     * @param  string $parentId
     * @param  string $id
     * @param  string $uuid
     * @param  string $creatorEmail
     * @param  string $flags
     * @param  string $tags
     * @param  string $tagNames
     * @param  int $color
     * @param  string $rgb
     * @param  int $date
     * @param  array $metadatas
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
     * Get uuid
     *
     * @return string
     */
    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    /**
     * Set uuid
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
     * Get parentId
     *
     * @return string
     */
    public function getParentId(): ?string
    {
        return $this->parentId;
    }

    /**
     * Set parentId
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
     * Get color
     *
     * @return int
     */
    public function getColor(): ?int
    {
        return $this->color;
    }

    /**
     * Set color
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
     * Get rgb
     *
     * @return string
     */
    public function getRgb(): ?string
    {
        return $this->rgb;
    }

    /**
     * Set rgb
     *
     * @param  string $rgb
     * @return self
     */
    public function setRgb(string $rgb): self
    {
        $this->rgb = $rgb;
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
     * Get creatorEmail
     *
     * @return string
     */
    public function getCreatorEmail(): ?string
    {
        return $this->creatorEmail;
    }

    /**
     * Set creatorEmail
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
     * Set metadatas
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
     * Get metadatas
     *
     * @return array
     */
    public function getMetadatas(): array
    {
        return $this->metadatas;
    }
}
