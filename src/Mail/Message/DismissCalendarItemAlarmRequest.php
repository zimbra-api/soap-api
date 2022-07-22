<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Mail\Struct\{DismissAppointmentAlarm, DismissTaskAlarm};
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * DismissCalendarItemAlarmRequest class
 * Dismiss calendar item alarm
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DismissCalendarItemAlarmRequest extends Request
{
    /**
     * Details of appt alarms to dismiss
     * 
     * @Accessor(getter="getApptAlarms", setter="setApptAlarms")
     * @Type("array<Zimbra\Mail\Struct\DismissAppointmentAlarm>")
     * @XmlList(inline=true, entry="appt", namespace="urn:zimbraMail")
     */
    private $apptAlarms = [];

    /**
     * Details of task alarms to dismiss
     * 
     * @Accessor(getter="getTaskAlarms", setter="setTaskAlarms")
     * @Type("array<Zimbra\Mail\Struct\DismissTaskAlarm>")
     * @XmlList(inline=true, entry="task", namespace="urn:zimbraMail")
     */
    private $taskAlarms = [];

    /**
     * Constructor method for DismissCalendarItemAlarmRequest
     *
     * @param  array $alarms
     * @return self
     */
    public function __construct(array $alarms = [])
    {
        $this->setApptAlarms($alarms)
             ->setTaskAlarms($alarms);
    }

    /**
     * Add dismiss appointment alarm
     *
     * @param  DismissAppointmentAlarm $filterRule
     * @return self
     */
    public function addApptAlarm(DismissAppointmentAlarm $alarm): self
    {
        $this->apptAlarms[] = $alarm;
        return $this;
    }

    /**
     * Sets apptAlarms
     *
     * @param  array $alarms
     * @return self
     */
    public function setApptAlarms(array $alarms): self
    {
        $this->apptAlarms = array_values(
            array_filter($alarms, static fn ($alarm) => $alarm instanceof DismissAppointmentAlarm)
        );
        return $this;
    }

    /**
     * Gets apptAlarms
     *
     * @return array
     */
    public function getApptAlarms(): array
    {
        return $this->apptAlarms;
    }

    /**
     * Add dismiss appointment alarm
     *
     * @param  DismissTaskAlarm $filterRule
     * @return self
     */
    public function addTaskAlarm(DismissTaskAlarm $alarm): self
    {
        $this->taskAlarms[] = $alarm;
        return $this;
    }

    /**
     * Sets taskAlarms
     *
     * @param  array $alarms
     * @return self
     */
    public function setTaskAlarms(array $alarms): self
    {
        $this->taskAlarms = array_values(
            array_filter($alarms, static fn ($alarm) => $alarm instanceof DismissTaskAlarm)
        );
        return $this;
    }

    /**
     * Gets taskAlarms
     *
     * @return array
     */
    public function getTaskAlarms(): array
    {
        return $this->taskAlarms;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new DismissCalendarItemAlarmEnvelope(
            new DismissCalendarItemAlarmBody($this)
        );
    }
}
