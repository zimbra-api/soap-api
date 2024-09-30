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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ExpandedRecurrenceInstance
{
    /**
     * Start time in milliseconds
     *
     * @var int
     */
    #[Accessor(getter: "getStartTime", setter: "setStartTime")]
    #[SerializedName("s")]
    #[Type("int")]
    #[XmlAttribute]
    private $startTime;

    /**
     * Duration in milliseconds
     *
     * @var int
     */
    #[Accessor(getter: "getDuration", setter: "setDuration")]
    #[SerializedName("dur")]
    #[Type("int")]
    #[XmlAttribute]
    private $duration;

    /**
     * Set if the instance is for an all day appointment
     *
     * @var bool
     */
    #[Accessor(getter: "getAllDay", setter: "setAllDay")]
    #[SerializedName("allDay")]
    #[Type("bool")]
    #[XmlAttribute]
    private $allDay;

    /**
     * GMT offset of start time in milliseconds; returned only when allDay is set
     *
     * @var int
     */
    #[Accessor(getter: "getTzOffset", setter: "setTzOffset")]
    #[SerializedName("tzo")]
    #[Type("int")]
    #[XmlAttribute]
    private $tzOffset;

    /**
     * Recurrence ID string in UTC timezone
     *
     * @var string
     */
    #[Accessor(getter: "getRecurIdZ", setter: "setRecurIdZ")]
    #[SerializedName("ridZ")]
    #[Type("string")]
    #[XmlAttribute]
    private $recurIdZ;

    /**
     * Constructor
     *
     * @param  int $startTime
     * @param  int $duration
     * @param  bool $allDay
     * @param  int $tzOffset
     * @param  string $recurIdZ
     * @return self
     */
    public function __construct(
        ?int $startTime = null,
        ?int $duration = null,
        ?bool $allDay = null,
        ?int $tzOffset = null,
        ?string $recurIdZ = null
    ) {
        if (null !== $startTime) {
            $this->setStartTime($startTime);
        }
        if (null !== $duration) {
            $this->setDuration($duration);
        }
        if (null !== $allDay) {
            $this->setAllDay($allDay);
        }
        if (null !== $tzOffset) {
            $this->setTzOffset($tzOffset);
        }
        if (null !== $recurIdZ) {
            $this->setRecurIdZ($recurIdZ);
        }
    }

    /**
     * Get startTime
     *
     * @return int
     */
    public function getStartTime(): ?int
    {
        return $this->startTime;
    }

    /**
     * Set startTime
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
     * Get duration
     *
     * @return int
     */
    public function getDuration(): ?int
    {
        return $this->duration;
    }

    /**
     * Set duration
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
     * Get allDay
     *
     * @return bool
     */
    public function getAllDay(): ?bool
    {
        return $this->allDay;
    }

    /**
     * Set allDay
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
     * Get tzOffset
     *
     * @return int
     */
    public function getTzOffset(): ?int
    {
        return $this->tzOffset;
    }

    /**
     * Set tzOffset
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
     * Get recurIdZ
     *
     * @return string
     */
    public function getRecurIdZ(): ?string
    {
        return $this->recurIdZ;
    }

    /**
     * Set recurIdZ
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
