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

use Zimbra\Enum\VerbType;
use Zimbra\Mail\Struct\DtTimeInfo;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\Msg;

/**
 * SendInviteReply request class
 * Send a reply to an invite
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SendInviteReply extends Base
{
    /**
     * Constructor method for MailSearchParams
     * @param  string $id
     * @param  int $compNum
     * @param  VerbType $verb
     * @param  bool $updateOrganizer
     * @param  string $identityId
     * @param  DtTimeInfo $exceptionId
     * @param  CalTZInfo $timezone
     * @param  Msg $msg
     * @return self
     */
    public function __construct(
        $id,
        $compNum,
        VerbType $verb,
        $updateOrganizer = null,
        $identityId = null,
        DtTimeInfo $exceptionId = null,
        CalTZInfo $timezone = null,
        Msg $msg = null
    )
    {
        parent::__construct();
        $this->setProperty('id', trim($id));
        $this->setProperty('compNum', (int) $compNum);
        $this->setProperty('verb', $verb);
        if(null !== $updateOrganizer)
        {
            $this->setProperty('updateOrganizer', (bool) $updateOrganizer);
        }
        if(null !== $identityId)
        {
            $this->setProperty('idnt', trim($identityId));
        }
        if($exceptionId instanceof DtTimeInfo)
        {
            $this->setChild('exceptId', $exceptionId);
        }
        if($timezone instanceof CalTZInfo)
        {
            $this->setChild('tz', $timezone);
        }
        if($msg instanceof Msg)
        {
            $this->setChild('m', $msg);
        }
    }

    /**
     * Gets Id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets Id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets component number of the invite
     *
     * @return int
     */
    public function getComponentNum()
    {
        return $this->getProperty('compNum');
    }

    /**
     * Sets component number of the invite
     *
     * @param  int $componentNum
     * @return self
     */
    public function setComponentNum($componentNum)
    {
        return $this->setProperty('compNum', (int) $componentNum);
    }

    /**
     * Gets verb
     * Verb - ACCEPT, DECLINE, TENTATIVE, COMPLETED, DELEGATED (Completed/Delegated are NOT supported as of 9/12/2005)
     *
     * @return VerbType
     */
    public function getVerb()
    {
        return $this->getProperty('verb');
    }

    /**
     * Sets verb
     * Verb - ACCEPT, DECLINE, TENTATIVE, COMPLETED, DELEGATED (Completed/Delegated are NOT supported as of 9/12/2005)
     *
     * @param  VerbType $verb
     * @return self
     */
    public function setVerb(VerbType $verb)
    {
        return $this->setProperty('verb', $verb);
    }

    /**
     * Gets update organizer
     *
     * @return bool
     */
    public function getUpdateOrganizer()
    {
        return $this->getProperty('updateOrganizer');
    }

    /**
     * Sets update organizer
     *
     * @param  bool $updateOrganizer
     * @return self
     */
    public function setUpdateOrganizer($updateOrganizer)
    {
        return $this->setProperty('updateOrganizer', (bool) $updateOrganizer);
    }

    /**
     * Gets identity Id
     *
     * @return string
     */
    public function getIdentityId()
    {
        return $this->getProperty('idnt');
    }

    /**
     * Sets identity Id
     *
     * @param  string $identityId
     * @return self
     */
    public function setIdentityId($identityId)
    {
        return $this->setProperty('idnt', trim($identityId));
    }

    /**
     * Gets exception id
     *
     * @return DtTimeInfo
     */
    public function getExceptionId()
    {
        return $this->getChild('exceptId');
    }

    /**
     * Sets exception id
     *
     * @param  DtTimeInfo $exceptionId
     * @return self
     */
    public function setExceptionId(DtTimeInfo $exceptionId)
    {
        return $this->setChild('exceptId', $exceptionId);
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
     * @param  CalTZInfo $timezone
     * @return self
     */
    public function setTimezone(CalTZInfo $timezone)
    {
        return $this->setChild('tz', $timezone);
    }

    /**
     * Gets embedded message
     *
     * @return Msg
     */
    public function getMsg()
    {
        return $this->getChild('m');
    }

    /**
     * Sets embedded message
     *
     * @param  Msg $msg
     * @return self
     */
    public function setMsg(Msg $msg)
    {
        return $this->setChild('m', $msg);
    }
}
