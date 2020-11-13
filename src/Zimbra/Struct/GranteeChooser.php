<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * GranteeChooser class
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="grantee")
 */
class GranteeChooser
{
    /**
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("string")
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
     * Constructor method for GranteeChooser
     * @param string $type
     * @param string $id
     * @param string $name
     * @return self
     */
    public function __construct($type = NULL, $id = NULL, $name = NULL)
    {
        if (NULL !== $type) {
            $this->setType($type);
        }
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $name) {
            $this->setName($name);
        }
    }

    /**
     * Gets a type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Sets a type
     *
     * @param  string $type
     * @return self
     */
    public function setType($type): self
    {
        $this->type = trim($type);
        return $this;
    }

    /**
     * Gets an id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets an id
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
     * Gets a name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets a name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name): self
    {
        $this->name = trim($name);
        return $this;
    }
}
