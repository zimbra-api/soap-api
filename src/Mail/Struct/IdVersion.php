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
 * IdVersion struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessVersion("public_method")
 * @XmlRoot(name="doc")
 */
class IdVersion
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
     * Constructor method for policy
     * @param string $id
     * @param int $version
     * @return self
     */
    public function __construct(string $id, ?int $version = NULL)
    {
        $this->setId($id);
        if (NULL !== $version) {
            $this->setVersion($version);
        }
    }

    /**
     * Gets version enum
     *
     * @return int
     */
    public function getVersion(): ?int
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
}
