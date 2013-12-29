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
 * FreeBusyUserSpec struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class FreeBusyUserSpec
{
    /**
     * Calendar folder ID; if omitted, get f/b on all calendar folders
     * @var int
     */
    private $_l;

    /**
     * Zimbra ID Either "name" or "id" must be specified
     * @var string
     */
    private $_id;

    /**
     * Email address. Either "name" or "id" must be specified
     * @var string
     */
    private $_name;

    /**
     * Constructor method for FreeBusyUserSpec
     * @param int $l
     * @param string $id
     * @param string $name
     * @return self
     */
    public function __construct(
        $l = null,
        $id = null,
        $name = null
    )
    {
        if(null !== $l)
        {
            $this->_l = (int) $l;
        }
        $this->_id = trim($id);
        $this->_name = trim($name);
    }

    /**
     * Gets or sets l
     *
     * @param  int $l
     * @return int|self
     */
    public function l($l = null)
    {
        if(null === $l)
        {
            return $this->_l;
        }
        $this->_l = (int) $l;
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
    public function toArray($name = 'usr')
    {
        $name = !empty($name) ? $name : 'usr';
        if(is_int($this->_l))
        {
            $arr['l'] = $this->_l;
        }
        if(!empty($this->_id))
        {
            $arr['id'] = $this->_id;
        }
        if(!empty($this->_name))
        {
            $arr['name'] = $this->_name;
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'usr')
    {
        $name = !empty($name) ? $name : 'usr';
        $xml = new SimpleXML('<'.$name.' />');
        if(is_int($this->_l))
        {
            $xml->addAttribute('l', $this->_l);
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
