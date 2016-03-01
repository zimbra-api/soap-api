<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

/**
 * VerifyStoreManager request class
 * Verify Certificate Key.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class VerifyStoreManager extends Base
{
    /**
     * Constructor method for VerifyStoreManager
     * @param int $fileSize File size
     * @param int $num The num
     * @param bool $checkBlobs Check blobs flag
     * @return self
     */
    public function __construct($fileSize = null, $num = null, $checkBlobs = null)
    {
        parent::__construct();
        if(null !== $fileSize)
        {
            $this->setProperty('fileSize', (int) $fileSize);
        }
        if(null !== $num)
        {
            $this->setProperty('num', (int) $num);
        }
        if(null !== $checkBlobs)
        {
            $this->setProperty('checkBlobs', (bool) $checkBlobs);
        }
    }

    /**
     * Gets fileSize
     *
     * @return int
     */
    public function getFileSize()
    {
        return $this->getProperty('fileSize');
    }

    /**
     * Sets fileSize
     *
     * @param  int $fileSize
     * @return self
     */
    public function setFileSize($fileSize)
    {
        return $this->setProperty('fileSize', (int) $fileSize);
    }

    /**
     * Gets num
     *
     * @return int
     */
    public function getNum()
    {
        return $this->getProperty('num');
    }

    /**
     * Sets num
     *
     * @param  int $num
     * @return self
     */
    public function setNum($num)
    {
        return $this->setProperty('num', (int) $num);
    }

    /**
     * Gets checkBlobs
     *
     * @return bool
     */
    public function getCheckBlobs()
    {
        return $this->getProperty('checkBlobs');
    }

    /**
     * Sets checkBlobs
     *
     * @param  bool $checkBlobs
     * @return self
     */
    public function setCheckBlobs($checkBlobs)
    {
        return $this->setProperty('checkBlobs', (bool) $checkBlobs);
    }
}
