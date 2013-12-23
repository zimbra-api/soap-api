<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;
use Zimbra\Soap\Enum\FreeBusyStatus;
use Zimbra\Soap\Enum\Transparency;
use Zimbra\Soap\Enum\InviteStatus;
use Zimbra\Soap\Enum\InviteClass;
use Zimbra\Soap\Enum\InviteChange;
use Zimbra\Utils\TypedSequence;

/**
 * InviteComponentCommon struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class InviteComponentCommon
{
    /**
     * The method
     * - use : required
     * @var string
     */
    private $_method;

    /**
     * Component number of the invite
     * - use : required
     * @var int
     */
    private $_compNum;

    /**
     * RSVP flag. Set if response requested, unset if no response requested
     * - use : required
     * @var boolean
     */
    private $_rsvp;

    /**
     * Priority (0 - 9; default = 0)
     * @var int
     */
    private $_priority;

    /**
     * The name
     * @var string
     */
    private $_name;

    /**
     * Location
     * @var string
     */
    private $_loc;

    /**
     * Percent complete for VTODO (0 - 100; default = 0)
     * @var int
     */
    private $_percentComplete;

    /**
     * VTODO COMPLETED DATE-TIME in format yyyyMMddThhmmssZ
     * @var string
     */
    private $_completed;

    /**
     * Set if invite has no blob data, i.e. all data is in db metadata
     * @var boolean
     */
    private $_noBlob;

    /**
     * The "actual" free-busy status of this invite (ie what the client should display).
     * This is synthesized taking into account our Attendee's PartStat, the Opacity of the appointment, its Status, etc... 
     * Valid values - F|B|T|U. i.e. Free, Busy (default), busy-Tentative, OutOfOffice (busy-unavailable)
     * @var FreeBusyStatus
     */
    private $_fba;

    /**
     * FreeBusy setting F|B|T|U 
     * i.e. Free, Busy (default), busy-Tentative, OutOfOffice (busy-unavailable)
     * @var FreeBusyStatus
     */
    private $_fb;

    /**
     * Transparency - O|T. i.e. Opaque or Transparent
     * @var Transparency
     */
    private $_transp;

    /**
     * Am I the organizer? [default 0 (false)]
     * @var boolean
     */
    private $_isOrg;

    /**
     * The x_uid
     * @var string
     */
    private $_x_uid;

    /**
     * UID to use when creating appointment. Optional: client can request the UID to use
     * @var string
     */
    private $_uid;

    /**
     * Sequence number (default = 0)
     * @var int
     */
    private $_seq;

    /**
     * Date - used for zdsync
     * @var integer
     */
    private $_d;

    /**
     * Mail item ID of appointment
     * @var string
     */
    private $_calItemId;

    /**
     * Appointment ID (deprecated)
     * @var string
     */
    private $_apptId;

    /**
     * Folder of appointment
     * @var string
     */
    private $_ciFolder;

    /**
     * Status - TENT|CONF|CANC|NEED|COMP|INPR|WAITING|DEFERRED
     * i.e. TENTative, CONFirmed, CANCelled, COMPleted, INPRogress, WAITING, DEFERRED where waiting
     * and Deferred are custom values not found in the iCalendar spec.
     * @var InviteStatus
     */
    private $_status;

    /**
     * Class = PUB|PRI|CON. i.e. PUBlic (default), PRIvate, CONfidential
     * @var string
     */
    private $_class;

    /**
     * The url
     * @var string
     */
    private $_url;

    /**
     * Set if this is invite is an exception
     * @var boolean
     */
    private $_ex;

    /**
     * Recurrence-id string in UTC timezone
     * @var string
     */
    private $_ridZ;

    /**
     * Set if is an all day appointment
     * @var boolean
     */
    private $_allDay;

    /**
     * Set if invite has changes that haven't been sent to attendees; for organizer only
     * @var boolean
     */
    private $_draft;

    /**
     * Set if attendees were never notified of this invite; for organizer only
     * @var boolean
     */
    private $_neverSent;

    /**
     * Comma-separated list of changed data in an updated invite.
     * Possible values are "subject", "location", "time" (start time, end time, or duration), and "recurrence".
     * @var TypedSequence
     */
    private $_change;

    /**
     * Constructor method for InviteComponentCommon
     *
     * @param string $method
     * @param int    $compNum
     * @param bool   $rsvp
     * @param int    $priority
     * @param string $name
     * @param string $loc
     * @param int    $percentComplete
     * @param string $completed
     * @param bool   $noBlob
     * @param FreeBusyStatus $fba
     * @param FreeBusyStatus $fb
     * @param Transparency $transp
     * @param bool   $isOrg
     * @param string $x_uid
     * @param string $uid
     * @param int    $seq
     * @param int    $d
     * @param string $calItemId
     * @param string $apptId
     * @param string $ciFolder
     * @param InviteStatus $status
     * @param InviteClass $class
     * @param string $url
     * @param bool   $ex
     * @param string $ridZ
     * @param bool   $allDay
     * @param bool   $draft
     * @param bool   $neverSent
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
        array $change = array()
    )
    {
        $this->_method = trim($method);
        $this->_compNum = (int) $compNum;
        $this->_rsvp = (bool) $rsvp;
        if(null !== $priority)
        {
            $this->_priority = ((int) $priority > 0 or (int) $priority < 10) ? (int) $priority : 0;
        }
        $this->_name = trim($name);
        $this->_loc = trim($loc);
        if(null !== $percentComplete)
        {
            $this->_percentComplete = ((int) $percentComplete > 0 or (int) $percentComplete <= 100) ? (int) $percentComplete : 0;
        }
        $this->_completed = trim($completed);
        if(null !== $noBlob)
        {
            $this->_noBlob = (bool) $noBlob;
        }
        if($fba instanceof FreeBusyStatus)
        {
            $this->_fba = $fba;
        }
        if($fb instanceof FreeBusyStatus)
        {
            $this->_fb = $fb;
        }
        if($transp instanceof Transparency)
        {
            $this->_transp = $transp;
        }
        if(null !== $isOrg)
        {
            $this->_isOrg = (bool) $isOrg;
        }
        $this->_x_uid = trim($x_uid);
        $this->_uid = trim($uid);
        if(null !== $seq)
        {
            $this->_seq = (int) $seq;
        }
        if(null !== $d)
        {
            $this->_d = (int) $d;
        }
        $this->_calItemId = trim($calItemId);
        $this->_apptId = trim($apptId);
        $this->_ciFolder = trim($ciFolder);
        if($status instanceof InviteStatus)
        {
            $this->_status = $status;
        }
        if($class instanceof InviteClass)
        {
            $this->_class = $class;
        }
        $this->_url = trim($url);
        if(null !== $ex)
        {
            $this->_ex = (bool) $ex;
        }
        $this->_ridZ = trim($ridZ);
        if(null !== $allDay)
        {
            $this->_allDay = (bool) $allDay;
        }
        if(null !== $draft)
        {
            $this->_draft = (bool) $draft;
        }
        if(null !== $neverSent)
        {
            $this->_neverSent = (bool) $neverSent;
        }

        $this->_change = new TypedSequence('Zimbra\Soap\Enum\InviteChange', $change);
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
            return $this->_method;
        }
        $this->_method = trim($method);
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
     * Gets or sets rsvp
     *
     * @param  boolean $rsvp
     * @return boolean|self
     */
    public function rsvp($rsvp = null)
    {
        if(null === $rsvp)
        {
            return $this->_rsvp;
        }
        $this->_rsvp = (bool) $rsvp;
        return $this;
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
            return $this->_priority;
        }
        $this->_priority = ((int) $priority > 0 or (int) $priority < 10) ? (int) $priority : 0;
        return $this;
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
            return $this->_name;
        }
        $this->_name = trim($name);
        return $this;
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
            return $this->_loc;
        }
        $this->_loc = trim($loc);
        return $this;
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
            return $this->_percentComplete;
        }
        $this->_percentComplete = ((int) $percentComplete > 0 or (int) $percentComplete <= 100) ? (int) $percentComplete : 0;
        return $this;
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
            return $this->_completed;
        }
        $this->_completed = trim($completed);
        return $this;
    }

    /**
     * Gets or sets ex
     *
     * @param  boolean $noBlob
     * @return boolean|self
     */
    public function noBlob($noBlob = null)
    {
        if(null === $noBlob)
        {
            return $this->_noBlob;
        }
        $this->_noBlob = (bool) $noBlob;
        return $this;
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
            return $this->_fba;
        }
        $this->_fba = $fba;
        return $this;
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
            return $this->_fb;
        }
        $this->_fb = $fb;
        return $this;
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
            return $this->_transp;
        }
        $this->_transp = $transp;
        return $this;
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
            return $this->_isOrg;
        }
        $this->_isOrg = (bool) $isOrg;
        return $this;
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
            return $this->_x_uid;
        }
        $this->_x_uid = trim($x_uid);
        return $this;
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
            return $this->_uid;
        }
        $this->_uid = trim($uid);
        return $this;
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
            return $this->_seq;
        }
        $this->_seq = (int) $seq;
        return $this;
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
            return $this->_d;
        }
        $this->_d = (int) $d;
        return $this;
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
            return $this->_calItemId;
        }
        $this->_calItemId = trim($calItemId);
        return $this;
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
            return $this->_apptId;
        }
        $this->_apptId = trim($apptId);
        return $this;
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
            return $this->_ciFolder;
        }
        $this->_ciFolder = trim($ciFolder);
        return $this;
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
            return $this->_status;
        }
        $this->_status = $status;
        return $this;
    }

    /**
     * Gets or sets class
     * Valid values: PUB|PRI|CON
     *
     * @param  InviteClass $class
     * @return InviteClass|self
     */
    public function klass(InviteClass $class = null)
    {
        if(null === $class)
        {
            return $this->_class;
        }
        $this->_class = $class;
        return $this;
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
            return $this->_url;
        }
        $this->_url = trim($url);
        return $this;
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
            return $this->_ex;
        }
        $this->_ex = (bool) $ex;
        return $this;
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
            return $this->_ridZ;
        }
        $this->_draft = trim($ridZ);
        return $this;
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
            return $this->_allDay;
        }
        $this->_allDay = (bool) $allDay;
        return $this;
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
            return $this->_draft;
        }
        $this->_draft = (bool) $draft;
        return $this;
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
            return $this->_neverSent;
        }
        $this->_neverSent = (bool) $neverSent;
        return $this;
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
        $this->_change->add($change);
        return $this;
    }

    /**
     * Get sequence of change
     *
     * @return Sequence
     */
    public function change()
    {
        return $this->_change;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'comp')
    {
        $name = !empty($name) ? $name : 'comp';
        $arr = array(
            'method' => $this->_method,
            'compNum' => $this->_compNum,
            'rsvp' => $this->_rsvp ? 1 : 0,
        );
        if(is_int($this->_priority))
        {
            $arr['priority'] = $this->_priority;
        }
        if(!empty($this->_name))
        {
            $arr['name'] = $this->_name;
        }
        if(!empty($this->_loc))
        {
            $arr['loc'] = $this->_loc;
        }
        if(is_int($this->_percentComplete))
        {
            $arr['percentComplete'] = $this->_percentComplete;
        }
        if(!empty($this->_completed))
        {
            $arr['completed'] = $this->_completed;
        }
        if(is_bool($this->_noBlob))
        {
            $arr['noBlob'] = $this->_noBlob ? 1 : 0;
        }
        if($this->_fba instanceof FreeBusyStatus)
        {
            $arr['fba'] = (string) $this->_fba;
        }
        if($this->_fb instanceof FreeBusyStatus)
        {
            $arr['fb'] = (string) $this->_fb;
        }
        if($this->_transp instanceof Transparency)
        {
            $arr['transp'] = (string) $this->_transp;
        }
        if(is_bool($this->_isOrg))
        {
            $arr['isOrg'] = $this->_isOrg ? 1 : 0;
        }
        if(!empty($this->_x_uid))
        {
            $arr['x_uid'] = $this->_x_uid;
        }
        if(!empty($this->_uid))
        {
            $arr['uid'] = $this->_uid;
        }
        if(is_int($this->_seq))
        {
            $arr['seq'] = $this->_seq;
        }
        if(is_int($this->_d))
        {
            $arr['d'] = $this->_d;
        }
        if(!empty($this->_calItemId))
        {
            $arr['calItemId'] = $this->_calItemId;
        }
        if(!empty($this->_apptId))
        {
            $arr['apptId'] = $this->_apptId;
        }
        if(!empty($this->_ciFolder))
        {
            $arr['ciFolder'] = $this->_ciFolder;
        }
        if($this->_status instanceof InviteStatus)
        {
            $arr['status'] = (string) $this->_status;
        }
        if($this->_class instanceof InviteClass)
        {
            $arr['class'] = (string) $this->_class;
        }
        if(!empty($this->_url))
        {
            $arr['url'] = $this->_url;
        }
        if(is_bool($this->_ex))
        {
            $arr['ex'] = $this->_ex ? 1 : 0;
        }
        if(!empty($this->_ridZ))
        {
            $arr['ridZ'] = $this->_ridZ;
        }
        if(is_bool($this->_allDay))
        {
            $arr['allDay'] = $this->_allDay ? 1 : 0;
        }
        if(is_bool($this->_draft))
        {
            $arr['draft'] = $this->_draft ? 1 : 0;
        }
        if(is_bool($this->_neverSent))
        {
            $arr['neverSent'] = $this->_neverSent ? 1 : 0;
        }
        if(count($this->_change))
        {
            $arr['change'] = implode(',', $this->_change->all());
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'comp')
    {
        $name = !empty($name) ? $name : 'comp';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('method', $this->_method)
            ->addAttribute('compNum', $this->_compNum)
            ->addAttribute('rsvp', $this->_rsvp ? 1 : 0);
        if(is_int($this->_priority))
        {
            $xml->addAttribute('priority', $this->_priority);
        }
        if(!empty($this->_name))
        {
            $xml->addAttribute('name', $this->_name);
        }
        if(!empty($this->_loc))
        {
            $xml->addAttribute('loc', $this->_loc);
        }
        if(is_int($this->_percentComplete))
        {
            $xml->addAttribute('percentComplete', $this->_percentComplete);
        }
        if(!empty($this->_completed))
        {
            $xml->addAttribute('completed', $this->_completed);
        }
        if(is_bool($this->_noBlob))
        {
            $xml->addAttribute('noBlob', $this->_noBlob ? 1 : 0);
        }
        if($this->_fba instanceof FreeBusyStatus)
        {
            $xml->addAttribute('fba', (string) $this->_fba);
        }
        if($this->_fb instanceof FreeBusyStatus)
        {
            $xml->addAttribute('fb', (string) $this->_fb);
        }
        if($this->_transp instanceof Transparency)
        {
            $xml->addAttribute('transp', (string) $this->_transp);
        }
        if(is_bool($this->_isOrg))
        {
            $xml->addAttribute('isOrg', $this->_isOrg ? 1 : 0);
        }
        if(!empty($this->_x_uid))
        {
            $xml->addAttribute('x_uid', $this->_x_uid);
        }
        if(!empty($this->_uid))
        {
            $xml->addAttribute('uid', $this->_uid);
        }
        if(is_int($this->_seq))
        {
            $xml->addAttribute('seq', $this->_seq);
        }
        if(is_int($this->_d))
        {
            $xml->addAttribute('d', $this->_d);
        }
        if(!empty($this->_calItemId))
        {
            $xml->addAttribute('calItemId', $this->_calItemId);
        }
        if(!empty($this->_apptId))
        {
            $xml->addAttribute('apptId', $this->_apptId);
        }
        if(!empty($this->_ciFolder))
        {
            $xml->addAttribute('ciFolder', $this->_ciFolder);
        }
        if($this->_status instanceof InviteStatus)
        {
            $xml->addAttribute('status', (string) $this->_status);
        }
        if($this->_class instanceof InviteClass)
        {
            $xml->addAttribute('class', (string) $this->_class);
        }
        if(!empty($this->_url))
        {
            $xml->addAttribute('url', $this->_url);
        }
        if(is_bool($this->_ex))
        {
            $xml->addAttribute('ex', $this->_ex ? 1 : 0);
        }
        if(!empty($this->_ridZ))
        {
            $xml->addAttribute('ridZ', $this->_ridZ);
        }
        if(is_bool($this->_allDay))
        {
            $xml->addAttribute('allDay', $this->_allDay ? 1 : 0);
        }
        if(is_bool($this->_draft))
        {
            $xml->addAttribute('draft', $this->_draft ? 1 : 0);
        }
        if(is_bool($this->_neverSent))
        {
            $xml->addAttribute('neverSent', $this->_neverSent ? 1 : 0);
        }
        if(count($this->_change))
        {
            $xml->addAttribute('change', implode(',', $this->_change->all()));
        }
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
