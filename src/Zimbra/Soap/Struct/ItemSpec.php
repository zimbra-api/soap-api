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
 * ItemSpec struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ItemSpec
{
    /**
     * Item ID
     * @var string
     */
    private $_id;

    /**
     * Folder ID
     * @var string
     */
    private $_l;

    /**
     * Name
     * @var string
     */
    private $_name;

    /**
     * Fully qualified path
     * @var string
     */
    private $_path;

    /**
     * Constructor method for ItemSpec
     * @param string $id
     * @param string $l
     * @param string $name
     * @param string $path
     * @return self
     */
    public function __construct(
        $id = null,
        $l = null,
        $name = null,
        $path = null
    )
    {
        $this->_id = trim($id);
        $this->_l = trim($l);
        $this->_name = trim($name);
        $this->_path = trim($path);
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
     * Gets or sets l
     *
     * @param  string $l
     * @return string|self
     */
    public function l($l = null)
    {
        if(null === $l)
        {
            return $this->_l;
        }
        $this->_l = trim($l);
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
     * Gets or sets path
     *
     * @param  string $path
     * @return string|self
     */
    public function path($path = null)
    {
        if(null === $path)
        {
            return $this->_path;
        }
        $this->_path = trim($path);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'item')
    {
        $name = !empty($name) ? $name : 'item';
        if(!empty($this->_id))
        {
            $arr['id'] = $this->_id;
        }
        if(!empty($this->_l))
        {
            $arr['l'] = $this->_l;
        }
        if(!empty($this->_name))
        {
            $arr['name'] = $this->_name;
        }
        if(!empty($this->_path))
        {
            $arr['path'] = $this->_path;
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'item')
    {
        $name = !empty($name) ? $name : 'item';
        $xml = new SimpleXML('<'.$name.' />');
        if(!empty($this->_id))
        {
            $xml->addAttribute('id', $this->_id);
        }
        if(!empty($this->_l))
        {
            $xml->addAttribute('l', $this->_l);
        }
        if(!empty($this->_name))
        {
            $xml->addAttribute('name', $this->_name);
        }
        if(!empty($this->_path))
        {
            $xml->addAttribute('path', $this->_path);
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
