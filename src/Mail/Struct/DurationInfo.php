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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Enum\AlarmRelated;
use Zimbra\Struct\DurationInfoInterface;

/**
 * DurationInfo class
 * Duration information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="info")
 */
class DurationInfo implements DurationInfoInterface
{
    /**
     * Set if the duration is negative.
     * @Accessor(getter="getDurationNegative", setter="setDurationNegative")
     * @SerializedName("neg")
     * @Type("bool")
     * @XmlAttribute
     */
    private $durationNegative;

    /**
     * Weeks component of the duration
     * Special note: if WEEKS are specified, NO OTHER OFFSET MAY BE SPECIFIED (weeks must be alone, per RFC2445)
     * @Accessor(getter="getWeeks", setter="setWeeks")
     * @SerializedName("w")
     * @Type("integer")
     * @XmlAttribute
     */
    private $weeks;

    /**
     * Days component of the duration
     * @Accessor(getter="getDays", setter="setDays")
     * @SerializedName("d")
     * @Type("integer")
     * @XmlAttribute
     */
    private $days;

    /**
     * Hours component of the duration
     * @Accessor(getter="getHours", setter="setHours")
     * @SerializedName("h")
     * @Type("integer")
     * @XmlAttribute
     */
    private $hours;

    /**
     * Minutes component of the duration
     * @Accessor(getter="getMinutes", setter="setMinutes")
     * @SerializedName("m")
     * @Type("integer")
     * @XmlAttribute
     */
    private $minutes;

    /**
     * Seconds component of the duration
     * @Accessor(getter="getSeconds", setter="setSeconds")
     * @SerializedName("s")
     * @Type("integer")
     * @XmlAttribute
     */
    private $seconds;

    /**
     * Specifies whether the alarm is related to the start of end.
     * Valid values are : START|END
     * @Accessor(getter="getRelated", setter="setRelated")
     * @SerializedName("related")
     * @Type("Zimbra\Enum\AlarmRelated")
     * @XmlAttribute
     */
    private $related;

    /**
     * Alarm repeat count
     * @Accessor(getter="getRepeatCount", setter="setRepeatCount")
     * @SerializedName("count")
     * @Type("integer")
     * @XmlAttribute
     */
    private $repeatCount;

    /**
     * Constructor method for DurationInfo
     *
     * @param  int $weeks
     * @param  int $days
     * @param  int $hours
     * @param  int $minutes
     * @param  int $seconds
     * @return self
     */
    public function __construct(
        ?int $weeks = NULL,
        ?int $days = NULL,
        ?int $hours = NULL,
        ?int $minutes = NULL,
        ?int $seconds = NULL
    )
    {
        if (NULL !== $weeks) {
            $this->setWeeks($weeks);
        }
        if (NULL !== $days) {
            $this->setDays($days);
        }
        if (NULL !== $hours) {
            $this->setHours($hours);
        }
        if (NULL !== $minutes) {
            $this->setMinutes($minutes);
        }
        if (NULL !== $seconds) {
            $this->setSeconds($seconds);
        }
    }

    /**
     * Gets durationNegative
     *
     * @return bool
     */
    public function getDurationNegative(): ?bool
    {
        return $this->durationNegative;
    }

    /**
     * Sets durationNegative
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
     * Gets weeks
     *
     * @return int
     */
    public function getWeeks(): ?int
    {
        return $this->weeks;
    }

    /**
     * Sets weeks
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
     * Gets days
     *
     * @return int
     */
    public function getDays(): ?int
    {
        return $this->days;
    }

    /**
     * Sets days
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
     * Gets hours
     *
     * @return int
     */
    public function getHours(): ?int
    {
        return $this->hours;
    }

    /**
     * Sets hours
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
     * Gets minutes
     *
     * @return int
     */
    public function getMinutes(): ?int
    {
        return $this->minutes;
    }

    /**
     * Sets minutes
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
     * Gets seconds
     *
     * @return int
     */
    public function getSeconds(): ?int
    {
        return $this->seconds;
    }

    /**
     * Sets seconds
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
     * Gets related
     *
     * @return AlarmRelated
     */
    public function getRelated(): ?AlarmRelated
    {
        return $this->related;
    }

    /**
     * Sets related
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
     * Gets repeatCount
     *
     * @return int
     */
    public function getRepeatCount(): ?int
    {
        return $this->repeatCount;
    }

    /**
     * Sets repeatCount
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
