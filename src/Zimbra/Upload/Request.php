<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Upload;

use PhpCollection\Sequence;

/**
 * Upload request class in Zimbra API PHP.
 * 
 * @package   Zimbra
 * @category  Upload
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Request
{
    /**
     * Request id
     * @var string
     */
    private $_requestId;

    /**
     * Upload files
     * @var Sequence
     */
    private $_files;

    /**
     * Constructor method for Request
     *
     * @param  string $requestId
     * @param  array $files
     * @return self
     */
    public function __construct($requestId, array $files = [])
    {
        $this->_requestId = trim($requestId);
        $this->setFiles($files);
    }

    /**
     * Gets request id
     *
     * @return string
     */
    public function getRequestId()
    {
        return $this->_requestId;
    }

    /**
     * Sets request id
     *
     * @param  string $requestId
     * @return self
     */
    public function setRequestId($requestId)
    {
        $this->_requestId = trim($requestId);
        return $this;
    }

    /**
     * Add an file
     *
     * @param  string $file
     * @return self
     */
    public function addFile($file)
    {
        $this->_files->add($file);
        return $this;
    }

    /**
     * Sets fileibute sequence
     *
     * @return self
     */
    public function setFiles(array $files)
    {
        $this->_files = new Sequence($files);
        return $this;
    }

    /**
     * Gets fileibute sequence
     *
     * @param array $files
     * @return Sequence
     */
    public function getFiles()
    {
        return $this->_files;
    }
}
