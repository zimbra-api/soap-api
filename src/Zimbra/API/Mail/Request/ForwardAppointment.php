<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\CalTZInfo;
use Zimbra\Soap\Struct\DtTimeInfo;
use Zimbra\Soap\Struct\Msg;

/**
 * ForwardAppointment request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ForwardAppointment extends Request
{
    /**
     * RECURRENCE-ID information if forwarding a single instance of a recurring appointment
     * @var DtTimeInfo
     */
    private $_exceptId;

    /**
     * Definition for TZID referenced by DATETIME in <exceptId>
     * @var CalTZInfo
     */
    private $_tz;

    /**
     * Details of the appointment.
     * @var Msg
     */
    private $_m;

    /**
     * Appointment item ID
     * @var string
     */
    private $_id;

    /**
     * Constructor method for ForwardAppointment
     * @param  DtTimeInfo $exceptId
     * @param  CalTZInfo $tz
     * @param  Msg $m
     * @param  string $id
     * @return self
     */
    public function __construct(
        DtTimeInfo $exceptId = null,
        CalTZInfo $tz = null,
        Msg $m = null,
        $id = null
    )
    {
        parent::__construct();
        if($exceptId instanceof DtTimeInfo)
        {
            $this->_exceptId = $exceptId;
        }
        if($tz instanceof CalTZInfo)
        {
            $this->_tz = $tz;
        }
        if($m instanceof Msg)
        {
            $this->_m = $m;
        }
        $this->_id = trim($id);
    }

    /**
     * Get or set exceptId
     *
     * @param  DtTimeInfo $exceptId
     * @return DtTimeInfo|self
     */
    public function exceptId(DtTimeInfo $exceptId = null)
    {
        if(null === $exceptId)
        {
            return $this->_exceptId;
        }
        $this->_exceptId = $exceptId;
        return $this;
    }

    /**
     * Get or set tz
     *
     * @param  CalTZInfo $tz
     * @return CalTZInfo|self
     */
    public function tz(CalTZInfo $tz = null)
    {
        if(null === $tz)
        {
            return $this->_tz;
        }
        $this->_tz = $tz;
        return $this;
    }

    /**
     * Get or set m
     *
     * @param  Msg $m
     * @return Msg|self
     */
    public function m(Msg $m = null)
    {
        if(null === $m)
        {
            return $this->_m;
        }
        $this->_m = $m;
        return $this;
    }

    /**
     * Get or set id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->_id;
        }
        $this->_id = trim($id);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(!empty($this->_id))
        {
            $this->array['id'] = $this->_id;
        }
        if($this->_exceptId instanceof DtTimeInfo)
        {
            $this->array += $this->_exceptId->toArray('exceptId');
        }
        if($this->_tz instanceof CalTZInfo)
        {
            $this->array += $this->_tz->toArray('tz');
        }
        if($this->_m instanceof Msg)
        {
            $this->array += $this->_m->toArray('m');
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
        if(!empty($this->_id))
        {
            $this->xml->addAttribute('id', $this->_id);
        }
        if($this->_exceptId instanceof DtTimeInfo)
        {
            $this->xml->append($this->_exceptId->toXml('exceptId'));
        }
        if($this->_tz instanceof CalTZInfo)
        {
            $this->xml->append($this->_tz->toXml('tz'));
        }
        if($this->_m instanceof Msg)
        {
            $this->xml->append($this->_m->toXml('m'));
        }
        return parent::toXml();
    }
}
