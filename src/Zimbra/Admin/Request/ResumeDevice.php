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
 * ResumeDevice request class
 * Resume sync with a device or all devices attached to an account if currently suspended.
 * This will cause a policy reset, but will not reset sync data..
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ResumeDevice extends Base
{
    /**
     * Constructor method for ResumeDevice
     * @param  Account $account Account selector
     * @param  Device $device Device ID
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
