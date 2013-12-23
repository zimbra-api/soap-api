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
 * WkDay struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class WkDay
{
    /**
     * Weekday - SU|MO|TU|WE|TH|FR|SA
     * @var WeekDay
     */
    private $_day;

    /**
     * Week number. [[+]|-]num num: 1 to 53
     * @var int
     */
    private $_ordwk;

    /**
     * Constructor method for WkDay
     * @param  WeekDay $day
     * @param  int $ordwk
     * @return self
     */
    public function __construct(WeekDay $day, $ordwk = null)
    {
        $this->_day = $day;
        if(null !== $ordwk)
        {
            $ordwk = (int) $ordwk;
            if($ordwk != 0 && $ordwk > -54 && $ordwk < 54)
            {
                $this->_ordwk = $ordwk;
            }
        }
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
     * Gets or sets ordwk
     *
     * @param  int $ordwk
     * @return int|self
     */
    public function ordwk($ordwk = null)
    {
        if(null === $ordwk)
        {
            return $this->_ordwk;
        }
        $ordwk = (int) $ordwk;
        if($ordwk != 0 && $ordwk > -54 && $ordwk < 54)
        {
            $this->_ordwk = $ordwk;
        }
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'wkday')
    {
        $name = !empty($name) ? $name : 'wkday';
        $arr = array(
            'day' => (string) $this->_day,
        );
        if(is_int($this->_ordwk))
        {
            $arr['ordwk'] = $this->_ordwk;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'wkday')
    {
        $name = !empty($name) ? $name : 'wkday';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('day', (string) $this->_day);
        if(is_int($this->_ordwk))
        {
            $xml->addAttribute('ordwk', $this->_ordwk);
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
