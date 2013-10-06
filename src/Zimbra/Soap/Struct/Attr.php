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
 * Attr class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Attr
{
    /**
     * Name of attribute
     * @var string
     */
    private $_name;

    /**
     * Value of attribute
     * @var string
     */
    private $_value;

    /**
     * Flags whether permission has been denied
     * If 1 (true), flags that the real value of this attribute has not been provided.
     * @var boolean
     */
    private $_pd;

    /**
     * Constructor method for attr
     * @param  string $name
     * @param  string $value
     * @param  bool   $pd
     * @return self
     */
    public function __construct($name, $value = null, $pd = null)
    {
        $this->_name = trim($name);
        if(empty($this->_name))
        {
            throw new \InvalidArgumentException('Name is not empty');
        }
        $this->_value = trim($value);
        if(null !== $pd)
        {
            $this->_pd = (bool) $pd;
        }
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
        if(empty($this->_name))
        {
            throw new \InvalidArgumentException('Name is not empty');
        }
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
     * Gets or sets pd
     *
     * @param  bool $pd
     * @return bool|self
     */
    public function pd($pd = null)
    {
        if(null === $pd)
        {
            return $this->_pd;
        }
        $this->_pd = (bool) $pd;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'attr')
    {
        $name = !empty($name) ? $name : 'attr';
        $arr = array(
            'name' => $this->_name,
            '_' => $this->_value,
        );
        if(is_bool($this->_pd))
        {
            $arr['pd'] = $this->_pd ? 1: 0;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'attr')
    {
        $name = !empty($name) ? $name : 'attr';
        $xml = new SimpleXML('<'.$name.'>'.$this->_value.'</'.$name.'>');
        $xml->addAttribute('name', $this->_name);
        if(is_bool($this->_pd))
        {
            $xml->addAttribute('pd', $this->_pd ? 1: 0);
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
