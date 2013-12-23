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
use Zimbra\Utils\TypedSequence;

/**
 * InvitationInfo struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class InvitationInfo extends InviteComponent
{
    /**
     * RAW RFC822 MESSAGE (XML-encoded) MUST CONTAIN A text/calendar PART
     * Description for element text content:Raw iCalendar data
     * @var RawInvite
     */
    private $_content;

    /**
     * Invite component
     * @var InviteComponent
     */
    private $_comp;

    /**
     * Timezones
     * @var List<CalTZInfo>
     */
    private $_tz;

    /**
     * Meeting notes parts 
     * @var List<MimePartInfo>
     */
    private $_mp;

    /**
     * Attachments
     * @var AttachmentsInfo
     */
    private $_attach;

    /**
     * ID
     * @var string
     */
    protected $_id;

    /**
     * MIME Content-Type
     * @var string
     */
    protected $_ct;

    /**
     * MIME Content-Id
     * @var string
     */
    protected $_ci;
    /**
     * Constructor method for InviteComponent
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
     * @param array  $category
     * @param array  $comment
     * @param array  $contact
     * @param GeoInfo $geo
     * @param array  $at
     * @param array  $alarm
     * @param array  $xprop
     * @param string $fr
     * @param string $desc
     * @param string $descHtml
     * @param CalOrganizer $or
     * @param RecurrenceInfo $recur
     * @param ExceptionRecurIdInfo $exceptId
     * @param DtTimeInfo $s
     * @param DtTimeInfo $e
     * @param DurationInfo $dur
     * @param RawInvite $content
     * @param InviteComponent $comp
     * @param array $tz
     * @param array $mp
     * @param AttachmentsInfo $attach
     * @param string $id
     * @param string $ct
     * @param string $ci
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
        array $change = array(),
        array $category = array(),
        array $comment = array(),
        array $contact = array(),
        GeoInfo $geo = null,
        array $at = array(),
        array $alarm = array(),
        array $xprop = array(),
        $fr = null,
        $desc = null,
        $descHtml = null,
        CalOrganizer $or = null,
        RecurrenceInfo $recur = null,
        ExceptionRecurIdInfo $exceptId = null,
        DtTimeInfo $s = null,
        DtTimeInfo $e = null,
        DurationInfo $dur = null,
        RawInvite $content = null,
        InviteComponent $comp = null,
        array $tz = array(),
        array $mp = array(),
        AttachmentsInfo $attach = null,
        $id = null,
        $ct = null,
        $ci = null
    )
    {
        parent::__construct(
            $method,
            $compNum,
            $rsvp,
            $priority,
            $name,
            $loc,
            $percentComplete,
            $completed,
            $noBlob,
            $fba,
            $fb,
            $transp,
            $isOrg,
            $x_uid,
            $uid,
            $seq,
            $d,
            $calItemId,
            $apptId,
            $ciFolder,
            $status,
            $class,
            $url,
            $ex,
            $ridZ,
            $allDay,
            $draft,
            $neverSent,
            $change,
            $category,
            $comment,
            $contact,
            $geo,
            $at,
            $alarm,
            $xprop,
            $fr,
            $desc,
            $descHtml,
            $or,
            $recur,
            $exceptId,
            $s,
            $e,
            $dur
        );
        if($content instanceof RawInvite)
        {
            $this->_content = $content;
        }
        if($comp instanceof InviteComponent)
        {
            $this->_comp = $comp;
        }
        $this->_tz = new TypedSequence('Zimbra\Soap\Struct\CalTZInfo', $tz);
        $this->_mp = new TypedSequence('Zimbra\Soap\Struct\MimePartInfo', $mp);
        if($attach instanceof AttachmentsInfo)
        {
            $this->_attach = $attach;
        }
        $this->_id = trim($id);
        $this->_ct = trim($ct);
        $this->_ci = trim($ci);
    }

    /**
     * Gets or sets content
     *
     * @param  RawInvite $content
     * @return RawInvite|self
     */
    public function content(RawInvite $content = null)
    {
        if(null === $content)
        {
            return $this->_content;
        }
        $this->_content = $content;
        return $this;
    }

    /**
     * Gets or sets comp
     *
     * @param  InviteComponent $comp
     * @return InviteComponent|self
     */
    public function comp(InviteComponent $comp = null)
    {
        if(null === $comp)
        {
            return $this->_comp;
        }
        $this->_comp = $comp;
        return $this;
    }

    /**
     * Add a tz
     *
     * @param  CalTZInfo $tz
     * @return self
     */
    public function addTz(CalTZInfo $tz)
    {
        $this->_tz->add($tz);
        return $this;
    }

    /**
     * Get sequence of tz
     *
     * @return Sequence
     */
    public function tz()
    {
        return $this->_tz;
    }

    /**
     * Add a mp
     *
     * @param  MimePartInfo $mp
     * @return self
     */
    public function addMp(MimePartInfo $mp)
    {
        $this->_mp->add($mp);
        return $this;
    }

    /**
     * Get sequence of mp
     *
     * @return Sequence
     */
    public function mp()
    {
        return $this->_mp;
    }

    /**
     * Gets or sets attach
     *
     * @param  AttachmentsInfo $attach
     * @return AttachmentsInfo|self
     */
    public function attach(AttachmentsInfo $attach = null)
    {
        if(null === $attach)
        {
            return $this->_attach;
        }
        $this->_attach = $attach;
        return $this;
    }

    /**
     * Gets or sets id
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
     * Gets or sets ct
     *
     * @param  string $ct
     * @return string|self
     */
    public function ct($ct = null)
    {
        if(null === $ct)
        {
            return $this->_ct;
        }
        $this->_ct = trim($ct);
        return $this;
    }

    /**
     * Gets or sets ci
     *
     * @param  string $ci
     * @return string|self
     */
    public function ci($ci = null)
    {
        if(null === $ci)
        {
            return $this->_ci;
        }
        $this->_ci = trim($ci);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'inv')
    {
        $name = !empty($name) ? $name : 'inv';
        $arr = parent::toArray($name);

        if($this->_content instanceof RawInvite)
        {
            $arr[$name] += $this->_content->toArray('content');
        }
        if($this->_comp instanceof InviteComponent)
        {
            $arr[$name] += $this->_comp->toArray('comp');
        }
        if(count($this->_tz))
        {
            $arr[$name]['tz'] = array();
            foreach ($this->_tz as $tz)
            {
                $tzArr = $tz->toArray('tz');
                $arr[$name]['tz'][] = $tzArr['tz'];
            }
        }
        if(count($this->_mp))
        {
            $arr[$name]['mp'] = array();
            foreach ($this->_mp as $mp)
            {
                $mpArr = $mp->toArray('mp');
                $arr[$name]['mp'][] = $mpArr['mp'];
            }
        }
        if($this->_attach instanceof AttachmentsInfo)
        {
            $arr[$name] += $this->_attach->toArray('attach');
        }
        if(!empty($this->_id))
        {
            $arr[$name]['id'] = $this->_id;
        }
        if(!empty($this->_ct))
        {
            $arr[$name]['ct'] = $this->_ct;
        }
        if(!empty($this->_ci))
        {
            $arr[$name]['ci'] = $this->_ci;
        }

        return $arr;
    }


    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'inv')
    {
        $name = !empty($name) ? $name : 'inv';
        $xml = parent::toXml($name);

        if($this->_content instanceof RawInvite)
        {
            $xml->append($this->_content->toXml('content'));
        }
        if($this->_comp instanceof InviteComponent)
        {
            $xml->append($this->_comp->toXml('comp'));
        }
        if(count($this->_tz))
        {
            foreach ($this->_tz as $tz)
            {
                $xml->append($tz->toXml('tz'));
            }
        }
        if(count($this->_mp))
        {
            foreach ($this->_mp as $mp)
            {
                $xml->append($mp->toXml('mp'));
            }
        }
        if($this->_attach instanceof AttachmentsInfo)
        {
            $xml->append($this->_attach->toXml('attach'));
        }
        if(!empty($this->_id))
        {
            $xml->addAttribute('id', $this->_id);
        }
        if(!empty($this->_ct))
        {
            $xml->addAttribute('ct', $this->_ct);
        }
        if(!empty($this->_ci))
        {
            $xml->addAttribute('ci', $this->_ci);
        }

        return $xml;
    }
}
