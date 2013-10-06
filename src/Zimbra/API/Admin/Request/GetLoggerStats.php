<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\HostName;
use Zimbra\Soap\Struct\StatsSpec;
use Zimbra\Soap\Struct\TimeAttr;

/**
 * GetLoggerStats class
 * Query to retrieve Logger statistics in ZCS.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetLoggerStats extends Request
{
    /**
     * Hostname
     * @var HostName
     */
    private $_hostname;

    /**
     * Stats
     * @var StatsSpec
     */
    private $_stats;

    /**
     * Start time
     * @var TimeAttr
     */
    private $_startTime;

    /**
     * End time 
     * @var TimeAttr
     */
    private $_endTime;

    /**
     * Constructor method for GetLoggerStats
     * @param  Hostname $hostname
     * @param  StatsSpec $stats
     * @param  TimeAttr $startTime
     * @param  TimeAttr $endTime
     * @return self
     */
    public function __construct(
        Hostname $hostname = null,
        StatsSpec $stats = null,
        TimeAttr $startTime = null,
        TimeAttr $endTime = null)
    {
        parent::__construct();
        if($hostname instanceof Hostname)
        {
            $this->_hostname = $hostname;
        }
        if($stats instanceof StatsSpec)
        {
            $this->_stats = $stats;
        }
        if($startTime instanceof TimeAttr)
        {
            $this->_startTime = $startTime;
        }
        if($endTime instanceof TimeAttr)
        {
            $this->_endTime = $endTime;
        }
    }

    /**
     * Gets or sets hostname
     *
     * @param  Hostname $hostname
     * @return Hostname|self
     */
    public function hostname(Hostname $hostname = null)
    {
        if(null === $hostname)
        {
            return $this->_hostname;
        }
        $this->_hostname = $hostname;
        return $this;
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
            return $this->_stats;
        }
        $this->_stats = $stats;
        return $this;
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
            return $this->_startTime;
        }
        $this->_startTime = $startTime;
        return $this;
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
            return $this->_endTime;
        }
        $this->_endTime = $endTime;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if($this->_hostname instanceof Hostname)
        {
            $this->array += $this->_hostname->toArray();
        }
        if($this->_stats instanceof StatsSpec)
        {
            $this->array += $this->_stats->toArray();
        }
        if($this->_startTime instanceof TimeAttr)
        {
            $this->array += $this->_startTime->toArray();
        }
        if($this->_endTime instanceof TimeAttr)
        {
            $this->array += $this->_endTime->toArray();
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if($this->_hostname instanceof Hostname)
        {
            $this->xml->append($this->_hostname->toXml());
        }
        if($this->_stats instanceof StatsSpec)
        {
            $this->xml->append($this->_stats->toXml());
        }
        if($this->_startTime instanceof TimeAttr)
        {
            $this->xml->append($this->_startTime->toXml());
        }
        if($this->_endTime instanceof TimeAttr)
        {
            $this->xml->append($this->_endTime->toXml());
        }
        return parent::toXml();
    }
}