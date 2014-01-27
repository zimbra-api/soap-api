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

use Zimbra\Struct\Base;

/**
 * RecurrenceInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class RecurrenceInfo extends Base
{
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
        parent::__construct();
        if($add instanceof AddRecurrenceInfo)
        {
            $this->child('add', $add);
        }
        if($exclude instanceof ExcludeRecurrenceInfo)
        {
            $this->child('exclude', $exclude);
        }
        if($except instanceof ExceptionRuleInfo)
        {
            $this->child('except', $except);
        }
        if($cancel instanceof CancelRuleInfo)
        {
            $this->child('cancel', $cancel);
        }
        if($dates instanceof SingleDates)
        {
            $this->child('dates', $dates);
        }
        if($rule instanceof SimpleRepeatingRule)
        {
            $this->child('rule', $rule);
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
            return $this->child('add');
        }
        return $this->child('add', $add);
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
            return $this->child('exclude');
        }
        return $this->child('exclude', $exclude);
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
            return $this->child('except');
        }
        return $this->child('except', $except);
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
            return $this->child('cancel');
        }
        return $this->child('cancel', $cancel);
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
            return $this->child('dates');
        }
        return $this->child('dates', $dates);
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
            return $this->child('rule');
        }
        return $this->child('rule', $rule);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'recur')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'recur')
    {
        return parent::toXml($name);
    }
}
