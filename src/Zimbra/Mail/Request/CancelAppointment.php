<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\InstanceRecurIdInfo;
use Zimbra\Mail\Struct\Msg;

/**
 * CancelAppointment request class
 * Cancel appointment
 * NOTE: If canceling an exception, the original instance (ie the one the exception was "excepting") WILL NOT be restored when you cancel this exception. 
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CancelAppointment extends Base
{
    /**
     * Constructor method for CancelAppointment
     * @param  InstanceRecurIdInfo $inst
     * @param  CalTZInfo $tz
     * @param  Msg $m
     * @param  string $id
     * @param  int $comp
     * @param  int $ms
     * @param  int $rev
     * @return self
     */
    public function __construct(
        InstanceRecurIdInfo $inst = null,
        CalTZInfo $tz = null,
        Msg $m = null,
        $id = null,
        $comp = null,
        $ms = null,
        $rev = null
    )
    {
        parent::__construct();
        if($inst instanceof InstanceRecurIdInfo)
        {
            $this->setChild('inst', $inst);
        }
        if($tz instanceof CalTZInfo)
        {
            $this->setChild('tz', $tz);
        }
        if($m instanceof Msg)
        {
            $this->setChild('m', $m);
        }
        if(null !== $id)
        {
            $this->setProperty('id', trim($id));
        }
        if(null !== $comp)
        {
            $this->setProperty('comp', (int) $comp);
        }
        if(null !== $ms)
        {
            $this->setProperty('ms', (int) $ms);
        }
        if(null !== $rev)
        {
            $this->setProperty('rev', (int) $rev);
        }
    }

    /**
     * Gets instance recurrence ID information
     *
     * @return InstanceRecurIdInfo
     */
    public function getInstance()
    {
        return $this->getChild('inst');
    }

    /**
     * Sets instance recurrence ID information
     *
     * @param  InstanceRecurIdInfo $inst
     * @return self
     */
    public function setInstance(InstanceRecurIdInfo $inst)
    {
        return $this->setChild('inst', $inst);
    }

    /**
     * Gets timezone
     *
     * @return CalTZInfo
     */
    public function getTimezone()
    {
        return $this->getChild('tz');
    }

    /**
     * Sets timezone
     *
     * @param  CalTZInfo $tz
     * @return self
     */
    public function setTimezone(CalTZInfo $tz)
    {
        return $this->setChild('tz', $tz);
    }

    /**
     * Gets message
     *
     * @return Msg
     */
    public function getMsg()
    {
        return $this->getChild('m');
    }

    /**
     * Sets message
     *
     * @param  Msg $m
     * @return self
     */
    public function setMsg(Msg $m)
    {
        return $this->setChild('m', $m);
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets component number of default invite
     *
     * @return int
     */
    public function getComponentNum()
    {
        return $this->getProperty('comp');
    }

    /**
     * Sets component number of default invite
     *
     * @param  int $comp
     * @return self
     */
    public function setComponentNum($comp)
    {
        return $this->setProperty('comp', (int) $comp);
    }

    /**
     * Gets modified sequence
     *
     * @return int
     */
    public function getModifiedSequence()
    {
        return $this->getProperty('ms');
    }

    /**
     * Sets modified sequence
     *
     * @param  int $ms
     * @return self
     */
    public function setModifiedSequence($ms)
    {
        return $this->setProperty('ms', (int) $ms);
    }

    /**
     * Gets revision
     *
     * @return int
     */
    public function getRevision()
    {
        return $this->getProperty('rev');
    }

    /**
     * Sets revision
     *
     * @param  int $rev
     * @return self
     */
    public function setRevision($rev)
    {
        return $this->setProperty('rev', (int) $rev);
    }
}
