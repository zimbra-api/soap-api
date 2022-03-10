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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * IdAndType class
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class IdAndType
{
    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("string")
     * @XmlAttribute
     */
    private $type;

    /**
     * Constructor method for IdAndType
     * @param  string $id The id
     * @param  string $type The type
     * @return self
     */
    public function __construct(string $id, string $type)
    {
        $this->setId($id)
             ->setType($type);
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
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
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
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }
}
