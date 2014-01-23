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
        $this->property('id', (int) $id);
        $type = in_array((int) $type, array(1, 2, 10)) ? (int) $type : 1;
        $this->property('type', $type);
        $this->property('compressionThreshold', (int) $compressionThreshold);
        $this->property('mgbits', (int) $mgbits);
        $this->property('mbits', (int) $mbits);
        $this->property('fgbits', (int) $fgbits);
        $this->property('fbits', (int) $fbits);

        if(null !== $name)
        {
            $this->property('name', trim($name));
        }
        if(null !== $rootpath)
        {
            $this->property('rootpath', trim($rootpath));
        }

        if(null !== $compressBlobs)
        {
            $this->property('compressBlobs', (bool) $compressBlobs);
        }
        if(null !== $isCurrent)
        {
            $this->property('isCurrent', (bool) $isCurrent);
        }
    }

    /**
     * Gets or sets id
     *
     * @param  int $id
     * @return int|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', (int) $id);
    }

    /**
     * Gets or sets type
     *
     * @param  int $type
     * @return int|self
     */
    public function type($type = null)
    {
        if(null === $type)
        {
            return $this->property('type');
        }
        $type = in_array((int) $type, array(1, 2, 10)) ? (int) $type : 1;
        return $this->property('type', $type);
    }

    /**
     * Gets or sets compressionThreshold
     *
     * @param  int $compressionThreshold
     * @return int|self
     */
    public function compressionThreshold($compressionThreshold = null)
    {
        if(null === $compressionThreshold)
        {
            return $this->property('compressionThreshold');
        }
        return $this->property('compressionThreshold', (int) $compressionThreshold);
    }

    /**
     * Gets or sets mgbits
     *
     * @param  int $mgbits
     * @return int|self
     */
    public function mgbits($mgbits = null)
    {
        if(null === $mgbits)
        {
            return $this->property('mgbits');
        }
        return $this->property('mgbits', (int) $mgbits);
    }

    /**
     * Gets or sets mbits
     *
     * @param  int $mbits
     * @return int|self
     */
    public function mbits($mbits = null)
    {
        if(null === $mbits)
        {
            return $this->property('mbits');
        }
        return $this->property('mbits', (int) $mbits);
    }

    /**
     * Gets or sets fgbits
     *
     * @param  int $fgbits
     * @return int|self
     */
    public function fgbits($fgbits = null)
    {
        if(null === $fgbits)
        {
            return $this->property('fgbits');
        }
        return $this->property('fgbits', (int) $fgbits);
    }

    /**
     * Gets or sets fbits
     *
     * @param  int $fbits
     * @return int|self
     */
    public function fbits($fbits = null)
    {
        if(null === $fbits)
        {
            return $this->property('fbits');
        }
        return $this->property('fbits', (int) $fbits);
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->property('name');
        }
        return $this->property('name', trim($name));
    }

    /**
     * Gets or sets rootpath
     *
     * @param  string $rootpath
     * @return string|self
     */
    public function rootpath($rootpath = null)
    {
        if(null === $rootpath)
        {
            return $this->property('rootpath');
        }
        return $this->property('rootpath', trim($rootpath));
    }

    /**
     * Gets or sets compressBlobs
     *
     * @param  bool $compressBlobs
     * @return bool|self
     */
    public function compressBlobs($compressBlobs = null)
    {
        if(null === $compressBlobs)
        {
            return $this->property('compressBlobs');
        }
        return $this->property('compressBlobs', (bool) $compressBlobs);
    }

    /**
     * Gets or sets isCurrent
     *
     * @param  bool $isCurrent
     * @return bool|self
     */
    public function isCurrent($isCurrent = null)
    {
        if(null === $isCurrent)
        {
            return $this->property('isCurrent');
        }
        return $this->property('isCurrent', (bool) $isCurrent);
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
