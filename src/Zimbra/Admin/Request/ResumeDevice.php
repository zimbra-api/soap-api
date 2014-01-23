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

use Zimbra\Soap\Request;
use Zimbra\Struct\AccountSelector as Account;
use Zimbra\Admin\Struct\DeviceId as Device;

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
class ResumeDevice extends Request
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
        $this->child('account', $account);
        if($device instanceof Device)
        {
            $this->child('device', $device);
        }
    }

    /**
     * Gets or sets account
     *
     * @param  Account $account
     * @return Account|self
     */
    public function account(Account $account = null)
    {
        if(null === $account)
        {
            return $this->child('account');
        }
        return $this->child('account', $account);
    }

    /**
     * Gets or sets device
     *
     * @param  Device $device
     * @return Device|self
     */
    public function device(Device $device = null)
    {
        if(null === $device)
        {
            return $this->child('device');
        }
        return $this->child('device', $device);
    }
}
