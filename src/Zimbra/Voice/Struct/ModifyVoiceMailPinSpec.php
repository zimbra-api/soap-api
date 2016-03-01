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
     * @param string $oldPin Old PIN
     * @param string $pin New PIN
     * @param string $name Phone name
     * @return self
     */
    public function __construct(
        $oldPin = null,
        $pin = null,
        $name = null
    )
    {
        parent::__construct();
    	$this->setProperty('oldPin', trim($oldPin));
        $this->setProperty('pin', trim($pin));
        if(null !== $name)
        {
            $this->setProperty('name', trim($name));
        }
    }

    /**
     * Gets old pin
     *
     * @return string
     */
    public function getOldPin()
    {
        return $this->getProperty('oldPin');
    }

    /**
     * Sets old pin
     *
     * @param  string $oldPin
     * @return self
     */
    public function setOldPin($oldPin)
    {
        return $this->setProperty('oldPin', trim($oldPin));
    }

    /**
     * Gets new pin
     *
     * @return string
     */
    public function getPin()
    {
        return $this->getProperty('pin');
    }

    /**
     * Sets new pin
     *
     * @param  string $pin
     * @return self
     */
    public function setPin($pin)
    {
        return $this->setProperty('pin', trim($pin));
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
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
