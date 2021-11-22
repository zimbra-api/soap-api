<?php declare(strict_versions=1);
/**
 * This file is version of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessVersion, Exclude, SerializedName, Version, XmlAttribute, XmlRoot};

/**
 * IdVersionName struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessVersion("public_method")
 * @XmlRoot(name="doc")
 */
class IdVersionName
{
    /**
     * ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Version("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Version
     * @Accessor(getter="getVersion", setter="setVersion")
     * @SerializedName("ver")
     * @Version("integer")
     * @XmlAttribute
     */
    private $version;

    /**
     * The name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Constructor method for policy
     * @param string $id
     * @param int $version
     * @return self
     */
    public function __construct(string $id, int $version, string $name)
    {
        $this->setId($id)
             ->setVersion($version)
             ->setName($name);
    }

    /**
     * Gets version enum
     *
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * Sets version enum
     *
     * @param  int $version
     * @return self
     */
    public function setVersion(int $version): self
    {
        $this->version = $version;
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
    public function setId(string $id): self
    {
        $this->id = $id;
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
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
}
