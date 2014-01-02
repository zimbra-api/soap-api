<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * SectionAttr class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SectionAttr
{
    /**
     * Metadata section key
     * @var string
     */
    private $_section;

    /**
     * Constructor method for SectionAttr
     * @param string $section
     * @return self
     */
    public function __construct($section)
    {
        $this->_section = trim($section);
    }

    /**
     * Get or set section
     *
     * @param  string $section
     * @return string|self
     */
    public function section($section = null)
    {
        if(null === $section)
        {
            return $this->_section;
        }
        $this->_section = trim($section);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'meta')
    {
        $name = !empty($name) ? $name : 'meta';
        $arr =  array(
            'section' => $this->_section,
        );
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'meta')
    {
        $name = !empty($name) ? $name : 'meta';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('section', $this->_section);
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
