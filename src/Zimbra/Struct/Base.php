<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

use Evenement\EventEmitter;
use PhpCollection\Map;
use Zimbra\Common\SimpleXML;
use Zimbra\Common\Text;

/**
 * Base struct class
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class Base extends EventEmitter implements StructInterface
{
    /**
     * Struct properties
     * @var array
     */
    private $_properties;

    /**
     * Struct children
     * @var array
     */
    private $_children;

    /**
     * Struct value
     * @var string
     */
    private $_value;

    /**
     * Xml namespace
     * @var string
     */
    private $_xmlNamespace = null;

    /**
     * Constructor method for Base
     *
     * @param  string $value
     * @return self
     */
    public function __construct($value = null)
    {
        if(null !== $value)
        {
            $this->_value = trim($value);
        }
        $this->_properties = new Map();
        $this->_children = new Map();
        $this->emit('initialize', [$this]);
    }

    /**
     * Gets xml namespace
     *
     * @return string
     */
    public function getXmlNamespace()
    {
        return $this->_xmlNamespace;
    }

    /**
     * Sets xml namespace
     *
     * @param  string $namespace
     * @return self
     */
    public function setXmlNamespace($namespace)
    {
        $this->_xmlNamespace = trim($namespace);
        return $this;
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * Sets value
     *
     * @return self
     */
    public function setValue($value)
    {
        $this->_value = trim($value);
        return $this;
    }

    /**
     * Gets a property
     *
     * @param  string $name
     * @return mix
     */
    public function getProperty($name)
    {
        if($this->_properties->containsKey($name))
        {
            return $this->_properties->get($name)->get();
        }
        else
        {
            return null;
        }
    }

    /**
     * Sets a property
     *
     * @param  string $name
     * @param  mix $value
     * @return self
     */
    public function setProperty($name, $value)
    {
        $this->_properties->set($name, $value);
        return $this;
    }

    /**
     * Remove a property
     *
     * @param  string $name
     * @return self
     */
    public function removeProperty($name)
    {
        if($this->_properties->containsKey($name))
        {
            $this->_properties->remove($name);
        }
        return $this;
    }

    /**
     * Gets a child
     *
     * @param  string $name
     * @return mix
     */
    public function getChild($name)
    {
        if($this->_children->containsKey($name))
        {
            return $this->_children->get($name)->get();
        }
        else
        {
            return null;
        }
    }

    /**
     * Sets a child
     *
     * @param  string $name
     * @param  mix $value
     * @return self
     */
    public function setChild($name, $value)
    {
        $this->_children->set($name, $value);
        return $this;
    }

    /**
     * Remove a child
     *
     * @param  string $name
     * @return self
     */
    public function removeChild($name)
    {
        if($this->_children->containsKey($name))
        {
            $this->_children->remove($name);
        }
        return $this;
    }

    /**
     * Returns name representation of this class 
     *
     * @return string
     */
    public function className()
    {
        $ref = new \ReflectionObject($this);
        return $ref->getShortName();
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = null)
    {
        $this->emit('before', [$this]);
        $name = !empty($name) ? $name : $this->className();
        $arr = [];
        if(null !== $this->_value)
        {
            $arr['_content'] = $this->_value;
        }
        if(!empty($this->_xmlNamespace))
        {
            $arr['_jsns'] = $this->_xmlNamespace;
        }
        foreach ($this->_properties as $key => $value)
        {
            if($value instanceof \Zimbra\Enum\Base)
            {
                $arr[$key] = $value->value();
            }
            else
            {
                $arr[$key] = $value;
            }
        }
        if(count($this->_children))
        {
            foreach ($this->_children as $key => $value)
            {
                if($value instanceof StructInterface)
                {
                    $arr += $value->toArray($key);
                }
                elseif($value instanceof \Zimbra\Enum\Base)
                {
                    $arr[$key] = $value->value();
                }
                elseif (is_array($value) && count($value))
                {
                    $arr[$key] = [];
                    foreach ($value as $v)
                    {
                        if($v instanceof StructInterface)
                        {
                            $vArr = $v->toArray($key);
                            $arr[$key][] = $vArr[$key];
                        }
                        elseif($v instanceof \Zimbra\Enum\Base)
                        {
                            $arr[$key][] = $v->value();
                        }
                        else
                        {
                            $arr[$key][] = $v;
                        }
                    }
                }
                else
                {
                    $arr[$key] = $value;
                }
            }
        }
        $this->emit('after.array', [&$arr]);
        return [$name => $arr];
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = null)
    {
        $this->emit('before', [$this]);
        $name = !empty($name) ? $name : $this->className();
        if(null !== $this->_value)
        {
            $xml = new SimpleXML('<' . $name . '>' . $this->_value . '</' . $name . '>');
        }
        else
        {
            $xml = new SimpleXML('<' . $name . ' />');
        }
        foreach ($this->_properties as $key => $value)
        {
            if($value instanceof \Zimbra\Enum\Base)
            {
                $xml->addAttribute($key, $value->value());
            }
            elseif(is_bool($value))
            {
                $xml->addAttribute($key, Text::boolToString($value));
            }
            else
            {
                $xml->addAttribute($key, $value);
            }
        }
        if(count($this->_children))
        {
            foreach ($this->_children as $key => $value)
            {
                if($value instanceof StructInterface)
                {
                    $xml->append($value->toXml($key), $value->GetXmlNamespace());
                }
                elseif($value instanceof \Zimbra\Enum\Base)
                {
                    $xml->addChild($key, $value->value());
                }
                elseif(is_bool($value))
                {
                    $xml->addChild($key, Text::boolToString($value));
                }
                elseif (is_array($value))
                {
                    foreach ($value as $child)
                    {
                        if($child instanceof StructInterface)
                        {
                            $xml->append($child->toXml($key), $child->GetXmlNamespace());
                        }
                        elseif($child instanceof \Zimbra\Enum\Base)
                        {
                            $xml->addChild($key, $child->value());
                        }
                        elseif(is_bool($child))
                        {
                            $xml->addChild($key, Text::boolToString($child));
                        }
                        else
                        {
                            $xml->addChild($key, $child);
                        }
                    }
                }
                else
                {
                    $xml->addChild($key, $value);
                }
            }
        }
        $this->emit('after.xml', [$xml]);
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
