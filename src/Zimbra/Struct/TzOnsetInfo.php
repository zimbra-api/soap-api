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
        $this->property('mon', $mon);
        $hour = in_array((int) $hour, range(0, 23)) ? (int) $hour : 0;
        $this->property('hour', $hour);
        $min = in_array((int) $min, range(0, 59)) ? (int) $min : 0;
        $this->property('min', $min);
        $sec = in_array((int) $sec, range(0, 59)) ? (int) $sec : 0;
        $this->property('sec', $sec);

        if(is_int($mday) and in_array((int) $mday, range(1, 31)))
        {
            $this->property('mday', (int) $mday);
        }
        if(is_int($week) and in_array((int) $week, array(-1, 1, 2, 3, 4)))
        {
            $this->property('week', (int) $week);
        }
        if(is_int($wkday) and in_array((int) $wkday, range(1, 7)))
        {
            $this->property('wkday', (int) $wkday);
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
            return $this->property('mon');
        }
        $mon = in_array((int) $mon, range(1, 12)) ? (int) $mon : 1;
        return $this->property('mon', $mon);
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
            return $this->property('mday');
        }
        $mday = in_array((int) $mday, range(1, 31)) ? (int) $mday : 1;
        return $this->property('mday', $mday);
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
            return $this->property('hour');
        }
        $hour = in_array((int) $hour, range(0, 23)) ? (int) $hour : 0;
        return $this->property('hour', $hour);
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
            return $this->property('min');
        }
        $min = in_array((int) $min, range(0, 59)) ? (int) $min : 0;
        return $this->property('min', $min);
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
            return $this->property('sec');
        }
        $sec = in_array((int) $sec, range(0, 59)) ? (int) $sec : 0;
        return $this->property('sec', $sec);
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
            return $this->property('week');
        }
        $week = in_array((int) $week, array(-1, 1, 2, 3, 4)) ? (int) $week : -1;
        return $this->property('week', $week);
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
            return $this->property('wkday');
        }
        $wkday = in_array((int) $wkday, range(1, 7)) ? (int) $wkday : 1;
        return $this->property('wkday', $wkday);
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
