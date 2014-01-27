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
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class ExpandedRecurrenceComponent extends Base
{
    /**
     * Constructor method for GeoInfo
     * @param  InstanceRecurIdInfo $exceptId RECURRENCE ID
     * @param  DurationInfo $dur DURATION
     * @param  RecurrenceInfo $recur RRULE/RDATE/EXDATE information
     * @param  int $s DTSTART time in milliseconds since the Epoch
     * @param  int $e DTEND time in milliseconds since the Epoch
     * @return self
     */
    public function __construct(
        InstanceRecurIdInfo $exceptId = null,
        DurationInfo $dur = null,
        RecurrenceInfo $recur = null,
        $s = null,
        $e = null
    )
    {
        parent::__construct();
        if($exceptId instanceof InstanceRecurIdInfo)
        {
            $this->child('exceptId', $exceptId);
        }
        if($dur instanceof DurationInfo)
        {
            $this->child('dur', $dur);
        }
        if($recur instanceof RecurrenceInfo)
        {
            $this->child('recur', $recur);
        }
        if(null !== $s)
        {
            $this->property('s', (int) $s);
        }
        if(null !== $e)
        {
            $this->property('e', (int) $e);
        }
    }

    /**
     * Gets or sets exceptId
     *
     * @param  InstanceRecurIdInfo $exceptId
     * @return InstanceRecurIdInfo|self
     */
    public function exceptId(InstanceRecurIdInfo $exceptId = null)
    {
        if(null === $exceptId)
        {
            return $this->child('exceptId');
        }
        return $this->child('exceptId', $exceptId);
    }

    /**
     * Gets or sets dur
     *
     * @param  DurationInfo $dur
     * @return DurationInfo|self
     */
    public function dur(DurationInfo $dur = null)
    {
        if(null === $dur)
        {
            return $this->child('dur');
        }
        return $this->child('dur', $dur);
    }

    /**
     * Gets or sets recur
     *
     * @param  RecurrenceInfo $recur
     * @return RecurrenceInfo|self
     */
    public function recur(RecurrenceInfo $recur = null)
    {
        if(null === $recur)
        {
            return $this->child('recur');
        }
        return $this->child('recur', $recur);
    }

    /**
     * Gets or sets s
     *
     * @param  int $s
     * @return int|self
     */
    public function s($s = null)
    {
        if(null === $s)
        {
            return $this->property('s');
        }
        return $this->property('s', (int) $s);
    }

    /**
     * Gets or sets e
     *
     * @param  int $e
     * @return int|self
     */
    public function e($e = null)
    {
        if(null === $e)
        {
            return $this->property('e');
        }
        return $this->property('e', (int) $e);
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
