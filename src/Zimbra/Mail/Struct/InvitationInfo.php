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
            $this->child('content', $content);
        }
        if($comp instanceof InviteComponent)
        {
            $this->child('comp', $comp);
        }
        $this->_tz = new TypedSequence('Zimbra\Mail\Struct\CalTZInfo', $tz);
        $this->_mp = new TypedSequence('Zimbra\Mail\Struct\MimePartInfo', $mp);
        if($attach instanceof AttachmentsInfo)
        {
            $this->child('attach', $attach);
        }
        if(null !== $id)
        {
            $this->property('id', trim($id));
        }
        if(null !== $ct)
        {
            $this->property('ct', trim($ct));
        }
        if(null !== $ci)
        {
            $this->property('ci', trim($ci));
        }

        $this->on('before', function(InviteComponent $sender)
        {
            if($sender->tz()->count())
            {
                $sender->child('tz', $sender->tz()->all());
            }
            if($sender->mp()->count())
            {
                $sender->child('mp', $sender->mp()->all());
            }
        });
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
            return $this->child('content');
        }
        return $this->child('content', $content);
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
            return $this->child('comp');
        }
        return $this->child('comp', $comp);
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
            return $this->child('attach');
        }
        return $this->child('attach', $attach);
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
            return $this->property('id');
        }
        return $this->property('id', trim($id));
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
            return $this->property('ct');
        }
        return $this->property('ct', trim($ct));
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
            return $this->property('ci');
        }
        return $this->property('ci', trim($ci));
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
