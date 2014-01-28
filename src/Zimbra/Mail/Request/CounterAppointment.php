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
use Zimbra\Soap\Request;

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
class CounterAppointment extends Request
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
            $this->child('m', $m);
        }
        if(null !== $id)
        {
            $this->property('id', trim($id));
        }
        if(null !== $comp)
        {
            $this->property('comp', (int) $comp);
        }
        if(null !== $ms)
        {
            $this->property('ms', (int) $ms);
        }
        if(null !== $rev)
        {
            $this->property('rev', (int) $rev);
        }
    }

    /**
     * Get or set m
     * Details of counter proposal.
     *
     * @param  Msg $m
     * @return Msg|self
     */
    public function m(Msg $m = null)
    {
        if(null === $m)
        {
            return $this->child('m');
        }
        return $this->child('m', $m);
    }

    /**
     * Get or set id
     * Invite ID of default invite
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Get or set comp
     * Component number of default component
     *
     * @param  int $comp
     * @return int|self
     */
    public function comp($comp = null)
    {
        if(null === $comp)
        {
            return $this->property('comp');
        }
        return $this->property('comp', (int) $comp);
    }

    /**
     * Get or set ms
     * Changed sequence of fetched version.
     * Used for conflict detection.
     * By setting this, the request indicates which version of the appointment it is attempting to propose.
     * If the appointment was updated on the server between the fetch and modify, an INVITE_OUT_OF_DATE exception will be thrown.
     *
     * @param  int $ms
     * @return int|self
     */
    public function ms($ms = null)
    {
        if(null === $ms)
        {
            return $this->property('ms');
        }
        return $this->property('ms', (int) $ms);
    }

    /**
     * Get or set rev
     * Revision
     *
     * @param  int $rev
     * @return int|self
     */
    public function rev($rev = null)
    {
        if(null === $rev)
        {
            return $this->property('rev');
        }
        return $this->property('rev', (int) $rev);
    }
}
