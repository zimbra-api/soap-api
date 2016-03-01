<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common;

use \SimpleXMLElement;

/**
 * SimpleXML class
 *
 * @package   Zimbra
 * @category  Common
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SimpleXML extends SimpleXMLElement
{
    /**
     * Convert SimpleXML object to stdClass object.
     *
     * @return object
     */
    public function toObject()
    {
        $attributes = $this->attributes();
        $children = $this->children();
        $textValue = trim((string) $this);
        if(count($attributes) === 0 and count($children) === 0)
        {
            return $textValue;
        }
        else
        {
            $object = new \StdClass;
            foreach($attributes as $key => $value)
            {
                $object->$key = (string)$value;
            }
            if(!empty($textValue))
            {
                $object->_ = $textValue;
            }
            foreach($children as $value)
            {
                $name = $value->getName();
                if(isset($object->$name))
                {
                    if(is_array($object->$name))
                    {
                        array_push($object->$name, $value->toObject());
                    }
                    else
                    {
                        $object->$name = [$object->$name, $value->toObject()];
                    }
                }
                else
                {
                    $object->$name = $value->toObject();
                }
            }
            return $object;
        }
    }

    /**
     * Append xml.
     *
     * @param  SimpleXML $xml.
     * @return self
     */
    public function append(SimpleXML $xml, $namespace = null)
    {
        $value = trim((string) $xml);
        $namespaces = array_values($xml->getNamespaces());
        if(isset($namespaces[0]))
        {
            $namespace = $namespaces[0];
        }
        $newChild = $this->addChild($xml->getName(), !empty($value) ? $value : null, $namespace);
        foreach($xml->attributes() as $name => $value)
        {
            $newChild->addAttribute($name, $value);
        }
        foreach($xml->children() as $child)
        {
            $newChild->append($child, $namespace);
        } 
        return $this;
    }

    /**
     * Add an array to xml.
     *
     * @param  array  $array.
     * @param  string $namespace.
     * @return void
     */
    public function addArray(array $array = [], $namespace = null)
    {
        foreach ($array as $name => $param)
        {
            if (is_array($param) and Text::isValidTagName($name))
            {
                $textValue = null;
                if(isset($param['_']))
                {
                    $textValue = $param['_'];
                    unset($param['_']);
                }

                if(is_numeric(key($param)))
                {
                    foreach($param as $value)
                    {
                        if(is_array($value))
                        {
                            $this->addArray([$name => $value]);
                        }
                        else
                        {
                            $this->addChild($name, Text::boolToString($value), $namespace);
                        }
                    }
                }
                else
                {
                    $child = $this->addChild($name, Text::boolToString($textValue), $namespace);
                    foreach($param as $key => $value)
                    {
                        if(!Text::isValidTagName($key))
                        {
                            throw new Exception('Illegal character in tag name. tag: '.$key);
                        }
                        if(is_array($value))
                        {
                            if(is_numeric(key($value)))
                            {
                                foreach($value as $k => $v)
                                {
                                    if(is_array($v))
                                    {
                                        $child->addArray([$key => $v]);
                                    }
                                    else
                                    {
                                        $child->addChild($key, Text::boolToString($v), $namespace);
                                    }
                                }
                            }
                            else
                            {
                                $child->addArray([$key => $value]);
                            }
                        }
                        else
                        {
                            $child->addAttribute($key, Text::boolToString($value));
                        }
                    }
                }
            }
            else
            {
                if(!Text::isValidTagName($name))
                {
                    throw new Exception('Illegal character in tag name. tag: '.$name);
                }
                $this->addChild($name, Text::boolToString($param), $namespace);
            }
        }
        return $this;
    }

    /**
     * Adds an attribute to the SimpleXML element.
     *
     * @param  string $name The name of the attribute to add.
     * @param  string $value The value of the attribute.
     * @param  string $namespace If specified, the namespace to which the attribute belongs.
     * @return self
     */
    public function addAttribute($name, $value = null, $namespace = null)
    {
        parent::addAttribute($name, $value, $namespace);
        return $this;
    }

    /**
     * Adds an array of attributes to the SimpleXML element.
     *
     * @param  array $attrs The array of attributes.
     * @param  string $namespace If specified, the namespace to which the attribute belongs.
     * @return self
     */
    public function addAttributes(array $attrs = array(), $namespace = null)
    {
        foreach ($attrs as $name => $value)
        {
            parent::addAttribute($name, $value, $namespace);
        }
        return $this;
    }
}
