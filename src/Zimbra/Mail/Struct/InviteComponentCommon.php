<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyfba and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Common\TypedSequence;
use Zimbra\Enum\FreeBusyStatus;
use Zimbra\Enum\Transparency;
use Zimbra\Enum\InviteStatus;
use Zimbra\Enum\InviteClass;
use Zimbra\Enum\InviteChange;
use Zimbra\Struct\Base;

/**
 * InviteComponentCommon struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyfba © 2013 by Nguyen Van Nguyen.
 */
class InviteComponentCommon extends Base
{
    /**
     * Comma-separated list of changed data in an updated invite.
     * Possible values are "subject", "location", "time" (start time, end time, or duration), and "recurrence".
     * @var TypedSequence
     */
    private $_changes;

    /**
     * Constructor method for InviteComponentCommon
     *
     * @param string $method The method
     * @param int    $compNum Component number of the invite
     * @param bool   $rsvp RSVP flag. Set if response requested, unset if no response requested
     * @param int    $priority Priority (0 - 9; default = 0)
     * @param string $name The name
     * @param string $loc Location
     * @param int    $percentComplete Percent complete for VTODO (0 - 100; default = 0)
     * @param string $completed VTODO COMPLETED DATE-TIME in format yyyyMMddThhmmssZ
     * @param bool   $noBlob Set if invite has no blob data, i.e. all data is in db metadata
     * @param FreeBusyStatus $fba The "actual" free-busy status of this invite (ie what the client should display).
     * @param FreeBusyStatus $fb FreeBusy setting F|B|T|U 
     * @param Transparency $transp Transparency - O|T. i.e. Opaque or Transparent
     * @param bool   $isOrg Am I the organizer? [default 0 (false)]
     * @param string $x_uid The x_uid
     * @param string $uid UID to use when creating appointment. Optional: client can request the UID to use
     * @param int    $seq Sequence number (default = 0)
     * @param int    $date Date - used for zdsync
     * @param string $calItemId Mail item ID of appointment
     * @param string $apptId Appointment ID (deprecated)
     * @param string $ciFolder Folder of appointment
     * @param InviteStatus $status Status - TENT|CONF|CANC|NEED|COMP|INPR|WAITING|DEFERRED
     * @param InviteClass $class Class = PUB|PRI|CON. i.e. PUBlic (default), PRIvate, CONfidential
     * @param string $url The url
     * @param bool   $ex Set if this is invite is an exception
     * @param string $ridZ Recurrence-id string in UTC timezone
     * @param bool   $allDay Set if is an all day appointment
     * @param bool   $draft Set if invite has changes that haven't been sent to attendees; for organizer only
     * @param bool   $neverSent Set if attendees were never notified of this invite; for organizer only
     * @param array  $change
     */
    public function __construct(
        $method = null,
        $compNum = null,
        $rsvp = null,
        $priority = null,
        $name = null,
        $loc = null,
        $percentComplete = null,
        $completed = null,
        $noBlob = null,
        FreeBusyStatus $fba = null,
        FreeBusyStatus $fb = null,
        Transparency $transp = null,
        $isOrg = null,
        $x_uid = null,
        $uid = null,
        $seq = null,
        $date = null,
        $calItemId = null,
        $apptId = null,
        $ciFolder = null,
        InviteStatus $status = null,
        InviteClass $class = null,
        $url = null,
        $ex = null,
        $ridZ = null,
        $allDay = null,
        $draft = null,
        $neverSent = null,
        array $changes = []
    )
    {
        parent::__construct();
        if(null !== $method)
        {
            $this->setProperty('method', trim($method));
        }
        if(null !== $compNum)
        {
            $this->setProperty('compNum', (int) $compNum);
        }
        if(null !== $rsvp)
        {
            $this->setProperty('rsvp', (bool) $rsvp);
        }
        if(null !== $priority)
        {
            $this->setProperty('priority', ((int) $priority > 0 or (int) $priority < 10) ? (int) $priority : 0);
        }
        if(null !== $name)
        {
            $this->setProperty('name', trim($name));
        }
        if(null !== $loc)
        {
            $this->setProperty('loc', trim($loc));
        }
        if(null !== $percentComplete)
        {
            $this->setProperty('percentComplete', ((int) $percentComplete > 0 or (int) $percentComplete <= 100) ? (int) $percentComplete : 0);
        }
        if(null !== $completed)
        {
            $this->setProperty('completed', trim($completed));
        }
        if(null !== $noBlob)
        {
            $this->setProperty('noBlob', (bool) $noBlob);
        }
        if($fba instanceof FreeBusyStatus)
        {
            $this->setProperty('fba', $fba);
        }
        if($fb instanceof FreeBusyStatus)
        {
            $this->setProperty('fb', $fb);
        }
        if($transp instanceof Transparency)
        {
            $this->setProperty('transp', $transp);
        }
        if(null !== $isOrg)
        {
            $this->setProperty('isOrg', (bool) $isOrg);
        }
        if(null !== $x_uid)
        {
            $this->setProperty('x_uid', trim($x_uid));
        }
        if(null !== $uid)
        {
            $this->setProperty('uid', trim($uid));
        }
        if(null !== $seq)
        {
            $this->setProperty('seq', (int) $seq);
        }
        if(null !== $date)
        {
            $this->setProperty('d', (int) $date);
        }
        if(null !== $calItemId)
        {
            $this->setProperty('calItemId', trim($calItemId));
        }
        if(null !== $apptId)
        {
            $this->setProperty('apptId', trim($apptId));
        }
        if(null !== $ciFolder)
        {
            $this->setProperty('ciFolder', trim($ciFolder));
        }
        if($status instanceof InviteStatus)
        {
            $this->setProperty('status', $status);
        }
        if($class instanceof InviteClass)
        {
            $this->setProperty('class', $class);
        }
        if(null !== $url)
        {
            $this->setProperty('url', trim($url));
        }
        if(null !== $ex)
        {
            $this->setProperty('ex', (bool) $ex);
        }
        if(null !== $ridZ)
        {
            $this->setProperty('ridZ', trim($ridZ));
        }
        if(null !== $allDay)
        {
            $this->setProperty('allDay', (bool) $allDay);
        }
        if(null !== $draft)
        {
            $this->setProperty('draft', (bool) $draft);
        }
        if(null !== $neverSent)
        {
            $this->setProperty('neverSent', (bool) $neverSent);
        }

        $this->setChanges($changes);
        $this->on('before', function(Base $sender)
        {
            $changes = $sender->getChanges();
            if(!empty($changes))
            {
                $sender->setProperty('changes', $sender->getChanges());
            }
        });
    }

