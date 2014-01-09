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
use Zimbra\Soap\Struct\IdStatus;

/**
 * UpdateDeviceStatus request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class UpdateDeviceStatus extends Request
{
    /**
     * Information about device status.
     * @var IdStatus
     */
    private $_device;

    /**
     * Constructor method for UpdateDeviceStatus
     * @param  IdStatus $device
     * @return self
     */
    public function __construct(IdStatus $device)
    {
        parent::__construct();
        $this->_device = $device;
    }

    /**
     * Get or set device
     *
     * @param  IdStatus $device
     * @return IdStatus|self
     */
    public function device(IdStatus $device = null)
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
