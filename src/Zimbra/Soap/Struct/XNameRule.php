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
 * XNameRule struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class XNameRule
{
    /**
     * XNAME Name
     * @var string
     */
    private $_name;

    /**
     * XNAME value
     * @var string
     */
    private $_value;

    /**
     * Constructor method for XNameRule
     *
     * @param string $name
     * @param string $value
     * @return self
     */
    public function __construct($name = null, $value = null)
    {
        $this->_name = trim($name);
        $this->_value = trim($value);
    }

    /**
     * Gets or sets XNAME name
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
     * Gets or sets XNAME value
     *
     * @param  string $value
     * @return string|self
     */
    public function value($value = null)
    {
        if(null === $value)
        {
            return $this->_value;
        }
        $this->_value = trim($value);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'rule-x-name')
    {
        $name = !empty($name) ? $name : 'rule-x-name';
        $arr = array();
        if(!empty($this->_name))
        {
            $arr['name'] = $this->_name;
        }
        if(!empty($this->_value))
        {
            $arr['value'] = $this->_value;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'rule-x-name')
    {
        $name = !empty($name) ? $name : 'rule-x-name';
        $xml = new SimpleXML('<'.$name.' />');
        if(!empty($this->_name))
        {
            $xml->addAttribute('name', $this->_name);
        }
        if(!empty($this->_value))
        {
            $xml->addAttribute('value', $this->_value);
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
