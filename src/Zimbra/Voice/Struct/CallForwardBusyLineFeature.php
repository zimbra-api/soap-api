<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Voice\Struct;

/**
 * CallForwardBusyLineFeature struct class
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CallForwardBusyLineFeature extends CallFeatureInfo
{
    /**
     * Constructor method for CallForwardBusyLineFeature
     * @param bool   $subscribed Flag whether subscribed or not
     * @param bool   $active Flag whether active or not
     * @param string $forwardTo Telephone number to forward calls to
     * @return self
     */
    public function __construct($subscribed, $active, $forwardTo = null)
    {
    	parent::__construct($subscribed, $active);
        if(null !== $forwardTo)
        {
            $this->setProperty('ft', trim($forwardTo));
        }
    }

    /**
     * Gets forward to
     *
     * @return string
     */
    public function getForwardTo()
    {
        return $this->getProperty('ft');
    }

    /**
     * Sets forward to
     *
     * @param  string $forwardTo
     * @return self
     */
    public function setForwardTo($forwardTo)
    {
        return $this->setProperty('ft', trim($forwardTo));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'callforwardbusyline')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'callforwardbusyline')
    {
        return parent::toXml($name);
    }
}