    /**
     * Gets method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->getProperty('method');
    }

    /**
     * Sets method
     *
     * @param  string $method
     * @return self
     */
    public function setMethod($method)
    {
        return $this->setProperty('method', trim($method));
    }

    /**
     * Gets component number
     *
     * @return int
     */
    public function getComponentNum()
    {
        return $this->getProperty('compNum');
    }

    /**
     * Sets component number
     *
     * @param  int $compNum
     * @return self
     */
    public function setComponentNum($compNum)
    {
        return $this->setProperty('compNum', (int) $compNum);
    }

    /**
     * Gets rsvp
     *
     * @return bool
     */
    public function getRsvp()
    {
        return $this->getProperty('rsvp');
    }

    /**
     * Sets rsvp
     *
     * @param  bool $rsvp
     * @return self
     */
    public function setRsvp($rsvp)
    {
        return $this->setProperty('rsvp', (bool) $rsvp);
    }

    /**
     * Gets priority
     *
     * @return int
     */
    public function getPriority()
    {
        return $this->getProperty('priority');
    }

    /**
     * Sets priority
     *
     * @param  int $priority
     * @return self
     */
    public function setPriority($priority)
    {
        return $this->setProperty('priority', (int) $priority);
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->getProperty('loc');
    }

    /**
     * Sets location
     *
     * @param  string $loc
     * @return self
     */
    public function setLocation($loc)
    {
        return $this->setProperty('loc', trim($loc));
    }

    /**
     * Gets percent complete
     *
     * @return int
     */
    public function getPercentComplete()
    {
        return $this->getProperty('percentComplete');
    }

