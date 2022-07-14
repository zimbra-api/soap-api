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
use Zimbra\Mail\Struct\{UpdatedAppointmentAlarmInfo, UpdatedTaskAlarmInfo};
use Zimbra\Soap\ResponseInterface;

/**
 * SnoozeCalendarItemAlarmResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SnoozeCalendarItemAlarmResponse implements ResponseInterface
{
    /**
     * Updated appt alarm information so the client knows when to trigger the next alarm
     * 
     * @Accessor(getter="getApptUpdatedAlarms", setter="setApptUpdatedAlarms")
     * @Type("array<Zimbra\Mail\Struct\UpdatedAppointmentAlarmInfo>")
     * @XmlList(inline=true, entry="appt", namespace="urn:zimbraMail")
     */
    private $apptUpdatedAlarms = [];

    /**
     * Updated task alarm information so the client knows when to trigger the next alarm
     * 
     * @Accessor(getter="getTaskUpdatedAlarms", setter="setTaskUpdatedAlarms")
     * @Type("array<Zimbra\Mail\Struct\UpdatedTaskAlarmInfo>")
     * @XmlList(inline=true, entry="task", namespace="urn:zimbraMail")
     */
    private $taskUpdatedAlarms = [];

    /**
     * Constructor method for SnoozeCalendarItemAlarmResponse
     *
     * @param  array $alarms
     * @return self
     */
    public function __construct(array $alarms = [])
    {
        $this->setApptUpdatedAlarms($alarms)
             ->setTaskUpdatedAlarms($alarms);
    }

    /**
     * Add appt alarm
     *
     * @param  UpdatedAppointmentAlarmInfo $match
     * @return self
     */
    public function addApptUpdatedAlarm(UpdatedAppointmentAlarmInfo $alarm): self
    {
        $this->apptUpdatedAlarms[] = $alarm;
        return $this;
    }

    /**
     * Sets apptUpdatedAlarms
     *
     * @param  array $apptUpdatedAlarms
     * @return self
     */
    public function setApptUpdatedAlarms(array $alarms): self
    {
        $this->apptUpdatedAlarms = array_values(
            array_filter($alarms, static fn ($alarm) => $alarm instanceof UpdatedAppointmentAlarmInfo)
        );
        return $this;
    }

    /**
     * Gets apptUpdatedAlarms
     *
     * @return array
     */
    public function getApptUpdatedAlarms(): array
    {
        return $this->apptUpdatedAlarms;
    }

    /**
     * Add task alarm
     *
     * @param  UpdatedTaskAlarmInfo $match
     * @return self
     */
    public function addTaskUpdatedAlarm(UpdatedTaskAlarmInfo $alarm): self
    {
        $this->taskUpdatedAlarms[] = $alarm;
        return $this;
    }

    /**
     * Sets taskUpdatedAlarms
     *
     * @param  array $taskUpdatedAlarms
     * @return self
     */
    public function setTaskUpdatedAlarms(array $alarms): self
    {
        $this->taskUpdatedAlarms = array_values(
            array_filter($alarms, static fn ($alarm) => $alarm instanceof UpdatedTaskAlarmInfo)
        );
        return $this;
    }

    /**
     * Gets taskUpdatedAlarms
     *
     * @return array
     */
    public function getTaskUpdatedAlarms(): array
    {
        return $this->taskUpdatedAlarms;
    }
}
