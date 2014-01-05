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
 * BodyTest class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class BodyTest extends FilterTest
{
    /**
     * Value
     * @var string
     */
    private $_value;

    /**
     * Case sensitive
     * @var bool
     */
    private $_caseSensitive;

    /**
     * Constructor method for BodyTest
     * @param int $index
     * @param string $value
     * @param bool $caseSensitive
     * @param bool $negative
     * @return self
     */
    public function __construct(
        $index,
        $value = null,
        $caseSensitive = null,
        $negative = null
    )
    {
        parent::__construct($index, $negative);
        $this->_value = trim($value);
        if(null !== $caseSensitive)
        {
            $this->_caseSensitive = (bool) $caseSensitive;
        }
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
     * Gets or sets caseSensitive
     *
     * @param  bool $caseSensitive
     * @return bool|self
     */
    public function caseSensitive($caseSensitive = null)
    {
        if(null === $caseSensitive)
        {
            return $this->_caseSensitive;
        }
        $this->_caseSensitive = (bool) $caseSensitive;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'bodyTest')
    {
        $name = !empty($name) ? $name : 'bodyTest';
        $arr = parent::toArray($name);
        if(!empty($this->_value))
        {
            $arr[$name]['value'] = $this->_value;
        }
        if(is_bool($this->_caseSensitive))
        {
            $arr[$name]['caseSensitive'] = $this->_caseSensitive ? 1 : 0;
        }
        return $arr;
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'bodyTest')
    {
        $name = !empty($name) ? $name : 'bodyTest';
        $xml = parent::toXml($name);
        if(!empty($this->_value))
        {
            $xml->addAttribute('value', $this->_value);
        }
        if(is_bool($this->_caseSensitive))
        {
            $xml->addAttribute('caseSensitive', $this->_caseSensitive ? 1 : 0);
        }
        return $xml;
    }
}
