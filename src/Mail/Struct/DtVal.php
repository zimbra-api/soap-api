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
use Zimbra\Common\Struct\{DtTimeInfoInterface, DtValInterface, DurationInfoInterface};

/**
 * DtVal struct class
 * Date/time value
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DtVal implements DtValInterface
{
    /**
     * Start DATE-TIME
     * @Accessor(getter="getStartTime", setter="setStartTime")
     * @SerializedName("s")
     * @Type("Zimbra\Mail\Struct\DtTimeInfo")
     * @XmlElement
     */
    private ?DtTimeInfoInterface $startTime = NULL;

    /**
     * Start DATE-TIME
     * @Accessor(getter="getEndTime", setter="setEndTime")
     * @SerializedName("e")
     * @Type("Zimbra\Mail\Struct\DtTimeInfo")
     * @XmlElement
     */
    private ?DtTimeInfoInterface $endTime = NULL;

    /**
     * Duration information
     * @Accessor(getter="getDuration", setter="setDuration")
     * @SerializedName("dur")
     * @Type("Zimbra\Mail\Struct\DurationInfo")
     * @XmlElement
     */
    private ?DurationInfoInterface $duration = NULL;

    /**
     * Constructor method
     *
     * @param DtTimeInfo $startTime
     * @param DtTimeInfo $endTime
     * @param DurationInfo $duration
     * @return self
     */
    public function __construct(
        ?DtTimeInfo $startTime = NULL,
        ?DtTimeInfo $endTime = NULL,
        ?DurationInfo $duration = NULL
    )
    {
        if ($startTime instanceof DtTimeInfo) {
            $this->setStartTime($startTime);
        }
        if ($endTime instanceof DtTimeInfo) {
            $this->setEndTime($endTime);
        }
        if ($duration instanceof DurationInfo) {
            $this->setDuration($duration);
        }
    }

    /**
     * Gets the startTime
     *
     * @return DtTimeInfoInterface
     */
    public function getStartTime(): ?DtTimeInfoInterface
    {
        return $this->startTime;
    }

    /**
     * Sets the startTime
     *
     * @param  DtTimeInfoInterface $startTime
     * @return self
     */
    public function setStartTime(DtTimeInfoInterface $startTime): self
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * Gets the endTime
     *
     * @return DtTimeInfoInterface
     */
    public function getEndTime(): ?DtTimeInfoInterface
    {
        return $this->endTime;
    }

    /**
     * Sets the endTime
     *
     * @param  DtTimeInfoInterface $endTime
     * @return self
     */
    public function setEndTime(DtTimeInfoInterface $endTime): self
    {
        $this->endTime = $endTime;
        return $this;
    }

    /**
     * Gets the duration
     *
     * @return DurationInfoInterface
     */
    public function getDuration(): ?DurationInfoInterface
    {
        return $this->duration;
    }

    /**
     * Sets the duration
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
