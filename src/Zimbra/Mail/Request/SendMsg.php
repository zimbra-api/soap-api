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
     * @param  MsgToSend $msg
     * @param  bool $needCalendarSentByFixup
     * @param  bool $isCalendarForward
     * @param  bool $noSave
     * @param  string $suid
     * @return self
     */
    public function __construct(
        MsgToSend $msg = null,
        $needCalendarSentByFixup = null,
        $isCalendarForward = null,
        $noSave = null,
        $suid = null
    )
    {
        parent::__construct();
        if($msg instanceof MsgToSend)
        {
            $this->setChild('m', $msg);
        }
        if(null !== $needCalendarSentByFixup)
        {
            $this->setProperty('needCalendarSentByFixup', (bool) $needCalendarSentByFixup);
        }
        if(null !== $isCalendarForward)
        {
            $this->setProperty('isCalendarForward', (bool) $isCalendarForward);
        }
        if(null !== $noSave)
        {
            $this->setProperty('noSave', (bool) $noSave);
        }
        if(null !== $suid)
        {
            $this->setProperty('suid', trim($suid));
        }
    }

    /**
     * Gets embedded message
     *
     * @return MsgToSend
     */
    public function getMsg()
    {
        return $this->getChild('m');
    }

    /**
     * Sets embedded message
     *
     * @param  MsgToSend $msg
     * @return self
     */
    public function setMsg(MsgToSend $msg)
    {
        return $this->setChild('m', $msg);
    }

    /**
     * Gets need calendar sent by fixup
     *
     * @return bool
     */
    public function getNeedCalendarSentByFixup()
    {
        return $this->getProperty('needCalendarSentByFixup');
    }

    /**
     * Sets need calendar sent by fixup
     *
     * @param  bool $needCalendarSentByFixup
     * @return self
     */
    public function setNeedCalendarSentByFixup($needCalendarSentByFixup)
    {
        return $this->setProperty('needCalendarSentByFixup', (bool) $needCalendarSentByFixup);
    }

    /**
     * Gets is calendar forward
     *
     * @return bool
     */
    public function getIsCalendarForward()
    {
        return $this->getProperty('isCalendarForward');
    }

    /**
     * Sets is calendar forward
     *
     * @param  bool $isCalendarForward
     * @return self
     */
    public function setIsCalendarForward($isCalendarForward)
    {
        return $this->setProperty('isCalendarForward', (bool) $isCalendarForward);
    }

    /**
     * Gets no save to sent
     *
     * @return bool
     */
    public function getNoSaveToSent()
    {
        return $this->getProperty('noSave');
    }

    /**
     * Sets no save to sent
     *
     * @param  bool $noSaveToSent
     * @return self
     */
    public function setNoSaveToSent($noSaveToSent)
    {
        return $this->setProperty('noSave', (bool) $noSaveToSent);
    }

    /**
     * Gets send UID
     *
     * @return string
     */
    public function getSendUid()
    {
        return $this->getProperty('suid');
    }

    /**
     * Sets send UID
     *
     * @param  string $sendUid
     * @return self
     */
    public function setSendUid($sendUid)
    {
        return $this->setProperty('suid', trim($sendUid));
    }
}
