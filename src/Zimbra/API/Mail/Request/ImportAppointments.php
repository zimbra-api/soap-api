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

use Zimbra\Soap\Struct\ContentSpec;
use Zimbra\Soap\Request;

/**
 * ImportAppointments request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ImportAppointments extends Request
{
    /**
     * Content specification
     * @var ContentSpec
     */
    private $_content;

    /**
     * Content type
     * Only currently supported content type is "text/calendar" (and its nickname "ics")
     * @var string
     */
    private $_ct;

    /**
     * Optional folder ID to import appointments into
     * @var string
     */
    private $_l;

    /**
     * Constructor method for ImportAppointments
     * @param  ContentSpec $content
     * @param  string $ct
     * @param  string $l
     * @return self
     */
    public function __construct(ContentSpec $content, $ct, $l = null)
    {
        parent::__construct();
        $this->_content = $content;
        $this->_ct = trim($ct);
        $this->_l = trim($l);
    }

    /**
     * Get or set content
     *
     * @param  ContentSpec $content
     * @return ContentSpec|self
     */
    public function content(ContentSpec $content = null)
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
        $this->xml->append($this->_content->toXml('content'));
        return parent::toXml();
    }
}
