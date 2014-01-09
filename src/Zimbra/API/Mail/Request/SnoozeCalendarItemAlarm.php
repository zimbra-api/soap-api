<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\SnoozeAppointmentAlarm;
use Zimbra\Soap\Struct\SnoozeTaskAlarm;

/**
 * SnoozeCalendarItemAlarm request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SnoozeCalendarItemAlarm extends Request
{
    /**
     * Dismiss appointment alarm
     * @var SnoozeAppointmentAlarm
     */
    private $_appt;

    /**
     * Dismiss task alarm
     * @var SnoozeTaskAlarm
     */
    private $_task;

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
            $this->_appt = $appt;
        }
        if($task instanceof SnoozeTaskAlarm)
        {
            $this->_task = $task;
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
            return $this->_appt;
        }
        $this->_appt = $appt;
        return $this;
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
            return $this->_task;
        }
        $this->_task = $task;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if($this->_appt instanceof SnoozeAppointmentAlarm)
        {
            $this->array += $this->_appt->toArray('appt');
        }
        if($this->_task instanceof SnoozeTaskAlarm)
        {
            $this->array += $this->_task->toArray('task');
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
        if($this->_appt instanceof SnoozeAppointmentAlarm)
        {
            $this->xml->append($this->_appt->toXml('appt'));
        }
        if($this->_task instanceof SnoozeTaskAlarm)
        {
            $this->xml->append($this->_task->toXml('task'));
        }
        return parent::toXml();
    }
}
