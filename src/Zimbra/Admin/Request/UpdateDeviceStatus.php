<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Admin\Struct\IdStatus as Device;
use Zimbra\Struct\AccountSelector as Account;

/**
 * UpdateDeviceStatus reqeust class
 * Update device status.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class UpdateDeviceStatus extends Base
{
    /**
     * Constructor method for SuspendDevice
     * @param  Account $account Account selector
     * @param  Device $device Information on new device status.
     * @return self
     */
    public function __construct(Account $account, Device $device)
    {
        parent::__construct();
        $this->setChild('account', $account);
        $this->setChild('device', $device);
    }

    /**
     * Sets the account.
     *
     * @return Account
     */
    public function getAccount()
    {
        return $this->getChild('account');
    }

    /**
     * Sets the account.
     *
     * @param  Account $account
     * @return self
     */
    public function setAccount(Account $account)
    {
        return $this->setChild('account', $account);
    }

    /**
     * Gets the device.
     *
     * @return Device
     */
    public function getDevice()
    {
        return $this->getChild('device');
    }

    /**
     * Sets the device.
     *
     * @param  Device $device
     * @return self
     */
    public function setDevice(Device $device)
    {
        return $this->setChild('device', $device);
    }
}
