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
 * Remove a device or remove all devices attached to an account.
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
     * @param  Device $device Device specification - Note - if not supplied ALL devices will be removed.
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
