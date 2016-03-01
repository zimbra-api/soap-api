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

use Zimbra\Admin\Struct\DeviceId as Device;
use Zimbra\Struct\AccountSelector as Account;

/**
 * RemoveDevice request class
 * Remove a Device or remove all Devices attached to an account.
 * This will not cause a reset of sync data, but will cause a reset of policies on the next sync.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RemoveDevice extends Base
{
    /**
     * Constructor method for RemoveDevice
     * @param  Account $account Use to select account
     * @param  Device $device Device specification - Note - if not supplied ALL Devices will be removed.
     * @return self
     */
    public function __construct(Account $account, Device $device = null)
    {
        parent::__construct();
        $this->setChild('account', $account);
        if($device instanceof Device)
        {
            $this->setChild('device', $device);
        }
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
     * Sets the Device.
     *
     * @param  Device $device
     * @return self
     */
    public function setDevice(Device $device)
    {
        return $this->setChild('device', $device);
    }
}
