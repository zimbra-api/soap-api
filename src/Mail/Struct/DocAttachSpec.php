<?php declare(strict_types=1);
/**
 * This file is id of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * DocAttachSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="doc")
 */
class DocAttachSpec extends AttachSpec
{
    /**
     * Document path.  If specified "id" and "ver" attributes are ignored
     * @Accessor(getter="getPath", setter="setPath")
     * @SerializedName("path")
     * @Type("string")
     * @XmlAttribute
     */
    private $path;

    /**
     * Item ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Optional Version.
     * @Accessor(getter="getVersion", setter="setVersion")
     * @SerializedName("ver")
     * @Type("integer")
     * @XmlAttribute
     */
    private $version;

    /**
     * Constructor method
     * 
     * @param string $path
     * @param string $id
     * @param int $version
     * @param bool $optional
     * @return self
     */
    public function __construct(
        string $path = NULL, string $id = NULL, ?int $version = NULL, ?bool $optional = NULL
    )
    {
        parent::__construct($optional);
        if (NULL !== $path) {
            $this->setPath($path);
        }
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $version) {
            $this->setVersion($version);
        }
    }

    /**
     * Gets path
     *
     * @return string
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * Sets path
     *
     * @param  string $type
     * @return self
     */
    public function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Gets the id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Sets the id
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
     * Gets version
     *
     * @return int
     */
    public function getVersion(): ?int
    {
        return $this->version;
    }

    /**
     * Sets version
     *
     * @param  int $type
     * @return self
     */
    public function setVersion(int $version): self
    {
        $this->version = $version;
        return $this;
    }
}
