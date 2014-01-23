<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use Zimbra\Enum\ConditionOperator as Op;
use Zimbra\Struct\Base;

/**
 * EntrySearchFilterSingleCond struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class EntrySearchFilterSingleCond extends Base
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
		$this->property('attr', trim($attr));
		$this->property('op', $op);
		$this->property('value', trim($value));
        if(null !== $not)
        {
			$this->property('not', (bool) $not);
        }
    }

    /**
     * Gets or sets attr
     *
     * @param  string $attr
     * @return string|self
     */
    public function attr($attr = null)
    {
        if(null === $attr)
        {
            return $this->property('attr');
        }
        return $this->property('attr', trim($attr));
    }

    /**
     * Gets or sets op
     *
     * @param  Op $op
     * @return Op|self
     */
    public function op(Op $op = null)
    {
        if(null === $op)
        {
            return $this->property('op');
        }
        return $this->property('op', $op);
    }

    /**
     * Gets or sets value
     *
     * @param  string $value
     * @return string|self
     */
    public function value($value = null)
    {
        if(null === $value)
        {
            return $this->property('value');
        }
        return $this->property('value', trim($value));
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
