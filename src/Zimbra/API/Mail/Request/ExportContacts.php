<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;

/**
 * ExportContacts request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ExportContacts extends Request
{
    /**
     * Content type.
     * Currently, the only supported content type is "csv" (comma-separated values)
     * @var string
     */
    private $_ct;

    /**
     * Optional folder id to export contacts from
     * @var string
     */
    private $_l;

    /**
     * Optional csv format for exported contacts.
     * The supported formats are defined in $ZIMBRA_HOME/conf/zimbra-contact-fields.xml
     * @var string
     */
    private $_csvfmt;

    /**
     * The locale to use when there are multiple {csv-format} locales defined.
     * When it is not specified, the {csv-format} with no locale specification is used.
     * @var string
     */
    private $_csvlocale;

    /**
     * Optional delimiter character to use in the resulting csv file - usually "," or ";"
     * @var string
     */
    private $_csvsep;

    /**
     * Constructor method for ExportContacts
     * @param  string $ct
     * @param  string $l
     * @param  string $csvfmt
     * @param  string $csvlocale
     * @param  string $csvsep
     * @return self
     */
    public function __construct($ct, $l = null, $csvfmt = null, $csvlocale = null, $csvsep = null)
    {
        parent::__construct();
        $this->_ct = trim($ct);
        $this->_l = trim($l);
        $this->_csvlocale = trim($csvlocale);
        $this->_csvfmt = trim($csvfmt);
        $this->_csvsep = trim($csvsep);
    }

    /**
     * Get or set ct
     *
     * @param  string $ct
     * @return string|self
     */
    public function ct($ct = null)
    {
        if(null === $ct)
        {
            return $this->_ct;
        }
        $this->_ct = trim($ct);
        return $this;
    }

    /**
     * Get or set l
     *
     * @param  string $l
     * @return string|self
     */
    public function l($l = null)
    {
        if(null === $l)
        {
            return $this->_l;
        }
        $this->_l = $l;
        return $this;
    }

    /**
     * Get or set csvfmt
     *
     * @param  string $csvfmt
     * @return string|self
     */
    public function csvfmt($csvfmt = null)
    {
        if(null === $csvfmt)
        {
            return $this->_csvfmt;
        }
        $this->_csvfmt = trim($csvfmt);
        return $this;
    }

    /**
     * Get or set csvlocale
     *
     * @param  string $csvlocale
     * @return string|self
     */
    public function csvlocale($csvlocale = null)
    {
        if(null === $csvlocale)
        {
            return $this->_csvlocale;
        }
        $this->_csvlocale = trim($csvlocale);
        return $this;
    }

    /**
     * Get or set csvsep
     *
     * @param  string $csvsep
     * @return string|self
     */
    public function csvsep($csvsep = null)
    {
        if(null === $csvsep)
        {
            return $this->_csvsep;
        }
        $this->_csvsep = trim($csvsep);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'ct' => $this->_ct,
        );
        if(!empty($this->_l))
        {
            $this->array['l'] = $this->_l;
        }
        if(!empty($this->_csvfmt))
        {
            $this->array['csvfmt'] = $this->_csvfmt;
        }
        if(!empty($this->_csvlocale))
        {
            $this->array['csvlocale'] = $this->_csvlocale;
        }
        if(!empty($this->_csvsep))
        {
            $this->array['csvsep'] = $this->_csvsep;
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
        $this->xml->addAttribute('ct', $this->_ct);
        if(!empty($this->_l))
        {
            $this->xml->addAttribute('l', $this->_l);
        }
        if(!empty($this->_csvfmt))
        {
            $this->xml->addAttribute('csvfmt', $this->_csvfmt);
        }
        if(!empty($this->_csvlocale))
        {
            $this->xml->addAttribute('csvlocale', $this->_csvlocale);
        }
        if(!empty($this->_csvsep))
        {
            $this->xml->addAttribute('csvsep', $this->_csvsep);
        }
        return parent::toXml();
    }
}