    /**
     * Sets percent complete
     *
     * @param  int $percentComplete
     * @return self
     */
    public function setPercentComplete($percentComplete)
    {
        return $this->setProperty('percentComplete', ((int) $percentComplete > 0 or (int) $percentComplete <= 100) ? (int) $percentComplete : 0);
    }

    /**
     * Gets completed
     *
     * @return string
     */
    public function getCompleted()
    {
        return $this->getProperty('completed');
    }

    /**
     * Sets completed
     *
     * @param  string $completed
     * @return self
     */
    public function setCompleted($completed)
    {
        return $this->setProperty('completed', trim($completed));
    }

    /**
     * Gets no blob
     *
     * @return bool
     */
    public function getNoBlob()
    {
        return $this->getProperty('noBlob');
    }

    /**
     * Sets no blob
     *
     * @param  bool $noBlob
     * @return self
     */
    public function setNoBlob($noBlob)
    {
        return $this->setProperty('noBlob', (bool) $noBlob);
    }

    /**
     * Gets free busy actual
     *
     * @return FreeBusyStatus
     */
    public function getFreeBusyActual()
    {
        return $this->getProperty('fba');
    }

    /**
     * Sets free busy actual
     *
     * @param  FreeBusyStatus $fba
     * @return self
     */
    public function setFreeBusyActual(FreeBusyStatus $fba)
    {
        return $this->setProperty('fba', $fba);
    }

    /**
     * Gets free busy
     *
     * @return FreeBusyStatus
     */
    public function getFreeBusy()
    {
        return $this->getProperty('fb');
    }

    /**
     * Sets free busy
     *
     * @param  FreeBusyStatus $fb
     * @return self
     */
    public function setFreeBusy(FreeBusyStatus $fb)
    {
        return $this->setProperty('fb', $fb);
    }

    /**
     * Gets transparency
     *
     * @return Transparency
     */
    public function getTransparency()
    {
        return $this->getProperty('transp');
    }

    /**
     * Sets transparency
     *
     * @param  Transparency $transp
     * @return self
     */
    public function setTransparency(Transparency $transp)
    {
        return $this->setProperty('transp', $transp);
    }

    /**
     * Gets is organizer
     *
     * @return bool
     */
    public function getIsOrganizer()
    {
        return $this->getProperty('isOrg');
    }

    /**
     * Sets is organizer
     *
     * @param  bool $isOrg
     * @return self
     */
    public function setIsOrganizer($isOrg)
    {
        return $this->setProperty('isOrg', (bool) $isOrg);
    }

    /**
     * Gets x uid
     *
     * @return string
     */
    public function getXUid()
    {
        return $this->getProperty('x_uid');
    }

    /**
     * Sets x uid
     *
     * @param  string $xUid
     * @return self
     */
    public function setXUid($xUid)
    {
        return $this->setProperty('x_uid', trim($xUid));
    }

    /**
     * Gets uid
     *
     * @return string
     */
    public function getUid()
    {
        return $this->getProperty('uid');
    }

    /**
     * Sets uid
     *
     * @param  string $uid
     * @return self
     */
    public function setUid($uid)
    {
        return $this->setProperty('uid', trim($uid));
    }

    /**
     * Gets sequence
     *
     * @return int
     */
    public function getSequence()
    {
        return $this->getProperty('seq');
    }

    /**
     * Sets sequence
     *
     * @param  int $seq
     * @return self
     */
    public function setSequence($seq)
    {
        return $this->setProperty('seq', (int) $seq);
    }

    /**
     * Gets date time
     *
     * @return int
     */
    public function getDateTime()
    {
        return $this->getProperty('d');
    }

    /**
     * Sets date time
     *
     * @param  int $d
     * @return self
     */
    public function setDateTime($d)
    {
        return $this->setProperty('d', (int) $d);
    }

    /**
     * Gets mail item ID
     *
     * @return string
     */
    public function getCalItemId()
    {
        return $this->getProperty('calItemId');
    }

    /**
     * Sets mail item ID
     *
     * @param  string $calItemId
     * @return self
     */
    public function setCalItemId($calItemId)
    {
        return $this->setProperty('calItemId', trim($calItemId));
    }

