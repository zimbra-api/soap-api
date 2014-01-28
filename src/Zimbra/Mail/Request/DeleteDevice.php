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

use Zimbra\Struct\Id;
use Zimbra\Soap\Request;

/**
 * DeleteDevice request class
 * Permanently deletes mapping for indicated device.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DeleteDevice extends Request
{
    /**
     * Constructor method for DeleteDevice
     * @param  Id $device
     * @return self
     */
    public function __construct(Id $device)
    {
        parent::__construct();
        $this->child('device', $device);
    }

    /**
     * Get or set device
     *
     * @param  Id $device
     * @return Id|self
     */
    public function device(Id $device = null)
    {
        if(null === $device)
        {
            return $this->child('device');
        }
        return $this->child('device', $device);
    }
}
