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

use Zimbra\Mail\Struct\DismissAppointmentAlarm;
use Zimbra\Mail\Struct\DismissTaskAlarm;

/**
 * DismissCalendarItemAlarm request class
 * Dismiss calendar item alarm
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DismissCalendarItemAlarm extends Base
{
    /**
     * Constructor method for DismissCalendarItemAlarm
     * @param  DismissAppointmentAlarm $appt
     * @param  DismissTaskAlarm $task
     * @return self
     */
    public function __construct(
        DismissAppointmentAlarm $appt = null,
        DismissTaskAlarm $task = null
    )
    {
        parent::__construct();
        if($appt instanceof DismissAppointmentAlarm)
        {
            $this->child('appt', $appt);
        }
        if($task instanceof DismissTaskAlarm)
        {
            $this->child('task', $task);
        }
    }

    /**
     * Get or set appt
     * Dismiss appointment alarm
     *
     * @param  DismissAppointmentAlarm $appt
     * @return DismissAppointmentAlarm|self
     */
    public function appt(DismissAppointmentAlarm $appt = null)
    {
        if(null === $appt)
        {
            return $this->child('appt');
        }
        return $this->child('appt', $appt);
    }

    /**
     * Get or set task
     * Dismiss task alarm
     *
     * @param  DismissTaskAlarm $task
     * @return DismissTaskAlarm|self
     */
    public function task(DismissTaskAlarm $task = null)
    {
        if(null === $task)
        {
            return $this->child('task');
        }
        return $this->child('task', $task);
    }
}
