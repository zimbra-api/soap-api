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

/**
 * Upload attactment class in Zimbra API PHP.
 * 
 * @package   Zimbra
 * @category  Upload
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Attactment
{
    /**
     * Attachment id
     * @var string
     */
    private $_attachmentId;

    /**
     * File name
     * @var string
     */
    private $_fileName;

    /**
     * Content type
     * @var string
     */
    private $_contentType;

    /**
     * Constructor method for Attactment
     *
     * @param  string $attachmentId
     * @param  string $fileName
     * @param  string $contentType
     * @return self
     */
    public function __construct($attachmentId, $fileName, $contentType)
    {
        $this->_attachmentId = $attachmentId;
        $this->_fileName = $fileName;
        $this->_contentType = $contentType;
    }

    /**
     * Gets attachment id
     *
     * @return string
     */
    public function getAttachmentId()
    {
        return $this->_attachmentId;
    }

    /**
     * Gets file name
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->_fileName;
    }

    /**
     * Gets content type
     *
     * @return string
     */
    public function getContentType()
    {
        return $this->_contentType;
    }
}
