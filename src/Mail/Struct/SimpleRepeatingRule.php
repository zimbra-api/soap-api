<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlList, XmlRoot};
use Zimbra\Enum\Frequency;
use Zimbra\Struct\SimpleRepeatingRuleInterface;
use Zimbra\Struct\DateTimeStringAttrInterface;
use Zimbra\Struct\NumAttrInterface;
use Zimbra\Struct\IntervalRuleInterface;
use Zimbra\Struct\BySecondRuleInterface;
use Zimbra\Struct\ByMinuteRuleInterface;
use Zimbra\Struct\ByHourRuleInterface;
use Zimbra\Struct\ByDayRuleInterface;
use Zimbra\Struct\ByMonthDayRuleInterface;
use Zimbra\Struct\ByYearDayRuleInterface;
use Zimbra\Struct\ByWeekNoRuleInterface;
use Zimbra\Struct\ByMonthRuleInterface;
use Zimbra\Struct\BySetPosRuleInterface;
use Zimbra\Struct\WkstRuleInterface;
use Zimbra\Struct\XNameRuleInterface;

/**
 * SimpleRepeatingRule class
 * Simple repeating rule information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="rule")
 */
class SimpleRepeatingRule implements RecurRuleBase, SimpleRepeatingRuleInterface
{
    /**
     * Frequency - SEC,MIN,HOU,DAI,WEE,MON,YEA
     * @Accessor(getter="getFrequency", setter="setFrequency")
     * @SerializedName("freq")
     * @Type("Zimbra\Enum\Frequency")
     * @XmlAttribute
     */
    private $frequency;

    /**
     * UNTIL date specification
     * @Accessor(getter="getUntil", setter="setUntil")
     * @SerializedName("until")
     * @Type("Zimbra\Mail\Struct\DateTimeStringAttr")
     * @XmlElement
     */
    private $until;

    /**
     * Count of instances to generate
     * @Accessor(getter="getCount", setter="setCount")
     * @SerializedName("count")
     * @Type("Zimbra\Mail\Struct\NumAttr")
     * @XmlElement
     */
    private $count;

    /**
     * Interval specification
     * @Accessor(getter="getInterval", setter="setInterval")
     * @SerializedName("interval")
     * @Type("Zimbra\Mail\Struct\IntervalRule")
     * @XmlElement
     */
    private $interval;

    /**
     * BYSECOND rule
     * @Accessor(getter="getBySecond", setter="setBySecond")
     * @SerializedName("bysecond")
     * @Type("Zimbra\Mail\Struct\BySecondRule")
     * @XmlElement
     */
    private $bySecond;

    /**
     * BYMINUTE rule
     * @Accessor(getter="getByMinute", setter="setByMinute")
     * @SerializedName("byminute")
     * @Type("Zimbra\Mail\Struct\ByMinuteRule")
     * @XmlElement
     */
    private $byMinute;

    /**
     * BYHOUR rule
     * @Accessor(getter="getByHour", setter="setByHour")
     * @SerializedName("byhour")
     * @Type("Zimbra\Mail\Struct\ByHourRule")
     * @XmlElement
     */
    private $byHour;

    /**
     * BYDAY rule
     * @Accessor(getter="getByDay", setter="setByDay")
     * @SerializedName("byday")
     * @Type("Zimbra\Mail\Struct\ByDayRule")
     * @XmlElement
     */
    private $byDay;

    /**
     * BYMONTHDAY rule
     * @Accessor(getter="getByMonthDay", setter="setByMonthDay")
     * @SerializedName("bymonthday")
     * @Type("Zimbra\Mail\Struct\ByMonthDayRule")
     * @XmlElement
     */
    private $byMonthDay;

    /**
     * BYYEARDAY rule
     * @Accessor(getter="getByYearDay", setter="setByYearDay")
     * @SerializedName("byyearday")
     * @Type("Zimbra\Mail\Struct\ByYearDayRule")
     * @XmlElement
     */
    private $byYearDay;

    /**
     * BYWEEKNO rule
     * @Accessor(getter="getByWeekNo", setter="setByWeekNo")
     * @SerializedName("byweekno")
     * @Type("Zimbra\Mail\Struct\ByWeekNoRule")
     * @XmlElement
     */
    private $byWeekNo;

