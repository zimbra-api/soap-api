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
     * @param  int    $w Weeks component of the duration
     * @param  int    $d Days component of the duration.
     * @param  int    $h Hours component of the duration.
     * @param  int    $m Minutes component of the duration.
     * @param  int    $s Seconds component of the duration.
     * @param  string $related Specifies whether the alarm is related to the start of end. Valid values are : START|END
     * @param  int    $count Alarm repeat count
     * @return self
     */
    public function __construct(
        $neg = null,
        $w = null,
        $d = null,
        $h = null,
        $m = null,
        $s = null,
        $related = null,
        $count = null
    )
    {
        parent::__construct();
        if(null !== $neg)
        {
            $this->setProperty('neg', (bool) $neg);
        }
        if(null !== $w)
        {
            $this->setProperty('w', (int) $w);
        }
        if(null !== $d)
        {
            $this->setProperty('d', (int) $d);
        }
        if(null !== $h)
        {
            $this->setProperty('h', (int) $h);
        }
        if(null !== $m)
        {
            $this->setProperty('m', (int) $m);
        }
        if(null !== $s)
        {
            $this->setProperty('s', (int) $s);
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
     * @param  bool $neg
     * @return self
     */
    public function setDurationNegative($neg)
    {
        return $this->setProperty('neg', (bool) $neg);
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
     * @param  int $w
     * @return self
     */
    public function setWeeks($w)
    {
        return $this->setProperty('w', (int) $w);
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
     * @param  int $d
     * @return self
     */
    public function setDays($d)
    {
        return $this->setProperty('d', (int) $d);
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
     * @param  int $h
     * @return self
     */
    public function setHours($h)
    {
        return $this->setProperty('h', (int) $h);
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
     * @param  int $m
     * @return self
     */
    public function setMinutes($m)
    {
        return $this->setProperty('m', (int) $m);
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
    public function setSeconds($s)
    {
        return $this->setProperty('s', (int) $s);
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
        if (in_array(trim($related), array('START', 'END')))
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
