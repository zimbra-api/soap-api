<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\HostName;
use Zimbra\Admin\Struct\StatsSpec;
use Zimbra\Admin\Struct\TimeAttr;
use Zimbra\Soap\Request;

/**
 * GetLoggerStatsRequest request class
 * Query to retrieve Logger statistics in ZCS
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetLoggerStatsRequest")
 */
class GetLoggerStatsRequest extends Request
{
    /**
     * Hostname
     * @Accessor(getter="getHostName", setter="setHostName")
     * @SerializedName("hostName")
     * @Type("Zimbra\Admin\Struct\HostName")
     * @XmlElement
     */
    private $hostName;

    /**
     * Stats
     * @Accessor(getter="getStats", setter="setStats")
     * @SerializedName("stats")
     * @Type("Zimbra\Admin\Struct\StatsSpec")
     * @XmlElement
     */
    private $stats;

    /**
     * Start time
     * @Accessor(getter="getStartTime", setter="setStartTime")
     * @SerializedName("startTime")
     * @Type("Zimbra\Admin\Struct\TimeAttr")
     * @XmlElement
     */
    private $startTime;

    /**
     * End time
     * @Accessor(getter="getEndTime", setter="setEndTime")
     * @SerializedName("endTime")
     * @Type("Zimbra\Admin\Struct\TimeAttr")
     * @XmlElement
     */
    private $endTime;

    /**
     * Constructor method for GetLoggerStatsRequest
     *
     * @param  HostName $hostName
     * @param  StatsSpec $stats
     * @param  TimeAttr $startTime
     * @param  TimeAttr $endTime
     * @return self
     */
    public function __construct(
        ?HostName $hostName = NULL, ?StatsSpec $stats = NULL, ?TimeAttr $startTime = NULL, ?TimeAttr $endTime = NULL
    )
    {
        if ($hostName instanceof HostName) {
            $this->setHostName($hostName);
        }
        if ($stats instanceof StatsSpec) {
            $this->setStats($stats);
        }
        if ($startTime instanceof TimeAttr) {
            $this->setStartTime($startTime);
        }
        if ($endTime instanceof TimeAttr) {
            $this->setEndTime($endTime);
        }
    }

    /**
     * Gets the hostName.
     *
     * @return HostName
     */
    public function getHostName(): ?HostName
    {
        return $this->hostName;
    }

    /**
     * Sets the hostName.
     *
     * @param  HostName $hostName
     * @return self
     */
    public function setHostName(HostName $hostName): self
    {
        $this->hostName = $hostName;
        return $this;
    }

    /**
     * Sets the stats.
     *
     * @return StatsSpec
     */
    public function getStats(): ?StatsSpec
    {
        return $this->stats;
    }

    /**
     * Sets the stats.
     *
     * @param  StatsSpec $stats
     * @return self
     */
    public function setStats(StatsSpec $stats): self
    {
        $this->stats = $stats;
        return $this;
    }

    /**
     * Gets startTime
     *
     * @return TimeAttr
     */
    public function getStartTime(): ?TimeAttr
    {
        return $this->startTime;
    }

    /**
     * Sets startTime
     *
     * @param  TimeAttr $startTime
     * @return self
     */
    public function setStartTime(TimeAttr $startTime): self
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * Gets endTime
     *
     * @return TimeAttr
     */
    public function getEndTime(): ?TimeAttr
    {
        return $this->endTime;
    }

    /**
     * Sets endTime
     *
     * @param  TimeAttr $endTime
     * @return self
     */
    public function setEndTime(TimeAttr $endTime): self
    {
        $this->endTime = $endTime;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetLoggerStatsEnvelope)) {
            $this->envelope = new GetLoggerStatsEnvelope(
                new GetLoggerStatsBody($this)
            );
        }
    }
}
