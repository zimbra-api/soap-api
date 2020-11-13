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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Enum\Type as EnumType;

/**
 * Policy struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="policy")
 */
class Policy
{
    /**
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Zimbra\Enum\Type")
     * @XmlAttribute
     */
    private $type;

    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * @Accessor(getter="getLifetime", setter="setLifetime")
     * @SerializedName("lifetime")
     * @Type("string")
     * @XmlAttribute
     */
    private $lifetime;

    /**
     * Constructor method for policy
     * @param EnumType $type Retention policy type
     * @param string $id The id
     * @param string $name The name
     * @param string $lifetime The duration
     * @return self
     */
    public function __construct(EnumType $type = NULL, $id = NULL, $name = NULL, $lifetime = NULL)
    {
        if ($type instanceof EnumType) {
            $this->setType($type);
        }
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $name) {
            $this->setName($name);
        }
        if (NULL !== $lifetime) {
            $this->setLifetime($lifetime);
        }
    }

    public static function newUserPolicy($lifetime = NULL)
    {
        return new self(EnumType::USER(), NULL, NULL, $lifetime);
    }

    public static function newSystemPolicy($id = NULL, $name = NULL, $lifetime = NULL)
    {
        return new self(EnumType::SYSTEM(), $id, $name, $lifetime);
    }

    /**
     * Gets type enum
     *
     * @return EnumType
     */
    public function getType(): EnumType
    {
        return $this->type;
    }

    /**
     * Sets type enum
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
     * Gets ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id): self
    {
        $this->id = trim($id);
        return $this;
    }

    /**
     * Gets the name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name): self
    {
        $this->name = trim($name);
        return $this;
    }

    /**
     * Gets the lifetime
     *
     * @return string
     */
    public function getLifetime(): string
    {
        return $this->lifetime;
    }

    /**
     * Sets the lifetime
     *
     * @param  string $lifetime
     * @return self
     */
    public function setLifetime($lifetime): self
    {
        $this->lifetime = trim($lifetime);
        return $this;
    }
}
