<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\SetCalendarItemInfo;
use Zimbra\Soap\Struct\Replies;
use Zimbra\Utils\TypedSequence;

/**
 * SetAppointment request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SetAppointment extends Request
{
    /**
     * Default calendar item information
     * @var SetCalendarItemInfo
     */
    private $_default;

    /**
     * Calendar item information for exceptions 
     * @var TypedSequence<SetCalendarItemInfo>
     */
    private $_except;

    /**
     * Calendar item information for cancellations 
     * @var TypedSequence<SetCalendarItemInfo>
     */
    private $_cancel;

    /**
     * Replies
     * @var Replies
     */
    private $_replies;

    /**
     * Flags
     * @var string
     */
    private $_f;

    /**
     * Tags (Deprecated - use {tag-names} instead)
     * @var string
     */
    private $_t;

    /**
     * Comma separated list of tag names
     * @var string
     */
    private $_tn;

    /**
     * ID of folder to create appointment in
     * @var string
     */
    private $_l;

    /**
     * Set if all alarms have been dismissed; if this is set, nextAlarm should not be set
     * @var bool
     */
    private $_noNextAlarm;

    /**
     * If specified, time when next alarm should go off. 
     * If missing, two possibilities:
     *   1. if noNextAlarm isn't set, keep current next alarm time (this is a backward compatibility case)
     *   2. if noNextAlarm is set, indicates all alarms have been dismissed
     * @var int
     */
    private $_nextAlarm;

    /**
     * Constructor method for SetAppointment
     * @param  SetCalendarItemInfo $m
     * @param  Replies $replies
     * @return self
     */
    public function __construct(
        SetCalendarItemInfo $default = null,
        array $except = array(),
        array $cancel = array(),
        Replies $replies = null,
        $f = null,
        $t = null,
        $tn = null,
        $l = null,
        $noNextAlarm = null,
        $nextAlarm = null
    )
    {
        parent::__construct();
        if($default instanceof SetCalendarItemInfo)
        {
            $this->_default = $default;
        }
        $this->_except = new TypedSequence('Zimbra\Soap\Struct\SetCalendarItemInfo', $except);
        $this->_cancel = new TypedSequence('Zimbra\Soap\Struct\SetCalendarItemInfo', $cancel);
        if($replies instanceof Replies)
        {
            $this->_replies = $replies;
        }
        $this->_f = trim($f);
        $this->_t = trim($t);
        $this->_tn = trim($tn);
        $this->_l = trim($l);
        if(null !== $noNextAlarm)
        {
            $this->_noNextAlarm = (bool) $noNextAlarm;
        }
        if(null !== $nextAlarm)
        {
            $this->_nextAlarm = (int) $nextAlarm;
        }
    }

    /**
     * Get or set default
     *
     * @param  SetCalendarItemInfo $default
     * @return SetCalendarItemInfo|self
     */
    public function default_(SetCalendarItemInfo $default = null)
    {
        if(null === $default)
        {
            return $this->_default;
        }
        $this->_default = $default;
        return $this;
    }

    /**
     * Add a except
     *
     * @param  SetCalendarItemInfo $except
     * @return self
     */
    public function addExcept(SetCalendarItemInfo $except)
    {
        $this->_except->add($except);
        return $this;
    }

    /**
     * Gets except nextAlarmuence
     *
     * @return Sequence
     */
    public function except()
    {
        return $this->_except;
    }

    /**
     * Add a cancel
     *
     * @param  SetCalendarItemInfo $cancel
     * @return self
     */
    public function addCancel(SetCalendarItemInfo $cancel)
    {
        $this->_cancel->add($cancel);
        return $this;
    }

    /**
     * Gets cancel nextAlarmuence
     *
     * @return Sequence
     */
    public function cancel()
    {
        return $this->_cancel;
    }

    /**
     * Get or set replies
     *
     * @param  Replies $replies
     * @return Replies|self
     */
    public function replies(Replies $replies = null)
    {
        if(null === $replies)
        {
            return $this->_replies;
        }
        $this->_replies = $replies;
        return $this;
    }

    /**
     * Gets or sets f
     *
     * @param  string $f
     * @return string|self
     */
    public function f($f = null)
    {
        if(null === $f)
        {
            return $this->_f;
        }
        $this->_f = trim($f);
        return $this;
    }

    /**
     * Gets or sets t
     *
     * @param  string $t
     * @return string|self
     */
    public function t($t = null)
    {
        if(null === $t)
        {
            return $this->_t;
        }
        $this->_t = trim($t);
        return $this;
    }

    /**
     * Gets or sets tn
     *
     * @param  string $tn
     * @return string|self
     */
    public function tn($tn = null)
    {
        if(null === $tn)
        {
            return $this->_tn;
        }
        $this->_tn = trim($tn);
        return $this;
    }

    /**
     * Gets or sets l
     *
     * @param  string $l
     * @return string|self
     */
    public function l($l = null)
    {
        if(null === $l)
        {
            return $this->_l;
        }
        $this->_l = trim($l);
        return $this;
    }

    /**
     * Gets or sets noNextAlarm
     *
     * @param  bool $noNextAlarm
     * @return bool|self
     */
    public function noNextAlarm($noNextAlarm = null)
    {
        if(null === $noNextAlarm)
        {
            return $this->_noNextAlarm;
        }
        $this->_noNextAlarm = (bool) $noNextAlarm;
        return $this;
    }

    /**
     * Gets or sets nextAlarm
     *
     * @param  int $nextAlarm
     * @return int|self
     */
    public function nextAlarm($nextAlarm = null)
    {
        if(null === $nextAlarm)
        {
            return $this->_nextAlarm;
        }
        $this->_nextAlarm = (int) $nextAlarm;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(!empty($this->_f))
        {
            $this->array['f'] = $this->_f;
        }
        if(!empty($this->_t))
        {
            $this->array['t'] = $this->_t;
        }
        if(!empty($this->_tn))
        {
            $this->array['tn'] = $this->_tn;
        }
        if(!empty($this->_l))
        {
            $this->array['l'] = $this->_l;
        }
        if(is_bool($this->_noNextAlarm))
        {
            $this->array['noNextAlarm'] = $this->_noNextAlarm ? 1 : 0;
        }
        if(is_int($this->_nextAlarm))
        {
            $this->array['nextAlarm'] = $this->_nextAlarm;
        }

        if($this->_default instanceof SetCalendarItemInfo)
        {
            $this->array += $this->_default->toArray('default');
        }
        if(count($this->_except))
        {
            $this->array['except'] = array();
            foreach ($this->_except as $except)
            {
                $exceptArr = $except->toArray('except');
                $this->array['except'][] = $exceptArr['except'];
            }
        }
        if(count($this->_cancel))
        {
            $this->array['cancel'] = array();
            foreach ($this->_cancel as $cancel)
            {
                $cancelArr = $cancel->toArray('cancel');
                $this->array['cancel'][] = $cancelArr['cancel'];
            }
        }
        if($this->_replies instanceof Replies)
        {
            $this->array += $this->_replies->toArray('replies');
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if(!empty($this->_f))
        {
            $this->xml->addAttribute('f', $this->_f);
        }
        if(!empty($this->_t))
        {
            $this->xml->addAttribute('t', $this->_t);
        }
        if(!empty($this->_tn))
        {
            $this->xml->addAttribute('tn', $this->_tn);
        }
        if(!empty($this->_l))
        {
            $this->xml->addAttribute('l', $this->_l);
        }
        if(is_bool($this->_noNextAlarm))
        {
            $this->xml->addAttribute('noNextAlarm', $this->_noNextAlarm ? 1 : 0);
        }
        if(is_int($this->_nextAlarm))
        {
            $this->xml->addAttribute('nextAlarm', $this->_nextAlarm);
        }
        if($this->_default instanceof SetCalendarItemInfo)
        {
            $this->xml->append($this->_default->toXml('default'));
        }
        foreach ($this->_except as $except)
        {
            $this->xml->append($except->toXml('except'));
        }
        foreach ($this->_cancel as $cancel)
        {
            $this->xml->append($cancel->toXml('cancel'));
        }
        if($this->_replies instanceof Replies)
        {
            $this->xml->append($this->_replies->toXml('replies'));
        }
        return parent::toXml();
    }
}
