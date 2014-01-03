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

use Zimbra\Soap\Struct\Content;
use Zimbra\Soap\Request;

/**
 * ImportContacts request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ImportContacts extends Request
{
    /**
     * Content specification
     * @var Content
     */
    private $_content;

    /**
     * Content type.
     * Only currenctly supported content type is "csv"
     * @var string
     */
    private $_ct;

    /**
     * Optional Folder ID to import contacts to
     * @var string
     */
    private $_l;

    /**
     * The format of csv being imported. when it's not defined, Zimbra format is assumed.
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
        $this->_content = $content;
        $this->_ct = trim($ct);
        $this->_l = trim($l);
        $this->_csvfmt = trim($csvfmt);
        $this->_csvlocale = trim($csvlocale);
    }

    /**
     * Get or set content
     *
     * @param  Content $content
     * @return Content|self
     */
    public function content(Content $content = null)
    {
        if(null === $content)
        {
            return $this->_content;
        }
        $this->_content = $content;
        return $this;
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
     * Gets or sets l
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
        $this->_l = trim($l);
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
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array['ct'] = $this->_ct;
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
        $this->array += $this->_content->toArray('content');
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
        $this->xml->append($this->_content->toXml('content'));
        return parent::toXml();
    }
}
