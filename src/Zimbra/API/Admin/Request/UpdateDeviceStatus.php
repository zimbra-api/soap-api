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
use Zimbra\Soap\Struct\IdStatus as Device;

/**
 * UpdateDeviceStatus class
 * Update device status.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class UpdateDeviceStatus extends Request
{
    /**
     * Account selector
     * @var Account
     */
    private $_account;

    /**
     * Information on new device status.
     * @var Device
     */
    private $_device;

    /**
     * Constructor method for SuspendDevice
     * @param  Account $account
     * @param  Device $device
     * @return self
     */
    public function __construct(Account $account, Device $device)
    {
        parent::__construct();
        $this->_account = $account;
        $this->_device = $device;
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
        $this->xml->append($this->_account->toXml())
                  ->append($this->_device->toXml('device'));
        return parent::toXml();
    }
}
