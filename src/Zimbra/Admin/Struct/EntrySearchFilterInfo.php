<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use Zimbra\Admin\Struct\EntrySearchFilterMultiCond as MultiCond;
use Zimbra\Admin\Struct\EntrySearchFilterSingleCond as SingleCond;
use Zimbra\Struct\Base;
use Zimbra\Struct\SearchFilterCondition;

/**
 * EntrySearchFilterInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class EntrySearchFilterInfo extends Base
{
    /**
     * Constructor method for EntrySearchFilterInfo
     * @param SearchFilterCondition $condition
     * @return self
     */
    public function __construct(SearchFilterCondition $condition = null)
    {
		parent::__construct();
        if($condition instanceof MultiCond)
        {
			$this->child('conds', $condition);
        }
        if($condition instanceof SingleCond)
        {
			$this->child('cond', $condition);
        }
    }

    /**
     * Gets or sets child
     *
     * @param  string $name
     * @param  mix $value
     * @return string|self
     */
    public function child($name, $value = null)
    {
        if($value instanceof SearchFilterCondition)
        {
            $conds = array('conds', 'cond');
            foreach ($conds as $cond)
            {
                $this->removeChild($cond);
            }
        }
        return parent::child($name, $value);
    }

    /**
     * Gets or sets conds
     *
     * @param  MultiCond $conds
     * @return MultiCond|self
     */
    public function conds(MultiCond $conds = null)
    {
        if(null === $conds)
        {
            return $this->child('conds');
        }
        return $this->child('conds', $conds);
    }

    /**
     * Gets or sets cond
     *
     * @param  SingleCond $cond
     * @return SingleCond|self
     */
    public function cond(SingleCond $cond = null)
    {
        if(null === $cond)
        {
            return $this->child('cond');
        }
        return $this->child('cond', $cond);
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