    /**
     * BYMONTH rule
     * @Accessor(getter="getByMonth", setter="setByMonth")
     * @SerializedName("bymonth")
     * @Type("Zimbra\Mail\Struct\ByMonthRule")
     * @XmlElement
     */
    private $byMonth;

    /**
     * BYSETPOS rule
     * @Accessor(getter="getBySetPos", setter="setBySetPos")
     * @SerializedName("bysetpos")
     * @Type("Zimbra\Mail\Struct\BySetPosRule")
     * @XmlElement
     */
    private $bySetPos;

    /**
     * Week start day - SU,MO,TU,WE,TH,FR,SA
     * @Accessor(getter="getWeekStart", setter="setWeekStart")
     * @SerializedName("wkst")
     * @Type("Zimbra\Mail\Struct\WkstRule")
     * @XmlElement
     */
    private $weekStart;

    /**
     * X Name rules
     * @Accessor(getter="getXNames", setter="setXNames")
     * @SerializedName("rule-x-name")
     * @Type("array<Zimbra\Mail\Struct\XNameRule>")
     * @XmlList(inline = true, entry = "rule-x-name")
     */
    private $xNames = [];

    /**
     * Constructor method for SimpleRepeatingRule
     *
     * @param  Frequency $frequency
     * @param  IntervalRule $ir
     * @param  array $xNames
     * @return self
     */
    public function __construct(Frequency $frequency, ?IntervalRule $ir = NULL, array $xNames = [])
    {
        $this->setFrequency($frequency)
             ->setXNames($xNames);
        if ($ir instanceof IntervalRule) {
            $this->setInterval($ir);
        }
    }

    /**
     * Gets frequency
     *
     * @return Frequency
     */
    public function getFrequency(): Frequency
    {
        return $this->frequency;
    }

    /**
     * Sets frequency
     *
     * @param  Frequency $frequency
     * @return self
     */
    public function setFrequency(Frequency $frequency): self
    {
        $this->frequency = $frequency;
        return $this;
    }

    /**
     * Gets until
     *
     * @return DateTimeStringAttrInterface
     */
    public function getUntil(): ?DateTimeStringAttrInterface
    {
        return $this->until;
    }

    /**
     * Sets until
     *
     * @param  DateTimeStringAttrInterface $until
     * @return self
     */
    public function setUntil(DateTimeStringAttrInterface $until): self
    {
        $this->until = $until;
        return $this;
    }

    /**
     * Gets count
     *
     * @return NumAttrInterface
     */
    public function getCount(): ?NumAttrInterface
    {
        return $this->count;
    }

    /**
     * Sets count
     *
     * @param  NumAttrInterface $count
     * @return self
     */
    public function setCount(NumAttrInterface $count): self
    {
        $this->count = $count;
        return $this;
    }

    /**
     * Gets interval
     *
     * @return IntervalRuleInterface
     */
    public function getInterval(): ?IntervalRuleInterface
    {
        return $this->interval;
    }

    /**
     * Sets interval
     *
     * @param  IntervalRuleInterface $interval
     * @return self
     */
    public function setInterval(IntervalRuleInterface $interval): self
    {
        $this->interval = $interval;
        return $this;
    }

    /**
     * Gets bySecond
     *
     * @return BySecondRuleInterface
     */
    public function getBySecond(): ?BySecondRuleInterface
    {
        return $this->bySecond;
    }

    /**
     * Sets bySecond
     *
     * @param  BySecondRuleInterface $bySecond
     * @return self
     */
    public function setBySecond(BySecondRuleInterface $bySecond): self
    {
        $this->bySecond = $bySecond;
        return $this;
    }

    /**
     * Gets byMinute
     *
     * @return ByMinuteRuleInterface
     */
    public function getByMinute(): ?ByMinuteRuleInterface
    {
        return $this->byMinute;
    }

    /**
     * Sets byMinute
     *
     * @param  ByMinuteRuleInterface $byMinute
     * @return self
     */
    public function setByMinute(ByMinuteRuleInterface $byMinute): self
    {
        $this->byMinute = $byMinute;
        return $this;
    }

    /**
     * Gets byHour
     *
     * @return ByHourRuleInterface
     */
    public function getByHour(): ?ByHourRuleInterface
    {
        return $this->byHour;
    }

