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
     * @param  string $verb
     * @param  DtTimeInfo $exceptId
     * @param  CalTZInfo $tz
     * @param  Msg $m
     * @param  bool $updateOrganizer
     * @param  string $idnt
     * @return self
     */
    public function __construct(
        $id,
        $compNum,
        $verb,
        DtTimeInfo $exceptId = null,
        CalTZInfo $tz = null,
        Msg $m = null,
        $updateOrganizer = null,
        $idnt = null
    )
    {
        parent::__construct();
        $this->property('id', trim($id));
        $this->property('compNum', (int) $compNum);
        $this->property('verb', trim($verb));
        if($exceptId instanceof DtTimeInfo)
        {
            $this->child('exceptId', $exceptId);
        }
        if($tz instanceof CalTZInfo)
        {
            $this->child('tz', $tz);
        }
        if($m instanceof Msg)
        {
            $this->child('m', $m);
        }
        if(null !== $updateOrganizer)
        {
            $this->property('updateOrganizer', (bool) $updateOrganizer);
        }
        if(null !== $idnt)
        {
            $this->property('idnt', trim($idnt));
        }
    }

    /**
     * Get or set id
     * Unique ID of the invite (and component therein) you are replying to
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
     * Gets or sets compNum
     * Component number of the invite
     *
     * @param  int $compNum
     * @return int|self
     */
    public function compNum($compNum = null)
    {
        if(null === $compNum)
        {
            return $this->property('compNum');
        }
        return $this->property('compNum', (int) $compNum);
    }

    /**
     * Get or set verb
     * Verb - ACCEPT, DECLINE, TENTATIVE, COMPLETED, DELEGATED (Completed/Delegated are NOT supported as of 9/12/2005)
     *
     * @param  string $verb
     * @return string|self
     */
    public function verb($verb = null)
    {
        if(null === $verb)
        {
            return $this->property('verb');
        }
        return $this->property('verb', trim($verb));
    }

    /**
     * Get or set exceptId
     * If supplied then reply to just one instance of the specified Invite (default is all instances)
     *
     * @param  DtTimeInfo $exceptId
     * @return DtTimeInfo|self
     */
    public function exceptId(DtTimeInfo $exceptId = null)
    {
        if(null === $exceptId)
        {
            return $this->child('exceptId');
        }
        return $this->child('exceptId', $exceptId);
    }

    /**
     * Get or set tz
     * Definition for TZID referenced by DATETIME in <exceptId>
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
     * Embedded message, if the user wants to send a custom update message.
     * The client is responsible for setting the message recipient list in this case
     * (which should include Organizer, if the client wants to tell the organizer about this response)
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
     * Get or set updateOrganizer
     * Update organizer. Set by default.
     * If unset then only make the update locally.
     * This parameter has no effect if an <m> element is present.
     *
     * @param  bool $updateOrganizer
     * @return bool|self
     */
    public function updateOrganizer($updateOrganizer = null)
    {
        if(null === $updateOrganizer)
        {
            return $this->property('updateOrganizer');
        }
        return $this->property('updateOrganizer', (bool) $updateOrganizer);
    }

    /**
     * Get or set idnt
     * Identity ID to use to send reply
     *
     * @param  string $idnt
     * @return string|self
     */
    public function idnt($idnt = null)
    {
        if(null === $idnt)
        {
            return $this->property('idnt');
        }
        return $this->property('idnt', trim($idnt));
    }
}
