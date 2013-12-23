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
use Zimbra\Soap\Enum\WeekDay;

/**
 * WkstRule struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class WkstRule
{
    /**
     * Weekday - SU|MO|TU|WE|TH|FR|SA
     * @var WeekDay
     */
    private $_day;

    /**
     * Constructor method for WkstRule
     * @param  WeekDay $day
     * @return self
     */
    public function __construct(WeekDay $day)
    {
        $this->_day = $day;
    }

    /**
     * Gets or sets day
     *
     * @param  WeekDay $day
     * @return WeekDay|self
     */
    public function day(WeekDay $day = null)
    {
        if(null === $day)
        {
            return $this->_day;
        }
        $this->_day = $day;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'wkst')
    {
        $name = !empty($name) ? $name : 'wkst';
        $arr = array(
            'day' => (string) $this->_day,
        );
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'wkst')
    {
        $name = !empty($name) ? $name : 'wkst';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('day', (string) $this->_day);
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
