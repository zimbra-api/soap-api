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
use Zimbra\Mail\Struct\{SnoozeAppointmentAlarm, SnoozeTaskAlarm};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * SnoozeCalendarItemAlarmRequest class
 * Snooze alarm(s) for appointments or tasks
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SnoozeCalendarItemAlarmRequest extends SoapRequest
{
    /**
     * Details of appt alarms
     * 
     * @var array
     */
    #[Accessor(getter: 'getApptAlarms', setter: 'setApptAlarms')]
    #[Type('array<Zimbra\Mail\Struct\SnoozeAppointmentAlarm>')]
    #[XmlList(inline: true, entry: 'appt', namespace: 'urn:zimbraMail')]
    private $apptAlarms = [];

    /**
     * Details of task alarms
     * 
     * @var array
     */
    #[Accessor(getter: 'getTaskAlarms', setter: 'setTaskAlarms')]
    #[Type('array<Zimbra\Mail\Struct\SnoozeTaskAlarm>')]
    #[XmlList(inline: true, entry: 'task', namespace: 'urn:zimbraMail')]
    private $taskAlarms = [];

    /**
     * Constructor
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
     * @param  SnoozeAppointmentAlarm $alarm
     * @return self
     */
    public function addApptAlarm(SnoozeAppointmentAlarm $alarm): self
    {
        $this->apptAlarms[] = $alarm;
        return $this;
    }

    /**
     * Set apptAlarms
     *
     * @param  array $alarms
     * @return self
     */
    public function setApptAlarms(array $alarms): self
    {
        $this->apptAlarms = array_values(
            array_filter($alarms, static fn ($alarm) => $alarm instanceof SnoozeAppointmentAlarm)
        );
        return $this;
    }

    /**
     * Get apptAlarms
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
     * @param  SnoozeTaskAlarm $alarm
     * @return self
     */
    public function addTaskAlarm(SnoozeTaskAlarm $alarm): self
    {
        $this->taskAlarms[] = $alarm;
        return $this;
    }

    /**
     * Set taskAlarms
     *
     * @param  array $alarms
     * @return self
     */
    public function setTaskAlarms(array $alarms): self
    {
        $this->taskAlarms = array_values(
            array_filter($alarms, static fn ($alarm) => $alarm instanceof SnoozeTaskAlarm)
        );
        return $this;
    }

    /**
     * Get taskAlarms
     *
     * @return array
     */
    public function getTaskAlarms(): array
    {
        return $this->taskAlarms;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new SnoozeCalendarItemAlarmEnvelope(
            new SnoozeCalendarItemAlarmBody($this)
        );
    }
}
