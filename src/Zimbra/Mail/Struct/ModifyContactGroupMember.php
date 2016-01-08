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

use Zimbra\Enum\MemberType;
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
     * @param MemberType $type Member type
     * @param string $value Member value
     * @param string $op Operation - +|-|reset
     * @return self
     */
    public function __construct(
        MemberType $type,
        $value,
        $op = null
    )
    {
        parent::__construct();
        $this->setType($type)
            ->setValue($value);
        if(null !== $op)
        {
            $this->setOperation($op);
        }
    }

    /**
     * Gets type
     *
     * @return MemberType
     */
    public function getType()
    {
        return $this->getProperty('type');
    }

    /**
     * Sets type
     *
     * @param  MemberType $type
     * @return self
     */
    public function setType(MemberType $type)
    {
        return $this->setProperty('type', $type);
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
     * Gets operation
     *
     * @return string
     */
    public function getOperation()
    {
        return $this->getProperty('op');
    }

    /**
     * Sets operation
     *
     * @param  string $op
     * @return self
     */
    public function setOperation($op)
    {
        return $this->setProperty('op', in_array(trim($op), ['+', '-', 'reset']) ? trim($op) : '');
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
