<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Admin\Struct\HostName;
use Zimbra\Admin\Struct\StatsSpec;
use Zimbra\Admin\Struct\TimeAttr;

/**
 * GetLoggerStats request class
 * Query to retrieve Logger statistics in ZCS.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetLoggerStats extends Base
{
    /**
     * Constructor method for GetLoggerStats
     * @param  Hostname $hostname Hostname
     * @param  StatsSpec $stats Stats
     * @param  TimeAttr $startTime Start time
     * @param  TimeAttr $endTime End time 
     * @return self
     */
    public function __construct(
        HostName $hostname = null,
        StatsSpec $stats = null,
        TimeAttr $startTime = null,
        TimeAttr $endTime = null)
    {
        parent::__construct();
        if($hostname instanceof HostName)
        {
            $this->setChild('hostname', $hostname);
        }
        if($stats instanceof StatsSpec)
        {
            $this->setChild('stats', $stats);
        }
        if($startTime instanceof TimeAttr)
        {
            $this->setChild('startTime', $startTime);
        }
        if($endTime instanceof TimeAttr)
        {
            $this->setChild('endTime', $endTime);
        }
    }

    /**
     * Gets the hostname.
     *
     * @return HostName
     */
    public function getHostName()
    {
        return $this->getChild('hostname');
    }

    /**
     * Sets the hostname.
     *
     * @param  HostName $hostname
     * @return self
     */
    public function setHostName(HostName $hostname)
    {
        return $this->setChild('hostname', $hostname);
    }

    /**
     * Gets the stats.
     *
     * @return StatsSpec
     */
    public function getStats()
    {
        return $this->getChild('stats');
    }

    /**
     * Sets the stats.
     *
     * @param  StatsSpec $stats
     * @return self
     */
    public function setStats(StatsSpec $stats)
    {
        return $this->setChild('stats', $stats);
    }

    /**
     * Gets the startTime.
     *
     * @return TimeAttr
     */
    public function getStartTime()
    {
        return $this->getChild('startTime');
    }

    /**
     * Sets the startTime.
     *
     * @param  TimeAttr $startTime
     * @return self
     */
    public function setStartTime(TimeAttr $startTime)
    {
        return $this->setChild('startTime', $startTime);
    }

    /**
     * Gets the endTime.
     *
     * @return TimeAttr
     */
    public function getEndTime()
    {
        return $this->getChild('endTime');
    }

    /**
     * Sets the endTime.
     *
     * @param  TimeAttr $endTime
     * @return self
     */
    public function setEndTime(TimeAttr $endTime)
    {
        return $this->setChild('endTime', $endTime);
    }
}