<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Common\TypedSequence;
use Zimbra\Enum\Frequency;
use Zimbra\Struct\Base;

/**
 * SimpleRepeatingRule struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SimpleRepeatingRule extends Base implements RecurRuleBase
{
    /**
     * X Name rules
     * @var TypedSequence
     */
    private $_ruleXNames;

    /**
     * Constructor method for SimpleRepeatingRule
     * @param Frequency $freq Frequency - SEC,MIN,HOU,DAI,WEE,MON,YEA
     * @param DateTimeStringAttr $until UNTIL date specification
     * @param NumAttr $count Count of instances to generate
     * @param IntervalRule $interval Interval specification
     * @param BySecondRule $bysecond BYSECOND rule
     * @param ByMinuteRule $byminute BYMINUTE rule
     * @param ByHourRule $byhour BYHOUR rule
     * @param ByDayRule $byday BYDAY rule
     * @param ByMonthDayRule $bymonthday BYMONTHDAY rule
     * @param ByYearDayRule $byyearday BYYEARDAY rule
     * @param ByWeekNoRule $byweekno BYWEEKNO rule
     * @param ByMonthRule $bymonth BYMONTH rule
     * @param BySetPosRule $bysetpos BYSETPOS rule
     * @param WkstRule $wkst Week start day - SU,MO,TU,WE,TH,FR,SA
     * @param array $ruleXNames X Name rules
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
        array $ruleXNames = []
    )
    {
        parent::__construct();
        $this->setProperty('freq', $freq);
        if($until instanceof DateTimeStringAttr)
        {
            $this->setChild('until', $until);
        }
        if($count instanceof NumAttr)
        {
            $this->setChild('count', $count);
        }
        if($interval instanceof IntervalRule)
        {
            $this->setChild('interval', $interval);
        }
        if($bysecond instanceof BySecondRule)
        {
            $this->setChild('bysecond', $bysecond);
        }
        if($byminute instanceof ByMinuteRule)
        {
            $this->setChild('byminute', $byminute);
        }
        if($byhour instanceof ByHourRule)
        {
            $this->setChild('byhour', $byhour);
        }
        if($byday instanceof ByDayRule)
        {
            $this->setChild('byday', $byday);
        }
        if($bymonthday instanceof ByMonthDayRule)
        {
            $this->setChild('bymonthday', $bymonthday);
        }
        if($byyearday instanceof ByYearDayRule)
        {
            $this->setChild('byyearday', $byyearday);
        }
        if($byweekno instanceof ByWeekNoRule)
        {
            $this->setChild('byweekno', $byweekno);
        }
        if($bymonth instanceof ByMonthRule)
        {
            $this->setChild('bymonth', $bymonth);
        }
        if($bysetpos instanceof BySetPosRule)
        {
            $this->setChild('bysetpos', $bysetpos);
        }
        if($wkst instanceof WkstRule)
        {
            $this->setChild('wkst', $wkst);
        }

        $this->setRuleXNames($ruleXNames);
        $this->on('before', function(Base $sender)
        {
            if($sender->getRuleXNames()->count())
            {
                $sender->setChild('rule-x-name', $sender->getRuleXNames()->all());
            }
        });
    }

    /**
     * Gets freq
     *
     * @return Frequency
     */
    public function getFrequency()
    {
        return $this->getProperty('freq');
    }

    /**
     * Sets freq
     *
     * @param  Frequency $freq
     * @return self
     */
    public function setFrequency(Frequency $freq)
    {
        return $this->setProperty('freq', $freq);
    }

    /**
     * Gets until
     *
     * @return DateTimeStringAttr
     */
    public function getUntil()
    {
        return $this->getChild('until');
    }

    /**
     * Sets until
     *
     * @param  DateTimeStringAttr $until
     * @return self
     */
    public function setUntil(DateTimeStringAttr $until)
    {
        return $this->setChild('until', $until);
    }

    /**
     * Gets count of instances to generate
     *
     * @return NumAttr
     */
    public function getCount()
    {
        return $this->getChild('count');
    }

    /**
     * Sets count of instances to generate
     *
     * @param  NumAttr $count
     * @return self
     */
    public function setCount(NumAttr $count)
    {
        return $this->setChild('count', $count);
    }

    /**
     * Gets interval
     *
     * @return IntervalRule
     */
    public function getInterval()
    {
        return $this->getChild('interval');
    }

    /**
     * Sets interval
     *
     * @param  IntervalRule $interval
     * @return self
     */
    public function setInterval(IntervalRule $interval)
    {
        return $this->setChild('interval', $interval);
    }

    /**
     * Gets by second rule
     *
     * @return BySecondRule
     */
    public function getBySecond()
    {
        return $this->getChild('bysecond');
    }

    /**
     * Sets by second rule
     *
     * @param  BySecondRule $bysecond
     * @return self
     */
    public function setBySecond(BySecondRule $bysecond)
    {
        return $this->setChild('bysecond', $bysecond);
    }

    /**
     * Gets by minute rule
     *
     * @return ByMinuteRule
     */
    public function getByMinute()
    {
        return $this->getChild('byminute');
    }

    /**
     * Sets by minute rule
     *
     * @param  ByMinuteRule $byminute
     * @return self
     */
    public function setByMinute(ByMinuteRule $byminute)
    {
        return $this->setChild('byminute', $byminute);
    }

    /**
     * Gets by hour rule
     *
     * @return ByHourRule
     */
    public function getByHour()
    {
        return $this->getChild('byhour');
    }

    /**
     * Sets by hour rule
     *
     * @param  ByHourRule $byhour
     * @return self
     */
    public function setByHour(ByHourRule $byhour)
    {
        return $this->setChild('byhour', $byhour);
    }

    /**
     * Gets by day rule
     *
     * @return ByDayRule
     */
    public function getByDay()
    {
        return $this->getChild('byday');
    }

    /**
     * Sets by day rule
     *
     * @param  ByDayRule $byday
     * @return self
     */
    public function setByDay(ByDayRule $byday)
    {
        return $this->setChild('byday', $byday);
    }

    /**
     * Gets by month day rule
     *
     * @return ByMonthDayRule
     */
    public function getByMonthDay()
    {
        return $this->getChild('bymonthday');
    }

    /**
     * Sets by month day rule
     *
     * @param  ByMonthDayRule $bymonthday
     * @return self
     */
    public function setByMonthDay(ByMonthDayRule $bymonthday)
    {
        return $this->setChild('bymonthday', $bymonthday);
    }

    /**
     * Gets by year day rule
     *
     * @return ByYearDayRule
     */
    public function getByYearDay()
    {
        return $this->getChild('byyearday');
    }

    /**
     * Sets by year day rule
     *
     * @param  ByYearDayRule $byyearday
     * @return self
     */
    public function setByYearDay(ByYearDayRule $byyearday)
    {
        return $this->setChild('byyearday', $byyearday);
    }

    /**
     * Gets by week no rule
     *
     * @return ByWeekNoRule
     */
    public function getByWeekNo()
    {
        return $this->getChild('byweekno');
    }

    /**
     * Sets by week no rule
     *
     * @param  ByWeekNoRule $byweekno
     * @return self
     */
    public function setByWeekNo(ByWeekNoRule $byweekno)
    {
        return $this->setChild('byweekno', $byweekno);
    }

    /**
     * Gets by month rule
     *
     * @return ByMonthRule
     */
    public function getByMonth()
    {
        return $this->getChild('bymonth');
    }

    /**
     * Sets by by month rule
     *
     * @param  ByMonthRule $bymonth
     * @return self
     */
    public function setByMonth(ByMonthRule $bymonth)
    {
        return $this->setChild('bymonth', $bymonth);
    }

    /**
     * Gets by set pos rule
     *
     * @return BySetPosRule
     */
    public function getBySetPos()
    {
        return $this->getChild('bysetpos');
    }

    /**
     * Sets by set pos rule
     *
     * @param  BySetPosRule $bysetpos
     * @return self
     */
    public function setBySetPos(BySetPosRule $bysetpos)
    {
        return $this->setChild('bysetpos', $bysetpos);
    }

    /**
     * Gets week start day
     *
     * @return WkstRule
     */
    public function getWeekStart()
    {
        return $this->getChild('wkst');
    }

    /**
     * Sets week start day
     *
     * @param  WkstRule $wkst
     * @return self
     */
    public function setWeekStart(WkstRule $wkst)
    {
        return $this->setChild('wkst', $wkst);
    }

    /**
     * Add XNameRule
     *
     * @param  XNameRule $ruleXName
     * @return self
     */
    public function addXNameRule(XNameRule $ruleXName)
    {
        $this->_ruleXNames->add($ruleXName);
        return $this;
    }

    /**
     * Sets ruleXName sequence
     *
     * @param  array $ruleXNames
     * @return self
     */
    public function setRuleXNames(array $ruleXNames)
    {
        $this->_ruleXNames = new TypedSequence('Zimbra\Mail\Struct\XNameRule', $ruleXNames);
        return $this;
    }

    /**
     * Gets ruleXName sequence
     *
     * @return Sequence
     */
    public function getRuleXNames()
    {
        return $this->_ruleXNames;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'rule')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'rule')
    {
        return parent::toXml($name);
    }
}
