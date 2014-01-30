<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full cnameyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Voice\Struct;

use Zimbra\Enum\VoiceMsgActionOp;
use Zimbra\Struct\Base;

/**
 * VoiceMsgActionSpec struct class
 * Action specification
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class VoiceMsgActionSpec extends Base
{
    /**
     * Constructor method for VoiceMsgActionSpec
     * @param VoiceMsgActionOp $op
     * @param string $phone
     * @param string $id
     * @param string $l
     * @return self
     */
    public function __construct(
        VoiceMsgActionOp $op,
        $phone,
        $id,
        $l = null
    )
    {
        parent::__construct();
        $this->property('op', $op);
        $this->property('phone', trim($phone));
        $this->property('id', trim($id));
        if(null !== $l)
        {
            $this->property('l', trim($l));
        }
    }

    /**
     * Gets or sets op
     *
     * @param  VoiceMsgActionOp $op
     * @return VoiceMsgActionOp|self
     */
    public function op(VoiceMsgActionOp $op = null)
    {
        if(null === $op)
        {
            return $this->property('op');
        }
        return $this->property('op', $op);
    }

    /**
     * Gets or sets phone
     *
     * @param  string $phone
     * @return string|self
     */
    public function phone($phone = null)
    {
        if(null === $phone)
        {
            return $this->property('phone');
        }
        return $this->property('phone', trim($phone));
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Gets or sets l
     *
     * @param  string $l
     * @return string|self
     */
    public function l($l = null)
    {
        if(null === $l)
        {
            return $this->property('l');
        }
        return $this->property('l', trim($l));
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'action')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'action')
    {
        return parent::toXml($name);
    }
}
