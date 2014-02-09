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

use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\DtTimeInfo;
use Zimbra\Mail\Struct\Msg;

/**
 * ForwardAppointment request class
 * Used by an attendee to forward an instance or entire appointment to another user who is not already an attendee.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ForwardAppointment extends Base
{
    /**
     * Constructor method for ForwardAppointment
     * @param  DtTimeInfo $exceptId
     * @param  CalTZInfo $tz
     * @param  Msg $m
     * @param  string $id
     * @return self
     */
    public function __construct(
        DtTimeInfo $exceptId = null,
        CalTZInfo $tz = null,
        Msg $m = null,
        $id = null
    )
    {
        parent::__construct();
        if($exceptId instanceof DtTimeInfo)
        {
            $this->child('exceptId', $exceptId);
        }
        if($tz instanceof CalTZInfo)
        {
            $this->child('tz', $tz);
        }
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
     * Get or set exceptId
     * RECURRENCE-ID information if forwarding a single instance of a recurring appointment
     *
     * @param  DtTimeInfo $exceptId
     * @return DtTimeInfo|self
     */
    public function exceptId(DtTimeInfo $exceptId = null)
    {
        if(null === $exceptId)
        {
            return $this->child('exceptId');
        }
        return $this->child('exceptId', $exceptId);
    }

    /**
     * Get or set tz
     * Definition for TZID referenced by DATETIME in <exceptId>
     *
     * @param  CalTZInfo $tz
     * @return CalTZInfo|self
     */
    public function tz(CalTZInfo $tz = null)
    {
        if(null === $tz)
        {
            return $this->child('tz');
        }
        return $this->child('tz', $tz);
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
