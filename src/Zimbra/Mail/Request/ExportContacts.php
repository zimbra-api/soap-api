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

/**
 * ExportContacts request class
 * Export contacts
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ExportContacts extends Base
{
    /**
     * Constructor method for ExportContacts
     * @param  string $contentType
     * @param  string $folderId
     * @param  string $csvfmt
     * @param  string $csvlocale
     * @param  string $csvDelimiter
     * @return self
     */
    public function __construct(
        $contentType,
        $folderId = null,
        $csvFormat = null,
        $csvLocale = null,
        $csvDelimiter = null
    )
    {
        parent::__construct();
        $this->setProperty('ct', trim($contentType));
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
        if(null !== $csvDelimiter)
        {
            $this->setProperty('csvsep', trim($csvDelimiter));
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
     * Gets folder Id
     *
     * @return string
     */
    public function getFolderId()
    {
        return $this->getProperty('l');
    }

    /**
     * Sets folder Id
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
     * @param  string $csvFormat
     * @return self
     */
    public function setCsvLocale($csvFormat)
    {
        return $this->setProperty('csvlocale', trim($csvFormat));
    }

    /**
     * Gets csv delimiter
     *
     * @return string
     */
    public function getCsvDelimiter()
    {
        return $this->getProperty('csvsep');
    }

    /**
     * Sets csv delimiter
     *
     * @param  string $csvDelimiter
     * @return self
     */
    public function setCsvDelimiter($csvDelimiter)
    {
        return $this->setProperty('csvsep', trim($csvDelimiter));
    }
}
