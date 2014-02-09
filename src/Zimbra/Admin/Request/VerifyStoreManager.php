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
            $this->property('fileSize', (int) $fileSize);
        }
        if(null !== $num)
        {
            $this->property('num', (int) $num);
        }
        if(null !== $checkBlobs)
        {
            $this->property('checkBlobs', (bool) $checkBlobs);
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
            return $this->property('fileSize');
        }
        return $this->property('fileSize', (int) $fileSize);
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
            return $this->property('num');
        }
        return $this->property('num', (int) $num);
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
            return $this->property('checkBlobs');
        }
        return $this->property('checkBlobs', (bool) $checkBlobs);
    }
}