    /**
     * Sets byHour
     *
     * @param  ByHourRuleInterface $byHour
     * @return self
     */
    public function setByHour(ByHourRuleInterface $byHour): self
    {
        $this->byHour = $byHour;
        return $this;
    }

    /**
     * Gets byDay
     *
     * @return ByDayRuleInterface
     */
    public function getByDay(): ?ByDayRuleInterface
    {
        return $this->byDay;
    }

    /**
     * Sets byDay
     *
     * @param  ByDayRuleInterface $byDay
     * @return self
     */
    public function setByDay(ByDayRuleInterface $byDay): self
    {
        $this->byDay = $byDay;
        return $this;
    }

    /**
     * Gets byMonthDay
     *
     * @return ByMonthDayRuleInterface
     */
    public function getByMonthDay(): ?ByMonthDayRuleInterface
    {
        return $this->byMonthDay;
    }

    /**
     * Sets byMonthDay
     *
     * @param  ByMonthDayRuleInterface $byMonthDay
     * @return self
     */
    public function setByMonthDay(ByMonthDayRuleInterface $byMonthDay): self
    {
        $this->byMonthDay = $byMonthDay;
        return $this;
    }

    /**
     * Gets byYearDay
     *
     * @return ByYearDayRuleInterface
     */
    public function getByYearDay(): ?ByYearDayRuleInterface
    {
        return $this->byYearDay;
    }

    /**
     * Sets byYearDay
     *
     * @param  ByYearDayRuleInterface $byYearDay
     * @return self
     */
    public function setByYearDay(ByYearDayRuleInterface $byYearDay): self
    {
        $this->byYearDay = $byYearDay;
        return $this;
    }

    /**
     * Gets byWeekNo
     *
     * @return ByWeekNoRuleInterface
     */
    public function getByWeekNo(): ?ByWeekNoRuleInterface
    {
        return $this->byWeekNo;
    }

    /**
     * Sets byWeekNo
     *
     * @param  ByWeekNoRuleInterface $byWeekNo
     * @return self
     */
    public function setByWeekNo(ByWeekNoRuleInterface $byWeekNo): self
    {
        $this->byWeekNo = $byWeekNo;
        return $this;
    }

    /**
     * Gets byMonth
     *
     * @return ByMonthRuleInterface
     */
    public function getByMonth(): ?ByMonthRuleInterface
    {
        return $this->byMonth;
    }

    /**
     * Sets byMonth
     *
     * @param  ByMonthRuleInterface $byMonth
     * @return self
     */
    public function setByMonth(ByMonthRuleInterface $byMonth): self
    {
        $this->byMonth = $byMonth;
        return $this;
    }

    /**
     * Gets bySetPos
     *
     * @return BySetPosRuleInterface
     */
    public function getBySetPos(): ?BySetPosRuleInterface
    {
        return $this->bySetPos;
    }

    /**
     * Sets bySetPos
     *
     * @param  BySetPosRuleInterface $bySetPos
     * @return self
     */
    public function setBySetPos(BySetPosRuleInterface $bySetPos): self
    {
        $this->bySetPos = $bySetPos;
        return $this;
    }

    /**
     * Gets weekStart
     *
     * @return WkstRuleInterface
     */
    public function getWeekStart(): ?WkstRuleInterface
    {
        return $this->weekStart;
    }

    /**
     * Sets weekStart
     *
     * @param  WkstRuleInterface $weekStart
     * @return self
     */
    public function setWeekStart(WkstRuleInterface $weekStart): self
    {
        $this->weekStart = $weekStart;
        return $this;
    }

    /**
     * Add xName
     *
     * @param  XNameRuleInterface $xName
     * @return self
     */
    public function addXName(XNameRuleInterface $xName): self
    {
        $this->xNames[] = $xName;
        return $this;
    }

    /**
     * Set xNames
     *
     * @param  array $xNames
     * @return self
     */
    public function setXNames(array $xNames): self
    {
        $this->xNames = [];
        foreach ($xNames as $xName) {
            if ($xName instanceof XNameRuleInterface) {
                $this->xNames[] = $xName;
            }
        }
        return $this;
    }

    /**
     * Gets xNames
     *
     * @return array
     */
    public function getXNames(): array
    {
        return $this->xNames;
    }
}
