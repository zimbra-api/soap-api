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

use Zimbra\Struct\Base;

/**
 * ModifyVoiceMailPinSpec struct class
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyVoiceMailPinSpec extends Base
{
    /**
     * Constructor method for ModifyVoiceMailPinSpec
     * @param string $oldPin
     * @param string $pin
     * @param string $name
     * @return self
     */
    public function __construct(
        $oldPin = null,
        $pin = null,
        $name = null
    )
    {
    	$this->property('oldPin', trim($oldPin));
        $this->property('pin', trim($pin));
        if(null !== $name)
        {
            $this->property('name', trim($name));
        }
    }

    /**
     * Gets or sets oldPin
     *
     * @param  string $oldPin
     * @return string|self
     */
    public function oldPin($oldPin = null)
    {
        if(null === $oldPin)
        {
            return $this->property('oldPin');
        }
        return $this->property('oldPin', trim($oldPin));
    }

    /**
     * Gets or sets pin
     * Name of user in the backing store
     *
     * @param  string $pin
     * @return string|self
     */
    public function pin($pin = null)
    {
        if(null === $pin)
        {
            return $this->property('pin');
        }
        return $this->property('pin', trim($pin));
    }

    /**
     * Gets or sets name
     * Account Number
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
     * @return array
     */
    public function toArray($name = 'phone')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'phone')
    {
        return parent::toXml($name);
    }
}
