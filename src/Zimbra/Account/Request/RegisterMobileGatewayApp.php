<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Request;

use Zimbra\Account\Struct\ZmgDeviceSpec;

/**
 * RegisterMobileGatewayApp request class
 * Registering app/device to receive push notifications.
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RegisterMobileGatewayApp extends Base
{
    /**
     * Constructor method for RegisterMobileGatewayApp
     * @param ZmgDeviceSpec $signature Zmg device specification
     * @return self
     */
    public function __construct(ZmgDeviceSpec $zmgDevice)
    {
        parent::__construct();
        $this->setChild('zmgDevice', $zmgDevice);
    }

    /**
     * Gets zmg device
     *
     * @return ZmgDeviceSpec
     */
    public function getZmgDevice()
    {
        return $this->getChild('zmgDevice');
    }

    /**
     * Sets zmg device
     *
     * @param  ZmgDeviceSpec $zmgDevice
     * @return self
     */
    public function setZmgDevice(ZmgDeviceSpec $zmgDevice)
    {
        return $this->setChild('zmgDevice', $zmgDevice);
    }
}
