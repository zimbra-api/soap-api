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
 * NewContactAttr struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class NewContactAttr
{
    /**
     * Attribute data
     * @var string
     */
    private $_value;

    /**
     * Attribute name
     * @var string
     */
    private $_n;

    /**
     * Upload ID
     * @var string
     */
    private $_aid;

    /**
     * Item ID. Used in combination with subpart-name
     * @var string
     */
    private $_id;

    /**
     * Subpart Name
     * @var string
     */
    private $_part;

    /**
     * Constructor method for NewContactAttr
     * @param string $n
     * @param string $value
     * @param string $aid
     * @param string $id
     * @param string $part
     * @return self
     */
    public function __construct(
        $n,
        $value = null,
        $aid = null,
        $id = null,
        $part = null
    )
    {
        $this->_n = trim($n);
        $this->_value = trim($value);
        $this->_aid = trim($aid);
        $this->_id = trim($id);
        $this->_part = trim($part);
    }

    /**
     * Gets or sets n
     *
     * @param  string $n
     * @return string|self
     */
    public function n($n = null)
    {
        if(null === $n)
        {
            return $this->_n;
        }
        $this->_n = trim($n);
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
     * Gets or sets aid
     *
     * @param  string $aid
     * @return string|self
     */
    public function aid($aid = null)
    {
        if(null === $aid)
        {
            return $this->_aid;
        }
        $this->_aid = trim($aid);
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
     * Gets or sets part
     *
     * @param  string $part
     * @return string|self
     */
    public function part($part = null)
    {
        if(null === $part)
        {
            return $this->_part;
        }
        $this->_part = trim($part);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'a')
    {
        $name = !empty($name) ? $name : 'a';
        $arr = array(
            'n' => $this->_n,
            '_' => $this->_value,
        );
        if(!empty($this->_aid))
        {
            $arr['aid'] = $this->_aid;
        }
        if(!empty($this->_id))
        {
            $arr['id'] = $this->_id;
        }
        if(!empty($this->_part))
        {
            $arr['part'] = $this->_part;
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'a')
    {
        $name = !empty($name) ? $name : 'a';
        $xml = new SimpleXML('<'.$name.'>'.$this->_value.'</'.$name.'>');
        $xml->addAttribute('n', $this->_n);
        if(!empty($this->_aid))
        {
            $xml->addAttribute('aid', $this->_aid);
        }
        if(!empty($this->_id))
        {
            $xml->addAttribute('id', $this->_id);
        }
        if(!empty($this->_part))
        {
            $xml->addAttribute('part', $this->_part);
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
