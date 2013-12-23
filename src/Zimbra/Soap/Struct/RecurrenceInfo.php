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

use Zimbra\Utils\SimpleXML;

/**
 * RecurrenceInfo struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class RecurrenceInfo
{
    /**
     * The add
     * @var AddRecurrenceInfo
     */
    private $_add;

    /**
     * The exclude
     * @var ExcludeRecurrenceInfo
     */
    private $_exclude;

    /**
     * The except
     * @var ExceptionRuleInfo
     */
    private $_except;

    /**
     * The cancel
     * @var CancelRuleInfo
     */
    private $_cancel;

    /**
     * The dates
     * @var SingleDates
     */
    private $_dates;

    /**
     * The rule
     * @var SimpleRepeatingRule
     */
    private $_rule;

    /**
     * Constructor method for RecurIdInfo
     * @param AddRecurrenceInfo $add
     * @param ExcludeRecurrenceInfo $exclude
     * @param ExceptionRuleInfo $except
     * @param CancelRuleInfo $cancel
     * @param SingleDates $dates
     * @param SimpleRepeatingRule $rule
     * @return self
     */
    public function __construct(
        AddRecurrenceInfo $add = null,
        ExcludeRecurrenceInfo $exclude = null,
        ExceptionRuleInfo $except = null,
        CancelRuleInfo $cancel = null,
        SingleDates $dates = null,
        SimpleRepeatingRule $rule = null
    )
    {
        if($add instanceof AddRecurrenceInfo)
        {
            $this->_add = $add;
        }
        if($exclude instanceof ExcludeRecurrenceInfo)
        {
            $this->_exclude = $exclude;
        }
        if($except instanceof ExceptionRuleInfo)
        {
            $this->_except = $except;
        }
        if($cancel instanceof CancelRuleInfo)
        {
            $this->_cancel = $cancel;
        }
        if($dates instanceof SingleDates)
        {
            $this->_dates = $dates;
        }
        if($rule instanceof SimpleRepeatingRule)
        {
            $this->_rule = $rule;
        }
    }

    /**
     * Gets or sets add
     *
     * @param  AddRecurrenceInfo $add
     * @return AddRecurrenceInfo|self
     */
    public function add(AddRecurrenceInfo $add = null)
    {
        if(null === $add)
        {
            return $this->_add;
        }
        $this->_add = $add;
        return $this;
    }

    /**
     * Gets or sets exclude
     *
     * @param  ExcludeRecurrenceInfo $exclude
     * @return ExcludeRecurrenceInfo|self
     */
    public function exclude(ExcludeRecurrenceInfo $exclude = null)
    {
        if(null === $exclude)
        {
            return $this->_exclude;
        }
        $this->_exclude = $exclude;
        return $this;
    }

    /**
     * Gets or sets except
     *
     * @param  ExceptionRuleInfo $except
     * @return ExceptionRuleInfo|self
     */
    public function except(ExceptionRuleInfo $except = null)
    {
        if(null === $except)
        {
            return $this->_except;
        }
        $this->_except = $except;
        return $this;
    }

    /**
     * Gets or sets cancel
     *
     * @param  CancelRuleInfo $cancel
     * @return CancelRuleInfo|self
     */
    public function cancel(CancelRuleInfo $cancel = null)
    {
        if(null === $cancel)
        {
            return $this->_cancel;
        }
        $this->_cancel = $cancel;
        return $this;
    }

    /**
     * Gets or sets dates
     *
     * @param  SingleDates $dates
     * @return SingleDates|self
     */
    public function dates(SingleDates $dates = null)
    {
        if(null === $dates)
        {
            return $this->_dates;
        }
        $this->_dates = $dates;
        return $this;
    }

    /**
     * Gets or sets rule
     *
     * @param  SimpleRepeatingRule $rule
     * @return SimpleRepeatingRule|self
     */
    public function rule(SimpleRepeatingRule $rule = null)
    {
        if(null === $rule)
        {
            return $this->_rule;
        }
        $this->_rule = $rule;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'recur')
    {
        $name = !empty($name) ? $name : 'recur';
        $arr = array();
        if($this->_add instanceof AddRecurrenceInfo)
        {
            $arr += $this->_add->toArray('add');
        }
        if($this->_exclude instanceof ExcludeRecurrenceInfo)
        {
            $arr += $this->_exclude->toArray('exclude');
        }
        if($this->_except instanceof ExceptionRuleInfo)
        {
            $arr += $this->_except->toArray('except');
        }
        if($this->_cancel instanceof CancelRuleInfo)
        {
            $arr += $this->_cancel->toArray('cancel');
        }
        if($this->_dates instanceof SingleDates)
        {
            $arr += $this->_dates->toArray('dates');
        }
        if($this->_rule instanceof SimpleRepeatingRule)
        {
            $arr += $this->_rule->toArray('rule');
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'recur')
    {
        $name = !empty($name) ? $name : 'recur';
        $xml = new SimpleXML('<'.$name.' />');
        if($this->_add instanceof AddRecurrenceInfo)
        {
            $xml->append($this->_add->toXml('add'));
        }
        if($this->_exclude instanceof ExcludeRecurrenceInfo)
        {
            $xml->append($this->_exclude->toXml('exclude'));
        }
        if($this->_except instanceof ExceptionRuleInfo)
        {
            $xml->append($this->_except->toXml('except'));
        }
        if($this->_cancel instanceof CancelRuleInfo)
        {
            $xml->append($this->_cancel->toXml('cancel'));
        }
        if($this->_dates instanceof SingleDates)
        {
            $xml->append($this->_dates->toXml('dates'));
        }
        if($this->_rule instanceof SimpleRepeatingRule)
        {
            $xml->append($this->_rule->toXml('rule'));
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
