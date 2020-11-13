<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Enum\VolumeType;

/**
 * VolumeInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="volume")
 */
class VolumeInfo
{
    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("integer")
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
     * @Accessor(getter="getRootPath", setter="setRootPath")
     * @SerializedName("rootpath")
     * @Type("string")
     * @XmlAttribute
     */
    private $rootPath;

    /**
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("integer")
     * @XmlAttribute
     */
    private $type;

    /**
     * @Accessor(getter="getCompressBlobs", setter="setCompressBlobs")
     * @SerializedName("compressBlobs")
     * @Type("bool")
     * @XmlAttribute
     */
    private $compressBlobs;

    /**
     * @Accessor(getter="getCompressionThreshold", setter="setCompressionThreshold")
     * @SerializedName("compressionThreshold")
     * @Type("integer")
     * @XmlAttribute
     */
    private $compressionThreshold;

    /**
     * @Accessor(getter="getMgbits", setter="setMgbits")
     * @SerializedName("mgbits")
     * @Type("integer")
     * @XmlAttribute
     */
    private $mgbits;

    /**
     * @Accessor(getter="getMbits", setter="setMbits")
     * @SerializedName("mbits")
     * @Type("integer")
     * @XmlAttribute
     */
    private $mbits;

    /**
     * @Accessor(getter="getFgbits", setter="setFgbits")
     * @SerializedName("fgbits")
     * @Type("integer")
     * @XmlAttribute
     */
    private $fgbits;

    /**
     * @Accessor(getter="getFbits", setter="setFbits")
     * @SerializedName("fbits")
     * @Type("integer")
     * @XmlAttribute
     */
    private $fbits;

    /**
     * @Accessor(getter="isCurrent", setter="setCurrent")
     * @SerializedName("isCurrent")
     * @Type("bool")
     * @XmlAttribute
     */
    private $current;

    /**
     * Constructor method for VolumeInfo
     * @param int    $id Volume ID
     * @param string $name Name or description of volume
     * @param string $rootPath Absolute path to root of volume, e.g. /opt/zimbra/store
     * @param int    $type Volume type
     * @param bool   $compressBlobs Specifies whether blobs in this volume are compressed
     * @param int    $compressionThreshold Long value that specifies the maximum uncompressed file size, in bytes, of blobs that will not be compressed (in other words blobs larger than this threshold are compressed)
     * @param int    $mgbits The mgbits
     * @param int    $mbits The mbits
     * @param int    $fgbits The fgbits
     * @param int    $fbits The fbits
     * @param bool   $current Set if the volume is current.
     * @return self
     */
    public function __construct(
        $id = NULL,
        $name = NULL,
        $rootPath = NULL,
        $type = NULL,
        $compressBlobs = NULL,
        $compressionThreshold = NULL,
        $mgbits = NULL,
        $mbits = NULL,
        $fgbits = NULL,
        $fbits = NULL,
        $current = NULL
    )
    {
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $name) {
            $this->setName($name);
        }
        if (NULL !== $rootPath) {
            $this->setRootPath($rootPath);
        }
        if (NULL !== $type) {
            $this->setType($type);
        }
        if (NULL !== $compressBlobs) {
            $this->setCompressBlobs($compressBlobs);
        }
        if (NULL !== $compressionThreshold) {
            $this->setCompressionThreshold($compressionThreshold);
        }
        if (NULL !== $mgbits) {
            $this->setMgbits($mgbits);
        }
        if (NULL !== $mbits) {
            $this->setMbits($mbits);
        }
        if (NULL !== $fgbits) {
            $this->setFgbits($fgbits);
        }
        if (NULL !== $fbits) {
            $this->setFbits($fbits);
        }
        if (NULL !== $current) {
            $this->setCurrent($current);
        }
    }

    /**
     * Gets the Id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Sets the Id
     *
     * @param  int $id
     * @return self
     */
    public function setId($id): self
    {
        $this->id = (int) $id;
        return $this;
    }

    /**
     * Gets the type
     *
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * Sets the type
     *
     * @param  int $type
     * @return self
     */
    public function setType($type): self
    {
        $this->type = VolumeType::isValid((int) $type) ? (int) $type : 1;
        return $this;
    }

    /**
     * Gets the compression threshold
     *
     * @return int
     */
    public function getCompressionThreshold(): int
    {
        return $this->compressionThreshold;
    }

    /**
     * Sets the compression threshold
     *
     * @param  int $compressionThreshold
     * @return self
     */
    public function setCompressionThreshold($compressionThreshold): self
    {
        $this->compressionThreshold = (int) $compressionThreshold;
        return $this;
    }

    /**
     * Gets the mgbits
     *
     * @return int
     */
    public function getMgbits(): int
    {
        return $this->mgbits;
    }

    /**
     * Sets the mgbits
     *
     * @param  int $mgbits
     * @return self
     */
    public function setMgbits($mgbits): self
    {
        $this->mgbits = (int) $mgbits;
        return $this;
    }

    /**
     * Gets the mbits
     *
     * @return int
     */
    public function getMbits(): int
    {
        return $this->mbits;
    }

    /**
     * Sets the mbits
     *
     * @param  int $mbits
     * @return self
     */
    public function setMbits($mbits): self
    {
        $this->mbits = (int) $mbits;
        return $this;
    }

    /**
     * Gets the fgbits
     *
     * @return int
     */
    public function getFgbits(): int
    {
        return $this->fgbits;
    }

    /**
     * Sets the fgbits
     *
     * @param  int $fgbits
     * @return self
     */
    public function setFgbits($fgbits): self
    {
        $this->fgbits = (int) $fgbits;
        return $this;
    }

    /**
     * Gets the fbits
     *
     * @return int
     */
    public function getFbits(): int
    {
        return $this->fbits;
    }

    /**
     * Sets the fbits
     *
     * @param  int $fbits
     * @return self
     */
    public function setFbits($fbits): self
    {
        $this->fbits = (int) $fbits;
        return $this;
    }

    /**
     * Sets the name
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
     * Sets the root path
     *
     * @return string
     */
    public function getRootPath(): string
    {
        return $this->rootPath;
    }

    /**
     * Sets the root path
     *
     * @param  string $rootpath
     * @return self
     */
    public function setRootPath($rootPath): self
    {
        $this->rootPath = trim($rootPath);
        return $this;
    }

    /**
     * Gets the compress blobs
     *
     * @return bool
     */
    public function getCompressBlobs(): bool
    {
        return $this->compressBlobs;
    }

    /**
     * Sets the compress blobs
     *
     * @param  bool $compressBlobs
     * @return self
     */
    public function setCompressBlobs($compressBlobs): self
    {
        $this->compressBlobs = (bool) $compressBlobs;
        return $this;
    }

    /**
     * Gets is current
     *
     * @return bool
     */
    public function isCurrent(): bool
    {
        return $this->current;
    }

    /**
     * Sets the current
     *
     * @param  bool $current
     * @return self
     */
    public function setCurrent($current): self
    {
        $this->current = (bool) $current;
        return $this;
    }
}
