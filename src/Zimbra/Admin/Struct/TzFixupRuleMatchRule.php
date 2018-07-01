<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;
use JMS\Serializer\Annotation\XmlValue;

/**
 * TzFixupRuleMatchRule struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="rule")
 */
class TzFixupRuleMatchRule
{
    /**
     * @Accessor(getter="getMonth", setter="setMonth")
     * @SerializedName("mon")
     * @Type("integer")
     * @XmlAttribute
     */
    private $_month;

    /**
     * @Accessor(getter="getWeek", setter="setWeek")
     * @SerializedName("week")
     * @Type("integer")
     * @XmlAttribute
     */
    private $_week;

    /**
     * @Accessor(getter="getWeekDay", setter="setWeekDay")
     * @SerializedName("wkday")
     * @Type("integer")
     * @XmlAttribute
     */
    private $_weekDay;

    /**
     * Constructor method for TzFixupRuleMatchRule
     * @param int $mon Match month. Value between 1 (January) and 12 (December)
     * @param int $week Match week. -1 means last week of month else between 1 and 4
     * @param int $wkday Match week day. Value between 1 (Sunday) and 7 (Saturday)
     * @return self
     */
    public function __construct($mon, $week, $wkday)
    {
        $this->setMonth($mon)
             ->setWeek($week)
             ->setWeekDay($wkday);
    }

    /**
     * Gets the match month
     *
     * @return int
     */
    public function getMonth()
    {
        return $this->_month;
    }

    /**
     * Sets the match month
     *
     * @param  int $mon
     * @return self
     */
    public function setMonth($mon)
    {
        $mon = in_array((int) $mon, range(1, 12)) ? (int) $mon : 1;
        $this->_month = $mon;
        return $this;
    }

    /**
     * Gets the match week
     *
     * @return int
     */
    public function getWeek()
    {
        return $this->_week;
    }

    /**
     * Sets the match week
     *
     * @param  int $week
     * @return self
     */
    public function setWeek($week)
    {
        $week = in_array((int) $week, [1, 2, 3, 4]) ? (int) $week : -1;
        $this->_week = $week;
        return $this;
    }

    /**
     * Gets the match week day
     *
     * @return int
     */
    public function getWeekDay()
    {
        return $this->_weekDay;
    }

    /**
     * Sets the match week day
     *
     * @param  int $wkday
     * @return self
     */
    public function setWeekDay($wkday)
    {
        $wkday = in_array((int) $wkday, range(1, 7)) ? (int) $wkday : 1;
        $this->_weekDay = $wkday;
        return $this;
    }
}
