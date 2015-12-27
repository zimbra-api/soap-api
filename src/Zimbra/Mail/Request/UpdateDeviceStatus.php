<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Mail\Struct\IdStatus;

/**
 * UpdateDeviceStatus request class
 * Update device status
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class UpdateDeviceStatus extends Base
{
    /**
     * Constructor method for UpdateDeviceStatus
     * @param  IdStatus $device
     * @return self
     */
    public function __construct(IdStatus $device)
    {
        parent::__construct();
        $this->setChild('device', $device);
    }

    /**
     * Gets information about device status
     *
     * @return IdStatus
     */
    public function getDevice()
    {
        return $this->getChild('device');
    }

    /**
     * Sets information about device status
     *
     * @param  IdStatus $device
     * @return self
     */
    public function setDevice(IdStatus $device)
    {
        return $this->setChild('device', $device);
    }
}
