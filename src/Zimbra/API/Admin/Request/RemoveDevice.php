<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\AccountSelector as Account;
use Zimbra\Soap\Struct\DeviceId as Device;

/**
 * RemoveDevice class
 * Remove a device or remove all devices attached to an account.
 * This will not cause a reset of sync data, but will cause a reset of policies on the next sync.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class RemoveDevice extends Request
{
    /**
     * Use to select account
     * @var AccountSelector
     */
    private $_account;

    /**
     * Device specification - Note - if not supplied ALL devices will be removed.
     * @var Device
     */
    private $_device;

    /**
     * Constructor method for RemoveDevice
     * @param  Account $account
     * @param  Device $device
     * @return self
     */
    public function __construct(Account $account, Device $device = null)
    {
        parent::__construct();
        $this->_account = $account;
        if($device instanceof Device)
        {
            $this->_device = $device;
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
            return $this->_account;
        }
        $this->_account = $account;
        return $this;
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
        $this->array = $this->_account->toArray();
        if($this->_device instanceof Device)
        {
            $this->array += $this->_device->toArray('device');
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_account->toXml());
        if($this->_device instanceof Device)
        {
            $this->xml->append($this->_device->toXml('device'));
        }
        return parent::toXml();
    }
}
