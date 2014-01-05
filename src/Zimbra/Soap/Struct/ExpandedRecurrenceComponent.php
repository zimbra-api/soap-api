<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * ExpandedRecurrenceComponent struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ExpandedRecurrenceComponent
{
    /**
     * RECURRENCE ID
     * @var InstanceRecurIdInfo
     */
    private $_exceptId;

    /**
     * DURATION
     * @var DurationInfo
     */
    private $_dur;

    /**
     * RRULE/RDATE/EXDATE information
     * @var RecurrenceInfo
     */
    private $_recur;

    /**
     * DTSTART time in milliseconds since the Epoch
     * @var int
     */
    private $_s;

    /**
     * DTEND time in milliseconds since the Epoch
     * @var int
     */
    private $_e;

    /**
     * Constructor method for GeoInfo
     * @param  float $lat
     * @param  float $lon
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
        if($exceptId instanceof InstanceRecurIdInfo)
        {
            $this->_exceptId = $exceptId;
        }
        if($dur instanceof DurationInfo)
        {
            $this->_dur = $dur;
        }
        if($recur instanceof RecurrenceInfo)
        {
            $this->_recur = $recur;
        }
        if(null !== $s)
        {
            $this->_s = (int) $s;
        }
        if(null !== $e)
        {
            $this->_e = (int) $e;
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
            return $this->_exceptId;
        }
        $this->_exceptId = $exceptId;
        return $this;
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
            return $this->_dur;
        }
        $this->_dur = $dur;
        return $this;
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
            return $this->_recur;
        }
        $this->_recur = $recur;
        return $this;
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
            return $this->_s;
        }
        $this->_s = (int) $s;
        return $this;
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
            return $this->_e;
        }
        $this->_e = (int) $e;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'comp')
    {
        $name = !empty($name) ? $name : 'comp';
        $arr = array();
        if(is_int($this->_s))
        {
            $arr['s'] = $this->_s;
        }
        if(is_int($this->_e))
        {
            $arr['e'] = $this->_e;
        }

        if($this->_exceptId instanceof InstanceRecurIdInfo)
        {
            $arr += $this->_exceptId->toArray('exceptId');
        }
        if($this->_dur instanceof DurationInfo)
        {
            $arr += $this->_dur->toArray('dur');
        }
        if($this->_recur instanceof RecurrenceInfo)
        {
            $arr += $this->_recur->toArray('recur');
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'comp')
    {
        $name = !empty($name) ? $name : 'comp';
        $xml = new SimpleXML('<'.$name.' />');
        if(is_int($this->_s))
        {
            $xml->addAttribute('s', $this->_s);
        }
        if(is_int($this->_e))
        {
            $xml->addAttribute('e', $this->_e);
        }

        if($this->_exceptId instanceof InstanceRecurIdInfo)
        {
            $xml->append($this->_exceptId->toXml('exceptId'));
        }
        if($this->_dur instanceof DurationInfo)
        {
            $xml->append($this->_dur->toXml('dur'));
        }
        if($this->_recur instanceof RecurrenceInfo)
        {
            $xml->append($this->_recur->toXml('recur'));
        }
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
