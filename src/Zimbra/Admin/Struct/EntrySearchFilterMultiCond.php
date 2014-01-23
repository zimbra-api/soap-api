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

/**
 * EntrySearchFilterMultiCond struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class EntrySearchFilterMultiCond extends Base
{
    /**
     * Constructor method for entrySearchFilterMultiCond
     * @param bool $not
     * @param bool $or
     * @param MultiCond $conds
     * @param SingleCond $cond
     * @return self
     */
    public function __construct(
        $not = null,
        $or = null,
        MultiCond $conds = null,
        SingleCond $cond = null
	)
    {
		parent::__construct();
        if(null !== $not)
        {
			$this->property('not', (bool) $not);
        }
        if(null !== $or)
        {
			$this->property('or', (bool) $or);
        }
        if($conds instanceof MultiCond)
        {
			$this->child('conds', $conds);
        }
        if($cond instanceof SingleCond)
        {
			$this->child('cond', $cond);
        }
    }

    /**
     * Gets or sets not flag
     *
     * @param  bool $not
     * @return bool|self
     */
    public function notFlag($not = null)
    {
        if(null === $not)
        {
            return $this->property('not');
        }
        return $this->property('not', (bool) $not);
    }

    /**
     * Gets or sets or flag
     *
     * @param  bool $or
     * @return bool|self
     */
    public function orFlag($or = null)
    {
        if(null === $or)
        {
            return $this->property('or');
        }
        return $this->property('or', (bool) $or);
    }

    /**
     * Gets or sets conds
     *
     * @param  MultiCond $conds
     * @return EntrySearchFilterMultiCond
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
    public function toArray($name = 'conds')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'conds')
    {
        return parent::toXml($name);
    }
}
