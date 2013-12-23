<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Soap\Enum\Frequency;
use Zimbra\Utils\SimpleXML;
use Zimbra\Utils\TypedSequence;

/**
 * SimpleRepeatingRule struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SimpleRepeatingRule
{
    /**
     * Frequency - SEC,MIN,HOU,DAI,WEE,MON,YEA
     * @var Frequency
     */
    private $_freq;

    /**
     * UNTIL date specification
     * @var DateTimeStringAttr
     */
    private $_until;

    /**
     * Count of instances to generate
     * @var NumAttr
     */
    private $_count;

    /**
     * Interval specification
     * @var IntervalRule
     */
    private $_interval;

    /**
     * BYSECOND rule
     * @var BySecondRule
     */
    private $_bysecond;

    /**
     * BYMINUTE rule
     * @var ByMinuteRule
     */
    private $_byminute;

    /**
     * BYHOUR rule
     * @var ByHourRule
     */
    private $_byhour;

    /**
     * BYDAY rule
     * @var ByDayRule
     */
    private $_byday;

    /**
     * BYMONTHDAY rule
     * @var ByMonthDayRule
     */
    private $_bymonthday;

    /**
     * BYYEARDAY rule
     * @var ByYearDayRule
     */
    private $_byyearday;

    /**
     * BYWEEKNO rule
     * @var ByWeekNoRule
     */
    private $_byweekno;

    /**
     * BYMONTH rule
     * @var ByMonthRule
     */
    private $_bymonth;

    /**
     * BYSETPOS rule
     * @var BySetPosRule
     */
    private $_bysetpos;

    /**
     * Week start day - SU,MO,TU,WE,TH,FR,SA
     * @var WkstRule
     */
    private $_wkst;

    /**
     * X Name rules
     * @var TypedSequence
     */
    private $_ruleXName;

    /**
     * Constructor method for attr
     * @param Frequency $freq
     * @param DateTimeStringAttr $until
     * @param NumAttr $count
     * @param IntervalRule $interval
     * @param BySecondRule $bysecond;
     * @param ByMinuteRule $byminute;
     * @param ByHourRule $byhour;
     * @param ByDayRule $byday;
     * @param ByMonthDayRule $bymonthday;
     * @param ByYearDayRule $byyearday;
     * @param ByWeekNoRule $byweekno;
     * @param ByMonthRule $bymonth;
     * @param BySetPosRule $bysetpos;
     * @param WkstRule $wkst;
     * @param array $ruleXNames;
     * @return self
     */
    public function __construct(
        Frequency $freq,
        DateTimeStringAttr $until = null,
        NumAttr $count = null,
        IntervalRule $interval = null,
        BySecondRule $bysecond = null,
        ByMinuteRule $byminute = null,
        ByHourRule $byhour = null,
        ByDayRule $byday = null,
        ByMonthDayRule $bymonthday = null,
        ByYearDayRule $byyearday = null,
        ByWeekNoRule $byweekno = null,
        ByMonthRule $bymonth = null,
        BySetPosRule $bysetpos = null,
        WkstRule $wkst = null,
        array $ruleXNames = array()
    )
    {
        $this->_freq = $freq;
        if($until instanceof DateTimeStringAttr)
        {
            $this->_until = $until;
        }
        if($count instanceof NumAttr)
        {
            $this->_count = $count;
        }
        if($interval instanceof IntervalRule)
        {
            $this->_interval = $interval;
        }
        if($bysecond instanceof BySecondRule)
        {
            $this->_bysecond = $bysecond;
        }
        if($byminute instanceof ByMinuteRule)
        {
            $this->_byminute = $byminute;
        }
        if($byhour instanceof ByHourRule)
        {
            $this->_byhour = $byhour;
        }
        if($byday instanceof ByDayRule)
        {
            $this->_byday = $byday;
        }
        if($bymonthday instanceof ByMonthDayRule)
        {
            $this->_bymonthday = $bymonthday;
        }
        if($byyearday instanceof ByYearDayRule)
        {
            $this->_byyearday = $byyearday;
        }
        if($byweekno instanceof ByWeekNoRule)
        {
            $this->_byweekno = $byweekno;
        }
        if($bymonth instanceof ByMonthRule)
        {
            $this->_bymonth = $bymonth;
        }
        if($bysetpos instanceof BySetPosRule)
        {
            $this->_bysetpos = $bysetpos;
        }
        if($wkst instanceof WkstRule)
        {
            $this->_wkst = $wkst;
        }
        $this->_ruleXName = new TypedSequence('Zimbra\Soap\Struct\XNameRule', $ruleXNames);
    }

    /**
     * Gets or sets freq
     *
     * @param  Frequency $ptst
     * @return Frequency|self
     */
    public function freq(Frequency $freq = null)
    {
        if(null === $freq)
        {
            return $this->_freq;
        }
        $this->_freq = $freq;
        return $this;
    }

    /**
     * Gets or sets until
     *
     * @param  DateTimeStringAttr $until
     * @return DateTimeStringAttr|self
     */
    public function until(DateTimeStringAttr $until = null)
    {
        if(null === $until)
        {
            return $this->_until;
        }
        $this->_until = $until;
        return $this;
    }

    /**
     * Gets or sets count
     *
     * @param  NumAttr $count
     * @return NumAttr|self
     */
    public function count(NumAttr $count = null)
    {
        if(null === $count)
        {
            return $this->_count;
        }
        $this->_count = $count;
        return $this;
    }

    /**
     * Gets or sets interval
     *
     * @param  IntervalRule $interval
     * @return IntervalRule|self
     */
    public function interval(IntervalRule $interval = null)
    {
        if(null === $interval)
        {
            return $this->_interval;
        }
        $this->_interval = $interval;
        return $this;
    }

    /**
     * Gets or sets bysecond
     *
     * @param  BySecondRule $bysecond
     * @return BySecondRule|self
     */
    public function bysecond(BySecondRule $bysecond = null)
    {
        if(null === $bysecond)
        {
            return $this->_bysecond;
        }
        $this->_bysecond = $bysecond;
        return $this;
    }

    /**
     * Gets or sets byminute
     *
     * @param  ByMinuteRule $byminute
     * @return ByMinuteRule|self
     */
    public function byminute(ByMinuteRule $byminute = null)
    {
        if(null === $byminute)
        {
            return $this->_byminute;
        }
        $this->_byminute = $byminute;
        return $this;
    }

    /**
     * Gets or sets byhour
     *
     * @param  ByHourRule $byhour
     * @return ByHourRule|self
     */
    public function byhour(ByHourRule $byhour = null)
    {
        if(null === $byhour)
        {
            return $this->_byhour;
        }
        $this->_byhour = $byhour;
        return $this;
    }

    /**
     * Gets or sets byday
     *
     * @param  ByDayRule $byday
     * @return ByDayRule|self
     */
    public function byday(ByDayRule $byday = null)
    {
        if(null === $byday)
        {
            return $this->_byday;
        }
        $this->_byday = $byday;
        return $this;
    }

    /**
     * Gets or sets bymonthday
     *
     * @param  ByMonthDayRule $bymonthday
     * @return ByMonthDayRule|self
     */
    public function bymonthday(ByMonthDayRule $bymonthday = null)
    {
        if(null === $bymonthday)
        {
            return $this->_bymonthday;
        }
        $this->_bymonthday = $bymonthday;
        return $this;
    }

    /**
     * Gets or sets byyearday
     *
     * @param  ByYearDayRule $byyearday
     * @return ByYearDayRule|self
     */
    public function byyearday(ByYearDayRule $byyearday = null)
    {
        if(null === $byyearday)
        {
            return $this->_byyearday;
        }
        $this->_byyearday = $byyearday;
        return $this;
    }

    /**
     * Gets or sets byweekno
     *
     * @param  ByWeekNoRule $byweekno
     * @return ByWeekNoRule|self
     */
    public function byweekno(ByWeekNoRule $byweekno = null)
    {
        if(null === $byweekno)
        {
            return $this->_byweekno;
        }
        $this->_byweekno = $byweekno;
        return $this;
    }

    /**
     * Gets or sets bymonth
     *
     * @param  ByMonthRule $bymonth
     * @return ByMonthRule|self
     */
    public function bymonth(ByMonthRule $bymonth = null)
    {
        if(null === $bymonth)
        {
            return $this->_bymonth;
        }
        $this->_bymonth = $bymonth;
        return $this;
    }

    /**
     * Gets or sets bysetpos
     *
     * @param  BySetPosRule $bysetpos
     * @return BySetPosRule|self
     */
    public function bysetpos(BySetPosRule $bysetpos = null)
    {
        if(null === $bysetpos)
        {
            return $this->_bysetpos;
        }
        $this->_bysetpos = $bysetpos;
        return $this;
    }

    /**
     * Gets or sets wkst
     *
     * @param  WkstRule $wkst
     * @return WkstRule|self
     */
    public function wkst(WkstRule $wkst = null)
    {
        if(null === $wkst)
        {
            return $this->_wkst;
        }
        $this->_wkst = $wkst;
        return $this;
    }

    /**
     * Add XNameRule
     *
     * @param  XNameRule $ruleXName
     * @return self
     */
    public function addXNameRule(XNameRule $ruleXName)
    {
        $this->_ruleXName->add($ruleXName);
        return $this;
    }

    /**
     * Gets ruleXName sequence
     *
     * @return Sequence
     */
    public function ruleXName()
    {
        return $this->_ruleXName;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'rule')
    {
        $name = !empty($name) ? $name : 'rule';
        $arr = array('freq' => (string) $this->_freq);
        if($this->_until instanceof DateTimeStringAttr)
        {
            $arr += $this->_until->toArray('until');
        }
        if($this->_count instanceof NumAttr)
        {
            $arr += $this->_count->toArray('count');
        }
        if($this->_interval instanceof IntervalRule)
        {
            $arr += $this->_interval->toArray('interval');
        }
        if($this->_bysecond instanceof BySecondRule)
        {
            $arr += $this->_bysecond->toArray('bysecond');
        }
        if($this->_byminute instanceof ByMinuteRule)
        {
            $arr += $this->_byminute->toArray('byminute');
        }
        if($this->_byhour instanceof ByHourRule)
        {
            $arr += $this->_byhour->toArray('byhour');
        }
        if($this->_byday instanceof ByDayRule)
        {
            $arr += $this->_byday->toArray('byday');
        }
        if($this->_bymonthday instanceof ByMonthDayRule)
        {
            $arr += $this->_bymonthday->toArray('bymonthday');
        }
        if($this->_byyearday instanceof ByYearDayRule)
        {
            $arr += $this->_byyearday->toArray('byyearday');
        }
        if($this->_byweekno instanceof ByWeekNoRule)
        {
            $arr += $this->_byweekno->toArray('byweekno');
        }
        if($this->_bymonth instanceof ByMonthRule)
        {
            $arr += $this->_bymonth->toArray('bymonth');
        }
        if($this->_bysetpos instanceof BySetPosRule)
        {
            $arr += $this->_bysetpos->toArray('bysetpos');
        }
        if($this->_wkst instanceof WkstRule)
        {
            $arr += $this->_wkst->toArray('wkst');
        }

        if(count($this->_ruleXName))
        {
            $arr['rule-x-name'] = array();
            foreach ($this->_ruleXName as $ruleXName)
            {
                $ruleXNameArr = $ruleXName->toArray('rule-x-name');
                $arr['rule-x-name'][] = $ruleXNameArr['rule-x-name'];
            }
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'rule')
    {
        $name = !empty($name) ? $name : 'rule';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('freq', (string) $this->_freq);
        if($this->_until instanceof DateTimeStringAttr)
        {
            $xml->append($this->_until->toXml('until'));
        }
        if($this->_count instanceof NumAttr)
        {
            $xml->append($this->_count->toXml('count'));
        }
        if($this->_interval instanceof IntervalRule)
        {
            $xml->append($this->_interval->toXml('interval'));
        }
        if($this->_bysecond instanceof BySecondRule)
        {
            $xml->append($this->_bysecond->toXml('bysecond'));
        }
        if($this->_byminute instanceof ByMinuteRule)
        {
            $xml->append($this->_byminute->toXml('byminute'));
        }
        if($this->_byhour instanceof ByHourRule)
        {
            $xml->append($this->_byhour->toXml('byhour'));
        }
        if($this->_byday instanceof ByDayRule)
        {
            $xml->append($this->_byday->toXml('byday'));
        }
        if($this->_bymonthday instanceof ByMonthDayRule)
        {
            $xml->append($this->_bymonthday->toXml('bymonthday'));
        }
        if($this->_byyearday instanceof ByYearDayRule)
        {
            $xml->append($this->_byyearday->toXml('byyearday'));
        }
        if($this->_byweekno instanceof ByWeekNoRule)
        {
            $xml->append($this->_byweekno->toXml('byweekno'));
        }
        if($this->_bymonth instanceof ByMonthRule)
        {
            $xml->append($this->_bymonth->toXml('bymonth'));
        }
        if($this->_bysetpos instanceof BySetPosRule)
        {
            $xml->append($this->_bysetpos->toXml('bysetpos'));
        }
        if($this->_wkst instanceof WkstRule)
        {
            $xml->append($this->_wkst->toXml('wkst'));
        }

        foreach ($this->_ruleXName as $ruleXName)
        {
            $xml->append($ruleXName->toXml('rule-x-name'));
        }
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
