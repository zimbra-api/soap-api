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

use Zimbra\Struct\EntrySearchFilterMultiCond as MultiCond;
use Zimbra\Struct\EntrySearchFilterSingleCond as SingleCond;

/**
 * EntrySearchFilterInfo struct class
 *
 * @package    Zimbra
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class EntrySearchFilterInfo extends Base
{
    /**
     * Compound condition or simple condition
     * @var SearchFilterCondition
     */
    private $_condition;

    /**
     * Constructor method for EntrySearchFilterInfo
     * @param SearchFilterCondition $condition
     * @return self
     */
    public function __construct(SearchFilterCondition $condition = null)
    {
        parent::__construct();
        $this->setCondition($condition);
    }

    /**
     * Gets search filter condition
     *
     * @return SearchFilterCondition
     */
    public function getCondition()
    {
        return $this->_condition;
    }

    /**
     * Sets search filter condition
     *
     * @param  SearchFilterCondition $condition
     * @return self
     */
    public function setCondition(SearchFilterCondition $condition)
    {
        $this->_condition = $condition;
        if($this->_condition instanceof MultiCond)
        {
            $this->setChild('conds', $this->_condition);
        }
        if($this->_condition instanceof SingleCond)
        {
            $this->setChild('cond', $this->_condition);
        }
        return $this;
    }

    /**
     * Gets or sets child
     *
     * @param  string $name
     * @param  mix $value
     * @return string|self
     */
    public function setChild($name, $value)
    {
        if($value instanceof SearchFilterCondition)
        {
            $this->removeChild('conds')->removeChild('cond');
        }
        return parent::setChild($name, $value);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'searchFilter')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'searchFilter')
    {
        return parent::toXml($name);
    }
}
