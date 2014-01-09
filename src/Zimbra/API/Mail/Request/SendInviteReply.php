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
use Zimbra\Soap\Struct\DtTimeInfo;
use Zimbra\Soap\Struct\CalTZInfo;
use Zimbra\Soap\Struct\Msg;

/**
 * SendInviteReply request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SendInviteReply extends Request
{
    /**
     * Unique ID of the invite (and component therein) you are replying to
     * @var string
     */
    private $_id;

    /**
     * Component number of the invite
     * @var int
     */
    private $_compNum;

    /**
     * Verb - ACCEPT, DECLINE, TENTATIVE, COMPLETED, DELEGATED (Completed/Delegated are NOT supported as of 9/12/2005)
     * @var string
     */
    private $_verb;

    /**
     * If supplied then reply to just one instance of the specified Invite (default is all instances)
     * @var DtTimeInfo
     */
    private $_exceptId;

    /**
     * Definition for TZID referenced by DATETIME in <exceptId>
     * @var CalTZInfo
     */
    private $_tz;

    /**
     * Embedded message, if the user wants to send a custom update message.
     * The client is responsible for setting the message recipient list in this case
     * (which should include Organizer, if the client wants to tell the organizer about this response)
     * @var Msg
     */
    private $_m;

    /**
     * Update organizer. Set by default.
     * If unset then only make the update locally.
     * This parameter has no effect if an <m> element is present.
     * @var bool
     */
    private $_updateOrganizer;

    /**
     * Identity ID to use to send reply
     * @var string
     */
    private $_idnt;

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
        $this->_id = trim($id);
        $this->_compNum = (int) $compNum;
        $this->_verb = trim($verb);
        if($exceptId instanceof DtTimeInfo)
        {
            $this->_exceptId = $exceptId;
        }
        if($tz instanceof CalTZInfo)
        {
            $this->_tz = $tz;
        }
        if($m instanceof Msg)
        {
            $this->_m = $m;
        }
        if(null !== $updateOrganizer)
        {
            $this->_updateOrganizer = (bool) $updateOrganizer;
        }
        $this->_idnt = trim($idnt);
    }

    /**
     * Get or set id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->_id;
        }
        $this->_id = trim($id);
        return $this;
    }

    /**
     * Gets or sets compNum
     *
     * @param  int $compNum
     * @return int|self
     */
    public function compNum($compNum = null)
    {
        if(null === $compNum)
        {
            return $this->_compNum;
        }
        $this->_compNum = (int) $compNum;
        return $this;
    }

    /**
     * Get or set verb
     *
     * @param  string $verb
     * @return string|self
     */
    public function verb($verb = null)
    {
        if(null === $verb)
        {
            return $this->_verb;
        }
        $this->_verb = trim($verb);
        return $this;
    }

    /**
     * Get or set exceptId
     *
     * @param  DtTimeInfo $exceptId
     * @return DtTimeInfo|self
     */
    public function exceptId(DtTimeInfo $exceptId = null)
    {
        if(null === $exceptId)
        {
            return $this->_exceptId;
        }
        $this->_exceptId = $exceptId;
        return $this;
    }

    /**
     * Get or set tz
     *
     * @param  CalTZInfo $tz
     * @return CalTZInfo|self
     */
    public function tz(CalTZInfo $tz = null)
    {
        if(null === $tz)
        {
            return $this->_tz;
        }
        $this->_tz = $tz;
        return $this;
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
            return $this->_m;
        }
        $this->_m = $m;
        return $this;
    }

    /**
     * Get or set updateOrganizer
     *
     * @param  bool $updateOrganizer
     * @return bool|self
     */
    public function updateOrganizer($updateOrganizer = null)
    {
        if(null === $updateOrganizer)
        {
            return $this->_updateOrganizer;
        }
        $this->_updateOrganizer = (bool) $updateOrganizer;
        return $this;
    }

    /**
     * Get or set idnt
     *
     * @param  string $idnt
     * @return string|self
     */
    public function idnt($idnt = null)
    {
        if(null === $idnt)
        {
            return $this->_idnt;
        }
        $this->_idnt = trim($idnt);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'id' => $this->_id,
            'compNum' => $this->_compNum,
            'verb' => $this->_verb,
        );
        if($this->_exceptId instanceof DtTimeInfo)
        {
            $this->array += $this->_exceptId->toArray('exceptId');
        }
        if($this->_tz instanceof CalTZInfo)
        {
            $this->array += $this->_tz->toArray('tz');
        }
        if($this->_m instanceof Msg)
        {
            $this->array += $this->_m->toArray('m');
        }
        if(is_bool($this->_updateOrganizer))
        {
            $this->array['updateOrganizer'] = $this->_updateOrganizer ? 1 : 0;
        }
        if(!empty($this->_idnt))
        {
            $this->array['idnt'] = $this->_idnt;
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
        $this->xml->addAttribute('id', $this->_id)
                  ->addAttribute('compNum', $this->_compNum)
                  ->addAttribute('verb', $this->_verb);
        if($this->_exceptId instanceof DtTimeInfo)
        {
            $this->xml->append($this->_exceptId->toXml('exceptId'));
        }
        if($this->_tz instanceof CalTZInfo)
        {
            $this->xml->append($this->_tz->toXml('tz'));
        }
        if($this->_m instanceof Msg)
        {
            $this->xml->append($this->_m->toXml('m'));
        }
        if(is_bool($this->_updateOrganizer))
        {
            $this->xml->addAttribute('updateOrganizer', $this->_updateOrganizer ? 1 : 0);
        }
        if(!empty($this->_idnt))
        {
            $this->xml->addAttribute('idnt', $this->_idnt);
        }
        return parent::toXml();
    }
}
