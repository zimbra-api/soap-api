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

use Zimbra\Enum\VolumeType;
use Zimbra\Struct\Base;

/**
 * VolumeInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class VolumeInfo extends Base
{
    /**
     * Constructor method for VolumeInfo
     * @param int    $id Volume ID
     * @param int    $type Volume type
     * @param int    $compressionThreshold Long value that specifies the maximum uncompressed file size, in bytes, of blobs that will not be compressed (in other words blobs larger than this threshold are compressed)
     * @param int    $mgbits The mgbits
     * @param int    $mbits The mbits
     * @param int    $fgbits The fgbits
     * @param int    $fbits The fbits
     * @param string $name Name or description of volume
     * @param string $rootpath Absolute path to root of volume, e.g. /opt/zimbra/store
     * @param bool   $compressBlobs Specifies whether blobs in this volume are compressed
     * @param bool   $isCurrent Set if the volume is current.
     * @return self
     */
    public function __construct(
        $id,
        $type,
        $compressionThreshold,
        $mgbits,
        $mbits,
        $fgbits,
        $fbits,
        $name = null,
        $rootpath = null,
        $compressBlobs = null,
        $isCurrent = null
    )
    {
        parent::__construct();
        $this->setProperty('id', (int) $id);
        $this->setType($type);
        $this->setProperty('compressionThreshold', (int) $compressionThreshold);
        $this->setProperty('mgbits', (int) $mgbits);
        $this->setProperty('mbits', (int) $mbits);
        $this->setProperty('fgbits', (int) $fgbits);
        $this->setProperty('fbits', (int) $fbits);

        if(null !== $name)
        {
            $this->setProperty('name', trim($name));
        }
        if(null !== $rootpath)
        {
            $this->setProperty('rootpath', trim($rootpath));
        }

        if(null !== $compressBlobs)
        {
            $this->setProperty('compressBlobs', (bool) $compressBlobs);
        }
        if(null !== $isCurrent)
        {
            $this->setProperty('isCurrent', (bool) $isCurrent);
        }
    }

    /**
     * Gets the Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets the Id
     *
     * @param  int $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', (int) $id);
    }

    /**
     * Gets the type
     *
     * @return int
     */
    public function getType()
    {
        return $this->getProperty('type');
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
        return $this->setProperty('type', $type);
    }

    /**
     * Gets the compression threshold
     *
     * @return int
     */
    public function getCompressionThreshold()
    {
        return $this->getProperty('compressionThreshold');
    }

    /**
     * Sets the compression threshold
     *
     * @param  int $compressionThreshold
     * @return self
     */
    public function setCompressionThreshold($compressionThreshold)
    {
        return $this->setProperty('compressionThreshold', (int) $compressionThreshold);
    }

    /**
     * Gets the mgbits
     *
     * @return int
     */
    public function getMgbits()
    {
        return $this->getProperty('mgbits');
    }

    /**
     * Sets the mgbits
     *
     * @param  int $mgbits
     * @return self
     */
    public function setMgbits($mgbits)
    {
        return $this->setProperty('mgbits', (int) $mgbits);
    }

    /**
     * Gets the mbits
     *
     * @return int
     */
    public function getMbits()
    {
        return $this->getProperty('mbits');
    }

    /**
     * Sets the mbits
     *
     * @param  int $mbits
     * @return self
     */
    public function setMbits($mbits)
    {
        return $this->setProperty('mbits', (int) $mbits);
    }

    /**
     * Gets the fgbits
     *
     * @return int
     */
    public function getFgbits()
    {
        return $this->getProperty('fgbits');
    }

    /**
     * Sets the fgbits
     *
     * @param  int $fgbits
     * @return self
     */
    public function setFgbits($fgbits)
    {
        return $this->setProperty('fgbits', (int) $fgbits);
    }

    /**
     * Gets the fbits
     *
     * @return int
     */
    public function getFbits()
    {
        return $this->getProperty('fbits');
    }

    /**
     * Sets the fbits
     *
     * @param  int $fbits
     * @return self
     */
    public function setFbits($fbits)
    {
        return $this->setProperty('fbits', (int) $fbits);
    }

    /**
     * Sets the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets the name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Sets the root path
     *
     * @return string
     */
    public function getRootPath()
    {
        return $this->getProperty('rootpath');
    }

    /**
     * Sets the root path
     *
     * @param  string $rootpath
     * @return self
     */
    public function setRootPath($rootpath)
    {
        return $this->setProperty('rootpath', trim($rootpath));
    }

    /**
     * Gets the compress blobs
     *
     * @return bool
     */
    public function getCompressBlobs()
    {
        return $this->getProperty('compressBlobs');
    }

    /**
     * Sets the compress blobs
     *
     * @param  bool $compressBlobs
     * @return self
     */
    public function setCompressBlobs($compressBlobs)
    {
        return $this->setProperty('compressBlobs', (bool) $compressBlobs);
    }

    /**
     * Gets is current
     *
     * @return bool
     */
    public function isCurrent()
    {
        return $this->getProperty('isCurrent');
    }

    /**
     * Sets the current
     *
     * @param  bool $isCurrent
     * @return self
     */
    public function setCurrent($isCurrent)
    {
        return $this->setProperty('isCurrent', (bool) $isCurrent);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'volume')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'volume')
    {
        return parent::toXml($name);
    }
}
