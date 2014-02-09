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
            $this->child('hostname', $hostname);
        }
        if($stats instanceof StatsSpec)
        {
            $this->child('stats', $stats);
        }
        if($startTime instanceof TimeAttr)
        {
            $this->child('startTime', $startTime);
        }
        if($endTime instanceof TimeAttr)
        {
            $this->child('endTime', $endTime);
        }
    }

    /**
     * Gets or sets hostname
     *
     * @param  HostName $hostname
     * @return HostName|self
     */
    public function hostname(HostName $hostname = null)
    {
        if(null === $hostname)
        {
            return $this->child('hostname');
        }
        return $this->child('hostname', $hostname);
    }

    /**
     * Gets or sets stats
     *
     * @param  StatsSpec $stats
     * @return StatsSpec|self
     */
    public function stats(StatsSpec $stats = null)
    {
        if(null === $stats)
        {
            return $this->child('stats');
        }
        return $this->child('stats', $stats);
    }

    /**
     * Gets or sets hostname
     *
     * @param  TimeAttr $hostname
     * @return TimeAttr|self
     */
    public function startTime(TimeAttr $startTime = null)
    {
        if(null === $startTime)
        {
            return $this->child('startTime');
        }
        return $this->child('startTime', $startTime);
    }

    /**
     * Gets or sets endTime
     *
     * @param  TimeAttr $endTime
     * @return TimeAttr|self
     */
    public function endTime(TimeAttr $endTime = null)
    {
        if(null === $endTime)
        {
            return $this->child('endTime');
        }
        return $this->child('endTime', $endTime);
    }
}