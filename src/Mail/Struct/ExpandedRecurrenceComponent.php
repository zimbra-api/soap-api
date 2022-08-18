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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};

/**
 * ExpandedRecurrenceComponent class
 * Expanded recurrence
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ExpandedRecurrenceComponent
{
    /**
     * Recurrence ID
     * 
     * @var InstanceRecurIdInfo
     */
    #[Accessor(getter: "getExceptionId", setter: "setExceptionId")]
    #[SerializedName('exceptId')]
    #[Type(InstanceRecurIdInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $exceptionId;

    /**
     * DTSTART time in milliseconds since the Epoch
     * 
     * @var int
     */
    #[Accessor(getter: 'getStartTime', setter: 'setStartTime')]
    #[SerializedName('s')]
    #[Type('int')]
    #[XmlAttribute]
    private $startTime;

    /**
     * DTEND time in milliseconds since the Epoch
     * 
     * @var int
     */
    #[Accessor(getter: 'getEndTime', setter: 'setEndTime')]
    #[SerializedName('e')]
    #[Type('int')]
    #[XmlAttribute]
    private $endTime;

    /**
     * Duration
     * 
     * @var DurationInfo
     */
    #[Accessor(getter: "getDuration", setter: "setDuration")]
    #[SerializedName('dur')]
    #[Type(DurationInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $duration;

    /**
     * RRULE/RDATE/EXDATE information
     * 
     * @var RecurrenceInfo
     */
    #[Accessor(getter: "getRecurrence", setter: "setRecurrence")]
    #[SerializedName('recur')]
    #[Type(RecurrenceInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $recurrence;

    /**
     * Constructor
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
     * Get exceptionId
     *
     * @return InstanceRecurIdInfo
     */
    public function getExceptionId(): ?InstanceRecurIdInfo
    {
        return $this->exceptionId;
    }

    /**
     * Set exceptionId
     *
     * @param  InstanceRecurIdInfo $exceptionId
     * @return self
     */
    public function setExceptionId(InstanceRecurIdInfo $exceptionId): self
    {
        $this->exceptionId = $exceptionId;
        return $this;
    }

    /**
     * Get startTime
     *
     * @return int
     */
    public function getStartTime(): int
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
     * Get endTime
     *
     * @return int
     */
    public function getEndTime(): ?int
    {
        return $this->endTime;
    }

    /**
     * Set endTime
     *
     * @param  int $endTime
     * @return self
     */
    public function setEndTime(int $endTime): self
    {
        $this->endTime = $endTime;
        return $this;
    }

    /**
     * Get duration
     *
     * @return DurationInfo
     */
    public function getDuration(): ?DurationInfo
    {
        return $this->duration;
    }

    /**
     * Set duration
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
     * Get recurrence
     *
     * @return RecurrenceInfo
     */
    public function getRecurrence(): ?RecurrenceInfo
    {
        return $this->recurrence;
    }

    /**
     * Set recurrence
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
