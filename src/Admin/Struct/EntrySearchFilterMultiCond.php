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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Admin\Struct\EntrySearchFilterMultiCond as MultiCond;
use Zimbra\Admin\Struct\EntrySearchFilterSingleCond as SingleCond;
use Zimbra\Common\Struct\SearchFilterCondition;

/**
 * EntrySearchFilterMultiCond class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class EntrySearchFilterMultiCond implements SearchFilterCondition
{
    /**
     * Negation flag
     * 
     * @Accessor(getter="isNot", setter="setNot")
     * @SerializedName("not")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'isNot', setter: 'setNot')]
    #[SerializedName(name: 'not')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $not;

    /**
     * OR flag
     * 
     * @Accessor(getter="isOr", setter="setOr")
     * @SerializedName("or")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'isOr', setter: 'setOr')]
    #[SerializedName(name: 'or')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $or;

    /**
     * The array of compound conditions
     * 
     * @Accessor(getter="getCompoundConditions", setter="setCompoundConditions")
     * @Type("array<Zimbra\Admin\Struct\EntrySearchFilterMultiCond>")
     * @XmlList(inline=true, entry="conds", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getCompoundConditions', setter: 'setCompoundConditions')]
    #[Type(name: 'array<Zimbra\Admin\Struct\EntrySearchFilterMultiCond>')]
    #[XmlList(inline: true, entry: 'conds', namespace: 'urn:zimbraAdmin')]
    private $compoundConditions = [];

    /**
     * The array of simple conditions
     * 
     * @Accessor(getter="getSingleConditions", setter="setSingleConditions")
     * @Type("array<Zimbra\Admin\Struct\EntrySearchFilterSingleCond>")
     * @XmlList(inline=true, entry="cond", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getSingleConditions', setter: 'setSingleConditions')]
    #[Type(name: 'array<Zimbra\Admin\Struct\EntrySearchFilterSingleCond>')]
    #[XmlList(inline: true, entry: 'cond', namespace: 'urn:zimbraAdmin')]
    private $singleConditions = [];

    /**
     * Constructor
     * 
     * @param bool $not
     * @param bool $or
     * @param array $conditions
     * @return self
     */
    public function __construct(
        ?bool $not = NULL,
        ?bool $or = NULL,
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
     * Get not flag
     *
     * @return bool
     */
    public function isNot(): ?bool
    {
        return $this->not;
    }

    /**
     * Set not flag
     *
     * @param  bool $not
     * @return self
     */
    public function setNot(bool $not): self
    {
        $this->not = $not;
        return $this;
    }

    /**
     * Get or flag
     *
     * @return bool
     */
    public function isOr(): ?bool
    {
        return $this->or;
    }

    /**
     * Set or flag
     *
     * @param  bool $or
     * @return self
     */
    public function setOr(bool $or): self
    {
        $this->or = $or;
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
     * Set search filter conditions
     *
     * @return self
     */
    public function setConditions(array $conditions): self
    {
        $this->setCompoundConditions($conditions)
             ->setSingleConditions($conditions);
        return $this;
    }

    /**
     * Get search filter conditions
     *
     * @return array
     */
    public function getConditions(): array
    {
        return array_merge($this->singleConditions, $this->compoundConditions);
    }

    /**
     * Get compound conditions
     *
     * @return array
     */
    public function getCompoundConditions(): array
    {
        return $this->compoundConditions;
    }

    /**
     * Set compound conditions
     *
     * @return self
     */
    public function setCompoundConditions(array $conditions): self
    {
        $this->compoundConditions = array_values(
            array_filter($conditions, static fn ($condition) => $condition instanceof MultiCond)
        );
        return $this;
    }

    /**
     * Get single conditions
     *
     * @return array
     */
    public function getSingleConditions(): array
    {
        return $this->singleConditions;
    }

    /**
     * Set single conditions
     *
     * @return self
     */
    public function setSingleConditions(array $conditions): self
    {
        $this->singleConditions = array_values(
            array_filter($conditions, static fn ($condition) => $condition instanceof SingleCond)
        );
        return $this;
    }
}
