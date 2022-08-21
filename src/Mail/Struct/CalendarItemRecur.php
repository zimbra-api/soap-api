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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\{
    DtTimeInfoInterface,
    DurationInfoInterface,
    ExceptionRecurIdInfoInterface,
    RecurrenceInfoInterface,
};

/**
 * CalendarItemRecur struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CalendarItemRecur
{
    /**
     * Information for iCalendar RECURRENCE-ID
     * 
     * @Accessor(getter="getExceptionId", setter="setExceptionId")
     * @SerializedName("exceptId")
     * @Type("Zimbra\Mail\Struct\ExceptionRecurIdInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var ExceptionRecurIdInfoInterface
     */
    #[Accessor(getter: "getExceptionId", setter: "setExceptionId")]
    #[SerializedName('exceptId')]
    #[Type(ExceptionRecurIdInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?ExceptionRecurIdInfoInterface $exceptionId;

    /**
     * Start time
     * 
     * @Accessor(getter="getDtStart", setter="setDtStart")
     * @SerializedName("s")
     * @Type("Zimbra\Mail\Struct\DtTimeInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var DtTimeInfoInterface
     */
    #[Accessor(getter: "getDtStart", setter: "setDtStart")]
    #[SerializedName('s')]
    #[Type(DtTimeInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?DtTimeInfoInterface $dtStart;

    /**
     * End time
     * 
     * @Accessor(getter="getDtEnd", setter="setDtEnd")
     * @SerializedName("e")
     * @Type("Zimbra\Mail\Struct\DtTimeInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var DtTimeInfoInterface
     */
    #[Accessor(getter: "getDtEnd", setter: "setDtEnd")]
    #[SerializedName('e')]
    #[Type(DtTimeInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?DtTimeInfoInterface $dtEnd;

    /**
     * Duration information
     * 
     * @Accessor(getter="getDuration", setter="setDuration")
     * @SerializedName("dur")
     * @Type("Zimbra\Mail\Struct\DurationInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var DurationInfoInterface
     */
    #[Accessor(getter: "getDuration", setter: "setDuration")]
    #[SerializedName('dur')]
    #[Type(DurationInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?DurationInfoInterface $duration;

    /**
     * Recurrence information
     * 
     * @Accessor(getter="getRecurrence", setter="setRecurrence")
     * @SerializedName("recur")
     * @Type("Zimbra\Mail\Struct\RecurrenceInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var RecurrenceInfoInterface
     */
    #[Accessor(getter: "getRecurrence", setter: "setRecurrence")]
    #[SerializedName('recur')]
    #[Type(RecurrenceInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?RecurrenceInfoInterface $recurrence;

    /**
     * Constructor
     *
     * @param ExceptionRecurIdInfo $exceptionId
     * @param DtTimeInfo $dtStart
     * @param DtTimeInfo $dtEnd
     * @param DurationInfo $duration
     * @param RecurrenceInfo $recurrence
     * @return self
     */
    public function __construct(
        ?ExceptionRecurIdInfo $exceptionId = NULL,
        ?DtTimeInfo $dtStart = NULL,
        ?DtTimeInfo $dtEnd = NULL,
        ?DurationInfo $duration = NULL,
        ?RecurrenceInfo $recurrence = NULL
    )
    {
        $this->exceptionId = $exceptionId;
        $this->dtStart = $dtStart;
        $this->dtEnd = $dtEnd;
        $this->duration = $duration;
        $this->recurrence = $recurrence;
    }

    /**
     * Get recurrence
     *
     * @return RecurrenceInfoInterface
     */
    public function getRecurrence(): ?RecurrenceInfoInterface
    {
        return $this->recurrence;
    }

    /**
     * Set recurrence
     *
     * @param  RecurrenceInfoInterface $recurrence
     * @return self
     */
    public function setRecurrence(RecurrenceInfoInterface $recurrence): self
    {
        $this->recurrence = $recurrence;
        return $this;
    }

    /**
     * Get exceptionId
     *
     * @return ExceptionRecurIdInfoInterface
     */
    public function getExceptionId(): ?ExceptionRecurIdInfoInterface
    {
        return $this->exceptionId;
    }

    /**
     * Set exceptionId
     *
     * @param  ExceptionRecurIdInfoInterface $exceptionId
     * @return self
     */
    public function setExceptionId(ExceptionRecurIdInfoInterface $exceptionId): self
    {
        $this->exceptionId = $exceptionId;
        return $this;
    }

    /**
     * Get dtStart
     *
     * @return DtTimeInfoInterface
     */
    public function getDtStart(): ?DtTimeInfoInterface
    {
        return $this->dtStart;
    }

    /**
     * Set dtStart
     *
     * @param  DtTimeInfoInterface $dtStart
     * @return self
     */
    public function setDtStart(DtTimeInfoInterface $dtStart): self
    {
        $this->dtStart = $dtStart;
        return $this;
    }

    /**
     * Get dtEnd
     *
     * @return DtTimeInfoInterface
     */
    public function getDtEnd(): ?DtTimeInfoInterface
    {
        return $this->dtEnd;
    }

    /**
     * Set dtEnd
     *
     * @param  DtTimeInfoInterface $dtEnd
     * @return self
     */
    public function setDtEnd(DtTimeInfoInterface $dtEnd): self
    {
        $this->dtEnd = $dtEnd;
        return $this;
    }

    /**
     * Get duration
     *
     * @return DurationInfoInterface
     */
    public function getDuration(): ?DurationInfoInterface
    {
        return $this->duration;
    }

    /**
     * Set duration
     *
     * @param  DurationInfoInterface $duration
     * @return self
     */
    public function setDuration(DurationInfoInterface $duration): self
    {
        $this->duration = $duration;
        return $this;
    }
}
