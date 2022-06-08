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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};
use Zimbra\Common\Enum\Frequency;
use Zimbra\Common\Struct\{
    ByDayRuleInterface,
    ByHourRuleInterface,
    ByMinuteRuleInterface,
    ByMonthDayRuleInterface,
    ByMonthRuleInterface,
    BySecondRuleInterface,
    BySetPosRuleInterface,
    ByWeekNoRuleInterface,
    ByYearDayRuleInterface,
    DateTimeStringAttrInterface,
    IntervalRuleInterface,
    NumAttrInterface,
    SimpleRepeatingRuleInterface,
    WkstRuleInterface,
    XNameRuleInterface
};

/**
 * SimpleRepeatingRule class
 * Simple repeating rule information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SimpleRepeatingRule implements RecurRuleBase, SimpleRepeatingRuleInterface
{
    /**
     * Frequency - SEC,MIN,HOU,DAI,WEE,MON,YEA
     * @Accessor(getter="getFrequency", setter="setFrequency")
     * @SerializedName("freq")
     * @Type("Zimbra\Common\Enum\Frequency")
     * @XmlAttribute
     */
    private Frequency $frequency;

    /**
     * UNTIL date specification
     * @Accessor(getter="getUntil", setter="setUntil")
     * @SerializedName("until")
     * @Type("Zimbra\Mail\Struct\DateTimeStringAttr")
     * @XmlElement
     */
    private ?DateTimeStringAttrInterface $until = NULL;

    /**
     * Count of instances to generate
     * @Accessor(getter="getCount", setter="setCount")
     * @SerializedName("count")
     * @Type("Zimbra\Mail\Struct\NumAttr")
     * @XmlElement
     */
    private ?NumAttrInterface $count = NULL;

    /**
     * Interval specification
     * @Accessor(getter="getInterval", setter="setInterval")
     * @SerializedName("interval")
     * @Type("Zimbra\Mail\Struct\IntervalRule")
     * @XmlElement
     */
    private ?IntervalRuleInterface $interval = NULL;

    /**
     * BYSECOND rule
     * @Accessor(getter="getBySecond", setter="setBySecond")
     * @SerializedName("bysecond")
     * @Type("Zimbra\Mail\Struct\BySecondRule")
     * @XmlElement
     */
    private ?BySecondRuleInterface $bySecond = NULL;

    /**
     * BYMINUTE rule
     * @Accessor(getter="getByMinute", setter="setByMinute")
     * @SerializedName("byminute")
     * @Type("Zimbra\Mail\Struct\ByMinuteRule")
     * @XmlElement
     */
    private ?ByMinuteRuleInterface $byMinute = NULL;

    /**
     * BYHOUR rule
     * @Accessor(getter="getByHour", setter="setByHour")
     * @SerializedName("byhour")
     * @Type("Zimbra\Mail\Struct\ByHourRule")
     * @XmlElement
     */
    private ?ByHourRuleInterface $byHour = NULL;

    /**
     * BYDAY rule
     * @Accessor(getter="getByDay", setter="setByDay")
     * @SerializedName("byday")
     * @Type("Zimbra\Mail\Struct\ByDayRule")
     * @XmlElement
     */
    private ?ByDayRuleInterface $byDay = NULL;

    /**
     * BYMONTHDAY rule
     * @Accessor(getter="getByMonthDay", setter="setByMonthDay")
     * @SerializedName("bymonthday")
     * @Type("Zimbra\Mail\Struct\ByMonthDayRule")
     * @XmlElement
     */
    private ?ByMonthDayRuleInterface $byMonthDay = NULL;

    /**
     * BYYEARDAY rule
     * @Accessor(getter="getByYearDay", setter="setByYearDay")
     * @SerializedName("byyearday")
     * @Type("Zimbra\Mail\Struct\ByYearDayRule")
     * @XmlElement
     */
    private ?ByYearDayRuleInterface $byYearDay = NULL;

    /**
     * BYWEEKNO rule
     * @Accessor(getter="getByWeekNo", setter="setByWeekNo")
     * @SerializedName("byweekno")
     * @Type("Zimbra\Mail\Struct\ByWeekNoRule")
     * @XmlElement
     */
    private ?ByWeekNoRuleInterface $byWeekNo = NULL;

    /**
     * BYMONTH rule
     * @Accessor(getter="getByMonth", setter="setByMonth")
     * @SerializedName("bymonth")
     * @Type("Zimbra\Mail\Struct\ByMonthRule")
     * @XmlElement
     */
    private ?ByMonthRuleInterface $byMonth = NULL;

    /**
     * BYSETPOS rule
     * @Accessor(getter="getBySetPos", setter="setBySetPos")
     * @SerializedName("bysetpos")
     * @Type("Zimbra\Mail\Struct\BySetPosRule")
     * @XmlElement
     */
    private ?BySetPosRuleInterface $bySetPos = NULL;

    /**
     * Week start day - SU,MO,TU,WE,TH,FR,SA
     * @Accessor(getter="getWeekStart", setter="setWeekStart")
     * @SerializedName("wkst")
     * @Type("Zimbra\Mail\Struct\WkstRule")
     * @XmlElement
     */
    private ?WkstRuleInterface $weekStart = NULL;

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
     * @param  IntervalRule $interval
     * @param  array $xNames
     * @return self
     */
    public function __construct(Frequency $frequency, ?IntervalRule $interval = NULL, array $xNames = [])
    {
        $this->setFrequency($frequency)
             ->setXNames($xNames);
        if ($interval instanceof IntervalRule) {
            $this->setInterval($interval);
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
        $this->xNames = array_filter($xNames, static fn($xName) => $xName instanceof XNameRuleInterface);
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
