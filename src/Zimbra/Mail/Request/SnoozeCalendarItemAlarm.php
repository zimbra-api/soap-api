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

use Zimbra\Mail\Struct\SnoozeAppointmentAlarm;
use Zimbra\Mail\Struct\SnoozeTaskAlarm;

/**
 * SnoozeCalendarItemAlarm request class
 * Snooze alarm(s) for appointments or tasks
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SnoozeCalendarItemAlarm extends Base
{
    /**
     * Constructor method for SnoozeCalendarItemAlarm
     * @param  SnoozeAppointmentAlarm $appt
     * @param  SnoozeTaskAlarm $task
     * @return self
     */
    public function __construct(
        SnoozeAppointmentAlarm $appt = null,
        SnoozeTaskAlarm $task = null
    )
    {
        parent::__construct();
        if($appt instanceof SnoozeAppointmentAlarm)
        {
            $this->child('appt', $appt);
        }
        if($task instanceof SnoozeTaskAlarm)
        {
            $this->child('task', $task);
        }
    }

    /**
     * Get or set appt
     *
     * @param  SnoozeAppointmentAlarm $appt
     * @return SnoozeAppointmentAlarm|self
     */
    public function appt(SnoozeAppointmentAlarm $appt = null)
    {
        if(null === $appt)
        {
            return $this->child('appt');
        }
        return $this->child('appt', $appt);
    }

    /**
     * Get or set task
     *
     * @param  SnoozeTaskAlarm $task
     * @return SnoozeTaskAlarm|self
     */
    public function task(SnoozeTaskAlarm $task = null)
    {
        if(null === $task)
        {
            return $this->child('task');
        }
        return $this->child('task', $task);
    }
}
