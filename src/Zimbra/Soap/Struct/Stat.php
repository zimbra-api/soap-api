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
 * Stat class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Stat
{
    /**
     * Stat name
     * @var string
     */
    private $_name;

    /**
     * Stat description
     * @var string
     */
    private $_description;

    /**
     * Constructor method for Stat
     * @param  string $name
     * @param  string $description
     * @return self
     */
    public function __construct($name = null, $description = null)
    {
        $this->_name = trim($name);
        $this->_description = trim($description);
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
     * Gets or sets description
     *
     * @param  string $description
     * @return string|self
     */
    public function description($description = null)
    {
        if(null === $description)
        {
            return $this->_description;
        }
        $this->_description = trim($description);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'stat')
    {
        $name = !empty($name) ? $name : 'stat';
        $arr = array();
        if(!empty($this->_name))
        {
            $arr['name'] = $this->_name;
        }
        if(!empty($this->_description))
        {
            $arr['description'] = $this->_description;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'stat')
    {
        $name = !empty($name) ? $name : 'stat';
        $xml = new SimpleXML('<'.$name.' />');
        if(!empty($this->_name))
        {
            $xml->addAttribute('name', $this->_name);
        }
        if(!empty($this->_description))
        {
            $xml->addAttribute('description', $this->_description);
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
