<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * TzFixupRuleMatchRule struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="rule")
 */
class TzFixupRuleMatchRule
{
    /**
     * Match month. Value between 1 (January) and 12 (December)
     * @Accessor(getter="getMonth", setter="setMonth")
     * @SerializedName("mon")
     * @Type("integer")
     * @XmlAttribute
     */
    private $month;

    /**
     * Match week. -1 means last week of month else between 1 and 4
     * @Accessor(getter="getWeek", setter="setWeek")
     * @SerializedName("week")
     * @Type("integer")
     * @XmlAttribute
     */
    private $week;

    /**
     * Match week day. Value between 1 (Sunday) and 7 (Saturday)
     * @Accessor(getter="getWeekDay", setter="setWeekDay")
     * @SerializedName("wkday")
     * @Type("integer")
     * @XmlAttribute
     */
    private $weekDay;

    /**
     * Constructor method for TzFixupRuleMatchRule
     * @param int $mon
     * @param int $week
     * @param int $wkday
     * @return self
     */
    public function __construct(int $mon, int $week, int $wkday)
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
    public function getMonth(): int
    {
        return $this->month;
    }

    /**
     * Sets the match month
     *
     * @param  int $mon
     * @return self
     */
    public function setMonth(int $mon): self
    {
        $mon = in_array($mon, range(1, 12)) ? $mon : 1;
        $this->month = $mon;
        return $this;
    }

    /**
     * Gets the match week
     *
     * @return int
     */
    public function getWeek(): int
    {
        return $this->week;
    }

    /**
     * Sets the match week
     *
     * @param  int $week
     * @return self
     */
    public function setWeek(int $week): self
    {
        $week = in_array($week, [1, 2, 3, 4]) ? $week : -1;
        $this->week = $week;
        return $this;
    }

    /**
     * Gets the match week day
     *
     * @return int
     */
    public function getWeekDay(): int
    {
        return $this->weekDay;
    }

    /**
     * Sets the match week day
     *
     * @param  int $wkday
     * @return self
     */
    public function setWeekDay(int $wkday): self
    {
        $wkday = in_array($wkday, range(1, 7)) ? $wkday : 1;
        $this->weekDay = $wkday;
        return $this;
    }
}
