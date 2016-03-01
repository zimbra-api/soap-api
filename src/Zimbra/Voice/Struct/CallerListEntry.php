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

use Zimbra\Struct\Base;

/**
 * CallerListEntry struct class
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CallerListEntry extends Base
{
    /**
     * Constructor method for CallerListEntry
     * @param string $phoneNumber Caller number from which the call should be forwarded to the forward to number
     * @param bool $active Flag whether phone number is active in the list - "true" or "false"
     * @return self
     */
    public function __construct($phoneNumber, $active)
    {
        parent::__construct();
        $this->setProperty('pn', trim($phoneNumber));
        $this->setProperty('a', (bool) $active);
    }

    /**
     * Gets phone number
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->getProperty('pn');
    }

    /**
     * Sets phone number
     *
     * @param  string $phoneNumber
     * @return self
     */
    public function setPhoneNumber($phoneNumber)
    {
        return $this->setProperty('pn', trim($phoneNumber));
    }

    /**
     * Gets active
     *
     * @return string
     */
    public function getActive()
    {
        return $this->getProperty('a');
    }

    /**
     * Sets active
     *
     * @param  string $active
     * @return self
     */
    public function setActive($active)
    {
        return $this->setProperty('a', (bool) $active);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'phone')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'phone')
    {
        return parent::toXml($name);
    }
}
