<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;

/**
 * VerifyStoreManager class
 * Verify Certificate Key.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class VerifyStoreManager extends Request
{
    /**
     * File size
     * @var int
     */
    private $_fileSize;

    /**
     * The num
     * @var int
     */
    private $_num;

    /**
     * Check blobs flag
     * @var bool
     */
    private $_checkBlobs;

    /**
     * Constructor method for VerifyStoreManager
     * @param int $fileSize
     * @param int $num
     * @param bool $checkBlobs
     * @return self
     */
    public function __construct($fileSize = null, $num = null, $checkBlobs = null)
    {
        parent::__construct();
        if(null !== $fileSize)
        {
            $this->_fileSize = intval($fileSize);
        }
        if(null !== $num)
        {
            $this->_num = intval($num);
        }
        if(null !== $checkBlobs)
        {
            $this->_checkBlobs = (bool) $checkBlobs;
        }
    }

    /**
     * Gets or sets fileSize
     *
     * @param  int $fileSize
     * @return int|self
     */
    public function fileSize($fileSize = null)
    {
        if(null === $fileSize)
        {
            return $this->_fileSize;
        }
        $this->_fileSize = intval($fileSize);
        return $this;
    }

    /**
     * Gets or sets num
     *
     * @param  int $num
     * @return int|self
     */
    public function num($num = null)
    {
        if(null === $num)
        {
            return $this->_num;
        }
        $this->_num = intval($num);
        return $this;
    }

    /**
     * Gets or sets checkBlobs
     *
     * @param  string $checkBlobs
     * @return string|self
     */
    public function checkBlobs($checkBlobs = null)
    {
        if(null === $checkBlobs)
        {
            return $this->_checkBlobs;
        }
        $this->_checkBlobs = (bool) $checkBlobs;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(is_int($this->_fileSize))
        {
            $this->array['fileSize'] = $this->_fileSize;
        }
        if(is_int($this->_num))
        {
            $this->array['num'] = $this->_num;
        }
        if(is_bool($this->_checkBlobs))
        {
            $this->array['checkBlobs'] = $this->_checkBlobs ? 1 : 0;
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if(is_int($this->_fileSize))
        {
            $this->xml->addAttribute('fileSize', $this->_fileSize);
        }
        if(is_int($this->_num))
        {
            $this->xml->addAttribute('num', $this->_num);
        }
        if(is_bool($this->_checkBlobs))
        {
            $this->xml->addAttribute('checkBlobs', $this->_checkBlobs ? 1 : 0);
        }
        return parent::toXml();
    }
}
