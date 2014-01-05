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
 * CurrentDayOfWeekTest class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CurrentDayOfWeekTest extends FilterTest
{
    /**
     * Value
     * @var string
     */
    private $_value;

    /**
     * Constructor method for CurrentDayOfWeekTest
     * @param int $index
     * @param string $value
     * @param bool $negative
     * @return self
     */
    public function __construct(
        $index, $value = null, $negative = null
    )
    {
        parent::__construct($index, $negative);
        $this->_value = trim($value);
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
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'currentDayOfWeekTest')
    {
        $name = !empty($name) ? $name : 'currentDayOfWeekTest';
        $arr = parent::toArray($name);
        $arr[$name]['value'] = $this->_value;
        return $arr;
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'currentDayOfWeekTest')
    {
        $name = !empty($name) ? $name : 'currentDayOfWeekTest';
        $xml = parent::toXml($name);
        $xml->addAttribute('value', $this->_value);
        return $xml;
    }
}
