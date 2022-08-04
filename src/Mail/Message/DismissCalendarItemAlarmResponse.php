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
use Zimbra\Common\Struct\SoapResponse;

/**
 * DismissCalendarItemAlarmResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DismissCalendarItemAlarmResponse extends SoapResponse
{
    /**
     * Updated appointment alarm information
     * 
     * @Accessor(getter="getApptUpdatedAlarms", setter="setApptUpdatedAlarms")
     * @Type("array<Zimbra\Mail\Struct\UpdatedAppointmentAlarmInfo>")
     * @XmlList(inline=true, entry="appt", namespace="urn:zimbraMail")
     */
    private $apptUpdatedAlarms = [];

    /**
     * Updated task alarm information
     * 
     * @Accessor(getter="getTaskUpdatedAlarms", setter="setTaskUpdatedAlarms")
     * @Type("array<Zimbra\Mail\Struct\UpdatedTaskAlarmInfo>")
     * @XmlList(inline=true, entry="task", namespace="urn:zimbraMail")
     */
    private $taskUpdatedAlarms = [];

    /**
     * Constructor method for DismissCalendarItemAlarmResponse
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
     * @param  UpdatedAppointmentAlarmInfo $alarm
     * @return self
     */
    public function addApptUpdatedAlarm(UpdatedAppointmentAlarmInfo $alarm): self
    {
        $this->apptUpdatedAlarms[] = $alarm;
        return $this;
    }

    /**
     * Set apptUpdatedAlarms
     *
     * @param  array $alarms
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
     * Get apptUpdatedAlarms
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
     * @param  UpdatedTaskAlarmInfo $alarm
     * @return self
     */
    public function addTaskUpdatedAlarm(UpdatedTaskAlarmInfo $alarm): self
    {
        $this->taskUpdatedAlarms[] = $alarm;
        return $this;
    }

    /**
     * Set taskUpdatedAlarms
     *
     * @param  array $alarms
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
     * Get taskUpdatedAlarms
     *
     * @return array
     */
    public function getTaskUpdatedAlarms(): array
    {
        return $this->taskUpdatedAlarms;
    }
}
