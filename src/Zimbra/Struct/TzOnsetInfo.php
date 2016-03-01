<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

/**
 * TzOnsetInfo struct class
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class TzOnsetInfo extends Base
{
    /**
     * Constructor method for TzOnsetInfo
     * @param int $mon Month; 1=January, 2=February, etc.
     * @param int $hour Transition hour (0..23)
     * @param int $min Transition minute (0..59)
     * @param int $sec Transition second; 0..59, usually 0
     * @param int $mday Day of month (1..31)
     * @param int $week Week number; 1=first, 2=second, 3=third, 4=fourth, -1=last
     * @param int $wkday Day of week; 1=Sunday, 2=Monday, etc.
     * @return self
     */
    public function __construct(
        $mon,
        $hour,
        $min,
        $sec,
        $mday = null,
        $week = null,
        $wkday = null
    )
    {
        parent::__construct();
        $mon = in_array((int) $mon, range(1, 12)) ? (int) $mon : 1;
        $this->setProperty('mon', $mon);
        $hour = in_array((int) $hour, range(0, 23)) ? (int) $hour : 0;
        $this->setProperty('hour', $hour);
        $min = in_array((int) $min, range(0, 59)) ? (int) $min : 0;
        $this->setProperty('min', $min);
        $sec = in_array((int) $sec, range(0, 59)) ? (int) $sec : 0;
        $this->setProperty('sec', $sec);

        if(is_int($mday) and in_array((int) $mday, range(1, 31)))
        {
            $this->setProperty('mday', (int) $mday);
        }
        if(is_int($week) and in_array((int) $week, [-1, 1, 2, 3, 4]))
        {
            $this->setProperty('week', (int) $week);
        }
        if(is_int($wkday) and in_array((int) $wkday, range(1, 7)))
        {
            $this->setProperty('wkday', (int) $wkday);
        }
    }

    /**
     * Gets month
     *
     * @return int
     */
    public function getMonth()
    {
        return $this->getProperty('mon');
    }

    /**
     * Sets month
     *
     * @param  int $mon
     * @return self
     */
    public function setMonth($mon)
    {
        $mon = in_array((int) $mon, range(1, 12)) ? (int) $mon : 1;
        return $this->setProperty('mon', $mon);
    }

    /**
     * Gets day of month
     *
     * @return int
     */
    public function getDayOfMonth()
    {
        return $this->getProperty('mday');
    }

    /**
     * Sets day of month
     *
     * @param  int $mday
     * @return self
     */
    public function setDayOfMonth($mday)
    {
        $mday = in_array((int) $mday, range(1, 31)) ? (int) $mday : 1;
        return $this->setProperty('mday', $mday);
    }

    /**
     * Gets hour
     *
     * @return int
     */
    public function getHour()
    {
        return $this->getProperty('hour');
    }

    /**
     * Sets hour
     *
     * @param  int $hour
     * @return self
     */
    public function setHour($hour)
    {
        $hour = in_array((int) $hour, range(0, 23)) ? (int) $hour : 0;
        return $this->setProperty('hour', $hour);
    }

    /**
     * Gets minute
     *
     * @return int
     */
    public function getMinute()
    {
        return $this->getProperty('min');
    }

    /**
     * Sets minute
     *
     * @param  int $min
     * @return self
     */
    public function setMinute($min)
    {
        $min = in_array((int) $min, range(0, 59)) ? (int) $min : 0;
        return $this->setProperty('min', $min);
    }

    /**
     * Gets second
     *
     * @return int
     */
    public function getSecond()
    {
        return $this->getProperty('sec');
    }

    /**
     * Sets second
     *
     * @param  int $sec
     * @return self
     */
    public function setSecond($sec)
    {
        $sec = in_array((int) $sec, range(0, 59)) ? (int) $sec : 0;
        return $this->setProperty('sec', $sec);
    }

    public function getWeek()
    {
        return $this->getProperty('week');
    }

    /**
     * Gets or sets week
     *
     * @param  int $week
     * @return int|self
     */
    public function setWeek($week)
    {
        $week = in_array((int) $week, [-1, 1, 2, 3, 4]) ? (int) $week : -1;
        return $this->setProperty('week', $week);
    }

    /**
     * Gets day of week
     *
     * @return int
     */
    public function getDayOfWeek()
    {
        return $this->getProperty('wkday');
    }

    /**
     * Gets or sets mon
     *
     * @param  int $wkday
     * @return self
     */
    public function setDayOfWeek($wkday)
    {
        $wkday = in_array((int) $wkday, range(1, 7)) ? (int) $wkday : 1;
        return $this->setProperty('wkday', $wkday);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'info')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'info')
    {
        return parent::toXml($name);
    }
}
