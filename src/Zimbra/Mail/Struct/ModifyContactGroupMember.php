<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Struct\Base;

/**
 * ModifyContactGroupMember struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyContactGroupMember extends Base
{
    /**
     * Constructor method for ModifyContactGroupMember
     * @param string $type Member type
     * @param string $value Member value
     * @param string $op Operation - +|-|reset
     * @return self
     */
    public function __construct(
        $type,
        $value,
        $op = null
    )
    {
        parent::__construct();
        $this->property('type', in_array(trim($type), array('C', 'G', 'I')) ? trim($type) : '');
        $this->property('value', trim($value));
        if(null !== $op)
        {
            $this->property('op', in_array(trim($op), array('+', '-', 'reset')) ? trim($op) : '');
        }
    }

    /**
     * Gets or sets type
     *
     * @param  string $type
     * @return string|self
     */
    public function type($type = null)
    {
        if(null === $type)
        {
            return $this->property('type');
        }
        return $this->property('type', in_array(trim($type), array('C', 'G', 'I')) ? trim($type) : '');
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
        return $this->property('op', in_array(trim($op), array('+', '-', 'reset')) ? trim($op) : '');
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'm')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'm')
    {
        return parent::toXml($name);
    }
}
