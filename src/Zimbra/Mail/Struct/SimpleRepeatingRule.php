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
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class SimpleRepeatingRule extends Base
{
    /**
     * X Name rules
     * @var TypedSequence
     */
    private $_ruleXName;

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
        array $ruleXNames = array()
    )
    {
        parent::__construct();
        $this->property('freq', $freq);
        if($until instanceof DateTimeStringAttr)
        {
            $this->child('until', $until);
        }
        if($count instanceof NumAttr)
        {
            $this->child('count', $count);
        }
        if($interval instanceof IntervalRule)
        {
            $this->child('interval', $interval);
        }
        if($bysecond instanceof BySecondRule)
        {
            $this->child('bysecond', $bysecond);
        }
        if($byminute instanceof ByMinuteRule)
        {
            $this->child('byminute', $byminute);
        }
        if($byhour instanceof ByHourRule)
        {
            $this->child('byhour', $byhour);
        }
        if($byday instanceof ByDayRule)
        {
            $this->child('byday', $byday);
        }
        if($bymonthday instanceof ByMonthDayRule)
        {
            $this->child('bymonthday', $bymonthday);
        }
        if($byyearday instanceof ByYearDayRule)
        {
            $this->child('byyearday', $byyearday);
        }
        if($byweekno instanceof ByWeekNoRule)
        {
            $this->child('byweekno', $byweekno);
        }
        if($bymonth instanceof ByMonthRule)
        {
            $this->child('bymonth', $bymonth);
        }
        if($bysetpos instanceof BySetPosRule)
        {
            $this->child('bysetpos', $bysetpos);
        }
        if($wkst instanceof WkstRule)
        {
            $this->child('wkst', $wkst);
        }
        $this->_ruleXName = new TypedSequence('Zimbra\Mail\Struct\XNameRule', $ruleXNames);

        $this->addHook(function($sender)
        {
            $sender->child('rule-x-name', $sender->ruleXName()->all());
        });
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
            return $this->property('freq');
        }
        return $this->property('freq', $freq);
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
            return $this->child('until');
        }
        return $this->child('until', $until);
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
            return $this->child('count');
        }
        return $this->child('count', $count);
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
            return $this->child('interval');
        }
        return $this->child('interval', $interval);
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
            return $this->child('bysecond');
        }
        return $this->child('bysecond', $bysecond);
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
            return $this->child('byminute');
        }
        return $this->child('byminute', $byminute);
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
            return $this->child('byhour');
        }
        return $this->child('byhour', $byhour);
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
            return $this->child('byday');
        }
        return $this->child('byday', $byday);
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
            return $this->child('bymonthday');
        }
        return $this->child('bymonthday', $bymonthday);
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
            return $this->child('byyearday');
        }
        return $this->child('byyearday', $byyearday);
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
            return $this->child('byweekno');
        }
        return $this->child('byweekno', $byweekno);
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
            return $this->child('bymonth');
        }
        return $this->child('bymonth', $bymonth);
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
            return $this->child('bysetpos');
        }
        return $this->child('bysetpos', $bysetpos);
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
            return $this->child('wkst');
        }
        return $this->child('wkst', $wkst);
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
