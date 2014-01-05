<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\NamedElement;

/**
 * RegisterDevice request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class RegisterDevice extends Request
{
    /**
     * Specification ranking device
     * @var NamedElement
     */
    private $_device;

    /**
     * Constructor method for RegisterDevice
     * @param  NamedElement $device
     * @return self
     */
    public function __construct(NamedElement $device)
    {
        parent::__construct();
        $this->_device = $device;
    }

    /**
     * Get or set device
     *
     * @param  NamedElement $device
     * @return NamedElement|self
     */
    public function device(NamedElement $device = null)
    {
        if(null === $device)
        {
            return $this->_device;
        }
        $this->_device = $device;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array += $this->_device->toArray('device');
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_device->toXml('device'));
        return parent::toXml();
    }
}
