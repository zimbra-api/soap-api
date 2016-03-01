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
use Zimbra\Mail\Struct\DismissAlarm;
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
     * Details of alarms to dismiss
     * @var TypedSequence<Zimbra\Mail\Struct\DismissAlarm>
     */
    private $_alarms;

    /**
     * Constructor method for DismissCalendarItemAlarm
     * @param  array $alarms Details of alarms to dismiss
     * @return self
     */
    public function __construct(array $alarms = [])
    {
        parent::__construct();
        $this->setAlarms($alarms);
        $this->on('before', function(Base $sender)
        {
            if($sender->getAlarms()->count())
            {
                foreach ($sender->getAlarms()->all() as $alarm)
                {
                    if($alarm instanceof DismissAppointmentAlarm)
                    {
                        $this->setChild('appt', $alarm);
                    }
                    if($alarm instanceof DismissTaskAlarm)
                    {
                        $this->setChild('task', $alarm);
                    }
                }
            }
        });
    }

    /**
     * Add a dismiss alarm
     *
     * @param  DismissAlarm $alarm
     * @return self
     */
    public function addAlarm(DismissAlarm $alarm)
    {
        $this->_alarms->add($alarm);
        return $this;
    }

    /**
     * Sets dismiss alarm sequence
     *
     * @param  array $alarms
     * @return self
     */
    public function setAlarms(array $alarms)
    {
        $this->_alarms = new TypedSequence('Zimbra\Mail\Struct\DismissAlarm', $alarms);
        return $this;
    }

    /**
     * Gets dismiss alarm sequence
     *
     * @return Sequence
     */
    public function getAlarms()
    {
        return $this->_alarms;
    }
}
