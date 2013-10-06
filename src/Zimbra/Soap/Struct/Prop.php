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
 * Prop class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Prop
{
    /**
     * Zimlet name
     * - use : required
     * @var long
     */
    private $_zimlet;

    /**
     * Property name
     * - use : required
     * @var string
     */
    private $_name;

    /**
     * Property value
     * @var string
     */
    private $_value;

    /**
     * Constructor method for pref
     * @param  string $name
     * @param  string $value
     * @param  long   $modified
     * @return self
     */
    public function __construct($zimlet, $name, $value = null)
    {
        $this->_zimlet = trim($zimlet);
        $this->_name = trim($name);
        $this->_value = trim($value);
    }

    /**
     * Gets or sets zimlet
     *
     * @param  int $zimlet
     * @return int|self
     */
    public function zimlet($zimlet = null)
    {
        if(null === $zimlet)
        {
            return $this->_zimlet;
        }
        $this->_zimlet = trim($zimlet);
        return $this;
    }

    /**
     * Gets or sets name
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
     * Gets or sets value
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
    public function toArray()
    {
        $arr = array(
            'zimlet' => $this->_zimlet,
            'name' => $this->_name,
            '_' => $this->_value,
        );
        return array('prop' => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $xml = new SimpleXML('<prop>'.$this->_value.'</prop>');
        $xml->addAttribute('zimlet', $this->_zimlet)
            ->addAttribute('name', $this->_name);
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
