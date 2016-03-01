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
use Zimbra\Struct\Base;

/**
 * RecurrenceInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RecurrenceInfo extends Base implements RecurRuleBase
{
    /**
     * Recurrence rules
     * @var TypedSequence<RecurRuleBase>
     */
    private $_rules;

    /**
     * Constructor method for RecurIdInfo
     * @param array $rules Recurrence rules
     * @return self
     */
    public function __construct(array $rules = [])
    {
        parent::__construct();
        $this->setRules($rules);
        $this->on('before', function(Base $sender)
        {
            if($sender->getRules()->count())
            {
                foreach ($sender->getRules()->all() as $rule)
                {
                    if($rule instanceof AddRecurrenceInfo)
                    {
                        $this->setChild('add', $rule);
                    }
                    if($rule instanceof ExcludeRecurrenceInfo)
                    {
                        $this->setChild('exclude', $rule);
                    }
                    if($rule instanceof ExceptionRuleInfo)
                    {
                        $this->setChild('except', $rule);
                    }
                    if($rule instanceof CancelRuleInfo)
                    {
                        $this->setChild('cancel', $rule);
                    }
                    if($rule instanceof SingleDates)
                    {
                        $this->setChild('dates', $rule);
                    }
                    if($rule instanceof SimpleRepeatingRule)
                    {
                        $this->setChild('rule', $rule);
                    }
                }
            }
        });
    }

    /**
     * Add a call feature
     *
     * @param  RecurRuleBase $rule
     * @return self
     */
    public function addRule(RecurRuleBase $rule)
    {
        $this->_rules->add($rule);
        return $this;
    }

    /**
     * Sets call feature sequence
     *
     * @param  array $rules
     * @return self
     */
    public function setRules(array $rules)
    {
        $this->_rules = new TypedSequence('Zimbra\Mail\Struct\RecurRuleBase', $rules);
        return $this;
    }

    /**
     * Gets call feature sequence
     *
     * @return Sequence
     */
    public function getRules()
    {
        return $this->_rules;
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
