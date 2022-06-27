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
use Zimbra\Common\Struct\{RecurrenceInfoInterface, RecurRuleBaseInterface};

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
     * @XmlList(inline=true, entry="add", namespace="urn:zimbraMail")
     */
    private $add = [];

    /**
     * Recurrence rules for excluding
     * @Accessor(getter="getExcludeRules", setter="setExcludeRules")
     * @SerializedName("exclude")
     * @Type("array<Zimbra\Mail\Struct\ExcludeRecurrenceInfo>")
     * @XmlList(inline=true, entry="exclude", namespace="urn:zimbraMail")
     */
    private $exclude = [];

    /**
     * Recurrence rules for excepting
     * @Accessor(getter="getExceptRules", setter="setExceptRules")
     * @SerializedName("except")
     * @Type("array<Zimbra\Mail\Struct\ExceptionRuleInfo>")
     * @XmlList(inline=true, entry="except", namespace="urn:zimbraMail")
     */
    private $except = [];

    /**
     * Recurrence rules for canceling
     * @Accessor(getter="getCancelRules", setter="setCancelRules")
     * @SerializedName("cancel")
     * @Type("array<Zimbra\Mail\Struct\CancelRuleInfo>")
     * @XmlList(inline=true, entry="cancel", namespace="urn:zimbraMail")
     */
    private $cancel = [];

    /**
     * Recurrence rules for dates
     * @Accessor(getter="getDatesRules", setter="setDatesRules")
     * @SerializedName("dates")
     * @Type("array<Zimbra\Mail\Struct\SingleDates>")
     * @XmlList(inline=true, entry="dates", namespace="urn:zimbraMail")
     */
    private $dates = [];

    /**
     * Simple recurrence rules
     * @Accessor(getter="getSimpleRules", setter="setSimpleRules")
     * @SerializedName("rule")
     * @Type("array<Zimbra\Mail\Struct\SimpleRepeatingRule>")
     * @XmlList(inline=true, entry="rule", namespace="urn:zimbraMail")
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
        $rules = array_filter($rules, static fn ($rule) => $rule instanceof RecurRuleBaseInterface);
        array_walk($rules, fn ($rule) => $this->addRule($rule));
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
        $this->add = array_filter($rules, static fn ($rule) => $rule instanceof AddRecurrenceInfo);
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
        $this->exclude = array_filter($rules, static fn ($rule) => $rule instanceof ExcludeRecurrenceInfo);
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
        $this->except = array_filter($rules, static fn ($rule) => $rule instanceof ExceptionRuleInfo);
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
        $this->cancel = array_filter($rules, static fn ($rule) => $rule instanceof CancelRuleInfo);
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
        $this->dates = array_filter($rules, static fn ($rule) => $rule instanceof SingleDates);
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
        $this->simple = array_filter($rules, static fn ($rule) => $rule instanceof SimpleRepeatingRule);
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
