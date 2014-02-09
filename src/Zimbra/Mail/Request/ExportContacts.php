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
     * @param  string $ct
     * @param  string $l
     * @param  string $csvfmt
     * @param  string $csvlocale
     * @param  string $csvsep
     * @return self
     */
    public function __construct(
        $ct,
        $l = null,
        $csvfmt = null,
        $csvlocale = null,
        $csvsep = null
    )
    {
        parent::__construct();
        $this->property('ct', trim($ct));
        if(null !== $l)
        {
            $this->property('l', trim($l));
        }
        if(null !== $csvlocale)
        {
            $this->property('csvlocale', trim($csvlocale));
        }
        if(null !== $csvfmt)
        {
            $this->property('csvfmt', trim($csvfmt));
        }
        if(null !== $csvsep)
        {
            $this->property('csvsep', trim($csvsep));
        }
    }

    /**
     * Get or set ct
     * Content type.
     * Currently, the only supported content type is "csv" (comma-separated values)
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
     * Get or set l
     * Optional folder id to export contacts from
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
     * Optional csv format for exported contacts.
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

    /**
     * Get or set csvsep
     * Optional delimiter character to use in the resulting csv file - usually "," or ";"
     *
     * @param  string $csvsep
     * @return string|self
     */
    public function csvsep($csvsep = null)
    {
        if(null === $csvsep)
        {
            return $this->property('csvsep');
        }
        return $this->property('csvsep', trim($csvsep));
    }
}
