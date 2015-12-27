<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Struct\Base;

/**
 * DurationInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DurationInfo extends Base
{
    /**
     * Constructor method for DurationInfo
     * @param  bool   $neg Set if the duration is negative.
     * @param  int    $weeks Weeks component of the duration
     * @param  int    $days Days component of the duration.
     * @param  int    $hours Hours component of the duration.
     * @param  int    $minutes Minutes component of the duration.
     * @param  int    $seconds Seconds component of the duration.
     * @param  string $related Specifies whether the alarm is related to the start of end. Valid values are : START|END
     * @param  int    $count Alarm repeat count
     * @return self
     */
    public function __construct(
        $negative = null,
        $weeks = null,
        $days = null,
        $hours = null,
        $minutes = null,
        $seconds = null,
        $related = null,
        $count = null
    )
    {
        parent::__construct();
        if(null !== $negative)
        {
            $this->setProperty('neg', (bool) $negative);
        }
        if(null !== $weeks)
        {
            $this->setProperty('w', (int) $weeks);
        }
        if(null !== $days)
        {
            $this->setProperty('d', (int) $days);
        }
        if(null !== $hours)
        {
            $this->setProperty('h', (int) $hours);
        }
        if(null !== $minutes)
        {
            $this->setProperty('m', (int) $minutes);
        }
        if(null !== $seconds)
        {
            $this->setProperty('s', (int) $seconds);
        }
        if(null !== $related)
        {
            $this->setRelated($related);
        }
        if(null !== $count)
        {
            $this->setProperty('count', (int) $count);
        }
    }

    /**
     * Gets duration is negative
     *
     * @return bool
     */
    public function getDurationNegative()
    {
        return $this->getProperty('neg');
    }

    /**
     * Sets duration is negative
     *
     * @param  bool $negative
     * @return self
     */
    public function setDurationNegative($negative)
    {
        return $this->setProperty('neg', (bool) $negative);
    }

    /**
     * Gets weeks component
     *
     * @return int
     */
    public function getWeeks()
    {
        return $this->getProperty('w');
    }

    /**
     * Sets weeks component
     *
     * @param  int $weeks
     * @return self
     */
    public function setWeeks($weeks)
    {
        return $this->setProperty('w', (int) $weeks);
    }

    /**
     * Gets days component
     *
     * @return int
     */
    public function getDays()
    {
        return $this->getProperty('d');
    }

    /**
     * Sets days component
     *
     * @param  int $days
     * @return self
     */
    public function setDays($days)
    {
        return $this->setProperty('d', (int) $days);
    }

    /**
     * Gets hours component
     *
     * @return int
     */
    public function getHours()
    {
        return $this->getProperty('h');
    }

    /**
     * Sets hours component
     *
     * @param  int $hours
     * @return self
     */
    public function setHours($hours)
    {
        return $this->setProperty('h', (int) $hours);
    }

    /**
     * Gets minutes component
     *
     * @return int
     */
    public function getMinutes()
    {
        return $this->getProperty('m');
    }

    /**
     * Sets minutes component
     *
     * @param  int $minutes
     * @return self
     */
    public function setMinutes($minutes)
    {
        return $this->setProperty('m', (int) $minutes);
    }

    /**
     * Gets seconds component
     *
     * @return int
     */
    public function getSeconds()
    {
        return $this->getProperty('s');
    }

    /**
     * Sets seconds component
     *
     * @param  int $s
     * @return self
     */
    public function setSeconds($seconds)
    {
        return $this->setProperty('s', (int) $seconds);
    }

    /**
     * Gets related
     *
     * @return string
     */
    public function getRelated()
    {
        return $this->getProperty('related');
    }

    /**
     * Sets related
     *
     * @param  string $related
     * @return self
     */
    public function setRelated($related)
    {
        if (in_array(trim($related), ['START', 'END']))
        {
            $this->setProperty('related', trim($related));
        }
        return $this;
    }

    /**
     * Gets repeat count
     *
     * @return int
     */
    public function getRepeatCount()
    {
        return $this->getProperty('count');
    }

    /**
     * Sets repeat count
     *
     * @param  int $count
     * @return self
     */
    public function setRepeatCount($count)
    {
        return $this->setProperty('count', (int) $count);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'rel')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $uid
     * @return SimpleXML
     */
    public function toXml($name = 'rel')
    {
        return parent::toXml($name);
    }
}
