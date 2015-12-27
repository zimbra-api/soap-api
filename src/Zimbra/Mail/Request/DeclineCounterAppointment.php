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

use Zimbra\Mail\Struct\Msg;

/**
 * DeclineCounterAppointment request class
 * Decline a change proposal from an attendee.
 * Sent by organizer to an attendee who has previously sent a COUNTER message.
 * The syntax of the request is very similar to CreateAppointmentRequest.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DeclineCounterAppointment extends Base
{
    /**
     * Constructor method for DeclineCounterAppointment
     * @param  Msg $m
     * @return self
     */
    public function __construct(Msg $m = null)
    {
        parent::__construct();
        if($m instanceof Msg)
        {
            $this->setChild('m', $m);
        }
    }

    /**
     * Gets details of the Decline Counter
     *
     * @return Msg
     */
    public function getMsg()
    {
        return $this->getChild('m');
    }

    /**
     * Sets details of the Decline Counter
     *
     * @param  Msg $msg
     * @return self
     */
    public function setMsg(Msg $msg)
    {
        return $this->setChild('m', $msg);
    }
}
