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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SimpleRepeatingRule implements RecurRuleBase, SimpleRepeatingRuleInterface
{
    /**
     * Frequency - SEC,MIN,HOU,DAI,WEE,MON,YEA
     * 
     * @Accessor(getter="getFrequency", setter="setFrequency")
     * @SerializedName("freq")
     * @Type("Enum<Zimbra\Common\Enum\Frequency>")
     * @XmlAttribute
     * 
     * @var Frequency
     */
    #[Accessor(getter: 'getFrequency', setter: 'setFrequency')]
    #[SerializedName(name: 'freq')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\Frequency>')]
    #[XmlAttribute]
    private $frequency;

    /**
     * UNTIL date specification
     * 
     * @Accessor(getter="getUntil", setter="setUntil")
     * @SerializedName("until")
     * @Type("Zimbra\Mail\Struct\DateTimeStringAttr")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var DateTimeStringAttrInterface
     */
    #[Accessor(getter: "getUntil", setter: "setUntil")]
    #[SerializedName(name: 'until')]
    #[Type(name: DateTimeStringAttr::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $until;

    /**
     * Count of instances to generate
     * 
     * @Accessor(getter="getCount", setter="setCount")
     * @SerializedName("count")
     * @Type("Zimbra\Mail\Struct\NumAttr")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var NumAttrInterface
     */
    #[Accessor(getter: "getCount", setter: "setCount")]
    #[SerializedName(name: 'count')]
    #[Type(name: NumAttr::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $count;

    /**
     * Interval specification
     * 
     * @Accessor(getter="getInterval", setter="setInterval")
     * @SerializedName("interval")
     * @Type("Zimbra\Mail\Struct\IntervalRule")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var IntervalRuleInterface
     */
    #[Accessor(getter: "getInterval", setter: "setInterval")]
    #[SerializedName(name: 'interval')]
    #[Type(name: IntervalRule::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $interval;

    /**
     * BYSECOND rule
     * 
     * @Accessor(getter="getBySecond", setter="setBySecond")
     * @SerializedName("bysecond")
     * @Type("Zimbra\Mail\Struct\BySecondRule")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var BySecondRuleInterface
     */
    #[Accessor(getter: "getBySecond", setter: "setBySecond")]
    #[SerializedName(name: 'bysecond')]
    #[Type(name: BySecondRule::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $bySecond;

    /**
     * BYMINUTE rule
     * 
     * @Accessor(getter="getByMinute", setter="setByMinute")
     * @SerializedName("byminute")
     * @Type("Zimbra\Mail\Struct\ByMinuteRule")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var ByMinuteRuleInterface
     */
    #[Accessor(getter: "getByMinute", setter: "setByMinute")]
    #[SerializedName(name: 'byminute')]
    #[Type(name: ByMinuteRule::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $byMinute;

    /**
     * BYHOUR rule
     * 
     * @Accessor(getter="getByHour", setter="setByHour")
     * @SerializedName("byhour")
     * @Type("Zimbra\Mail\Struct\ByHourRule")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var ByHourRuleInterface
     */
    #[Accessor(getter: "getByHour", setter: "setByHour")]
    #[SerializedName(name: 'byhour')]
    #[Type(name: ByHourRule::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $byHour;

    /**
     * BYDAY rule
     * 
     * @Accessor(getter="getByDay", setter="setByDay")
     * @SerializedName("byday")
     * @Type("Zimbra\Mail\Struct\ByDayRule")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var ByDayRuleInterface
     */
    #[Accessor(getter: "getByDay", setter: "setByDay")]
    #[SerializedName(name: 'byday')]
    #[Type(name: ByDayRule::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $byDay;

    /**
     * BYMONTHDAY rule
     * 
     * @Accessor(getter="getByMonthDay", setter="setByMonthDay")
     * @SerializedName("bymonthday")
     * @Type("Zimbra\Mail\Struct\ByMonthDayRule")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var ByMonthDayRuleInterface
     */
    #[Accessor(getter: "getByMonthDay", setter: "setByMonthDay")]
    #[SerializedName(name: 'bymonthday')]
    #[Type(name: ByMonthDayRule::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $byMonthDay;

    /**
     * BYYEARDAY rule
     * 
     * @Accessor(getter="getByYearDay", setter="setByYearDay")
     * @SerializedName("byyearday")
     * @Type("Zimbra\Mail\Struct\ByYearDayRule")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var ByYearDayRuleInterface
     */
    #[Accessor(getter: "getByYearDay", setter: "setByYearDay")]
    #[SerializedName(name: 'byyearday')]
    #[Type(name: ByYearDayRule::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $byYearDay;

    /**
     * BYWEEKNO rule
     * 
     * @Accessor(getter="getByWeekNo", setter="setByWeekNo")
     * @SerializedName("byweekno")
     * @Type("Zimbra\Mail\Struct\ByWeekNoRule")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var ByWeekNoRuleInterface
     */
    #[Accessor(getter: "getByWeekNo", setter: "setByWeekNo")]
    #[SerializedName(name: 'byweekno')]
    #[Type(name: ByWeekNoRule::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $byWeekNo;

    /**
     * BYMONTH rule
     * 
     * @Accessor(getter="getByMonth", setter="setByMonth")
     * @SerializedName("bymonth")
     * @Type("Zimbra\Mail\Struct\ByMonthRule")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var ByMonthRuleInterface
     */
    #[Accessor(getter: "getByMonth", setter: "setByMonth")]
    #[SerializedName(name: 'bymonth')]
    #[Type(name: ByMonthRule::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $byMonth;

    /**
     * BYSETPOS rule
     * 
     * @Accessor(getter="getBySetPos", setter="setBySetPos")
     * @SerializedName("bysetpos")
     * @Type("Zimbra\Mail\Struct\BySetPosRule")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var BySetPosRuleInterface
     */
    #[Accessor(getter: "getBySetPos", setter: "setBySetPos")]
    #[SerializedName(name: 'bysetpos')]
    #[Type(name: BySetPosRule::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $bySetPos;

    /**
     * Week start day - SU,MO,TU,WE,TH,FR,SA
     * 
     * @Accessor(getter="getWeekStart", setter="setWeekStart")
     * @SerializedName("wkst")
     * @Type("Zimbra\Mail\Struct\WkstRule")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var WkstRuleInterface
     */
    #[Accessor(getter: "getWeekStart", setter: "setWeekStart")]
    #[SerializedName(name: 'wkst')]
    #[Type(name: WkstRule::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $weekStart;

    /**
     * X Name rules
     * 
     * @Accessor(getter="getXNames", setter="setXNames")
     * @Type("array<Zimbra\Mail\Struct\XNameRule>")
     * @XmlList(inline=true, entry="rule-x-name", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getXNames', setter: 'setXNames')]
    #[Type(name: 'array<Zimbra\Mail\Struct\XNameRule>')]
    #[XmlList(inline: true, entry: 'rule-x-name', namespace: 'urn:zimbraMail')]
    private $xNames = [];

    /**
     * Constructor
     *
     * @param  Frequency $frequency
     * @param  DateTimeStringAttrInterface $until
     * @param  NumAttrInterface $count
     * @param  IntervalRuleInterface $interval
     * @param  BySecondRuleInterface $bySecond
     * @param  ByMinuteRuleInterface $byMinute
     * @param  ByHourRuleInterface $byHour
     * @param  ByDayRuleInterface $byDay
     * @param  ByMonthDayRuleInterface $byMonthDay
     * @param  ByYearDayRuleInterface $byYearDay
     * @param  ByWeekNoRuleInterface $byWeekNo
     * @param  ByMonthRuleInterface $byMonth
     * @param  BySetPosRuleInterface $bySetPos
     * @param  WkstRuleInterface $weekStart
     * @param  array $xNames
     * @return self
     */
    public function __construct(
        ?Frequency $frequency = NULL,
        ?DateTimeStringAttrInterface $until = NULL,
        ?NumAttrInterface $count = NULL,
        ?IntervalRuleInterface $interval = NULL,
        ?BySecondRuleInterface $bySecond = NULL,
        ?ByMinuteRuleInterface $byMinute = NULL,
        ?ByHourRuleInterface $byHour = NULL,
        ?ByDayRuleInterface $byDay = NULL,
        ?ByMonthDayRuleInterface $byMonthDay = NULL,
        ?ByYearDayRuleInterface $byYearDay = NULL,
        ?ByWeekNoRuleInterface $byWeekNo = NULL,
        ?ByMonthRuleInterface $byMonth = NULL,
        ?BySetPosRuleInterface $bySetPos = NULL,
        ?WkstRuleInterface $weekStart = NULL,
        array $xNames = []
    )
    {
        $this->setFrequency($frequency ?? new Frequency('SEC'))
             ->setXNames($xNames);
        if ($until instanceof DateTimeStringAttrInterface) {
            $this->setUntil($until);
        }
        if ($count instanceof NumAttrInterface) {
            $this->setCount($count);
        }
        if ($interval instanceof IntervalRuleInterface) {
            $this->setInterval($interval);
        }
        if ($bySecond instanceof BySecondRuleInterface) {
            $this->setBySecond($bySecond);
        }
        if ($byMinute instanceof ByMinuteRuleInterface) {
            $this->setByMinute($byMinute);
        }
        if ($byHour instanceof ByHourRuleInterface) {
            $this->setByHour($byHour);
        }
        if ($byDay instanceof ByDayRuleInterface) {
            $this->setByDay($byDay);
        }
        if ($byMonthDay instanceof ByMonthDayRuleInterface) {
            $this->setByMonthDay($byMonthDay);
        }
        if ($byYearDay instanceof ByYearDayRuleInterface) {
            $this->setByYearDay($byYearDay);
        }
        if ($byWeekNo instanceof ByWeekNoRuleInterface) {
            $this->setByWeekNo($byWeekNo);
        }
        if ($byMonth instanceof ByMonthRuleInterface) {
            $this->setByMonth($byMonth);
        }
        if ($bySetPos instanceof BySetPosRuleInterface) {
            $this->setBySetPos($bySetPos);
        }
        if ($weekStart instanceof WkstRuleInterface) {
            $this->setWeekStart($weekStart);
        }
    }

    /**
     * Get frequency
     *
     * @return Frequency
     */
    public function getFrequency(): Frequency
    {
        return $this->frequency;
    }

    /**
     * Set frequency
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
     * Get until
     *
     * @return DateTimeStringAttrInterface
     */
    public function getUntil(): ?DateTimeStringAttrInterface
    {
        return $this->until;
    }

    /**
     * Set until
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
     * Get count
     *
     * @return NumAttrInterface
     */
    public function getCount(): ?NumAttrInterface
    {
        return $this->count;
    }

    /**
     * Set count
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
     * Get interval
     *
     * @return IntervalRuleInterface
     */
    public function getInterval(): ?IntervalRuleInterface
    {
        return $this->interval;
    }

    /**
     * Set interval
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
     * Get bySecond
     *
     * @return BySecondRuleInterface
     */
    public function getBySecond(): ?BySecondRuleInterface
    {
        return $this->bySecond;
    }

    /**
     * Set bySecond
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
     * Get byMinute
     *
     * @return ByMinuteRuleInterface
     */
    public function getByMinute(): ?ByMinuteRuleInterface
    {
        return $this->byMinute;
    }

    /**
     * Set byMinute
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
     * Get byHour
     *
     * @return ByHourRuleInterface
     */
    public function getByHour(): ?ByHourRuleInterface
    {
        return $this->byHour;
    }

    /**
     * Set byHour
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
     * Get byDay
     *
     * @return ByDayRuleInterface
     */
    public function getByDay(): ?ByDayRuleInterface
    {
        return $this->byDay;
    }

    /**
     * Set byDay
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
     * Get byMonthDay
     *
     * @return ByMonthDayRuleInterface
     */
    public function getByMonthDay(): ?ByMonthDayRuleInterface
    {
        return $this->byMonthDay;
    }

    /**
     * Set byMonthDay
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
     * Get byYearDay
     *
     * @return ByYearDayRuleInterface
     */
    public function getByYearDay(): ?ByYearDayRuleInterface
    {
        return $this->byYearDay;
    }

    /**
     * Set byYearDay
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
     * Get byWeekNo
     *
     * @return ByWeekNoRuleInterface
     */
    public function getByWeekNo(): ?ByWeekNoRuleInterface
    {
        return $this->byWeekNo;
    }

    /**
     * Set byWeekNo
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
     * Get byMonth
     *
     * @return ByMonthRuleInterface
     */
    public function getByMonth(): ?ByMonthRuleInterface
    {
        return $this->byMonth;
    }

    /**
     * Set byMonth
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
     * Get bySetPos
     *
     * @return BySetPosRuleInterface
     */
    public function getBySetPos(): ?BySetPosRuleInterface
    {
        return $this->bySetPos;
    }

    /**
     * Set bySetPos
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
     * Get weekStart
     *
     * @return WkstRuleInterface
     */
    public function getWeekStart(): ?WkstRuleInterface
    {
        return $this->weekStart;
    }

    /**
     * Set weekStart
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
        $this->xNames = array_filter($xNames, static fn ($xName) => $xName instanceof XNameRuleInterface);
        return $this;
    }

    /**
     * Get xNames
     *
     * @return array
     */
    public function getXNames(): array
    {
        return $this->xNames;
    }
}
