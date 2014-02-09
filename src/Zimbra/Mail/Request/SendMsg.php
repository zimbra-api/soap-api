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

use Zimbra\Mail\Struct\MsgToSend;

/**
 * SendMsg request class
 * Send message
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SendMsg extends Base
{
    /**
     * Constructor method for SendMsg
     * @param  MsgToSend $m
     * @param  bool $needCalendarSentByFixup
     * @param  bool $isCalendarForward
     * @param  bool $noSave
     * @param  string $suid
     * @return self
     */
    public function __construct(
        MsgToSend $m = null,
        $needCalendarSentByFixup = null,
        $isCalendarForward = null,
        $noSave = null,
        $suid = null
    )
    {
        parent::__construct();
        if($m instanceof MsgToSend)
        {
            $this->child('m', $m);
        }
        if(null !== $needCalendarSentByFixup)
        {
            $this->property('needCalendarSentByFixup', (bool) $needCalendarSentByFixup);
        }
        if(null !== $isCalendarForward)
        {
            $this->property('isCalendarForward', (bool) $isCalendarForward);
        }
        if(null !== $noSave)
        {
            $this->property('noSave', (bool) $noSave);
        }
        if(null !== $suid)
        {
            $this->property('suid', trim($suid));
        }
    }

    /**
     * Get or set m
     *
     * @param  MsgToSend $m
     * @return MsgToSend|self
     */
    public function m(MsgToSend $m = null)
    {
        if(null === $m)
        {
            return $this->child('m');
        }
        return $this->child('m', $m);
    }

    /**
     * Get or set needCalendarSentByFixup
     *
     * @param  bool $needCalendarSentByFixup
     * @return bool|self
     */
    public function needCalendarSentByFixup($needCalendarSentByFixup = null)
    {
        if(null === $needCalendarSentByFixup)
        {
            return $this->property('needCalendarSentByFixup');
        }
        return $this->property('needCalendarSentByFixup', (bool) $needCalendarSentByFixup);
    }

    /**
     * Get or set isCalendarForward
     *
     * @param  bool $isCalendarForward
     * @return bool|self
     */
    public function isCalendarForward($isCalendarForward = null)
    {
        if(null === $isCalendarForward)
        {
            return $this->property('isCalendarForward');
        }
        return $this->property('isCalendarForward', (bool) $isCalendarForward);
    }

    /**
     * Get or set noSave
     *
     * @param  bool $noSave
     * @return bool|self
     */
    public function noSave($noSave = null)
    {
        if(null === $noSave)
        {
            return $this->property('noSave');
        }
        return $this->property('noSave', (bool) $noSave);
    }

    /**
     * Get or set suid
     *
     * @param  string $suid
     * @return string|self
     */
    public function suid($suid = null)
    {
        if(null === $suid)
        {
            return $this->property('suid');
        }
        return $this->property('suid', trim($suid));
    }
}
