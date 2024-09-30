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
use Zimbra\Common\Enum\Type as EnumType;

/**
 * Policy struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class Policy
{
    /**
     * Retention policy type
     *
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Enum<Zimbra\Common\Enum\Type>")
     * @XmlAttribute
     *
     * @var EnumType
     */
    #[Accessor(getter: "getType", setter: "setType")]
    #[SerializedName("type")]
    #[Type("Enum<Zimbra\Common\Enum\Type>")]
    #[XmlAttribute]
    private ?EnumType $type;

    /**
     * The id
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
     * The name
     *
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private $name;

    /**
     * The duration
     *
     * @Accessor(getter="getLifetime", setter="setLifetime")
     * @SerializedName("lifetime")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getLifetime", setter: "setLifetime")]
    #[SerializedName("lifetime")]
    #[Type("string")]
    #[XmlAttribute]
    private $lifetime;

    /**
     * Constructor
     *
     * @param EnumType $type
     * @param string $id
     * @param string $name
     * @param string $lifetime
     * @return self
     */
    public function __construct(
        ?EnumType $type = null,
        ?string $id = null,
        ?string $name = null,
        ?string $lifetime = null
    ) {
        $this->type = $type;
        if (null !== $id) {
            $this->setId($id);
        }
        if (null !== $name) {
            $this->setName($name);
        }
        if (null !== $lifetime) {
            $this->setLifetime($lifetime);
        }
    }

    public static function newUserPolicy(?string $lifetime = null): Policy
    {
        return new self(new EnumType("user"), null, null, $lifetime);
    }

    public static function newSystemPolicy(
        ?string $id = null,
        ?string $name = null,
        ?string $lifetime = null
    ): Policy {
        return new self(new EnumType("system"), $id, $name, $lifetime);
    }

    /**
     * Get type enum
     *
     * @return EnumType
     */
    public function getType(): ?EnumType
    {
        return $this->type;
    }

    /**
     * Set type enum
     *
     * @param  EnumType $type
     * @return self
     */
    public function setType(EnumType $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get ID
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Set ID
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
     * Get the lifetime
     *
     * @return string
     */
    public function getLifetime(): ?string
    {
        return $this->lifetime;
    }

    /**
     * Set the lifetime
     *
     * @param  string $lifetime
     * @return self
     */
    public function setLifetime(string $lifetime): self
    {
        $this->lifetime = $lifetime;
        return $this;
    }
}
