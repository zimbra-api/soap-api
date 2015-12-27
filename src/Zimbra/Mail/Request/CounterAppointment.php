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

use Zimbra\Mail\Struct\Msg;

/**
 * CounterAppointment request class
 * Propose a new time/location.
 * Sent by meeting attendee to organizer. 
 * The syntax is very similar to CreateAppointmentRequest. 
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CounterAppointment extends Base
{
    /**
     * Constructor method for CounterAppointment
     * @param  Msg $m
     * @param  string $id
     * @param  int $comp
     * @param  int $ms
     * @param  int $rev
     * @return self
     */
    public function __construct(
        Msg $m = null,
        $id = null,
        $comp = null,
        $ms = null,
        $rev = null
    )
    {
        parent::__construct();
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
     *     Details of counter proposal.
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
     *     Invite ID of default invite
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets component number of default component
     *
     * @return int
     */
    public function getComponentNum()
    {
        return $this->getProperty('comp');
    }

    /**
     * Sets component number of default component
     *
     * @param  int $comp
     * @return self
     */
    public function setComponentNum($comp)
    {
        return $this->setProperty('comp', (int) $comp);
    }

    /**
     * Gets changed sequence of fetched version
     *
     * @return int
     */
    public function getModifiedSequence()
    {
        return $this->getProperty('ms');
    }

    /**
     * Sets changed sequence of fetched version
     *
     * @param  int $ms
     *     Used for conflict detection.
     *     By setting this, the request indicates which version of the appointment it is attempting to propose.
     *     If the appointment was updated on the server between the fetch and modify, an INVITE_OUT_OF_DATE exception will be thrown.
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
