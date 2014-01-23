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
 * ConstraintAttr struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ConstraintAttr extends Base
{
    /**
     * Constructor method for ConstraintAttr
     * @param  ConstraintInfo $constraint Constraint information
     * @param  string $name Constraint name
     * @return self
     */
    public function __construct(ConstraintInfo $constraint, $name)
    {
        parent::__construct();
        $this->child('constraint', $constraint);
        $this->property('name', trim($name));
    }

    /**
     * Gets or sets constraint
     *
     * @param  ConstraintInfo $constraint
     * @return ConstraintInfo|self
     */
    public function constraint(ConstraintInfo $constraint = null)
    {
        if(null === $constraint)
        {
            return $this->child('constraint');
        }
        return $this->child('constraint', $constraint);
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->property('name');
        }
        return $this->property('name', trim($name));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'a')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'a')
    {
        return parent::toXml($name);
    }
}