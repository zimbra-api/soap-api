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
 * Pref class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Pref
{
    /**
     * Preference name
     * - use : required
     * @var string
     */
    private $_name;

    /**
     * Preference value
     * @var string
     */
    private $_value;

    /**
     * Preference modified time
     * @var long
     */
    private $_modified;

    /**
     * Constructor method for pref
     * @param  string $name
     * @param  string $value
     * @param  int   $modified
     * @return self
     */
    public function __construct($name, $value = null, $modified = null)
    {
        $this->_name = trim($name);
        $this->_value = trim($value);
        if($modified !== null)
        {
            $this->_modified = (int) $modified;
        }
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
     * Gets or sets modified
     *
     * @param  int $modified
     * @return int|self
     */
    public function modified($modified = null)
    {
        if(null === $modified)
        {
            return $this->_modified;
        }
        $this->_modified = (int) $modified;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $arr = array(
            'name' => $this->_name,
            '_' => $this->_value,
        );
        if(is_int($this->_modified))
        {
            $arr['modified'] = $this->_modified;
        }
        return array('pref' => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $xml = new SimpleXML('<pref>'.$this->_value.'</pref>');
        $xml->addAttribute('name', $this->_name);
        if(is_int($this->_modified))
        {
            $xml->addAttribute('modified', $this->_modified);
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
