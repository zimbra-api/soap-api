<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * VolumeInfo class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class VolumeInfo
{
    /**
     * Volume ID
     * @var int
     */
    private $_id;

    /**
     * Volume type
     * @var int
     */
    private $_type;

    /**
     * Long value that specifies the maximum uncompressed file size, in bytes, of blobs that will not be compressed (in other words blobs larger than this threshold are compressed)
     * @var int
     */
    private $_compressionThreshold;

    /**
     * The mgbits
     * @var int
     */
    private $_mgbits;

    /**
     * The mbits
     * @var int
     */
    private $_mbits;

    /**
     * The fgbits
     * @var int
     */
    private $_fgbits;

    /**
     * The fbits
     * @var int
     */
    private $_fbits;

    /**
     * Name or description of volume
     * @var string
     */
    private $_name;

    /**
     * Absolute path to root of volume, e.g. /opt/zimbra/store
     * @var string
     */
    private $_rootpath;

    /**
     * Specifies whether blobs in this volume are compressed
     * @var boolean
     */
    private $_compressBlobs;

    /**
     * Set if the volume is current.
     * @var boolean
     */
    private $_isCurrent;

    /**
     * Constructor method for volumeInfo
     * @param int    $id
     * @param int    $type
     * @param int    $compressionThreshold
     * @param int    $mgbits
     * @param int    $mbits
     * @param int    $fgbits
     * @param int    $fbits
     * @param string $name
     * @param string $rootpath
     * @param bool   $compressBlobs
     * @param bool   $isCurrent
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
        $this->_id = (int) $id;
        $this->_type = in_array((int) $type, array(1, 2, 10)) ? (int) $type : 1;
        $this->_compressionThreshold = (int) $compressionThreshold;
        $this->_mgbits = (int) $mgbits;
        $this->_mbits = (int) $mbits;
        $this->_fgbits = (int) $fgbits;
        $this->_fbits = (int) $fbits;

        $this->_name = trim($name);
        $this->_rootpath = trim($rootpath);

        if(null !== $compressBlobs)
        {
            $this->_compressBlobs = (bool) $compressBlobs;
        }
        if(null !== $isCurrent)
        {
            $this->_isCurrent = (bool) $isCurrent;
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
            return $this->_id;
        }
        $this->_id = (int) $id;
        return $this;
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
            return $this->_type;
        }
        $this->_type = in_array((int) $type, array(1, 2, 10)) ? (int) $type : 1;
        return $this;
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
            return $this->_compressionThreshold;
        }
        $this->_compressionThreshold = (int) $compressionThreshold;
        return $this;
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
            return $this->_mgbits;
        }
        $this->_mgbits = (int) $mgbits;
        return $this;
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
            return $this->_mbits;
        }
        $this->_mbits = (int) $mbits;
        return $this;
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
            return $this->_fgbits;
        }
        $this->_fgbits = (int) $fgbits;
        return $this;
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
            return $this->_fbits;
        }
        $this->_fbits = (int) $fbits;
        return $this;
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
            return $this->_name;
        }
        $this->_name = trim($name);
        return $this;
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
            return $this->_rootpath;
        }
        $this->_rootpath = trim($rootpath);
        return $this;
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
            return $this->_compressBlobs;
        }
        $this->_compressBlobs = (bool) $compressBlobs;
        return $this;
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
            return $this->_isCurrent;
        }
        $this->_isCurrent = (bool) $isCurrent;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'volume')
    {
        $name = !empty($name) ? $name : 'volume';
        $arr = array(
            'id' => $this->_id,
            'type' => $this->_type,
            'compressionThreshold' => $this->_compressionThreshold,
            'mgbits' => $this->_mgbits,
            'mbits' => $this->_mbits,
            'fgbits' => $this->_fgbits,
            'fbits' => $this->_fbits,
        );
        if(!empty($this->_name))
        {
            $arr['name'] = $this->_name;
        }
        if(!empty($this->_rootpath))
        {
            $arr['rootpath'] = $this->_rootpath;
        }
        if(is_bool($this->_compressBlobs))
        {
            $arr['compressBlobs'] = $this->_compressBlobs ? 1: 0;
        }
        if(is_bool($this->_isCurrent))
        {
            $arr['isCurrent'] = $this->_isCurrent ? 1: 0;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'volume')
    {
        $name = !empty($name) ? $name : 'volume';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('id', $this->_id)
            ->addAttribute('type', $this->_type)
            ->addAttribute('compressionThreshold', $this->_compressionThreshold)
            ->addAttribute('mgbits', $this->_mgbits)
            ->addAttribute('mbits', $this->_mbits)
            ->addAttribute('fgbits', $this->_fgbits)
            ->addAttribute('fbits', $this->_fbits);
        if(!empty($this->_name))
        {
            $xml->addAttribute('name', $this->_name);
        }
        if(!empty($this->_rootpath))
        {
            $xml->addAttribute('rootpath', $this->_rootpath);
        }
        if(is_bool($this->_compressBlobs))
        {
            $xml->addAttribute('compressBlobs', $this->_compressBlobs ? 1: 0);
        }
        if(is_bool($this->_isCurrent))
        {
            $xml->addAttribute('isCurrent', $this->_isCurrent ? 1: 0);
        }
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
