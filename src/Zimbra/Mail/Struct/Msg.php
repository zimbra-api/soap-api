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
use Zimbra\Enum\ReplyType;
use Zimbra\Struct\Base;

/**
 * Msg struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class Msg extends Base
{
    /**
     * Headers
     * @var TypedSequence<Header>
     */
    private $_headers;

    /**
     * Email address information
     * @var TypedSequence<EmailAddrInfo>
     */
    private $_emails;

    /**
     * Timezones
     * @var TypedSequence<CalTZInfo>
     */
    private $_timezones;

    /**
     * Any element
     * @var TypedSequence
     */
    private $_extras;

    /**
     * Constructor method for Msg
     * @param string $content Content
     * @param MimePartInfo $mp Mime part information
     * @param AttachmentsInfo $attach Attachments information
     * @param InvitationInfo $inv Invite information
     * @param string $fr First few bytes of the message (probably between 40 and 100 bytes)
     * @param string $aid Uploaded MIME body ID
     * @param string $origid Original ID
     * @param ReplyType $rt Reply type - r|w. (r)eplied or for(w)arded.
     * @param string $idnt Identity ID. The identity referenced by {identity-id} specifies the folder where the sent message is saved.
     * @param string $su Subject
     * @param string $irt Message-ID header for message being replied to
     * @param string $l Folder ID
     * @param string $f Flags
     * @param array $headers Headers
     * @param array $emails Email address information
     * @param array $timezones Timezones
     * @param array $extras Other elements
     * @return self
     */
    public function __construct(
        $content = null,
        MimePartInfo $mp = null,
        AttachmentsInfo $attach = null,
        InvitationInfo $inv = null,
        $fr = null,
        $aid = null,
        $origid = null,
        ReplyType $rt = null,
        $idnt = null,
        $su = null,
        $irt = null,
        $l = null,
        $f = null,
        array $headers = [],
        array $emails = [],
        array $timezones = [],
        array $extras = []
    )
    {
        parent::__construct();
        if(null !== $content)
        {
            $this->setChild('content', trim($content));
        }

        if($mp instanceof MimePartInfo)
        {
            $this->setChild('mp', $mp);
        }
        if($attach instanceof AttachmentsInfo)
        {
            $this->setChild('attach', $attach);
        }
        if($inv instanceof InvitationInfo)
        {
            $this->setChild('inv', $inv);
        }
        if(null !== $fr)
        {
            $this->setChild('fr', trim($fr));
        }

        if(null !== $aid)
        {
            $this->setProperty('aid', trim($aid));
        }
        if(null !== $origid)
        {
            $this->setProperty('origid', trim($origid));
        }
        if(null !== $rt)
        {
            $this->setProperty('rt', $rt);
        }
        if(null !== $idnt)
        {
            $this->setProperty('idnt', trim($idnt));
        }
        if(null !== $su)
        {
            $this->setProperty('su', trim($su));
        }
        if(null !== $irt)
        {
            $this->setProperty('irt', trim($irt));
        }
        if(null !== $l)
        {
            $this->setProperty('l', trim($l));
        }
        if(null !== $f)
        {
            $this->setProperty('f', trim($f));
        }

        $this->setHeaders($headers)
            ->setEmails($emails)
            ->setTimezones($timezones)
            ->setExtras($extras);
        $this->on('before', function(Base $sender)
        {
            if($sender->getHeaders()->count())
            {
                $sender->setChild('header', $sender->getHeaders()->all());
            }
            if($sender->getEmails()->count())
            {
                $sender->setChild('e', $sender->getEmails()->all());
            }
            if($sender->getTimezones()->count())
            {
                $sender->setChild('tz', $sender->getTimezones()->all());
            }
            if($sender->getExtras()->count())
            {
                $sender->setChild('any', $sender->getExtras()->all());
            }
        });
    }

    /**
     * Gets content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->getChild('content');
    }

    /**
     * Sets content
     *
     * @param  string $content
     * @return self
     */
    public function setContent($content)
    {
        return $this->setChild('content', trim($content));
    }

    /**
     * Add a header
     *
     * @param  Header $header
     * @return self
     */
    public function addHeader(Header $header)
    {
        $this->_headers->add($header);
        return $this;
    }

    /**
     * Sets header sequence
     *
     * @param  array $headers
     * @return self
     */
    public function setHeaders(array $headers)
    {
        $this->_headers = new TypedSequence('Zimbra\Mail\Struct\Header', $headers);
        return $this;
    }

    /**
     * Gets header sequence
     *
     * @return Sequence
     */
    public function getHeaders()
    {
        return $this->_headers;
    }

    /**
     * Gets mime part information
     *
     * @return MimePartInfo
     */
    public function getMimePart()
    {
        return $this->getChild('mp');
    }

    /**
     * Sets mime part information
     *
     * @param  MimePartInfo $mp
     * @return self
     */
    public function setMimePart(MimePartInfo $mp)
    {
        return $this->setChild('mp', $mp);
    }

    /**
     * Gets attachments information
     *
     * @return AttachmentsInfo
     */
    public function getAttachments()
    {
        return $this->getChild('attach');
    }

    /**
     * Sets attachments information
     *
     * @param  AttachmentsInfo $attach
     * @return self
     */
    public function setAttachments(AttachmentsInfo $attach)
    {
        return $this->setChild('attach', $attach);
    }

    /**
     * Gets invite information
     *
     * @return InvitationInfo
     */
    public function getInvite()
    {
        return $this->getChild('inv');
    }

    /**
     * Sets invite information
     *
     * @param  InvitationInfo $inv
     * @return self
     */
    public function setInvite(InvitationInfo $inv)
    {
        return $this->setChild('inv', $inv);
    }

    /**
     * Add an email address
     *
     * @param  EmailAddrInfo $email
     * @return self
     */
    public function addEmail(EmailAddrInfo $email)
    {
        $this->_emails->add($email);
        return $this;
    }

    /**
     * Sets email address sequence
     *
     * @param  array $emails
     * @return self
     */
    public function setEmails(array $emails)
    {
        $this->_emails = new TypedSequence('Zimbra\Mail\Struct\EmailAddrInfo', $emails);
        return $this;
    }

    /**
     * Gets email address sequence
     *
     * @return Sequence
     */
    public function getEmails()
    {
        return $this->_emails;
    }

    /**
     * Add timezone
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
     * Sets timezone sequence
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
     * Gets timezone sequence
     *
     * @return Sequence
     */
    public function getTimezones()
    {
        return $this->_timezones;
    }

    /**
     * Gets fragment
     *
     * @return string
     */
    public function getFragment()
    {
        return $this->getChild('fr');
    }

    /**
     * Sets fragment
     *
     * @param  string $fr
     * @return self
     */
    public function setFragment($fr)
    {
        return $this->setChild('fr', trim($fr));
    }

    /**
     * Gets uploaded MIME body ID
     *
     * @return string
     */
    public function getAttachmentId()
    {
        return $this->getProperty('aid');
    }

    /**
     * Sets uploaded MIME body ID
     *
     * @param  string $aid
     * @return self
     */
    public function setAttachmentId($aid)
    {
        return $this->setProperty('aid', trim($aid));
    }

    /**
     * Gets Original ID
     *
     * @return string
     */
    public function getOrigId()
    {
        return $this->getProperty('origid');
    }

    /**
     * Sets Original ID
     *
     * @param  string $origid
     * @return self
     */
    public function setOrigId($origid)
    {
        return $this->setProperty('origid', trim($origid));
    }

    /**
     * Gets reply type
     *
     * @return ReplyType
     */
    public function getReplyType()
    {
        return $this->getProperty('rt');
    }

    /**
     * Sets reply type
     *
     * @param  ReplyType $rt
     * @return self
     */
    public function setReplyType(ReplyType $rt)
    {
        return $this->setProperty('rt', $rt);
    }

    /**
     * Gets identity ID
     *
     * @return string
     */
    public function getIdentityId()
    {
        return $this->getProperty('idnt');
    }

    /**
     * Sets identity ID
     *
     * @param  string $idnt
     * @return self
     */
    public function setIdentityId($idnt)
    {
        return $this->setProperty('idnt', trim($idnt));
    }

    /**
     * Gets subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->getProperty('su');
    }

    /**
     * Sets subject
     *
     * @param  string $su
     * @return self
     */
    public function setSubject($su)
    {
        return $this->setProperty('su', trim($su));
    }

    /**
     * Gets message-ID header for message being replied to
     *
     * @return string
     */
    public function getInReplyTo()
    {
        return $this->getProperty('irt');
    }

    /**
     * Sets message-ID header for message being replied to
     *
     * @param  string $irt
     * @return self
     */
    public function setInReplyTo($irt)
    {
        return $this->setProperty('irt', trim($irt));
    }

    /**
     * Gets folder Id
     *
     * @return string
     */
    public function getFolderId()
    {
        return $this->getProperty('l');
    }

    /**
     * Sets folder Id
     *
     * @param  string $l
     * @return self
     */
    public function setFolderId($l)
    {
        return $this->setProperty('l', trim($l));
    }

    /**
     * Gets flags
     *
     * @return string
     */
    public function getFlags()
    {
        return $this->getProperty('f');
    }

    /**
     * Sets flags
     *
     * @param  string $f
     * @return self
     */
    public function setFlags($f)
    {
        return $this->setProperty('f', trim($f));
    }

    /**
     * Add extra element
     *
     * @param  Base $extra
     * @return self
     */
    public function addExtra(Base $extra)
    {
        $this->_extras->add($extra);
        return $this;
    }

    /**
     * Sets extra element sequence
     *
     * @param  array $extras
     * @return self
     */
    public function setExtras(array $extras)
    {
        $this->_extras = new TypedSequence('Zimbra\Struct\Base', $extras);
        return $this;
    }

    /**
     * Gets extra element sequence
     *
     * @return TypedSequence
     */
    public function getExtras()
    {
        return $this->_extras;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'm')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'm')
    {
        return parent::toXml($name);
    }
}