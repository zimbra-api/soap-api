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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * ExpandedRecurrenceInstance class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ExpandedRecurrenceInstance
{
    /**
     * Start time in milliseconds
     * @Accessor(getter="getStartTime", setter="setStartTime")
     * @SerializedName("s")
     * @Type("integer")
     * @XmlAttribute
     */
    private $startTime;

    /**
     * Duration in milliseconds
     * @Accessor(getter="getDuration", setter="setDuration")
     * @SerializedName("dur")
     * @Type("integer")
     * @XmlAttribute
     */
    private $duration;

    /**
     * Set if the instance is for an all day appointment
     * @Accessor(getter="getAllDay", setter="setAllDay")
     * @SerializedName("allDay")
     * @Type("bool")
     * @XmlAttribute
     */
    private $allDay;

    /**
     * GMT offset of start time in milliseconds; returned only when allDay is set
     * @Accessor(getter="getTzOffset", setter="setTzOffset")
     * @SerializedName("tzo")
     * @Type("integer")
     * @XmlAttribute
     */
    private $tzOffset;

    /**
     * Recurrence ID string in UTC timezone
     * @Accessor(getter="getRecurIdZ", setter="setRecurIdZ")
     * @SerializedName("ridZ")
     * @Type("string")
     * @XmlAttribute
     */
    private $recurIdZ;

    /**
     * Constructor method for ExpandedRecurrenceInstance
     *
     * @param  int $startTime
     * @param  int $duration
     * @param  bool $allDay
     * @param  int $tzOffset
     * @param  string $recurIdZ
     * @return self
     */
    public function __construct(
        ?int $startTime = NULL,
        ?int $duration = NULL,
        ?bool $allDay = NULL,
        ?int $tzOffset = NULL,
        ?string $recurIdZ = NULL
    )
    {
        if (NULL !== $startTime) {
            $this->setStartTime($startTime);
        }
        if (NULL !== $duration) {
            $this->setDuration($duration);
        }
        if (NULL !== $allDay) {
            $this->setAllDay($allDay);
        }
        if (NULL !== $tzOffset) {
            $this->setTzOffset($tzOffset);
        }
        if (NULL !== $recurIdZ) {
            $this->setRecurIdZ($recurIdZ);
        }
    }

    /**
     * Gets startTime
     *
     * @return int
     */
    public function getStartTime(): ?int
    {
        return $this->startTime;
    }

    /**
     * Sets startTime
     *
     * @param  int $startTime
     * @return self
     */
    public function setStartTime(int $startTime): self
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * Gets duration
     *
     * @return int
     */
    public function getDuration(): ?int
    {
        return $this->duration;
    }

    /**
     * Sets duration
     *
     * @param  int $duration
     * @return self
     */
    public function setDuration(int $duration): self
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * Gets allDay
     *
     * @return bool
     */
    public function getAllDay(): ?bool
    {
        return $this->allDay;
    }

    /**
     * Sets allDay
     *
     * @param  bool $allDay
     * @return self
     */
    public function setAllDay(bool $allDay): self
    {
        $this->allDay = $allDay;
        return $this;
    }

    /**
     * Gets tzOffset
     *
     * @return int
     */
    public function getTzOffset(): ?int
    {
        return $this->tzOffset;
    }

    /**
     * Sets tzOffset
     *
     * @param  int $tzOffset
     * @return self
     */
    public function setTzOffset(int $tzOffset): self
    {
        $this->tzOffset = $tzOffset;
        return $this;
    }

    /**
     * Gets recurIdZ
     *
     * @return string
     */
    public function getRecurIdZ(): ?string
    {
        return $this->recurIdZ;
    }

    /**
     * Sets recurIdZ
     *
     * @param  string $recurIdZ
     * @return self
     */
    public function setRecurIdZ(string $recurIdZ): self
    {
        $this->recurIdZ = $recurIdZ;
        return $this;
    }
}
