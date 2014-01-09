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
use Zimbra\Soap\Struct\MsgToSend;

/**
 * SendMsg request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SendMsg extends Request
{
    /**
     * Message
     * @var MsgToSend
     */
    private $_m;

    /**
     * If set then Add SENT-BY parameter to ORGANIZER and/or ATTENDEE properties in iCalendar part when sending message on behalf of another user.
     * Default is unset.
     * @var bool
     */
    private $_needCalendarSentByFixup;

    /**
     * Indicates whether this a forward of calendar invitation in which case the server sends Forward Invitation Notification, default is unset.
     * @var string
     */
    private $_isCalendarForward;

    /**
     * If set, a copy will not be saved to sent regardless of account/identity settings
     * @var string
     */
    private $_noSave;

    /**
     * Send UID
     * @var string
     */
    private $_suid;

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
            $this->_m = $m;
        }
        if(null !== $needCalendarSentByFixup)
        {
            $this->_needCalendarSentByFixup = (bool) $needCalendarSentByFixup;
        }
        if(null !== $isCalendarForward)
        {
            $this->_isCalendarForward = (bool) $isCalendarForward;
        }
        if(null !== $noSave)
        {
            $this->_noSave = (bool) $noSave;
        }
        $this->_suid = trim($suid);
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
            return $this->_m;
        }
        $this->_m = $m;
        return $this;
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
            return $this->_needCalendarSentByFixup;
        }
        $this->_needCalendarSentByFixup = (bool) $needCalendarSentByFixup;
        return $this;
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
            return $this->_isCalendarForward;
        }
        $this->_isCalendarForward = (bool) $isCalendarForward;
        return $this;
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
            return $this->_noSave;
        }
        $this->_noSave = (bool) $noSave;
        return $this;
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
            return $this->_suid;
        }
        $this->_suid = trim($suid);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if($this->_m instanceof MsgToSend)
        {
            $this->array += $this->_m->toArray('m');
        }
        if(is_bool($this->_needCalendarSentByFixup))
        {
            $this->array['needCalendarSentByFixup'] = $this->_needCalendarSentByFixup ? 1 : 0;
        }
        if(is_bool($this->_isCalendarForward))
        {
            $this->array['isCalendarForward'] = $this->_isCalendarForward ? 1 : 0;
        }
        if(is_bool($this->_noSave))
        {
            $this->array['noSave'] = $this->_noSave ? 1 : 0;
        }
        if(!empty($this->_suid))
        {
            $this->array['suid'] = $this->_suid;
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
        if($this->_m instanceof MsgToSend)
        {
            $this->xml->append($this->_m->toXml('m'));
        }
        if(is_bool($this->_needCalendarSentByFixup))
        {
            $this->xml->addAttribute('needCalendarSentByFixup', $this->_needCalendarSentByFixup ? 1 : 0);
        }
        if(is_bool($this->_isCalendarForward))
        {
            $this->xml->addAttribute('isCalendarForward', $this->_isCalendarForward ? 1 : 0);
        }
        if(is_bool($this->_noSave))
        {
            $this->xml->addAttribute('noSave', $this->_noSave ? 1 : 0);
        }
        if(!empty($this->_suid))
        {
            $this->xml->addAttribute('suid', $this->_suid);
        }
        return parent::toXml();
    }
}
