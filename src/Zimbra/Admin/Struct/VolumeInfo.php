<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Enum\VolumeType;

/**
 * VolumeInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
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
    private $_id;

    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $_name;

    /**
     * @Accessor(getter="getRootPath", setter="setRootPath")
     * @SerializedName("rootpath")
     * @Type("string")
     * @XmlAttribute
     */
    private $_rootPath;

    /**
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("integer")
     * @XmlAttribute
     */
    private $_type;

    /**
     * @Accessor(getter="getCompressBlobs", setter="setCompressBlobs")
     * @SerializedName("compressBlobs")
     * @Type("bool")
     * @XmlAttribute
     */
    private $_compressBlobs;

    /**
     * @Accessor(getter="getCompressionThreshold", setter="setCompressionThreshold")
     * @SerializedName("compressionThreshold")
     * @Type("integer")
     * @XmlAttribute
     */
    private $_compressionThreshold;

    /**
     * @Accessor(getter="getMgbits", setter="setMgbits")
     * @SerializedName("mgbits")
     * @Type("integer")
     * @XmlAttribute
     */
    private $_mgbits;

    /**
     * @Accessor(getter="getMbits", setter="setMbits")
     * @SerializedName("mbits")
     * @Type("integer")
     * @XmlAttribute
     */
    private $_mbits;

    /**
     * @Accessor(getter="getFgbits", setter="setFgbits")
     * @SerializedName("fgbits")
     * @Type("integer")
     * @XmlAttribute
     */
    private $_fgbits;

    /**
     * @Accessor(getter="getFbits", setter="setFbits")
     * @SerializedName("fbits")
     * @Type("integer")
     * @XmlAttribute
     */
    private $_fbits;

    /**
     * @Accessor(getter="isCurrent", setter="setCurrent")
     * @SerializedName("isCurrent")
     * @Type("bool")
     * @XmlAttribute
     */
    private $_current;

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
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Sets the Id
     *
     * @param  int $id
     * @return self
     */
    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    /**
     * Gets the type
     *
     * @return int
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * Sets the type
     *
     * @param  int $type
     * @return self
     */
    public function setType($type)
    {
        $type = in_array((int) $type, VolumeType::enums()) ? (int) $type : 1;
        $this->_type = $type;
        return $this;
    }

    /**
     * Gets the compression threshold
     *
     * @return int
     */
    public function getCompressionThreshold()
    {
        return $this->_compressionThreshold;
    }

    /**
     * Sets the compression threshold
     *
     * @param  int $compressionThreshold
     * @return self
     */
    public function setCompressionThreshold($compressionThreshold)
    {
        $this->_compressionThreshold = (int) $compressionThreshold;
        return $this;
    }

    /**
     * Gets the mgbits
     *
     * @return int
     */
    public function getMgbits()
    {
        return $this->_mgbits;
    }

    /**
     * Sets the mgbits
     *
     * @param  int $mgbits
     * @return self
     */
    public function setMgbits($mgbits)
    {
        $this->_mgbits = (int) $mgbits;
        return $this;
    }

    /**
     * Gets the mbits
     *
     * @return int
     */
    public function getMbits()
    {
        return $this->_mbits;
    }

    /**
     * Sets the mbits
     *
     * @param  int $mbits
     * @return self
     */
    public function setMbits($mbits)
    {
        $this->_mbits = (int) $mbits;
        return $this;
    }

    /**
     * Gets the fgbits
     *
     * @return int
     */
    public function getFgbits()
    {
        return $this->_fgbits;
    }

    /**
     * Sets the fgbits
     *
     * @param  int $fgbits
     * @return self
     */
    public function setFgbits($fgbits)
    {
        $this->_fgbits = (int) $fgbits;
        return $this;
    }

    /**
     * Gets the fbits
     *
     * @return int
     */
    public function getFbits()
    {
        return $this->_fbits;
    }

    /**
     * Sets the fbits
     *
     * @param  int $fbits
     * @return self
     */
    public function setFbits($fbits)
    {
        $this->_fbits = (int) $fbits;
        return $this;
    }

    /**
     * Sets the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Sets the name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        $this->_name = trim($name);
        return $this;
    }

    /**
     * Sets the root path
     *
     * @return string
     */
    public function getRootPath()
    {
        return $this->_rootPath;
    }

    /**
     * Sets the root path
     *
     * @param  string $rootpath
     * @return self
     */
    public function setRootPath($rootPath)
    {
        $this->_rootPath = trim($rootPath);
        return $this;
    }

    /**
     * Gets the compress blobs
     *
     * @return bool
     */
    public function getCompressBlobs()
    {
        return $this->_compressBlobs;
    }

    /**
     * Sets the compress blobs
     *
     * @param  bool $compressBlobs
     * @return self
     */
    public function setCompressBlobs($compressBlobs)
    {
        $this->_compressBlobs = (bool) $compressBlobs;
        return $this;
    }

    /**
     * Gets is current
     *
     * @return bool
     */
    public function isCurrent()
    {
        return $this->_current;
    }

    /**
     * Sets the current
     *
     * @param  bool $current
     * @return self
     */
    public function setCurrent($current)
    {
        $this->_current = (bool) $current;
        return $this;
    }
}
