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
     * @param int    $d Date - used for zdsync
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
        $method,
        $compNum,
        $rsvp,
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
        $d = null,
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
        array $changes = array()
    )
    {
        parent::__construct();
        $this->property('method', trim($method));
        $this->property('compNum', (int) $compNum);
        $this->property('rsvp', (bool) $rsvp);
        if(null !== $priority)
        {
            $this->property('priority', ((int) $priority > 0 or (int) $priority < 10) ? (int) $priority : 0);
        }
        if(null !== $name)
        {
            $this->property('name', trim($name));
        }
        if(null !== $loc)
        {
            $this->property('loc', trim($loc));
        }
        if(null !== $percentComplete)
        {
            $this->property('percentComplete', ((int) $percentComplete > 0 or (int) $percentComplete <= 100) ? (int) $percentComplete : 0);
        }
        if(null !== $completed)
        {
            $this->property('completed', trim($completed));
        }
        if(null !== $noBlob)
        {
            $this->property('noBlob', (bool) $noBlob);
        }
        if($fba instanceof FreeBusyStatus)
        {
            $this->property('fba', $fba);
        }
        if($fb instanceof FreeBusyStatus)
        {
            $this->property('fb', $fb);
        }
        if($transp instanceof Transparency)
        {
            $this->property('transp', $transp);
        }
        if(null !== $isOrg)
        {
            $this->property('isOrg', (bool) $isOrg);
        }
        if(null !== $x_uid)
        {
            $this->property('x_uid', trim($x_uid));
        }
        if(null !== $uid)
        {
            $this->property('uid', trim($uid));
        }
        if(null !== $seq)
        {
            $this->property('seq', (int) $seq);
        }
        if(null !== $d)
        {
            $this->property('d', (int) $d);
        }
        if(null !== $calItemId)
        {
            $this->property('calItemId', trim($calItemId));
        }
        if(null !== $apptId)
        {
            $this->property('apptId', trim($apptId));
        }
        if(null !== $ciFolder)
        {
            $this->property('ciFolder', trim($ciFolder));
        }
        if($status instanceof InviteStatus)
        {
            $this->property('status', $status);
        }
        if($class instanceof InviteClass)
        {
            $this->property('class', $class);
        }
        if(null !== $url)
        {
            $this->property('url', trim($url));
        }
        if(null !== $ex)
        {
            $this->property('ex', (bool) $ex);
        }
        if(null !== $ridZ)
        {
            $this->property('ridZ', trim($ridZ));
        }
        if(null !== $allDay)
        {
            $this->property('allDay', (bool) $allDay);
        }
        if(null !== $draft)
        {
            $this->property('draft', (bool) $draft);
        }
        if(null !== $neverSent)
        {
            $this->property('neverSent', (bool) $neverSent);
        }

        $this->_changes = new TypedSequence('Zimbra\Enum\InviteChange', $changes);

        $this->on('before', function(Base $sender)
        {
            $changes = $sender->changes();
            if(!empty($changes))
            {
                $sender->property('changes', $sender->changes());
            }
        });
    }

    /**
     * Gets or sets method
     *
     * @param  string $method
     * @return string|self
     */
    public function method($method = null)
    {
        if(null === $method)
        {
            return $this->property('method');
        }
        return $this->property('method', trim($method));
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
            return $this->property('compNum');
        }
        return $this->property('compNum', (int) $compNum);
    }

    /**
     * Gets or sets rsvp
     *
     * @param  bool $rsvp
     * @return bool|self
     */
    public function rsvp($rsvp = null)
    {
        if(null === $rsvp)
        {
            return $this->property('rsvp');
        }
        return $this->property('rsvp', (bool) $rsvp);
    }

    /**
     * Gets or sets priority
     *
     * @param  int $priority
     * @return int|self
     */
    public function priority($priority = null)
    {
        if(null === $priority)
        {
            return $this->property('priority');
        }
        return $this->property('priority', ((int) $priority > 0 or (int) $priority < 10) ? (int) $priority : 0);
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->property('name');
        }
        return $this->property('name', trim($name));
    }

    /**
     * Gets or sets loc
     *
     * @param  string $loc
     * @return string|self
     */
    public function loc($loc = null)
    {
        if(null === $loc)
        {
            return $this->property('loc');
        }
        return $this->property('loc', trim($loc));
    }

    /**
     * Gets or sets seq
     *
     * @param  int $seq
     * @return int|self
     */
    public function percentComplete($percentComplete = null)
    {
        if(null === $percentComplete)
        {
            return $this->property('percentComplete');
        }
        return $this->property('percentComplete', ((int) $percentComplete > 0 or (int) $percentComplete <= 100) ? (int) $percentComplete : 0);
    }

    /**
     * Gets or sets completed
     * VTODO COMPLETED DATE-TIME in format yyyyMMddThhmmssZ
     *
     * @param  string $completed
     * @return string|self
     */
    public function completed($completed = null)
    {
        if(null === $completed)
        {
            return $this->property('completed');
        }
        return $this->property('completed', trim($completed));
    }

    /**
     * Gets or sets noBlob
     *
     * @param  boolean $noBlob
     * @return boolean|self
     */
    public function noBlob($noBlob = null)
    {
        if(null === $noBlob)
        {
            return $this->property('noBlob');
        }
        return $this->property('noBlob', (bool) $noBlob);
    }

    /**
     * Gets or sets "actual" free-busy status
     * Valid values - F|B|T|U. i.e. Free, Busy (default), busy-Tentative, OutOfOffice (busy-unavailable)
     *
     * @param  FreeBusyStatus $fb
     * @return FreeBusyStatus|self
     */
    public function fba(FreeBusyStatus $fba = null)
    {
        if(null === $fba)
        {
            return $this->property('fba');
        }
        return $this->property('fba', $fba);
    }

    /**
     * Gets or sets FreeBusy setting
     * Valid values: F|B|T|U 
     * i.e. Free, Busy (default), busy-Tentative, OutOfOffice (busy-unavailable)
     *
     * @param  FreeBusyStatus $fb
     * @return FreeBusyStatus|self
     */
    public function fb(FreeBusyStatus $fb = null)
    {
        if(null === $fb)
        {
            return $this->property('fb');
        }
        return $this->property('fb', $fb);
    }

    /**
     * Gets or sets transparency
     * Valid values: O|T. i.e. Opaque or Transparent
     *
     * @param  Transparency $transp
     * @return Transparency|self
     */
    public function transp(Transparency $transp = null)
    {
        if(null === $transp)
        {
            return $this->property('transp');
        }
        return $this->property('transp', $transp);
    }

    /**
     * Gets or sets isOrg
     *
     * @param  boolean $isOrg
     * @return boolean|self
     */
    public function isOrg($isOrg = null)
    {
        if(null === $isOrg)
        {
            return $this->property('isOrg');
        }
        return $this->property('isOrg', (bool) $isOrg);
    }

    /**
     * Gets or sets x_uid
     *
     * @param  string $x_uid
     * @return string|self
     */
    public function x_uid($x_uid = null)
    {
        if(null === $x_uid)
        {
            return $this->property('x_uid');
        }
        return $this->property('x_uid', trim($x_uid));
    }

    /**
     * Gets or sets uid
     *
     * @param  string $uid
     * @return string|self
     */
    public function uid($uid = null)
    {
        if(null === $uid)
        {
            return $this->property('uid');
        }
        return $this->property('uid', trim($uid));
    }

    /**
     * Gets or sets seq
     *
     * @param  int $seq
     * @return int|self
     */
    public function seq($seq = null)
    {
        if(null === $seq)
        {
            return $this->property('seq');
        }
        return $this->property('seq', (int) $seq);
    }

    /**
     * Gets or sets d
     *
     * @param  int $d
     * @return int|self
     */
    public function d($d = null)
    {
        if(null === $d)
        {
            return $this->property('d');
        }
        return $this->property('d', (int) $d);
    }

    /**
     * Gets or sets calItemId
     *
     * @param  string $calItemId
     * @return string|self
     */
    public function calItemId($calItemId = null)
    {
        if(null === $calItemId)
        {
            return $this->property('calItemId');
        }
        return $this->property('calItemId', trim($calItemId));
    }

    /**
     * Gets or sets apptId
     *
     * @param  string $apptId
     * @return string|self
     */
    public function apptId($apptId = null)
    {
        if(null === $apptId)
        {
            return $this->property('apptId');
        }
        return $this->property('apptId', trim($apptId));
    }

    /**
     * Gets or sets ciFolder
     *
     * @param  string $ciFolder
     * @return string|self
     */
    public function ciFolder($ciFolder = null)
    {
        if(null === $ciFolder)
        {
            return $this->property('ciFolder');
        }
        return $this->property('ciFolder', trim($ciFolder));
    }

    /**
     * Gets or sets status
     * Valid values: TENT|CONF|CANC|NEED|COMP|INPR|WAITING|DEFERRED
     * i.e. TENTative, CONFirmed, CANCelled, COMPleted, INPRogress, WAITING, DEFERRED where waiting and Deferred are custom values not found in the iCalendar spec.
     *
     * @param  InviteStatus $status
     * @return InviteStatus|self
     */
    public function status(InviteStatus $status = null)
    {
        if(null === $status)
        {
            return $this->property('status');
        }
        return $this->property('status', $status);
    }

    /**
     * Gets or sets class
     * Valid values: PUB|PRI|CON
     *
     * @param  InviteClass $class
     * @return InviteClass|self
     */
    public function class_(InviteClass $class = null)
    {
        if(null === $class)
        {
            return $this->property('class');
        }
        return $this->property('class', $class);
    }

    /**
     * Gets or sets url
     *
     * @param  string $url
     * @return string|self
     */
    public function url($url = null)
    {
        if(null === $url)
        {
            return $this->property('url');
        }
        return $this->property('url', trim($url));
    }

    /**
     * Gets or sets ex
     *
     * @param  boolean $ex
     * @return boolean|self
     */
    public function ex($ex = null)
    {
        if(null === $ex)
        {
            return $this->property('ex');
        }
        return $this->property('ex', (bool) $ex);
    }

    /**
     * Gets or sets ridZ
     *
     * @param  string $ridZ
     * @return string|self
     */
    public function ridZ($ridZ = null)
    {
        if(null === $ridZ)
        {
            return $this->property('ridZ');
        }
        return $this->property('ridZ', trim($ridZ));
    }

    /**
     * Gets or sets allDay
     *
     * @param  bool $allDay
     * @return bool|self
     */
    public function allDay($allDay = null)
    {
        if(null === $allDay)
        {
            return $this->property('allDay');
        }
        return $this->property('allDay', (bool) $allDay);
    }

    /**
     * Gets or sets draft
     *
     * @param  boolean $draft
     * @return boolean|self
     */
    public function draft($draft = null)
    {
        if(null === $draft)
        {
            return $this->property('draft');
        }
        return $this->property('draft', (bool) $draft);
    }

    /**
     * Gets or sets neverSent
     *
     * @param  boolean $neverSent
     * @return boolean|self
     */
    public function neverSent($neverSent = null)
    {
        if(null === $neverSent)
        {
            return $this->property('neverSent');
        }
        return $this->property('neverSent', (bool) $neverSent);
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
     * Get string of change
     *
     * @return string
     */
    public function changes()
    {
        return count($this->_changes) ? implode(',', $this->_changes->all()) : '';
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
