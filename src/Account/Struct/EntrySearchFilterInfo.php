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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Account\Struct\EntrySearchFilterMultiCond as MultiCond;
use Zimbra\Account\Struct\EntrySearchFilterSingleCond as SingleCond;
use Zimbra\Struct\{EntrySearchFilterInterface, SearchFilterCondition};

/**
 * EntrySearchFilterInfo class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="searchFilter")
 */
class EntrySearchFilterInfo implements EntrySearchFilterInterface
{
    /**
     * Search filter simple condition
     * @Accessor(getter="getCondition", setter="setCondition")
     * @SerializedName("cond")
     * @Type("Zimbra\Account\Struct\EntrySearchFilterSingleCond")
     * @XmlElement
     */
    private $condition;

    /**
     * Search filter compound condition
     * @Accessor(getter="getConditions", setter="setCondition")
     * @SerializedName("conds")
     * @Type("Zimbra\Account\Struct\EntrySearchFilterMultiCond")
     * @XmlElement
     */
    private $conditions;

    /**
     * Constructor method for EntrySearchFilterInfo
     * @param SearchFilterCondition $condition
     * @return self
     */
    public function __construct(? SearchFilterCondition $condition = NULL)
    {
        if ($condition instanceof SearchFilterCondition) {
            $this->setCondition($condition);
        }
    }

    /**
     * Gets simple search filter condition
     *
     * @return SearchFilterCondition
     */
    public function getCondition(): ?SearchFilterCondition
    {
        return $this->condition;
    }

    /**
     * Gets compound search filter condition
     *
     * @return SearchFilterCondition
     */
    public function getConditions(): ?SearchFilterCondition
    {
        return $this->conditions;
    }

    /**
     * Sets search filter condition
     *
     * @param  SearchFilterCondition $condition
     * @return self
     */
    public function setCondition(SearchFilterCondition $condition): self
    {
        $this->condition = $this->conditions = NULL;
        if ($condition instanceof MultiCond) {
            $this->conditions = $condition;
        }
        if ($condition instanceof SingleCond) {
            $this->condition = $condition;
        }
        return $this;
    }
}
