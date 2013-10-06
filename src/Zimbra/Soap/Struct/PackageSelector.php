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
 * PackageSelector class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class PackageSelector
{
    /**
     * The name
     * @var string
     */
    public $name;

    /**
     * Constructor method for PackageSelector
     * @param string $name
     * @return self
     */
    public function __construct($name = null)
    {
        $this->_name = trim($name);
    }

    /**
     * Get or set name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->_name;
        }
        $this->_name = trim($name);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'package')
    {
        $name = !empty($name) ? $name : 'package';
        $arr =  array();
        if(!empty($this->_name))
        {
            $arr['name'] = $this->_name;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'package')
    {
        $name = !empty($name) ? $name : 'package';
        $xml = new SimpleXML('<'.$name.' />');
        if(!empty($this->_name))
        {
            $xml->addAttribute('name', $this->_name);
        }
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
