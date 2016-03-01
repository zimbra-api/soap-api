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

use Zimbra\Enum\ConditionOperator as Op;

/**
 * EntrySearchFilterSingleCond struct class
 *
 * @package    Zimbra
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class EntrySearchFilterSingleCond extends Base implements SearchFilterCondition
{
    /**
     * Constructor method for EntrySearchFilterSingleCond
     * @param string $attr
     * @param Op $op
     * @param string $value
     * @param bool $not
     * @return self
     */
    public function __construct(
        $attr,
        Op $op,
        $value,
        $not = null
    )
    {
        parent::__construct();
        $this->setProperty('attr', trim($attr));
        $this->setProperty('op', $op);
        $this->setProperty('value', trim($value));
        if(null !== $not)
        {
            $this->setProperty('not', (bool) $not);
        }
    }

    /**
     * Gets attribute name
     *
     * @return string
     */
    public function getAttr()
    {
        return $this->getProperty('attr');
    }

    /**
     * Sets attribute name
     *
     * @param  string $attr
     * @return self
     */
    public function setAttr($attr)
    {
        return $this->setProperty('attr', trim($attr));
    }

    /**
     * Gets operator
     *
     * @return Zimbra\Enum\ConditionOperator
     */
    public function getOp()
    {
        return $this->getProperty('op');
    }

    /**
     * Sets operator
     *
     * @param  Zimbra\Enum\ConditionOperator $op
     * @return self
     */
    public function setOp(Op $op)
    {
        return $this->setProperty('op', $op);
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->getProperty('value');
    }

    /**
     * Sets value
     *
     * @param  string $value
     * @return self
     */
    public function setValue($value)
    {
        return $this->setProperty('value', trim($value));
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
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'cond')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'cond')
    {
        return parent::toXml($name);
    }
}
