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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Admin\Struct\{HostName, StatsSpec, TimeAttr};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetLoggerStatsRequest request class
 * Query to retrieve Logger statistics in ZCS
 * Use cases:
 * - No elements specified. result: a listing of reporting host names
 * - hostname specified. result: a listing of stat groups for the specified host
 * - hostname and stats specified, text content of stats non-empty. result: a listing of columns for the given host and group
 * - hostname and stats specified, text content empty, startTime/endTime optional. result: all of the statistics for the given host/group are returned, if start and end are specified, limit/expand the timerange to the given setting. if limit=true is specified, attempt to reduce result set to under 500 records
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetLoggerStatsRequest extends SoapRequest
{
    /**
     * Hostname
     * 
     * @var HostName
     */
    #[Accessor(getter: 'getHostName', setter: 'setHostName')]
    #[SerializedName('hostname')]
    #[Type(HostName::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $hostName;

    /**
     * Stats
     * 
     * @var StatsSpec
     */
    #[Accessor(getter: 'getStats', setter: 'setStats')]
    #[SerializedName('stats')]
    #[Type(StatsSpec::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $stats;

    /**
     * Start time
     * 
     * @var TimeAttr
     */
    #[Accessor(getter: 'getStartTime', setter: 'setStartTime')]
    #[SerializedName('startTime')]
    #[Type(TimeAttr::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $startTime;

    /**
     * End time
     * 
     * @var TimeAttr
     */
    #[Accessor(getter: 'getEndTime', setter: 'setEndTime')]
    #[SerializedName('endTime')]
    #[Type(TimeAttr::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $endTime;

    /**
     * Constructor
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
     * Get the hostName.
     *
     * @return HostName
     */
    public function getHostName(): ?HostName
    {
        return $this->hostName;
    }

    /**
     * Set the hostName.
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
     * Set the stats.
     *
     * @return StatsSpec
     */
    public function getStats(): ?StatsSpec
    {
        return $this->stats;
    }

    /**
     * Set the stats.
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
     * Get startTime
     *
     * @return TimeAttr
     */
    public function getStartTime(): ?TimeAttr
    {
        return $this->startTime;
    }

    /**
     * Set startTime
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
     * Get endTime
     *
     * @return TimeAttr
     */
    public function getEndTime(): ?TimeAttr
    {
        return $this->endTime;
    }

    /**
     * Set endTime
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetLoggerStatsEnvelope(
            new GetLoggerStatsBody($this)
        );
    }
}
