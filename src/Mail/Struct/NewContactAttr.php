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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};

/**
 * NewContactAttr class
 * New contact attribute
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class NewContactAttr
{
    /**
     * Attribute name
     * 
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("n")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName(name: 'n')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $name;

    /**
     * Upload ID
     * 
     * @Accessor(getter="getAttachId", setter="setAttachId")
     * @SerializedName("aid")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getAttachId', setter: 'setAttachId')]
    #[SerializedName(name: 'aid')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $attachId;

    /**
     * Item ID.  Used in combination with subpart-name
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $id;

    /**
     * Subpart Name
     * 
     * @Accessor(getter="getPart", setter="setPart")
     * @SerializedName("part")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getPart', setter: 'setPart')]
    #[SerializedName(name: 'part')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $part;

    /**
     * Attribute data
     * 
     * Date related attributes like "birthday" and "anniversary" SHOULD use "yyyy-MM-dd" format or,
     * if the year isn't specified "--MM-dd" format
     * 
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     * 
     * @var string
     */
    #[Accessor(getter: 'getValue', setter: 'setValue')]
    #[Type(name: 'string')]
    #[XmlValue(cdata: false)]
    private $value;

    /**
     * Constructor
     *
     * @param  string $name
     * @param  string $attachId
     * @param  int $id
     * @param  string $part
     * @param  string $value
     * @return self
     */
    public function __construct(
        string $name = '', ?string $attachId = NULL, ?int $id = NULL, ?string $part = NULL, ?string $value = NULL
    )
    {
        $this->setName($name);
        if (NULL !== $attachId) {
            $this->setAttachId($attachId);
        }
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $part) {
            $this->setPart($part);
        }
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
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
     * Get attachId
     *
     * @return string
     */
    public function getAttachId(): ?string
    {
        return $this->attachId;
    }

    /**
     * Set attachId
     *
     * @param  string $attachId
     * @return self
     */
    public function setAttachId(string $attachId): self
    {
        $this->attachId = $attachId;
        return $this;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param  int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get part
     *
     * @return string
     */
    public function getPart(): ?string
    {
        return $this->part;
    }

    /**
     * Set part
     *
     * @param  string $part
     * @return self
     */
    public function setPart(string $part): self
    {
        $this->part = $part;
        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
