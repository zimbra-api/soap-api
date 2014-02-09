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
     * @param  Content $content
     * @param  string $ct
     * @param  string $l
     * @param  string $csvfmt
     * @param  string $csvlocale
     * @return self
     */
    public function __construct(
        Content $content,
        $ct,
        $l = null,
        $csvfmt = null,
        $csvlocale = null
    )
    {
        parent::__construct();
        $this->child('content', $content);
        $this->property('ct', trim($ct));
        if(null !== $l)
        {
            $this->property('l', trim($l));
        }
        if(null !== $csvfmt)
        {
            $this->property('csvfmt', trim($csvfmt));
        }
        if(null !== $csvlocale)
        {
            $this->property('csvlocale', trim($csvlocale));
        }
    }

    /**
     * Get or set content
     * Content specification
     *
     * @param  Content $content
     * @return Content|self
     */
    public function content(Content $content = null)
    {
        if(null === $content)
        {
            return $this->child('content');
        }
        return $this->child('content', $content);
    }

    /**
     * Get or set ct
     * Content type.
     * Only currenctly supported content type is "csv"
     *
     * @param  string $ct
     * @return string|self
     */
    public function ct($ct = null)
    {
        if(null === $ct)
        {
            return $this->property('ct');
        }
        return $this->property('ct', trim($ct));
    }

    /**
     * Gets or sets l
     * Optional Folder ID to import contacts to
     *
     * @param  string $l
     * @return string|self
     */
    public function l($l = null)
    {
        if(null === $l)
        {
            return $this->property('l');
        }
        return $this->property('l', trim($l));
    }

    /**
     * Get or set csvfmt
     * The format of csv being imported. when it's not defined, Zimbra format is assumed.
     * The supported formats are defined in $ZIMBRA_HOME/conf/zimbra-contact-fields.xml
     *
     * @param  string $csvfmt
     * @return string|self
     */
    public function csvfmt($csvfmt = null)
    {
        if(null === $csvfmt)
        {
            return $this->property('csvfmt');
        }
        return $this->property('csvfmt', trim($csvfmt));
    }

    /**
     * Get or set csvlocale
     * The locale to use when there are multiple {csv-format} locales defined.
     * When it is not specified, the {csv-format} with no locale specification is used.
     *
     * @param  string $csvlocale
     * @return string|self
     */
    public function csvlocale($csvlocale = null)
    {
        if(null === $csvlocale)
        {
            return $this->property('csvlocale');
        }
        return $this->property('csvlocale', trim($csvlocale));
    }
}
