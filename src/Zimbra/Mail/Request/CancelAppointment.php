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
            $this->child('inst', $inst);
        }
        if($tz instanceof CalTZInfo)
        {
            $this->child('tz', $tz);
        }
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
     * Get or set inst
     * Instance recurrence ID information
     *
     * @param  InstanceRecurIdInfo $inst
     * @return InstanceRecurIdInfo|self
     */
    public function inst(InstanceRecurIdInfo $inst = null)
    {
        if(null === $inst)
        {
            return $this->child('inst');
        }
        return $this->child('inst', $inst);
    }

    /**
     * Get or set tz
     * Definition for TZID referenced by DATETIME in <inst>
     *
     * @param  CalTZInfo $tz
     * @return CalTZInfo|self
     */
    public function tz(CalTZInfo $tz = null)
    {
        if(null === $tz)
        {
            return $this->child('tz');
        }
        return $this->child('tz', $tz);
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
            return $this->child('m');
        }
        return $this->child('m', $m);
    }

    /**
     * Gets or sets id
     * ID of default invite
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
     * Gets or sets comp
     * Component number of default invite
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
     * Gets or sets ms
     * Modified sequence
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
     * Gets or sets rev
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
