<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * TzOnsetInfo class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class TzOnsetInfo
{
    /**
     * Month; 1=January, 2=February, etc.
     *
     * @Accessor(getter="getMonth", setter="setMonth")
     * @SerializedName("mon")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getMonth", setter: "setMonth")]
    #[SerializedName("mon")]
    #[Type("int")]
    #[XmlAttribute]
    private $month;

    /**
     * Transition hour (0..23)
     *
     * @Accessor(getter="getHour", setter="setHour")
     * @SerializedName("hour")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getHour", setter: "setHour")]
    #[SerializedName("hour")]
    #[Type("int")]
    #[XmlAttribute]
    private $hour;

    /**
     * Transition minute (0..59)
     *
     * @Accessor(getter="getMinute", setter="setMinute")
     * @SerializedName("min")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getMinute", setter: "setMinute")]
    #[SerializedName("min")]
    #[Type("int")]
    #[XmlAttribute]
    private $minute;

    /**
     * Transition second; 0..59, usually 0
     *
     * @Accessor(getter="getSecond", setter="setSecond")
     * @SerializedName("sec")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getSecond", setter: "setSecond")]
    #[SerializedName("sec")]
    #[Type("int")]
    #[XmlAttribute]
    private $second;

    /**
     * Day of month (1..31)
     *
     * @Accessor(getter="getDayOfMonth", setter="setDayOfMonth")
     * @SerializedName("mday")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getDayOfMonth", setter: "setDayOfMonth")]
    #[SerializedName("mday")]
    #[Type("int")]
    #[XmlAttribute]
    private $dayOfMonth;

    /**
     * Week number; 1=first, 2=second, 3=third, 4=fourth, -1=last
     *
     * @Accessor(getter="getWeek", setter="setWeek")
     * @SerializedName("week")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getWeek", setter: "setWeek")]
    #[SerializedName("week")]
    #[Type("int")]
    #[XmlAttribute]
    private $week;

    /**
     * Day of week; 1=Sunday, 2=Monday, etc.
     *
     * @Accessor(getter="getDayOfWeek", setter="setDayOfWeek")
     * @SerializedName("wkday")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getDayOfWeek", setter: "setDayOfWeek")]
    #[SerializedName("wkday")]
    #[Type("int")]
    #[XmlAttribute]
    private $dayOfWeek;

    /**
     * Constructor
     *
     * @param int $month
     * @param int $hour
     * @param int $minute
     * @param int $second
     * @param int $dayOfMonth
     * @param int $week
     * @param int $dayOfWeek
     * @return self
     */
    public function __construct(
        int $month = 0,
        int $hour = 0,
        int $minute = 0,
        int $second = 0,
        ?int $dayOfMonth = null,
        ?int $week = null,
        ?int $dayOfWeek = null
    ) {
        $this->setMonth($month)
            ->setHour($hour)
            ->setMinute($minute)
            ->setSecond($second);

        if (null !== $dayOfMonth) {
            $this->setDayOfMonth($dayOfMonth);
        }
        if (null !== $week) {
            $this->setWeek($week);
        }
        if (null !== $dayOfWeek) {
            $this->setDayOfWeek($dayOfWeek);
        }
    }

    /**
     * Get month
     *
     * @return int
     */
    public function getMonth(): int
    {
        return $this->month;
    }

    /**
     * Set month
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
     * Get day of month
     *
     * @return int
     */
    public function getDayOfMonth(): ?int
    {
        return $this->dayOfMonth;
    }

    /**
     * Set day of month
     *
     * @param  int $mday
     * @return self
     */
    public function setDayOfMonth(int $mday): self
    {
        $mday = in_array($mday, range(1, 31)) ? $mday : 1;
        $this->dayOfMonth = $mday;
        return $this;
    }

    /**
     * Get hour
     *
     * @return int
     */
    public function getHour(): int
    {
        return $this->hour;
    }

    /**
     * Set hour
     *
     * @param  int $hour
     * @return self
     */
    public function setHour(int $hour): self
    {
        $hour = in_array($hour, range(0, 23)) ? $hour : 0;
        $this->hour = $hour;
        return $this;
    }

    /**
     * Get minute
     *
     * @return int
     */
    public function getMinute(): int
    {
        return $this->minute;
    }

    /**
     * Set minute
     *
     * @param  int $min
     * @return self
     */
    public function setMinute(int $min): self
    {
        $min = in_array($min, range(0, 59)) ? $min : 0;
        $this->minute = $min;
        return $this;
    }

    /**
     * Get second
     *
     * @return int
     */
    public function getSecond(): int
    {
        return $this->second;
    }

    /**
     * Set second
     *
     * @param  int $sec
     * @return self
     */
    public function setSecond(int $sec): self
    {
        $sec = in_array($sec, range(0, 59)) ? $sec : 0;
        $this->second = $sec;
        return $this;
    }

    /**
     * Get week
     *
     * @return int
     */
    public function getWeek(): ?int
    {
        return $this->week;
    }

    /**
     * Set week
     *
     * @param  int $week
     * @return self
     */
    public function setWeek(int $week): self
    {
        $week = in_array($week, [-1, 1, 2, 3, 4]) ? $week : -1;
        $this->week = $week;
        return $this;
    }

    /**
     * Get day of week
     *
     * @return int
     */
    public function getDayOfWeek(): ?int
    {
        return $this->dayOfWeek;
    }

    /**
     * Get or sets mon
     *
     * @param  int $wkday
     * @return self
     */
    public function setDayOfWeek(int $wkday): self
    {
        $wkday = in_array($wkday, range(1, 7)) ? $wkday : 1;
        $this->dayOfWeek = $wkday;
        return $this;
    }
}
