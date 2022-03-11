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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Struct\{RecurrenceInfoInterface, RecurRuleBaseInterface};

/**
 * RecurrenceInfo struct class
 * Recurrence Information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class RecurrenceInfo implements RecurRuleBase, RecurrenceInfoInterface
{
    /**
     * Recurrence rules for adding
     * @Accessor(getter="getAddRules", setter="setAddRules")
     * @SerializedName("add")
     * @Type("array<Zimbra\Mail\Struct\AddRecurrenceInfo>")
     * @XmlList(inline = true, entry = "add")
     */
    private $add = [];

    /**
     * Recurrence rules for excluding
     * @Accessor(getter="getExcludeRules", setter="setExcludeRules")
     * @SerializedName("exclude")
     * @Type("array<Zimbra\Mail\Struct\ExcludeRecurrenceInfo>")
     * @XmlList(inline = true, entry = "exclude")
     */
    private $exclude = [];

    /**
     * Recurrence rules for excepting
     * @Accessor(getter="getExceptRules", setter="setExceptRules")
     * @SerializedName("except")
     * @Type("array<Zimbra\Mail\Struct\ExceptionRuleInfo>")
     * @XmlList(inline = true, entry = "except")
     */
    private $except = [];

    /**
     * Recurrence rules for canceling
     * @Accessor(getter="getCancelRules", setter="setCancelRules")
     * @SerializedName("cancel")
     * @Type("array<Zimbra\Mail\Struct\CancelRuleInfo>")
     * @XmlList(inline = true, entry = "cancel")
     */
    private $cancel = [];

    /**
     * Recurrence rules for dates
     * @Accessor(getter="getDatesRules", setter="setDatesRules")
     * @SerializedName("dates")
     * @Type("array<Zimbra\Mail\Struct\SingleDates>")
     * @XmlList(inline = true, entry = "dates")
     */
    private $dates = [];

    /**
     * Simple recurrence rules
     * @Accessor(getter="getSimpleRules", setter="setSimpleRules")
     * @SerializedName("rule")
     * @Type("array<Zimbra\Mail\Struct\SimpleRepeatingRule>")
     * @XmlList(inline = true, entry = "rule")
     */
    private $simple = [];

    /**
     * Constructor method
     *
     * @param array $rules
     * @return self
     */
    public function __construct(array $rules = [])
    {
        $this->setRules($rules);
    }

    /**
     * Add rule
     *
     * @param  RecurRuleBaseInterface $rule
     * @return self
     */
    public function addRule(RecurRuleBaseInterface $rule): self
    {
        if ($rule instanceof AddRecurrenceInfo) {
            $this->add[] = $rule;
        }
        if ($rule instanceof ExcludeRecurrenceInfo) {
            $this->exclude[] = $rule;
        }
        if ($rule instanceof ExceptionRuleInfo) {
            $this->except[] = $rule;
        }
        if ($rule instanceof CancelRuleInfo) {
            $this->cancel[] = $rule;
        }
        if ($rule instanceof SingleDates) {
            $this->dates[] = $rule;
        }
        if ($rule instanceof SimpleRepeatingRule) {
            $this->simple[] = $rule;
        }
        return $this;
    }

    /**
     * Sets the rules
     *
     * @param  array $rules
     * @return self
     */
    public function setRules(array $rules): self
    {
        $this->add = $this->exclude = $this->except = $this->cancel = $this->dates = $this->simple = [];
        foreach ($rules as $rule) {
            if ($rule instanceof RecurRuleBaseInterface) {
                $this->addRule($rule);
            }
        }
        return $this;
    }

    /**
     * Gets rules
     *
     * @return array
     */
    public function getRules(): array
    {
        return array_merge($this->add, $this->exclude, $this->except, $this->cancel, $this->dates, $this->simple);
    }

    /**
     * Sets add rules
     *
     * @param  array $rules
     * @return self
     */
    public function setAddRules(array $rules): self
    {
        $this->add = [];
        foreach ($rules as $rule) {
            if ($rule instanceof AddRecurrenceInfo) {
                $this->add[] = $rule;
            }
        }
        return $this;
    }

    /**
     * Gets add rules
     *
     * @return array
     */
    public function getAddRules(): array
    {
        return $this->add;
    }

    /**
     * Sets exclude rules
     *
     * @param  array $rules
     * @return self
     */
    public function setExcludeRules(array $rules): self
    {
        $this->exclude = [];
        foreach ($rules as $rule) {
            if ($rule instanceof ExcludeRecurrenceInfo) {
                $this->exclude[] = $rule;
            }
        }
        return $this;
    }

    /**
     * Gets exclude rules
     *
     * @return array
     */
    public function getExcludeRules(): array
    {
        return $this->exclude;
    }

    /**
     * Sets except rules
     *
     * @param  array $rules
     * @return self
     */
    public function setExceptRules(array $rules): self
    {
        $this->except = [];
        foreach ($rules as $rule) {
            if ($rule instanceof ExceptionRuleInfo) {
                $this->except[] = $rule;
            }
        }
        return $this;
    }

    /**
     * Gets except rules
     *
     * @return array
     */
    public function getExceptRules(): array
    {
        return $this->except;
    }

    /**
     * Sets cancel rules
     *
     * @param  array $rules
     * @return self
     */
    public function setCancelRules(array $rules): self
    {
        $this->cancel = [];
        foreach ($rules as $rule) {
            if ($rule instanceof CancelRuleInfo) {
                $this->cancel[] = $rule;
            }
        }
        return $this;
    }

    /**
     * Gets cancel rules
     *
     * @return array
     */
    public function getCancelRules(): array
    {
        return $this->cancel;
    }

    /**
     * Sets dates rules
     *
     * @param  array $rules
     * @return self
     */
    public function setDatesRules(array $rules): self
    {
        $this->dates = [];
        foreach ($rules as $rule) {
            if ($rule instanceof SingleDates) {
                $this->dates[] = $rule;
            }
        }
        return $this;
    }

    /**
     * Gets dates rules
     *
     * @return array
     */
    public function getDatesRules(): array
    {
        return $this->dates;
    }

    /**
     * Sets simple rules
     *
     * @param  array $rules
     * @return self
     */
    public function setSimpleRules(array $rules): self
    {
        $this->simple = [];
        foreach ($rules as $rule) {
            if ($rule instanceof SimpleRepeatingRule) {
                $this->simple[] = $rule;
            }
        }
        return $this;
    }

    /**
     * Gets simple rules
     *
     * @return array
     */
    public function getSimpleRules(): array
    {
        return $this->simple;
    }
}
