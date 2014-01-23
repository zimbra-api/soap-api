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
     * @param  ConstraintInfoValues $values Values
     * @return self
     */
    public function __construct($min = null, $max = null, ConstraintInfoValues $values = null)
    {
        parent::__construct();
        $this->child('min', trim($min));
        $this->child('max', trim($max));
        $this->child('values', $values);
    }

    /**
     * Gets or sets min
     *
     * @param  string $min
     * @return string|self
     */
    public function min($min = null)
    {
        if(null === $min)
        {
            return $this->child('min');
        }
        return $this->child('min', trim($min));
    }

    /**
     * Gets or sets max
     *
     * @param  string $max
     * @return string|self
     */
    public function max($max = null)
    {
        if(null === $max)
        {
            return $this->child('max');
        }
        return $this->child('max', trim($max));
    }

    /**
     * Gets or sets values
     *
     * @param  ConstraintInfoValues $values
     * @return ConstraintInfoValues|self
     */
    public function values(ConstraintInfoValues $values = null)
    {
        if(null === $values)
        {
            return $this->child('values');
        }
        return $this->child('values', $values);
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