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

use Zimbra\Soap\Enum\Type;
use Zimbra\Utils\SimpleXML;

/**
 * Policy class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Policy
{
    /**
     * Retention policy type
     * @var Type
     */
    private $_type;
    /**
     * The id
     * @var string
     */
    private $_id;
    /**
     * The name
     * @var string
     */
    private $_name;
    /**
     * The duration
     * @var string
     */
    private $_lifetime;

    /**
     * Constructor method for policy
     * @param string $type
     * @param string $id
     * @param string $name
     * @param string $lifetime
     * @return self
     */
    public function __construct(Type $type = null, $id = null, $name = null, $lifetime = null)
    {
        if($type instanceof Type)
        {
            $this->_type = $type;
        }
        $this->_id = trim($id);
        $this->_name = trim($name);
        $this->_lifetime = trim($lifetime);
    }

    /**
     * Gets or sets type
     *
     * @param  Type $type
     * @return Type|self
     */
    public function type(Type $type = null)
    {
        if(null === $type)
        {
            return $this->_type;
        }
        $this->_type = $type;
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
     * Gets or sets lifetime
     *
     * @param  string $lifetime
     * @return string|self
     */
    public function lifetime($lifetime = null)
    {
        if(null === $lifetime)
        {
            return $this->_lifetime;
        }
        $this->_lifetime = trim($lifetime);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'policy')
    {
        $name = !empty($name) ? $name : 'policy';
        $arr = array();
        if($this->_type instanceof Type)
        {
            $arr['type'] = (string) $this->_type;
        }
        if(!empty($this->_id))
        {
            $arr['id'] = $this->_id;
        }
        if(!empty($this->_name))
        {
            $arr['name'] = $this->_name;
        }
        if(!empty($this->_lifetime))
        {
            $arr['lifetime'] = $this->_lifetime;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'policy')
    {
        $name = !empty($name) ? $name : 'policy';
        $xml = new SimpleXML('<'.$name.' />');
        if($this->_type instanceof Type)
        {
            $xml->addAttribute('type', (string) $this->_type);
        }
        if(!empty($this->_id))
        {
            $xml->addAttribute('id', $this->_id);
        }
        if(!empty($this->_name))
        {
            $xml->addAttribute('name', $this->_name);
        }
        if(!empty($this->_lifetime))
        {
            $xml->addAttribute('lifetime', $this->_lifetime);
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
