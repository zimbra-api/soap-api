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

use Zimbra\Struct\NamedElement;

/**
 * RegisterDevice request class
 * Register a device
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RegisterDevice extends Base
{
    /**
     * Constructor method for RegisterDevice
     * @param  NamedElement $device
     * @return self
     */
    public function __construct(NamedElement $device)
    {
        parent::__construct();
        $this->setChild('device', $device);
    }

    /**
     * Gets specify the device
     *
     * @return NamedElement
     */
    public function getDevice()
    {
        return $this->getChild('device');
    }

    /**
     * Sets specify the device
     *
     * @param  NamedElement $device
     * @return self
     */
    public function setDevice(NamedElement $device)
    {
        return $this->setChild('device', $device);
    }
}
