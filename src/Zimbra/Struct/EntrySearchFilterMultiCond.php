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

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\EntrySearchFilterMultiCond as MultiCond;
use Zimbra\Struct\EntrySearchFilterSingleCond as SingleCond;

/**
 * EntrySearchFilterMultiCond struct class
 *
 * @package    Zimbra
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class EntrySearchFilterMultiCond extends Base implements SearchFilterCondition
{
    /**
     * The sequence of condition
     * @var TypedSequence
     */
    private $_conditions = [];

    /**
     * Constructor method for entrySearchFilterMultiCond
     * @param bool $not
     * @param bool $or
     * @param array $conditions
     * @return self
     */
    public function __construct(
        $not = null,
        $or = null,
        array $conditions = []
    )
    {
        parent::__construct();
        if(null !== $not)
        {
            $this->setProperty('not', (bool) $not);
        }
        if(null !== $or)
        {
            $this->setProperty('or', (bool) $or);
        }
        $this->setConditions($conditions);

        $this->on('before', function(Base $sender)
        {
            if($sender->getConditions()->count())
            {
                $conds = [];
                $cond = [];
                foreach ($sender->getConditions()->all() as $condition)
                {
                    if ($condition instanceof MultiCond)
                    {
                        $conds[] = $condition;
                    }
                    if ($condition instanceof SingleCond)
                    {
                        $cond[] = $condition;
                    }
                }
                if (!empty($conds))
                {
                    $sender->setChild('conds', $conds);
                }
                if (!empty($cond))
                {
                    $sender->setChild('cond', $cond);
                }
            }
        });
    }

    /**
     * Gets not flag
     *
     * @return bool
     */
    public function getNot()
    {
        return $this->getProperty('not');
    }

    /**
     * Sets not flag
     *
     * @param  bool $not
     * @return self
     */
    public function setNot($not)
    {
        return $this->setProperty('not', (bool) $not);
    }

    /**
     * Gets or flag
     *
     * @return bool
     */
    public function getOr()
    {
        return $this->getProperty('or');
    }

    /**
     * Sets or flag
     *
     * @param  bool $or
     * @return self
     */
    public function setOr($or)
    {
        return $this->setProperty('or', (bool) $or);
    }

    /**
     * Add a condition
     *
     * @param  SearchFilterCondition $condition
     * @return self
     */
    public function addCondition(SearchFilterCondition $condition)
    {
        $this->_conditions->add($condition);
        return $this;
    }

    /**
     * Sets condition sequence
     *
     * @return self
     */
    public function setConditions(array $conditions)
    {
        $this->_conditions = new TypedSequence(
            'Zimbra\Struct\SearchFilterCondition', $conditions
        );
        return $this;
    }

    /**
     * Gets condition sequence
     *
     * @return Sequence
     */
    public function getConditions()
    {
        return $this->_conditions;
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
