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

use Zimbra\Soap\Request;

/**
 * SendDeliveryReport request class
 * Send a delivery report
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SendDeliveryReport extends Request
{
    /**
     * Constructor method for SendDeliveryReport
     * @param  string $mid
     * @return self
     */
    public function __construct($mid)
    {
        parent::__construct();
        $this->property('mid', trim($mid));
    }

    /**
     * Get or set mid
     *
     * @param  string $mid
     * @return string|self
     */
    public function mid($mid = null)
    {
        if(null === $mid)
        {
            return $this->property('mid');
        }
        return $this->property('mid', trim($mid));
    }
}
