<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Struct\EntrySearchFilterMultiCond as MultiCond;
use Zimbra\Struct\EntrySearchFilterSingleCond as SingleCond;

/**
 * EntrySearchFilterInfo struct class
 *
 * @package    Zimbra
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="searchFilter")
 */
class EntrySearchFilterInfo
{
    /**
     * @Accessor(getter="getCondition", setter="setCondition")
     * @SerializedName("cond")
     * @Type("Zimbra\Struct\EntrySearchFilterSingleCond")
     * @XmlElement
     */
    private $_condition;

    /**
     * @Accessor(getter="getConditions", setter="setCondition")
     * @SerializedName("conds")
     * @Type("Zimbra\Struct\EntrySearchFilterMultiCond")
     * @XmlElement
     */
    private $_conditions;

    /**
     * Constructor method for EntrySearchFilterInfo
     * @param SearchFilterCondition $condition
     * @return self
     */
    public function __construct(SearchFilterCondition $condition = NULL)
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
    public function getCondition()
    {
        return $this->_condition;
    }

    /**
     * Gets compound search filter condition
     *
     * @return SearchFilterCondition
     */
    public function getConditions()
    {
        return $this->_conditions;
    }

    /**
     * Sets search filter condition
     *
     * @param  SearchFilterCondition $condition
     * @return self
     */
    public function setCondition(SearchFilterCondition $condition)
    {
        $this->_condition = $this->_conditions = NULL;
        if ($condition instanceof MultiCond) {
            $this->_conditions = $condition;
        }
        if ($condition instanceof SingleCond) {
            $this->_condition = $condition;
        }
        return $this;
    }
}
