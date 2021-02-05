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
 * TzFixupRuleMatchDate struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="date")
 */
class TzFixupRuleMatchDate
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
     * Match day of month (1..31)
     * @Accessor(getter="getMonthDay", setter="setMonthDay")
     * @SerializedName("mday")
     * @Type("integer")
     * @XmlAttribute
     */
    private $monthDay;

    /**
     * Constructor method for TzFixupRuleMatchDate
     * @param int $mon
     * @param int $mday
     * @return self
     */
    public function __construct(int $mon, int $mday)
    {
        $this->setMonth($mon)
             ->setMonthDay($mday);
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
     * Gets the match month day
     *
     * @return int
     */
    public function getMonthDay(): int
    {
        return $this->monthDay;
    }

    /**
     * Sets the match month day
     *
     * @param  int $mday
     * @return self
     */
    public function setMonthDay(int $mday): self
    {
        $mday = in_array($mday, range(1, 31)) ? $mday : 1;
        $this->monthDay = $mday;
        return $this;
    }
}