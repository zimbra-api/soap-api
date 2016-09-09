<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Common\TypedSequence;

/**
 * InvitationInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class InvitationInfo extends InviteComponent
{

    /**
     * Timezones
     * @var TypedSequence
     */
    private $_timezones;

    /**
     * Meeting notes parts
     * @var TypedSequence
     */
    private $_mimeParts;

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
     * @param array  $changes
     * @param array  $categories
     * @param array  $comments
     * @param array  $contacts
     * @param GeoInfo $geo
     * @param array  $attendees
     * @param array  $alarms
     * @param array  $xprops
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
     * @param array $timezones
     * @param array $mimeParts
     * @param AttachmentsInfo $attach
     * @param string $id
     * @param string $ct
     * @param string $ci
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
        array $changes = [],
        array $categories = [],
        array $comments = [],
        array $contacts = [],
        GeoInfo $geo = null,
        array $attendees = [],
        array $alarms = [],
        array $xprops = [],
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
        array $timezones = [],
        array $mimeParts = [],
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
            $changes,
            $categories,
            $comments,
            $contacts,
            $geo,
            $attendees,
            $alarms,
            $xprops,
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
            $this->setChild('content', $content);
        }
        if($comp instanceof InviteComponent)
        {
            $this->setChild('comp', $comp);
        }
        if($attach instanceof AttachmentsInfo)
        {
            $this->setChild('attach', $attach);
        }
        if(null !== $id)
        {
            $this->setProperty('id', trim($id));
        }
        if(null !== $ct)
        {
            $this->setProperty('ct', trim($ct));
        }
        if(null !== $ci)
        {
            $this->setProperty('ci', trim($ci));
        }

        $this->setTimezones($timezones)
            ->setMimeParts($mimeParts);
        $this->on('before', function(InviteComponent $sender)
        {
            if($sender->getTimezones()->count())
            {
                $sender->setChild('tz', $sender->getTimezones()->all());
            }
            if($sender->getMimeParts()->count())
            {
                $sender->setChild('mp', $sender->getMimeParts()->all());
            }
        });
    }

    /**
     * Gets content
     *
     * @return RawInvite
     */
    public function getContent()
    {
        return $this->getChild('content');
    }

    /**
     * Sets content
     *
     * @param  RawInvite $content
     * @return self
     */
    public function setContent(RawInvite $content)
    {
        return $this->setChild('content', $content);
    }

    /**
     * Gets invite component
     *
     * @return InviteComponent
     */
    public function getInviteComponent()
    {
        return $this->getChild('comp');
    }

    /**
     * Sets invite component
     *
     * @param  InviteComponent $comp
     * @return self
     */
    public function setInviteComponent(InviteComponent $comp)
    {
        return $this->setChild('comp', $comp);
    }

    /**
     * Add a timezone
     *
     * @param  CalTZInfo $tz
     * @return self
     */
    public function addTimezone(CalTZInfo $tz)
    {
        $this->_timezones->add($tz);
        return $this;
    }

    /**
     * Set sequence of timezone
     *
     * @param  array $timezones
     * @return self
     */
    public function setTimezones(array $timezones)
    {
        $this->_timezones = new TypedSequence('Zimbra\Mail\Struct\CalTZInfo', $timezones);
        return $this;
    }

    /**
     * Get sequence of timezone
     *
     * @return Sequence
     */
    public function getTimezones()
    {
        return $this->_timezones;
    }

    /**
     * Add a mime part
     *
     * @param  MimePartInfo $mp
     * @return self
     */
    public function addMimePart(MimePartInfo $mp)
    {
        $this->_mimeParts->add($mp);
        return $this;
    }

    /**
     * Set sequence of mime part
     *
     * @param  array $mimeParts
     * @return self
     */
    public function setMimeParts(array $mimeParts)
    {
        $this->_mimeParts = new TypedSequence('Zimbra\Mail\Struct\MimePartInfo', $mimeParts);
        return $this;
    }

    /**
     * Get sequence of mime part
     *
     * @return Sequence
     */
    public function getMimeParts()
    {
        return $this->_mimeParts;
    }

    /**
     * Gets attachments
     *
     * @return AttachmentsInfo
     */
    public function getAttachments()
    {
        return $this->getChild('attach');
    }

    /**
     * Sets attachments
     *
     * @param  AttachmentsInfo $attach
     * @return self
     */
    public function setAttachments(AttachmentsInfo $attach)
    {
        return $this->setChild('attach', $attach);
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets content type
     *
     * @return string
     */
    public function getContentType()
    {
        return $this->getProperty('ct');
    }

    /**
     * Sets content type
     *
     * @param  string $ct
     * @return self
     */
    public function setContentType($ct)
    {
        return $this->setProperty('ct', trim($ct));
    }

    /**
     * Gets content Id
     *
     * @return string
     */
    public function getContentId()
    {
        return $this->getProperty('ci');
    }

    /**
     * Sets content Id
     *
     * @param  string $ci
     * @return self
     */
    public function setContentId($ci)
    {
        return $this->setProperty('ci', trim($ci));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'inv')
    {
        return parent::toArray($name);
    }


    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'inv')
    {
        return parent::toXml($name);
    }
}
