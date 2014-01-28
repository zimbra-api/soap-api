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
use Zimbra\Soap\Request;

/**
 * ForwardAppointmentInvite request class
 * Used by an attendee to forward an appointment invite email to another user who is not already an attendee. 
 * To forward an appointment item, use ForwardAppointmentRequest instead.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ForwardAppointmentInvite extends Request
{
    /**
     * Constructor method for ForwardAppointmentInvite
     * @param  Msg $m
     * @param  string $id
     * @return self
     */
    public function __construct(Msg $m = null, $id = null)
    {
        parent::__construct();
        if($m instanceof Msg)
        {
            $this->child('m', $m);
        }
        if(null !== $id)
        {
            $this->property('id', trim($id));
        }
    }

    /**
     * Get or set m
     * Details of the appointment.
     *
     * @param  Msg $m
     * @return Msg|self
     */
    public function m(Msg $m = null)
    {
        if(null === $m)
        {
            return $this->child('m');
        }
        return $this->child('m', $m);
    }

    /**
     * Get or set id
     * Appointment item ID
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }
}
