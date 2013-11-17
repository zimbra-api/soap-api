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
use Zimbra\Soap\Enum\InterestType;
use Zimbra\Utils\TypedSequence;

/**
 * WaitSetAddSpec class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class WaitSetAddSpec
{
    /**
     * The name
     * @var string
     */
    private $_name;

    /**
     * The id
     * @var string
     */
    private $_id;

    /**
     * Last known sync token
     * @var string
     */
    private $_token;

    /**
     * Comma-separated list
     * @var string
     */
    private $_types;

    /**
     * Constructor method for waitSetAddSpec
     * @param string $name
     * @param string $id
     * @param string $token
     * @param array $types
     * @return self
     */
    public function __construct($name = null, $id = null, $token = null, array $types = array())
    {
        $this->_name = trim($name);
        $this->_id = trim($id);
        $this->_token = trim($token);
        $this->_types = new TypedSequence('Zimbra\Soap\Enum\InterestType', $types);
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
     * Gets or sets token
     *
     * @param  string $token
     * @return string|self
     */
    public function token($token = null)
    {
        if(null === $token)
        {
            return $this->_token;
        }
        $this->_token = trim($token);
        return $this;
    }

    /**
     * Add a type
     *
     * @param  InterestType $type
     * @return self
     */
    public function addType(InterestType $type)
    {
        $this->_types->add($type);
        return $this;
    }

    /**
     * Gets types
     *
     * @return string
     */
    public function types()
    {
        return count($this->_types) ? implode(',', $this->_types->all()) : '';
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'a')
    {
        $name = !empty($name) ? $name : 'a';
        $arr = array();
        if(!empty($this->_name))
        {
            $arr['name'] = $this->_name;
        }
        if(!empty($this->_id))
        {
            $arr['id'] = $this->_id;
        }
        if(!empty($this->_token))
        {
            $arr['token'] = $this->_token;
        }
        $types = $this->types();
        if(!empty($types))
        {
            $arr['types'] = $types;
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'a')
    {
        $name = !empty($name) ? $name : 'a';
        $xml = new SimpleXML('<'.$name.' />');
        if(!empty($this->_name))
        {
            $xml->addAttribute('name', $this->_name);
        }
        if(!empty($this->_id))
        {
            $xml->addAttribute('id', $this->_id);
        }
        if(!empty($this->_token))
        {
            $xml->addAttribute('token', $this->_token);
        }
        $types = $this->types();
        if(!empty($types))
        {
            $xml->addAttribute('types', $types);
        }
        return $xml;
    }

    /**
     * Method returning the xml string representative this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
