<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Mail\Struct\ContentSpec;

/**
 * ImportAppointments request class
 * Import appointments
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ImportAppointments extends Base
{
    /**
     * Constructor method for ImportAppointments
     * @param  string $contentType
     * @param  ContentSpec $content
     * @param  string $folderId
     * @return self
     */
    public function __construct($contentType, ContentSpec $content, $folderId = null)
    {
        parent::__construct();
        $this->setProperty('ct', trim($contentType));
        $this->setChild('content', $content);
        if(null !== $folderId)
        {
            $this->setProperty('l', trim($folderId));
        }
    }

    /**
     * Gets content type
     *
     * @return string
     */
    public function getContentType()
    {
        return $this->getProperty('ct');
    }

    /**
     * Sets content type
     *
     * @param  string $contentType
     * @return self
     */
    public function setContentType($contentType)
    {
        return $this->setProperty('ct', trim($contentType));
    }

    /**
     * Gets content specification
     *
     * @return ContentSpec
     */
    public function getContent()
    {
        return $this->getChild('content');
    }

    /**
     * Sets content specification
     *
     * @param  ContentSpec $content
     * @return self
     */
    public function setContent(ContentSpec $content)
    {
        return $this->setChild('content', $content);
    }

    /**
     * Gets folder ID
     *
     * @return string
     */
    public function getFolderId()
    {
        return $this->getProperty('l');
    }

    /**
     * Sets folder ID
     *
     * @param  string $folderId
     * @return self
     */
    public function setFolderId($folderId)
    {
        return $this->setProperty('l', trim($folderId));
    }
}
