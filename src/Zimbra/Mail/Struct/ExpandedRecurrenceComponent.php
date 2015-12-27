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
 * ExpandedRecurrenceComponent struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ExpandedRecurrenceComponent extends Base
{
    /**
     * Constructor method for GeoInfo
     * @param  InstanceRecurIdInfo $exceptId RECURRENCE ID
     * @param  DurationInfo $dur DURATION
     * @param  RecurrenceInfo $recur RRULE/RDATE/EXDATE information
     * @param  int $start DTSTART time in milliseconds since the Epoch
     * @param  int $end DTEND time in milliseconds since the Epoch
     * @return self
     */
    public function __construct(
        InstanceRecurIdInfo $exceptId = null,
        DurationInfo $dur = null,
        RecurrenceInfo $recur = null,
        $start = null,
        $end = null
    )
    {
        parent::__construct();
        if($exceptId instanceof InstanceRecurIdInfo)
        {
            $this->setChild('exceptId', $exceptId);
        }
        if($dur instanceof DurationInfo)
        {
            $this->setChild('dur', $dur);
        }
        if($recur instanceof RecurrenceInfo)
        {
            $this->setChild('recur', $recur);
        }
        if(null !== $start)
        {
            $this->setProperty('s', (int) $start);
        }
        if(null !== $end)
        {
            $this->setProperty('e', (int) $end);
        }
    }

    /**
     * Gets exception id
     *
     * @return InstanceRecurIdInfo
     */
    public function getExceptionId()
    {
        return $this->getChild('exceptId');
    }

    /**
     * Sets exception id
     *
     * @param  InstanceRecurIdInfo $exceptId
     * @return self
     */
    public function setExceptionId(InstanceRecurIdInfo $exceptId)
    {
        return $this->setChild('exceptId', $exceptId);
    }

    /**
     * Gets duration
     *
     * @return DurationInfo
     */
    public function getDuration()
    {
        return $this->getChild('dur');
    }

    /**
     * Sets duration
     *
     * @param  DurationInfo $dur
     * @return self
     */
    public function setDuration(DurationInfo $dur)
    {
        return $this->setChild('dur', $dur);
    }

    /**
     * Gets recurrence
     *
     * @return RecurrenceInfo
     */
    public function getRecurrence()
    {
        return $this->getChild('recur');
    }

    /**
     * Sets recurrence
     *
     * @param  RecurrenceInfo $recur
     * @return self
     */
    public function setRecurrence(RecurrenceInfo $recur)
    {
        return $this->setChild('recur', $recur);
    }

    /**
     * Gets start time
     *
     * @return int
     */
    public function getStartTime()
    {
        return $this->getProperty('s');
    }

    /**
     * Sets start time
     *
     * @param  int $s
     * @return self
     */
    public function setStartTime($s)
    {
        return $this->setProperty('s', (int) $s);
    }

    /**
     * Gets end time
     *
     * @return int
     */
    public function getEndTime()
    {
        return $this->getProperty('e');
    }

    /**
     * Sets end time
     *
     * @param  int $e
     * @return self
     */
    public function setEndTime($e)
    {
        return $this->setProperty('e', (int) $e);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'comp')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'comp')
    {
        return parent::toXml($name);
    }
}
