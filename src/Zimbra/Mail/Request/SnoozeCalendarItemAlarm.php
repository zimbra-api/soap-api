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

use Zimbra\Common\TypedSequence;
use Zimbra\Mail\Struct\SnoozeAlarm;
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
     * Details of alarms.
     * @var TypedSequence<SnoozeAlarm>
     */
    private $_alarms;

    /**
     * Constructor method for SnoozeCalendarItemAlarm
     * @param  array $alarms
     * @return self
     */
    public function __construct(array $alarms = [])
    {
        parent::__construct();
        $this->_alarms = new TypedSequence('Zimbra\Mail\Struct\SnoozeAlarm', $alarms);
        $this->on('before', function(Base $sender)
        {
            if($sender->getAlarms()->count())
            {
                foreach ($sender->getAlarms()->all() as $alarm)
                {
                    if($alarm instanceof SnoozeAppointmentAlarm)
                    {
                        $this->setChild('appt', $alarm);
                    }
                    if($alarm instanceof SnoozeTaskAlarm)
                    {
                        $this->setChild('task', $alarm);
                    }
                }
            }
        });
    }

    /**
     * Add an alarm
     *
     * @param  SnoozeAlarm $alarm
     * @return self
     */
    public function addAlarm(SnoozeAlarm $alarm)
    {
        $this->_alarms->add($alarm);
        return $this;
    }

    /**
     * Sets alarms
     *
     * @param  array $alarms
     * @return self
     */
    public function setAlarms(array $alarms)
    {
        $this->_alarms = new TypedSequence('Zimbra\Mail\Struct\SnoozeAlarm', $alarms);
        return $this;
    }

    /**
     * Gets alarms
     *
     * @return Sequence
     */
    public function getAlarms()
    {
        return $this->_alarms;
    }
}
