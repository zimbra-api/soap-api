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
use Zimbra\Mail\Struct\{LegacyAppointmentData, LegacyTaskData};
use Zimbra\Common\Soap\ResponseInterface;

/**
 * GetCalendarItemSummariesResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyentry © 2013-present by Nguyen Van Nguyen.
 */
class GetCalendarItemSummariesResponse implements ResponseInterface
{
    /**
     * Appointment summaries
     * 
     * @Accessor(getter="getApptEntries", setter="setApptEntries")
     * @Type("array<Zimbra\Mail\Struct\LegacyAppointmentData>")
     * @XmlList(inline=true, entry="appt", namespace="urn:zimbraMail")
     */
    private $apptEntries = [];

    /**
     * Task summaries
     * 
     * @Accessor(getter="getTaskEntries", setter="setTaskEntries")
     * @Type("array<Zimbra\Mail\Struct\LegacyTaskData>")
     * @XmlList(inline=true, entry="task", namespace="urn:zimbraMail")
     */
    private $taskEntries = [];

    /**
     * Constructor method for GetCalendarItemSummariesResponse
     *
     * @param  array $apptEntries
     * @param  array $taskEntries
     * @return self
     */
    public function __construct(
        array $apptEntries = [],
        array $taskEntries = []
    )
    {
        $this->setApptEntries($apptEntries)
             ->setTaskEntries($taskEntries);
    }

    /**
     * Add appt entry
     *
     * @param  LegacyAppointmentData $entry
     * @return self
     */
    public function addApptEntry(LegacyAppointmentData $entry): self
    {
        $this->apptEntries[] = $entry;
        return $this;
    }

    /**
     * Sets apptEntries
     *
     * @param  array $apptEntries
     * @return self
     */
    public function setApptEntries(array $entries): self
    {
        $this->apptEntries = array_filter($entries, static fn ($entry) => $entry instanceof LegacyAppointmentData);
        return $this;
    }

    /**
     * Gets apptEntries
     *
     * @return array
     */
    public function getApptEntries(): array
    {
        return $this->apptEntries;
    }

    /**
     * Add task entry
     *
     * @param  LegacyTaskData $entry
     * @return self
     */
    public function addTaskEntry(LegacyTaskData $entry): self
    {
        $this->taskEntries[] = $entry;
        return $this;
    }

    /**
     * Sets taskEntries
     *
     * @param  array $taskEntries
     * @return self
     */
    public function setTaskEntries(array $entries): self
    {
        $this->taskEntries = array_filter($entries, static fn ($entry) => $entry instanceof LegacyTaskData);
        return $this;
    }

    /**
     * Gets taskEntries
     *
     * @return array
     */
    public function getTaskEntries(): array
    {
        return $this->taskEntries;
    }
}
