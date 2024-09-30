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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Mail\Struct\{CalendarItemInfo, TaskItemInfo};
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetAppointmentResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAppointmentResponse extends SoapResponse
{
    /**
     * Appointment information
     *
     * @Accessor(getter="getApptItem", setter="setApptItem")
     * @SerializedName("appt")
     * @Type("Zimbra\Mail\Struct\CalendarItemInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var CalendarItemInfo
     */
    #[Accessor(getter: "getApptItem", setter: "setApptItem")]
    #[SerializedName("appt")]
    #[Type(CalendarItemInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?CalendarItemInfo $appt;

    /**
     * Task information
     *
     * @Accessor(getter="getTaskItem", setter="setTaskItem")
     * @SerializedName("task")
     * @Type("Zimbra\Mail\Struct\TaskItemInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var TaskItemInfo
     */
    #[Accessor(getter: "getTaskItem", setter: "setTaskItem")]
    #[SerializedName("task")]
    #[Type(TaskItemInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?TaskItemInfo $task;

    /**
     * Constructor
     *
     * @param  CalendarItemInfo $appt
     * @return self
     */
    public function __construct(
        ?CalendarItemInfo $appt = null,
        ?TaskItemInfo $task = null
    ) {
        $this->appt = $appt;
        $this->task = $task;
    }

    /**
     * Get appt
     *
     * @return CalendarItemInfo
     */
    public function getApptItem(): ?CalendarItemInfo
    {
        return $this->appt;
    }

    /**
     * Set appt
     *
     * @param  CalendarItemInfo $appt
     * @return self
     */
    public function setApptItem(CalendarItemInfo $appt): self
    {
        $this->appt = $appt;
        return $this;
    }

    /**
     * Get task
     *
     * @return TaskItemInfo
     */
    public function getTaskItem(): ?TaskItemInfo
    {
        return $this->task;
    }

    /**
     * Set task
     *
     * @param  TaskItemInfo $task
     * @return self
     */
    public function setTaskItem(TaskItemInfo $task): self
    {
        $this->task = $task;
        return $this;
    }
}
