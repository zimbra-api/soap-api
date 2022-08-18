<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Account\Struct\EntrySearchFilterMultiCond as MultiCond;
use Zimbra\Account\Struct\EntrySearchFilterSingleCond as SingleCond;
use Zimbra\Common\Struct\{EntrySearchFilterInterface, SearchFilterCondition};

/**
 * EntrySearchFilterInfo class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class EntrySearchFilterInfo implements EntrySearchFilterInterface
{
    /**
     * Search filter simple condition
     * 
     * @Accessor(getter="getCondition", setter="setCondition")
     * @SerializedName("cond")
     * @Type("Zimbra\Account\Struct\EntrySearchFilterSingleCond")
     * @XmlElement(namespace="urn:zimbraAccount")
     * 
     * @var SearchFilterCondition
     */
    #[Accessor(getter: 'getCondition', setter: 'setCondition')]
    #[SerializedName('cond')]
    #[Type(EntrySearchFilterSingleCond::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private $condition;

    /**
     * Search filter compound condition
     * 
     * @Accessor(getter="getConditions", setter="setConditions")
     * @SerializedName("conds")
     * @Type("Zimbra\Account\Struct\EntrySearchFilterMultiCond")
     * @XmlElement(namespace="urn:zimbraAccount")
     * 
     * @var SearchFilterCondition
     */
    #[Accessor(getter: 'getConditions', setter: 'setConditions')]
    #[SerializedName('conds')]
    #[Type(EntrySearchFilterMultiCond::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private $conditions;

    /**
     * Constructor
     * 
     * @param SearchFilterCondition $condition
     * @return self
     */
    public function __construct(?SearchFilterCondition $condition = NULL)
    {
        if ($condition instanceof MultiCond) {
            $this->setConditions($condition);
        }
        if ($condition instanceof SingleCond) {
            $this->setCondition($condition);
        }
    }

    /**
     * Get simple search filter condition
     *
     * @return SearchFilterCondition
     */
    public function getCondition(): ?SearchFilterCondition
    {
        return $this->condition;
    }

    /**
     * Set simple search filter condition
     *
     * @param  SingleCond $condition
     * @return self
     */
    public function setCondition(SingleCond $condition): self
    {
        $this->condition = $condition;
        return $this;
    }

    /**
     * Get compound search filter condition
     *
     * @return SearchFilterCondition
     */
    public function getConditions(): ?SearchFilterCondition
    {
        return $this->conditions;
    }

    /**
     * Set compound search filter condition
     *
     * @param  MultiCond $conditions
     * @return self
     */
    public function setConditions(MultiCond $conditions): self
    {
        $this->conditions = $conditions;
        return $this;
    }
}
