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

/**
 * OpValue struct class
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class OpValue extends Base
{
    /**
     * Constructor method for OpValue
     * @param  string $op
     * @param  string $value
     * @return self
     */
    public function __construct($op, $value = null)
    {
        parent::__construct(trim($value));
        if($op !== null and in_array(trim($op), array('+', '-')))
        {
            $this->property('op', trim($op));
        }
    }

    /**
     * Gets or sets op
     *
     * @param  string $op
     * @return string|self
     */
    public function op($op = null)
    {
        if(null === $op)
        {
            return $this->property('op');
        }
        if(in_array(trim($op), array('+', '-')))
        {
            $this->property('op', trim($op));
        }
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'addr')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'addr')
    {
        return parent::toXml($name);
    }
}
