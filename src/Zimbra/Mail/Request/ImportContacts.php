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

use Zimbra\Mail\Struct\Content;

/**
 * ImportContacts request class
 * Import contacts
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ImportContacts extends Base
{
    /**
     * Constructor method for ImportContacts
     * @param  string $ct
     * @param  Content $content
     * @param  string $folderId
     * @param  string $csvFormat
     * @param  string $csvLocale
     * @return self
     */
    public function __construct(
        $ct,
        Content $content,
        $folderId = null,
        $csvFormat = null,
        $csvLocale = null
    )
    {
        parent::__construct();
        $this->setProperty('ct', trim($ct));
        $this->setChild('content', $content);
        if(null !== $folderId)
        {
            $this->setProperty('l', trim($folderId));
        }
        if(null !== $csvFormat)
        {
            $this->setProperty('csvfmt', trim($csvFormat));
        }
        if(null !== $csvLocale)
        {
            $this->setProperty('csvlocale', trim($csvLocale));
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
     * @return Content
     */
    public function getContent()
    {
        return $this->getChild('content');
    }

    /**
     * Sets content specification
     *
     * @param  Content $content
     * @return self
     */
    public function setContent(Content $content)
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

    /**
     * Gets csv format
     *
     * @return string
     */
    public function getCsvFormat()
    {
        return $this->getProperty('csvfmt');
    }

    /**
     * Sets csv format
     *
     * @param  string $csvFormat
     * @return self
     */
    public function setCsvFormat($csvFormat)
    {
        return $this->setProperty('csvfmt', trim($csvFormat));
    }

    /**
     * Gets csv locale
     *
     * @return string
     */
    public function getCsvLocale()
    {
        return $this->getProperty('csvlocale');
    }

    /**
     * Sets csv locale
     *
     * @param  string $csvLocale
     * @return self
     */
    public function setCsvLocale($csvLocale)
    {
        return $this->setProperty('csvlocale', trim($csvLocale));
    }
}
