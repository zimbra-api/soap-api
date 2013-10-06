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
 * TzOnsetInfo class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class TzOnsetInfo
{
    /**
     * Week number; 1=first, 2=second, 3=third, 4=fourth, -1=last
     * @var int
     */
    private $_week;

    /**
     * Day of week; 1=Sunday, 2=Monday, etc.
     * @var int
     */
    private $_wkday;

    /**
     * Month; 1=January, 2=February, etc.
     * @var int
     */
    private $_mon;

    /**
     * Day of month (1..31)
     * @var int
     */
    private $_mday;

    /**
     * Transition hour (0..23)
     * @var int
     */
    private $_hour;

    /**
     * Transition minute (0..59)
     * @var int
     */
    private $_min;

    /**
     * Transition second; 0..59, usually 0
     * @var int
     */
    private $_sec;

    /**
     * Constructor method for TzOnsetInfo
     * @param int $mon
     * @param int $hour
     * @param int $min
     * @param int $sec
     * @param int $mday
     * @param int $week
     * @param int $wkday
     * @return self
     */
    public function __construct(
        $mon,
        $hour,
        $min,
        $sec,
        $mday = null,
        $week = null,
        $wkday = null)
    {
        $this->_mon = in_array((int) $mon, range(1, 12)) ? (int) $mon : 1;
        $this->_hour = in_array((int) $hour, range(0, 23)) ? (int) $hour : 0;
        $this->_min = in_array((int) $min, range(0, 59)) ? (int) $min : 0;
        $this->_sec = in_array((int) $sec, range(0, 59)) ? (int) $sec : 0;

        if(is_int($mday) and in_array((int) $mday, range(1, 31)))
        {
            $this->_mday = (int) $mday;
        }
        if(is_int($week) and in_array((int) $week, array(-1, 1, 2, 3, 4)))
        {
            $this->_week =  (int) $week;
        }
        if(is_int($wkday) and in_array((int) $wkday, range(1, 7)))
        {
            $this->_wkday = (int) $wkday;
        }
    }

    /**
     * Gets or sets mon
     *
     * @param  int $mon
     * @return int|self
     */
    public function mon($mon = null)
    {
        if(null === $mon)
        {
            return $this->_mon;
        }
        $this->_mon = in_array((int) $mon, range(1, 12)) ? (int) $mon : 1;
        return $this;
    }

    /**
     * Gets or sets mday
     *
     * @param  int $mday
     * @return int|self
     */
    public function mday($mday = null)
    {
        if(null === $mday)
        {
            return $this->_mday;
        }
        $this->_mday = in_array((int) $mday, range(1, 31)) ? (int) $mday : 1;
        return $this;
    }

    /**
     * Gets or sets hour
     *
     * @param  int $hour
     * @return int|self
     */
    public function hour($hour = null)
    {
        if(null === $hour)
        {
            return $this->_hour;
        }
        $this->_hour = in_array((int) $hour, range(0, 23)) ? (int) $hour : 0;
        return $this;
    }

    /**
     * Gets or sets min
     *
     * @param  int $min
     * @return int|self
     */
    public function min($min = null)
    {
        if(null === $min)
        {
            return $this->_min;
        }
        $this->_min = in_array((int) $min, range(0, 59)) ? (int) $min : 0;
        return $this;
    }

    /**
     * Gets or sets sec
     *
     * @param  int $sec
     * @return int|self
     */
    public function sec($sec = null)
    {
        if(null === $sec)
        {
            return $this->_sec;
        }
        $this->_sec = in_array((int) $sec, range(0, 59)) ? (int) $sec : 0;
        return $this;
    }

    /**
     * Gets or sets week
     *
     * @param  int $week
     * @return int|self
     */
    public function week($week = null)
    {
        if(null === $week)
        {
            return $this->_week;
        }
        $this->_week = in_array((int) $week, array(-1, 1, 2, 3, 4)) ? (int) $week : -1;
        return $this;
    }

    /**
     * Gets or sets mon
     *
     * @param  int $mon
     * @return int|self
     */
    public function wkday($wkday = null)
    {
        if(null === $wkday)
        {
            return $this->_wkday;
        }
        $this->_wkday = in_array((int) $wkday, range(1, 7)) ? (int) $wkday : 1;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'info')
    {
        $name = !empty($name) ? $name : 'info';
        $arr = array(
            'mon' => $this->_mon,
            'hour' => $this->_hour,
            'min' => $this->_min,
            'sec' => $this->_sec,
        );
        if(is_int($this->_mday))
        {
            $arr['mday'] = $this->_mday;
        }
        if(is_int($this->_week))
        {
            $arr['week'] = $this->_week;
        }
        if(is_int($this->_week))
        {
            $arr['wkday'] = $this->_wkday;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'info')
    {
        $name = !empty($name) ? $name : 'info';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('mon', $this->_mon)
            ->addAttribute('hour', $this->_hour)
            ->addAttribute('min', $this->_min)
            ->addAttribute('sec', $this->_sec);
        if(is_int($this->_mday))
        {
            $xml->addAttribute('mday', $this->_mday);
        }
        if(is_int($this->_week))
        {
            $xml->addAttribute('week', $this->_week);
        }
        if(is_int($this->_week))
        {
            $xml->addAttribute('wkday', $this->_wkday);
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
