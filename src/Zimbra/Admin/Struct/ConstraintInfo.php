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

use Zimbra\Struct\Base;

/**
 * ConstraintInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ConstraintInfo extends Base
{
    /**
     * Constructor method for ConstraintInfo
     * @param  string $min Minimum value
     * @param  string $max Maximum value
     * @param  ConstraintInfoValues $values Acceptable values
     * @return self
     */
    public function __construct($min = null, $max = null, ConstraintInfoValues $values = null)
    {
        parent::__construct();
        $this->setChild('min', trim($min));
        $this->setChild('max', trim($max));
        $this->setChild('values', $values);
    }

    /**
     * Gets minimum value
     *
     * @return string
     */
    public function getMin()
    {
        return $this->getChild('min');
    }

    /**
     * Sets minimum value
     *
     * @param  string $min
     * @return string|self
     */
    public function setMin($min)
    {
        return $this->setChild('min', trim($min));
    }

    /**
     * Gets maximum value
     *
     * @return string
     */
    public function getMax()
    {
        return $this->getChild('max');
    }

    /**
     * Sets maximum value
     *
     * @param  string $max
     * @return self
     */
    public function setMax($max)
    {
        return $this->setChild('max', trim($max));
    }

    /**
     * Gets acceptable values
     *
     * @return ConstraintInfoValues
     */
    public function getValues()
    {
        return $this->getChild('values');
    }

    /**
     * Sets acceptable values
     *
     * @param  ConstraintInfoValues $values
     * @return self
     */
    public function setValues(ConstraintInfoValues $values)
    {
        return $this->setChild('values', $values);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'constraint')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'constraint')
    {
        return parent::toXml($name);
    }
}