<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};

/**
 * ExpandedRecurrenceComponent class
 * Expanded recurrence
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="exp")
 */
class ExpandedRecurrenceComponent
{
    /**
     * RECURRENCE_ID
     * @Accessor(getter="getExceptionId", setter="setExceptionId")
     * @SerializedName("exceptId")
     * @Type("Zimbra\Mail\Struct\InstanceRecurIdInfo")
     * @XmlElement
     */
    private $exceptionId;

    /**
     * DTSTART time in milliseconds since the Epoch
     * @Accessor(getter="getStartTime", setter="setStartTime")
     * @SerializedName("s")
     * @Type("integer")
     * @XmlAttribute
     */
    private $startTime;

    /**
     * DTEND time in milliseconds since the Epoch
     * @Accessor(getter="getEndTime", setter="setEndTime")
     * @SerializedName("e")
     * @Type("integer")
     * @XmlAttribute
     */
    private $endTime;

    /**
     * DURATION
     * @Accessor(getter="getDuration", setter="setDuration")
     * @SerializedName("dur")
     * @Type("Zimbra\Mail\Struct\DurationInfo")
     * @XmlElement
     */
    private $duration;

    /**
     * RRULE/RDATE/EXDATE information
     * @Accessor(getter="getRecurrence", setter="setRecurrence")
     * @SerializedName("recur")
     * @Type("Zimbra\Mail\Struct\RecurrenceInfo")
     * @XmlElement
     */
    private $recurrence;

    /**
     * Constructor method for ExpandedRecurrenceComponent
     *
     * @param  InstanceRecurIdInfo $exceptionId
     * @param  int $startTime
     * @param  int $endTime
     * @param  DurationInfo $duration
     * @param  RecurrenceInfo $recurrence
     * @return self
     */
    public function __construct(
        ?InstanceRecurIdInfo $exceptionId = NULL,
        ?int $startTime = NULL,
        ?int $endTime = NULL,
        ?DurationInfo $duration = NULL,
        ?RecurrenceInfo $recurrence = NULL
    )
    {
        if ($exceptionId instanceof InstanceRecurIdInfo) {
            $this->setExceptionId($exceptionId);
        }
        if (NULL !== $startTime) {
            $this->setStartTime($startTime);
        }
        if (NULL !== $endTime) {
            $this->setEndTime($endTime);
        }
        if ($duration instanceof DurationInfo) {
            $this->setDuration($duration);
        }
        if ($recurrence instanceof RecurrenceInfo) {
            $this->setRecurrence($recurrence);
        }
    }

    /**
     * Gets range
     *
     * @return InstanceRecurIdInfo
     */
    public function getExceptionId(): ?InstanceRecurIdInfo
    {
        return $this->range;
    }

    /**
     * Sets range
     *
     * @param  InstanceRecurIdInfo $range
     * @return self
     */
    public function setExceptionId(InstanceRecurIdInfo $range): self
    {
        $this->range = $range;
        return $this;
    }

    /**
     * Gets dateTime
     *
     * @return int
     */
    public function getStartTime(): int
    {
        return $this->dateTime;
    }

    /**
     * Sets dateTime
     *
     * @param  int $dateTime
     * @return self
     */
    public function setStartTime(int $dateTime): self
    {
        $this->dateTime = $dateTime;
        return $this;
    }

    /**
     * Gets timezone
     *
     * @return int
     */
    public function getEndTime(): ?int
    {
        return $this->timezone;
    }

    /**
     * Sets timezone
     *
     * @param  int $timezone
     * @return self
     */
    public function setEndTime(int $timezone): self
    {
        $this->timezone = $timezone;
        return $this;
    }

    /**
     * Gets duration
     *
     * @return DurationInfo
     */
    public function getDuration(): ?DurationInfo
    {
        return $this->duration;
    }

    /**
     * Sets duration
     *
     * @param  DurationInfo $duration
     * @return self
     */
    public function setDuration(DurationInfo $duration): self
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * Gets recurrence
     *
     * @return RecurrenceInfo
     */
    public function getRecurrence(): ?RecurrenceInfo
    {
        return $this->recurrence;
    }

    /**
     * Sets recurrence
     *
     * @param  RecurrenceInfo $recurrence
     * @return self
     */
    public function setRecurrence(RecurrenceInfo $recurrence): self
    {
        $this->recurrence = $recurrence;
        return $this;
    }
}
