<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, Exclude, SerializedName, Type, VirtualProperty, XmlAttribute, XmlList, XmlRoot};
use Zimbra\Admin\Struct\EntrySearchFilterMultiCond as MultiCond;
use Zimbra\Admin\Struct\EntrySearchFilterSingleCond as SingleCond;
use Zimbra\Struct\SearchFilterCondition;

/**
 * EntrySearchFilterMultiCond class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="conds")
 */
class EntrySearchFilterMultiCond implements SearchFilterCondition
{
    /**
     * Negation flag
     * @Accessor(getter="isNot", setter="setNot")
     * @SerializedName("not")
     * @Type("boolean")
     * @XmlAttribute
     */
    private $not;

    /**
     * OR flag
     * @Accessor(getter="isOr", setter="setOr")
     * @SerializedName("or")
     * @Type("boolean")
     * @XmlAttribute
     */
    private $or;

    /**
     * The array of compound conditions
     * @Accessor(getter="getCompoundConditions", setter="setConditions")
     * @Type("array<Zimbra\Admin\Struct\EntrySearchFilterMultiCond>")
     * @SerializedName("conds")
     * @XmlList(inline = true, entry = "conds")
     */
    private $compoundConditions = [];

    /**
     * The array of simple conditions
     * @Accessor(getter="getSingleConditions", setter="setConditions")
     * @Type("array<Zimbra\Admin\Struct\EntrySearchFilterSingleCond>")
     * @SerializedName("cond")
     * @XmlList(inline = true, entry = "cond")
     */
    private $singleConditions = [];

    /**
     * Constructor method for entrySearchFilterMultiCond
     * @param bool $not
     * @param bool $or
     * @param array $conditions
     * @return self
     */
    public function __construct(
        $not = NULL,
        $or = NULL,
        array $conditions = []
    )
    {
        if (NULL !== $not) {
            $this->setNot($not);
        }
        if (NULL !== $or) {
            $this->setOr($or);
        }
        $this->setConditions($conditions);
    }

    /**
     * Gets not flag
     *
     * @return bool
     */
    public function isNot(): bool
    {
        return $this->not;
    }

    /**
     * Sets not flag
     *
     * @param  bool $not
     * @return self
     */
    public function setNot($not): self
    {
        $this->not = (bool) $not;
        return $this;
    }

    /**
     * Gets or flag
     *
     * @return bool
     */
    public function isOr(): bool
    {
        return $this->or;
    }

    /**
     * Sets or flag
     *
     * @param  bool $or
     * @return self
     */
    public function setOr($or): self
    {
        $this->or = (bool) $or;
        return $this;
    }

    /**
     * Add a condition
     *
     * @param  SearchFilterCondition $condition
     * @return self
     */
    public function addCondition(SearchFilterCondition $condition): self
    {
        if ($condition instanceof MultiCond) {
            $this->compoundConditions[] = $condition;
        }
        if ($condition instanceof SingleCond) {
            $this->singleConditions[] = $condition;
        }
        return $this;
    }

    /**
     * Sets search filter conditions
     *
     * @return self
     */
    public function setConditions(array $conditions): self
    {
        $this->compoundConditions = $this->singleConditions = [];
        foreach ($conditions as $condition) {
            if ($condition instanceof SearchFilterCondition) {
                $this->addCondition($condition);
            }
        }
        return $this;
    }

    /**
     * Gets search filter conditions
     *
     * @return array
     */
    public function getConditions(): array
    {
        $conditions = $this->singleConditions;
        foreach ($this->compoundConditions as $condition) {
            if ($condition instanceof SearchFilterCondition) {
                $conditions[] = $condition;
            }
        }
        return $conditions;
    }

    /**
     * Gets compound conditions
     *
     * @return array
     */
    public function getCompoundConditions(): array
    {
        return $this->compoundConditions;
    }

    /**
     * Gets single conditions
     *
     * @return array
     */
    public function getSingleConditions(): array
    {
        return $this->singleConditions;
    }
}
