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
use Zimbra\Soap\Struct\DismissAppointmentAlarm;
use Zimbra\Soap\Struct\DismissTaskAlarm;

/**
 * DismissCalendarItemAlarm request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DismissCalendarItemAlarm extends Request
{
    /**
     * Dismiss appointment alarm
     * @var DismissAppointmentAlarm
     */
    private $_appt;

    /**
     * Dismiss task alarm
     * @var DismissTaskAlarm
     */
    private $_task;

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
            $this->_appt = $appt;
        }
        if($task instanceof DismissTaskAlarm)
        {
            $this->_task = $task;
        }
    }

    /**
     * Get or set appt
     *
     * @param  DismissAppointmentAlarm $appt
     * @return DismissAppointmentAlarm|self
     */
    public function appt(DismissAppointmentAlarm $appt = null)
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
     * @param  DismissTaskAlarm $task
     * @return DismissTaskAlarm|self
     */
    public function task(DismissTaskAlarm $task = null)
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
        if($this->_appt instanceof DismissAppointmentAlarm)
        {
            $this->array += $this->_appt->toArray('appt');
        }
        if($this->_task instanceof DismissTaskAlarm)
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
        if($this->_appt instanceof DismissAppointmentAlarm)
        {
            $this->xml->append($this->_appt->toXml('appt'));
        }
        if($this->_task instanceof DismissTaskAlarm)
        {
            $this->xml->append($this->_task->toXml('task'));
        }
        return parent::toXml();
    }
}
