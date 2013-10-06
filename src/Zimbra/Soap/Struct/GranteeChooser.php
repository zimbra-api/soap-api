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

use Zimbra\Soap\Enum\AccountBy;
use Zimbra\Utils\SimpleXML;

/**
 * GranteeChooser class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GranteeChooser
{
    /**
     * The type.
     * If specified, filters the result by the specified grantee type.
     * @var string
     */
    private $_type;

    /**
     * The id.
     * If specified, filters the result by the specified grantee ID.
     * @var string
     */
    private $_id;

    /**
     * The name
     * If specified, filters the result by the specified grantee name.
     * @var string
     */
    private $_name;

    /**
     * Constructor method for granteeChooser
     * @param string $type
     * @param string $id
     * @param string $name
     * @return self
     */
    public function __construct($type = null, $id = null, $name = null)
    {
        $this->_type = trim($type);
        $this->_id = trim($id);
        $this->_name = trim($name);
    }

    /**
     * Gets or sets type
     *
     * @param  string $type
     * @return string|self
     */
    public function type($type = null)
    {
        if(null === $type)
        {
            return $this->_type;
        }
        $this->_type = trim($type);
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
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray()
    {
        $arr = array();
        if(!empty($this->_type))
        {
            $arr['type'] = $this->_type;
        }
        if(!empty($this->_id))
        {
            $arr['id'] = $this->_id;
        }
        if(!empty($this->_name))
        {
            $arr['name'] = $this->_name;
        }
        return array('grantee' => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $xml = new SimpleXML('<grantee />');
        if(!empty($this->_type))
        {
            $xml->addAttribute('type', $this->_type);
        }
        if(!empty($this->_id))
        {
            $xml->addAttribute('id', $this->_id);
        }
        if(!empty($this->_name))
        {
            $xml->addAttribute('name', $this->_name);
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
