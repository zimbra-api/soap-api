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

use Zimbra\Common\TypedSequence;
use Zimbra\Mail\Struct\SetCalendarItemInfo;
use Zimbra\Mail\Struct\Replies;
use Zimbra\Soap\Request;

/**
 * SetAppointment request class
 * Directly set status of an entire appointment.
 * This API is intended for mailbox Migration (ie migrating a mailbox onto this server) and is not used by normal mail clients.
 * Need to specify folder for appointment 
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SetAppointment extends Request
{
    /**
     * Constructor method for SetAppointment
     * @param  SetCalendarItemInfo $m
     * @param  array $except
     * @param  array $cancel
     * @param  Replies $replies
     * @param  string $f
     * @param  string $t
     * @param  string $tn
     * @param  string $l
     * @param  bool $noNextAlarm
     * @param  int $nextAlarm
     * @return self
     */
    public function __construct(
        SetCalendarItemInfo $default = null,
        array $except = array(),
        array $cancel = array(),
        Replies $replies = null,
        $f = null,
        $t = null,
        $tn = null,
        $l = null,
        $noNextAlarm = null,
        $nextAlarm = null
    )
    {
        parent::__construct();
        if($default instanceof SetCalendarItemInfo)
        {
            $this->child('default', $default);
        }
        $this->_except = new TypedSequence('Zimbra\Mail\Struct\SetCalendarItemInfo', $except);
        $this->_cancel = new TypedSequence('Zimbra\Mail\Struct\SetCalendarItemInfo', $cancel);
        if($replies instanceof Replies)
        {
            $this->child('replies', $replies);
        }
        if(null !== $f)
        {
            $this->property('f', trim($f));
        }
        if(null !== $t)
        {
            $this->property('t', trim($t));
        }
        if(null !== $tn)
        {
            $this->property('tn', trim($tn));
        }
        if(null !== $l)
        {
            $this->property('l', trim($l));
        }
        if(null !== $noNextAlarm)
        {
            $this->property('noNextAlarm', (bool) $noNextAlarm);
        }
        if(null !== $nextAlarm)
        {
            $this->property('nextAlarm', (int) $nextAlarm);
        }

        $this->addHook(function($sender)
        {
            if(count($sender->except()))
            {
                $sender->child('except', $sender->except()->all());
            }
            if(count($sender->cancel()))
            {
                $sender->child('cancel', $sender->cancel()->all());
            }
        });
    }

    /**
     * Get or set default
     *
     * @param  SetCalendarItemInfo $default
     * @return SetCalendarItemInfo|self
     */
    public function default_(SetCalendarItemInfo $default = null)
    {
        if(null === $default)
        {
            return $this->child('default');
        }
        return $this->child('default', $default);
    }

    /**
     * Add a except
     *
     * @param  SetCalendarItemInfo $except
     * @return self
     */
    public function addExcept(SetCalendarItemInfo $except)
    {
        $this->_except->add($except);
        return $this;
    }

    /**
     * Gets except nextAlarmuence
     *
     * @return Sequence
     */
    public function except()
    {
        return $this->_except;
    }

    /**
     * Add a cancel
     *
     * @param  SetCalendarItemInfo $cancel
     * @return self
     */
    public function addCancel(SetCalendarItemInfo $cancel)
    {
        $this->_cancel->add($cancel);
        return $this;
    }

    /**
     * Gets cancel nextAlarmuence
     *
     * @return Sequence
     */
    public function cancel()
    {
        return $this->_cancel;
    }

    /**
     * Get or set replies
     *
     * @param  Replies $replies
     * @return Replies|self
     */
    public function replies(Replies $replies = null)
    {
        if(null === $replies)
        {
            return $this->child('replies');
        }
        return $this->child('replies', $replies);
    }

    /**
     * Gets or sets f
     *
     * @param  string $f
     * @return string|self
     */
    public function f($f = null)
    {
        if(null === $f)
        {
            return $this->property('f');
        }
        return $this->property('f', trim($f));
    }

    /**
     * Gets or sets t
     *
     * @param  string $t
     * @return string|self
     */
    public function t($t = null)
    {
        if(null === $t)
        {
            return $this->property('t');
        }
        return $this->property('t', trim($t));
    }

    /**
     * Gets or sets tn
     *
     * @param  string $tn
     * @return string|self
     */
    public function tn($tn = null)
    {
        if(null === $tn)
        {
            return $this->property('tn');
        }
        return $this->property('tn', trim($tn));
    }

    /**
     * Gets or sets l
     *
     * @param  string $l
     * @return string|self
     */
    public function l($l = null)
    {
        if(null === $l)
        {
            return $this->property('l');
        }
        return $this->property('l', trim($l));
    }

    /**
     * Gets or sets noNextAlarm
     *
     * @param  bool $noNextAlarm
     * @return bool|self
     */
    public function noNextAlarm($noNextAlarm = null)
    {
        if(null === $noNextAlarm)
        {
            return $this->property('noNextAlarm');
        }
        return $this->property('noNextAlarm', (bool) $noNextAlarm);
    }

    /**
     * Gets or sets nextAlarm
     *
     * @param  int $nextAlarm
     * @return int|self
     */
    public function nextAlarm($nextAlarm = null)
    {
        if(null === $nextAlarm)
        {
            return $this->property('nextAlarm');
        }
        return $this->property('nextAlarm', (int) $nextAlarm);
    }
}
