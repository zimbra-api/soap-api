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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\VolumeType;

/**
 * VolumeInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class VolumeInfo
{
    /**
     * Volume ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("integer")
     * @XmlAttribute
     */
    private $id;

    /**
     * Name or description of volume
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Absolute path to root of volume, e.g. /opt/zimbra/store
     * @Accessor(getter="getRootPath", setter="setRootPath")
     * @SerializedName("rootpath")
     * @Type("string")
     * @XmlAttribute
     */
    private $rootPath;

    /**
     * Volume type
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("integer")
     * @XmlAttribute
     */
    private $type;

    /**
     * Specifies whether blobs in this volume are compressed
     * @Accessor(getter="getCompressBlobs", setter="setCompressBlobs")
     * @SerializedName("compressBlobs")
     * @Type("bool")
     * @XmlAttribute
     */
    private $compressBlobs;

    /**
     * Long value that specifies the maximum uncompressed file size, in bytes, of blobs
     * that will not be compressed (in other words blobs larger than this threshold are compressed)
     * @Accessor(getter="getCompressionThreshold", setter="setCompressionThreshold")
     * @SerializedName("compressionThreshold")
     * @Type("integer")
     * @XmlAttribute
     */
    private $compressionThreshold;

    /**
     * The mgbits
     * @Accessor(getter="getMgbits", setter="setMgbits")
     * @SerializedName("mgbits")
     * @Type("integer")
     * @XmlAttribute
     */
    private $mgbits;

    /**
     * The mbits
     * @Accessor(getter="getMbits", setter="setMbits")
     * @SerializedName("mbits")
     * @Type("integer")
     * @XmlAttribute
     */
    private $mbits;

    /**
     * The fgbits
     * @Accessor(getter="getFgbits", setter="setFgbits")
     * @SerializedName("fgbits")
     * @Type("integer")
     * @XmlAttribute
     */
    private $fgbits;

    /**
     * The fbits
     * @Accessor(getter="getFbits", setter="setFbits")
     * @SerializedName("fbits")
     * @Type("integer")
     * @XmlAttribute
     */
    private $fbits;

    /**
     * Set if the volume is current.
     * @Accessor(getter="isCurrent", setter="setCurrent")
     * @SerializedName("isCurrent")
     * @Type("bool")
     * @XmlAttribute
     */
    private $current;

    /**
     * Constructor method for VolumeInfo
     * @param int    $id
     * @param string $name
     * @param string $rootPath
     * @param int    $type
     * @param bool   $compressBlobs
     * @param int    $compressionThreshold
     * @param int    $mgbits
     * @param int    $mbits
     * @param int    $fgbits
     * @param int    $fbits
     * @param bool   $current
     * @return self
     */
    public function __construct(
        ?int $id = NULL,
        ?string $name = NULL,
        ?string $rootPath = NULL,
        ?int $type = NULL,
        ?bool $compressBlobs = NULL,
        ?int $compressionThreshold = NULL,
        ?int $mgbits = NULL,
        ?int $mbits = NULL,
        ?int $fgbits = NULL,
        ?int $fbits = NULL,
        ?bool $current = NULL
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
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Sets the Id
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
     * Gets the type
     *
     * @return int
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * Sets the type
     *
     * @param  int $type
     * @return self
     */
    public function setType(int $type): self
    {
        $this->type = VolumeType::isValid($type) ? $type : VolumeType::PRIMARY()->getValue();
        return $this;
    }

    /**
     * Gets the compression threshold
     *
     * @return int
     */
    public function getCompressionThreshold(): ?int
    {
        return $this->compressionThreshold;
    }

    /**
     * Sets the compression threshold
     *
     * @param  int $compressionThreshold
     * @return self
     */
    public function setCompressionThreshold(int $compressionThreshold): self
    {
        $this->compressionThreshold = $compressionThreshold;
        return $this;
    }

    /**
     * Gets the mgbits
     *
     * @return int
     */
    public function getMgbits(): ?int
    {
        return $this->mgbits;
    }

    /**
     * Sets the mgbits
     *
     * @param  int $mgbits
     * @return self
     */
    public function setMgbits(int $mgbits): self
    {
        $this->mgbits = $mgbits;
        return $this;
    }

    /**
     * Gets the mbits
     *
     * @return int
     */
    public function getMbits(): ?int
    {
        return $this->mbits;
    }

    /**
     * Sets the mbits
     *
     * @param  int $mbits
     * @return self
     */
    public function setMbits(int $mbits): self
    {
        $this->mbits = $mbits;
        return $this;
    }

    /**
     * Gets the fgbits
     *
     * @return int
     */
    public function getFgbits(): ?int
    {
        return $this->fgbits;
    }

    /**
     * Sets the fgbits
     *
     * @param  int $fgbits
     * @return self
     */
    public function setFgbits(int $fgbits): self
    {
        $this->fgbits = $fgbits;
        return $this;
    }

    /**
     * Gets the fbits
     *
     * @return int
     */
    public function getFbits(): ?int
    {
        return $this->fbits;
    }

    /**
     * Sets the fbits
     *
     * @param  int $fbits
     * @return self
     */
    public function setFbits(int $fbits): self
    {
        $this->fbits = $fbits;
        return $this;
    }

    /**
     * Sets the name
     *
     * @return string
     */
    public function getName(): ?string
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

    /**
     * Sets the root path
     *
     * @return string
     */
    public function getRootPath(): ?string
    {
        return $this->rootPath;
    }

    /**
     * Sets the root path
     *
     * @param  string $rootpath
     * @return self
     */
    public function setRootPath(string $rootPath): self
    {
        $this->rootPath = $rootPath;
        return $this;
    }

    /**
     * Gets the compress blobs
     *
     * @return bool
     */
    public function getCompressBlobs(): ?bool
    {
        return $this->compressBlobs;
    }

    /**
     * Sets the compress blobs
     *
     * @param  bool $compressBlobs
     * @return self
     */
    public function setCompressBlobs(bool $compressBlobs): self
    {
        $this->compressBlobs = $compressBlobs;
        return $this;
    }

    /**
     * Gets is current
     *
     * @return bool
     */
    public function isCurrent(): ?bool
    {
        return $this->current;
    }

    /**
     * Sets the current
     *
     * @param  bool $current
     * @return self
     */
    public function setCurrent(bool $current): self
    {
        $this->current = $current;
        return $this;
    }
}
