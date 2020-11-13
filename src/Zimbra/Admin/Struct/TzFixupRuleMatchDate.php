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
     * @Accessor(getter="getMonth", setter="setMonth")
     * @SerializedName("mon")
     * @Type("integer")
     * @XmlAttribute
     */
    private $month;

    /**
     * @Accessor(getter="getMonthDay", setter="setMonthDay")
     * @SerializedName("mday")
     * @Type("integer")
     * @XmlAttribute
     */
    private $monthDay;

    /**
     * Constructor method for TzFixupRuleMatchDate
     * @param int $mon Match month. Value between 1 (January) and 12 (December)
     * @param int $mday Match day of month (1..31)
     * @return self
     */
    public function __construct($mon, $mday)
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
    public function setMonth($mon): self
    {
        $mon = in_array((int) $mon, range(1, 12)) ? (int) $mon : 1;
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
    public function setMonthDay($mday): self
    {
        $mday = in_array((int) $mday, range(1, 31)) ? (int) $mday : 1;
        $this->monthDay = $mday;
        return $this;
    }
}