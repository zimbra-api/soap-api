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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement,
    XmlList
};

/**
 * TagInfo class
 * A Tag Info
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class TagInfo
{
    /**
     * The folder id
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private string $id;

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
     * color numeric; range 0-127; defaults to 0 if not present; client can display only 0-7
     *
     * @var int
     */
    #[Accessor(getter: "getColor", setter: "setColor")]
    #[SerializedName("color")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $color = null;

    /**
     * RGB color in format #rrggbb where r,g and b are hex digits
     *
     * @var string
     */
    #[Accessor(getter: "getRgb", setter: "setRgb")]
    #[SerializedName("rgb")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $rgb = null;

    /**
     * Unread count. Only present if value > 0
     *
     * @var int
     */
    #[Accessor(getter: "getUnread", setter: "setUnread")]
    #[SerializedName("u")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $unread = null;

    /**
     * Item count. Only present if value > 0
     *
     * @var int
     */
    #[Accessor(getter: "getCount", setter: "setCount")]
    #[SerializedName("n")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $count = null;

    /**
     * Date
     *
     * @var int
     */
    #[Accessor(getter: "getDate", setter: "setDate")]
    #[SerializedName("d")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $date = null;

    /**
     * Revision
     *
     * @var int
     */
    #[Accessor(getter: "getRevision", setter: "setRevision")]
    #[SerializedName("rev")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $revision = null;

    /**
     * Modified date in seconds
     *
     * @var int
     */
    #[Accessor(getter: "getChangeDate", setter: "setChangeDate")]
    #[SerializedName("md")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $changeDate = null;

    /**
     * Modified sequence
     *
     * @var int
     */
    #[Accessor(getter: "getModifiedSequence", setter: "setModifiedSequence")]
    #[SerializedName("ms")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $modifiedSequence = null;

    /**
     * Custom metadata
     *
     * @var array
     */
    #[Accessor(getter: "getMetadatas", setter: "setMetadatas")]
    #[Type("array<Zimbra\Mail\Struct\MailCustomMetadata>")]
    #[XmlList(inline: true, entry: "meta", namespace: "urn:zimbraMail")]
    private array $metadatas = [];

    /**
     * Retention policy
     *
     * @var RetentionPolicy
     */
    #[Accessor(getter: "getRetentionPolicy", setter: "setRetentionPolicy")]
    #[SerializedName("retentionPolicy")]
    #[Type(RetentionPolicy::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?RetentionPolicy $retentionPolicy;

    /**
     * Constructor
     *
     * @param  string $id
     * @param  string $name
     * @param  int $color
     * @param  string $rgb
     * @param  int $unread
     * @param  int $count
     * @param  int $date
     * @param  int $revision
     * @param  int $changeDate
     * @param  int $modifiedSequence
     * @param  array $metadatas
     * @param  RetentionPolicy $retentionPolicy
     * @return self
     */
    public function __construct(
        string $id = "",
        ?string $name = null,
        ?int $color = null,
        ?string $rgb = null,
        ?int $unread = null,
        ?int $count = null,
        ?int $date = null,
        ?int $revision = null,
        ?int $changeDate = null,
        ?int $modifiedSequence = null,
        array $metadatas = [],
        ?RetentionPolicy $retentionPolicy = null
    ) {
        $this->setId($id)->setMetadatas($metadatas);
        $this->retentionPolicy = $retentionPolicy;
        if (null !== $name) {
            $this->setName($name);
        }
        if (null !== $color) {
            $this->setColor($color);
        }
        if (null !== $rgb) {
            $this->setRgb($rgb);
        }
        if (null !== $unread) {
            $this->setUnread($unread);
        }
        if (null !== $count) {
            $this->setCount($count);
        }
        if (null !== $date) {
            $this->setDate($date);
        }
        if (null !== $revision) {
            $this->setRevision($revision);
        }
        if (null !== $changeDate) {
            $this->setChangeDate($changeDate);
        }
        if (null !== $modifiedSequence) {
            $this->setModifiedSequence($modifiedSequence);
        }
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): string
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
     * Get name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name
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
     * Get unread
     *
     * @return int
     */
    public function getUnread(): ?int
    {
        return $this->unread;
    }

    /**
     * Set unread
     *
     * @param  int $unread
     * @return self
     */
    public function setUnread(int $unread): self
    {
        $this->unread = $unread;
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
     * Get count
     *
     * @return int
     */
    public function getCount(): ?int
    {
        return $this->count;
    }

    /**
     * Set count
     *
     * @param  int $count
     * @return self
     */
    public function setCount(int $count): self
    {
        $this->count = $count;
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
     * Set metadatas
     *
     * @param  array $metadatas
     * @return self
     */
    public function setMetadatas(array $metadatas): self
    {
        $this->metadatas = array_filter(
            $metadatas,
            static fn($metadata) => $metadata instanceof MailCustomMetadata
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

    /**
     * Get retentionPolicy
     *
     * @return RetentionPolicy
     */
    public function getRetentionPolicy(): ?RetentionPolicy
    {
        return $this->retentionPolicy;
    }

    /**
     * Set retentionPolicy
     *
     * @param  RetentionPolicy $retentionPolicy
     * @return self
     */
    public function setRetentionPolicy(RetentionPolicy $retentionPolicy): self
    {
        $this->retentionPolicy = $retentionPolicy;
        return $this;
    }
}
