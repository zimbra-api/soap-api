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
use Zimbra\Common\Enum\AlarmRelated;
use Zimbra\Common\Struct\DurationInfoInterface;

/**
 * DurationInfo class
 * Duration information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DurationInfo implements DurationInfoInterface
{
    /**
     * Set if the duration is negative.
     *
     * @Accessor(getter="getDurationNegative", setter="setDurationNegative")
     * @SerializedName("neg")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getDurationNegative", setter: "setDurationNegative")]
    #[SerializedName("neg")]
    #[Type("bool")]
    #[XmlAttribute]
    private $durationNegative;

    /**
     * Weeks component of the duration
     * Special note: if WEEKS are specified, NO OTHER OFFSET MAY BE SPECIFIED (weeks must be alone, per RFC2445)
     *
     * @Accessor(getter="getWeeks", setter="setWeeks")
     * @SerializedName("w")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getWeeks", setter: "setWeeks")]
    #[SerializedName("w")]
    #[Type("int")]
    #[XmlAttribute]
    private $weeks;

    /**
     * Days component of the duration
     *
     * @Accessor(getter="getDays", setter="setDays")
     * @SerializedName("d")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getDays", setter: "setDays")]
    #[SerializedName("d")]
    #[Type("int")]
    #[XmlAttribute]
    private $days;

    /**
     * Hours component of the duration
     *
     * @Accessor(getter="getHours", setter="setHours")
     * @SerializedName("h")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getHours", setter: "setHours")]
    #[SerializedName("h")]
    #[Type("int")]
    #[XmlAttribute]
    private $hours;

    /**
     * Minutes component of the duration
     *
     * @Accessor(getter="getMinutes", setter="setMinutes")
     * @SerializedName("m")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getMinutes", setter: "setMinutes")]
    #[SerializedName("m")]
    #[Type("int")]
    #[XmlAttribute]
    private $minutes;

    /**
     * Seconds component of the duration
     *
     * @Accessor(getter="getSeconds", setter="setSeconds")
     * @SerializedName("s")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getSeconds", setter: "setSeconds")]
    #[SerializedName("s")]
    #[Type("int")]
    #[XmlAttribute]
    private $seconds;

    /**
     * Specifies whether the alarm is related to the start of end.
     * Valid values are : START|END
     *
     * @Accessor(getter="getRelated", setter="setRelated")
     * @SerializedName("related")
     * @Type("Enum<Zimbra\Common\Enum\AlarmRelated>")
     * @XmlAttribute
     *
     * @var AlarmRelated
     */
    #[Accessor(getter: "getRelated", setter: "setRelated")]
    #[SerializedName("related")]
    #[Type("Enum<Zimbra\Common\Enum\AlarmRelated>")]
    #[XmlAttribute]
    private ?AlarmRelated $related;

    /**
     * Alarm repeat count
     *
     * @Accessor(getter="getRepeatCount", setter="setRepeatCount")
     * @SerializedName("count")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getRepeatCount", setter: "setRepeatCount")]
    #[SerializedName("count")]
    #[Type("int")]
    #[XmlAttribute]
    private $repeatCount;

    /**
     * Constructor
     *
     * @param  int $weeks
     * @param  int $days
     * @param  int $hours
     * @param  int $minutes
     * @param  int $seconds
     * @param  AlarmRelated $related
     * @return self
     */
    public function __construct(
        ?int $weeks = null,
        ?int $days = null,
        ?int $hours = null,
        ?int $minutes = null,
        ?int $seconds = null,
        ?AlarmRelated $related = null
    ) {
        $this->related = $related;
        if (null !== $weeks) {
            $this->setWeeks($weeks);
        }
        if (null !== $days) {
            $this->setDays($days);
        }
        if (null !== $hours) {
            $this->setHours($hours);
        }
        if (null !== $minutes) {
            $this->setMinutes($minutes);
        }
        if (null !== $seconds) {
            $this->setSeconds($seconds);
        }
    }

    /**
     * Get durationNegative
     *
     * @return bool
     */
    public function getDurationNegative(): ?bool
    {
        return $this->durationNegative;
    }

    /**
     * Set durationNegative
     *
     * @param  bool $durationNegative
     * @return self
     */
    public function setDurationNegative(bool $durationNegative): self
    {
        $this->durationNegative = $durationNegative;
        return $this;
    }

    /**
     * Get weeks
     *
     * @return int
     */
    public function getWeeks(): ?int
    {
        return $this->weeks;
    }

    /**
     * Set weeks
     *
     * @param  int $weeks
     * @return self
     */
    public function setWeeks(int $weeks): self
    {
        $this->weeks = $weeks;
        return $this;
    }

    /**
     * Get days
     *
     * @return int
     */
    public function getDays(): ?int
    {
        return $this->days;
    }

    /**
     * Set days
     *
     * @param  int $days
     * @return self
     */
    public function setDays(int $days): self
    {
        $this->days = $days;
        return $this;
    }

    /**
     * Get hours
     *
     * @return int
     */
    public function getHours(): ?int
    {
        return $this->hours;
    }

    /**
     * Set hours
     *
     * @param  int $hours
     * @return self
     */
    public function setHours(int $hours): self
    {
        $this->hours = $hours;
        return $this;
    }

    /**
     * Get minutes
     *
     * @return int
     */
    public function getMinutes(): ?int
    {
        return $this->minutes;
    }

    /**
     * Set minutes
     *
     * @param  int $minutes
     * @return self
     */
    public function setMinutes(int $minutes): self
    {
        $this->minutes = $minutes;
        return $this;
    }

    /**
     * Get seconds
     *
     * @return int
     */
    public function getSeconds(): ?int
    {
        return $this->seconds;
    }

    /**
     * Set seconds
     *
     * @param  int $seconds
     * @return self
     */
    public function setSeconds(int $seconds): self
    {
        $this->seconds = $seconds;
        return $this;
    }

    /**
     * Get related
     *
     * @return AlarmRelated
     */
    public function getRelated(): ?AlarmRelated
    {
        return $this->related;
    }

    /**
     * Set related
     *
     * @param  AlarmRelated $related
     * @return self
     */
    public function setRelated(AlarmRelated $related): self
    {
        $this->related = $related;
        return $this;
    }

    /**
     * Get repeatCount
     *
     * @return int
     */
    public function getRepeatCount(): ?int
    {
        return $this->repeatCount;
    }

    /**
     * Set repeatCount
     *
     * @param  int $repeatCount
     * @return self
     */
    public function setRepeatCount(int $repeatCount): self
    {
        $this->repeatCount = $repeatCount;
        return $this;
    }
}