    /**
     * Gets appointment ID
     *
     * @return string
     */
    public function getApptId()
    {
        return $this->getProperty('apptId');
    }

    /**
     * Sets appointment ID
     *
     * @param  string $apptId
     * @return self
     */
    public function setApptId($apptId)
    {
        return $this->setProperty('apptId', trim($apptId));
    }

    /**
     * Gets folder of appointment
     *
     * @return string
     */
    public function getCalItemFolder()
    {
        return $this->getProperty('ciFolder');
    }

    /**
     * Sets folder of appointment
     *
     * @param  string $ciFolder
     * @return self
     */
    public function setCalItemFolder($ciFolder)
    {
        return $this->setProperty('ciFolder', trim($ciFolder));
    }

    /**
     * Gets status
     *
     * @return InviteStatus
     */
    public function getStatus()
    {
        return $this->getProperty('status');
    }

    /**
     * Sets status
     *
     * @param  InviteStatus $status
     * @return self
     */
    public function setStatus(InviteStatus $status)
    {
        return $this->setProperty('status', $status);
    }

    /**
     * Gets class
     *
     * @return InviteClass
     */
    public function getCalClass()
    {
        return $this->getProperty('class');
    }

    /**
     * Sets class
     *
     * @param  InviteClass $class
     * @return self
     */
    public function setCalClass(InviteClass $class)
    {
        return $this->setProperty('class', $class);
    }

    /**
     * Gets url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->getProperty('url');
    }

    /**
     * Sets url
     *
     * @param  string $url
     * @return self
     */
    public function setUrl($url)
    {
        return $this->setProperty('url', trim($url));
    }

    /**
     * Gets is an exception
     *
     * @return bool
     */
    public function getIsException()
    {
        return $this->getProperty('ex');
    }

    /**
     * Sets is an exception
     *
     * @param  bool $ex
     * @return self
     */
    public function setIsException($ex)
    {
        return $this->setProperty('ex', (bool) $ex);
    }

    /**
     * Gets recurrence id
     *
     * @return string
     */
    public function getRecurIdZ()
    {
        return $this->getProperty('ridZ');
    }

    /**
     * Sets recurrence id
     *
     * @param  string $ridZ
     * @return self
     */
    public function setRecurIdZ($ridZ)
    {
        return $this->setProperty('ridZ', trim($ridZ));
    }

    /**
     * Gets is an all day appointment
     *
     * @return bool
     */
    public function getIsAllDay()
    {
        return $this->getProperty('allDay');
    }

    /**
     * Sets is an all day appointment
     *
     * @param  bool $allDay
     * @return self
     */
    public function setIsAllDay($allDay)
    {
        return $this->setProperty('allDay', (bool) $allDay);
    }

    /**
     * Gets is draft appointment
     *
     * @return bool
     */
    public function getIsDraft()
    {
        return $this->getProperty('draft');
    }

    /**
     * Sets is draft appointment
     *
     * @param  bool $draft
     * @return self
     */
    public function setIsDraft($draft)
    {
        return $this->setProperty('draft', (bool) $draft);
    }

    /**
     * Gets is never sent
     *
     * @return bool
     */
    public function getNeverSent()
    {
        return $this->getProperty('neverSent');
    }

    /**
     * Sets is never sent
     *
     * @param  bool $neverSent
     * @return self
     */
    public function setNeverSent($neverSent)
    {
        return $this->setProperty('neverSent', (bool) $neverSent);
    }

    /**
     * Add in invite change
     * Valid values: subject|location|time|recurrence
     *
     * @param  InviteChange $change
     * @return self
     */
    public function addChange(InviteChange $change)
    {
        $this->_changes->add($change);
        return $this;
    }

    /**
     * Set sequence of change
     *
     * @param  array $changes
     * @return self
     */
    public function setChanges(array $changes)
    {
        $this->_changes = new TypedSequence('Zimbra\Enum\InviteChange', $changes);
        return $this;
    }

    /**
     * Get string of change
     *
     * @return string
     */
    public function getChanges()
    {
        return count($this->_changes) ? implode(',', $this->_changes->all()) : NULL;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'comp')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'comp')
    {
        return parent::toXml($name);
    }
}
