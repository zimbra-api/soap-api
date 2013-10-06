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
 * Identity class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Identity
{
    /**
     * The name
     * @var string
     */
    public $name;
    /**
     * The id
     * @var string
     */
    public $id;

    /**
     * Attributes
     * @var array Array of Attr
     */
    private $_attrs = array();

    /**
     * Constructor method for identity
     * @param string $name
     * @param string $id
     * @param array  $attrs
     * @return self
     */
    public function __construct($name = null, $id = null, array $attrs = array())
    {
        $this->_name = trim($name);
        $this->_id = trim($id);
        $this->attrs($attrs);
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
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->_id;
        }
        $this->_id = trim($id);
        return $this;
    }

    /**
     * Add Attr
     *
     * @param  Attr $attr
     * @return Identity
     */
    public function addAttr(Attr $attr)
    {
        $this->_attrs[] = $attr;
        return $this;
    }

    /**
     * Get array of Attr
     *
     * @return array Array of Attr
     */
    public function attrs(array $attrs = null)
    {
        if(null === $attrs)
        {
            return $this->_attrs;
        }
        $this->_attrs = array();
        foreach ($attrs as $attr)
        {
            if($attr instanceof Attr)
            {
                $this->_attrs[] = $attr;
            }
        }
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $arr =  array();
        if(!empty($this->_name))
        {
            $arr['name'] = (string) $this->_name;
        }
        if(!empty($this->_id))
        {
            $arr['id'] = (string) $this->_id;
        }
        if(count($this->_attrs))
        {
            $arr['a'] = array();
            foreach ($this->_attrs as $attr)
            {
                $attrArr = $attr->toArray('a');
                $arr['a'][] = $attrArr['a'];
            }
        }
        return array('identity' => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $xml = new SimpleXML('<identity />');
        if(!empty($this->_name))
        {
            $xml->addAttribute('name', (string) $this->_name);
        }
        if(!empty($this->_id))
        {
            $xml->addAttribute('id', (string) $this->_id);
        }
        if(count($this->_attrs))
        {
            foreach ($this->_attrs as $attr)
            {
                $xml->append($attr->toXml('a'));
            }
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
