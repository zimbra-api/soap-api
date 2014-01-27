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
use Zimbra\Struct\Base;

/**
 * Msg struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class Msg extends Base
{
    /**
     * Headers
     * @var TypedSequence<Header>
     */
    private $_header;

    /**
     * Email address information
     * @var TypedSequence<EmailAddrInfo>
     */
    private $_e;

    /**
     * Timezones
     * @var TypedSequence<CalTZInfo>
     */
    private $_tz;

    /**
     * Any element
     * @var TypedSequence
     */
    private $_any;

    /**
     * Constructor method for Msg
     * @param string $content Content
     * @param array $header Headers
     * @param MimePartInfo $mp Mime part information
     * @param AttachmentsInfo $attach Attachments information
     * @param InvitationInfo $inv Invite information
     * @param array $e Email address information
     * @param array $tz Timezones
     * @param string $fr First few bytes of the message (probably between 40 and 100 bytes)
     * @param string $aid Uploaded MIME body ID
     * @param string $origid Original ID
     * @param string $rt Reply type - r|w. (r)eplied or for(w)arded.
     * @param string $idnt Identity ID. The identity referenced by {identity-id} specifies the folder where the sent message is saved.
     * @param string $su Subject
     * @param string $irt Message-ID header for message being replied to
     * @param string $l Folder ID
     * @param string $f Flags
     * @param array $any Any element
     * @return self
     */
    public function __construct(
        $content = null,
        array $header = array(),
        MimePartInfo $mp = null,
        AttachmentsInfo $attach = null,
        InvitationInfo $inv = null,
        array $e = array(),
        array $tz = array(),
        $fr = null,
        $aid = null,
        $origid = null,
        $rt = null,
        $idnt = null,
        $su = null,
        $irt = null,
        $l = null,
        $f = null,
        array $any = array()
    )
    {
        parent::__construct();
        if(null !== $content)
        {
            $this->child('content', trim($content));
        }
        $this->_header = new TypedSequence('Zimbra\Mail\Struct\Header', $header);

        if($mp instanceof MimePartInfo)
        {
            $this->child('mp', $mp);
        }
        if($attach instanceof AttachmentsInfo)
        {
            $this->child('attach', $attach);
        }
        if($inv instanceof InvitationInfo)
        {
            $this->child('inv', $inv);
        }
        $this->_e = new TypedSequence('Zimbra\Mail\Struct\EmailAddrInfo', $e);
        $this->_tz = new TypedSequence('Zimbra\Mail\Struct\CalTZInfo', $tz);
        if(null !== $fr)
        {
            $this->child('fr', trim($fr));
        }

        if(null !== $aid)
        {
            $this->property('aid', trim($aid));
        }
        if(null !== $origid)
        {
            $this->property('origid', trim($origid));
        }
        if(null !== $rt)
        {
            $this->property('rt', trim($rt));
        }
        if(null !== $idnt)
        {
            $this->property('idnt', trim($idnt));
        }
        if(null !== $su)
        {
            $this->property('su', trim($su));
        }
        if(null !== $irt)
        {
            $this->property('irt', trim($irt));
        }
        if(null !== $l)
        {
            $this->property('l', trim($l));
        }
        if(null !== $f)
        {
            $this->property('f', trim($f));
        }

        $this->_any = new TypedSequence('Zimbra\Struct\Base', $any);

        $this->addHook(function($sender)
        {
            if(count($sender->header()))
            {
                $sender->child('header', $sender->header()->all());
            }
            if(count($sender->e()))
            {
                $sender->child('e', $sender->e()->all());
            }
            if(count($sender->tz()))
            {
                $sender->child('tz', $sender->tz()->all());
            }
            if(count($sender->any()))
            {
                $sender->child('any', $sender->any()->all());
            }
        });
    }

    /**
     * Gets or sets content
     *
     * @param  string $content
     * @return string|self
     */
    public function content($content = null)
    {
        if(null === $content)
        {
            return $this->child('content');
        }
        return $this->child('content', trim($content));
    }

    /**
     * Add a header
     *
     * @param  Header $header
     * @return self
     */
    public function addHeader(Header $header)
    {
        $this->_header->add($header);
        return $this;
    }

    /**
     * Gets header sequence
     *
     * @return Sequence
     */
    public function header()
    {
        return $this->_header;
    }

    /**
     * Gets or sets mp
     *
     * @param  MimePartInfo $mp
     * @return MimePartInfo|self
     */
    public function mp(MimePartInfo $mp = null)
    {
        if(null === $mp)
        {
            return $this->child('mp');
        }
        return $this->child('mp', $mp);
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
     * Gets or sets inv
     *
     * @param  InvitationInfo $inv
     * @return InvitationInfo|self
     */
    public function inv(InvitationInfo $inv = null)
    {
        if(null === $inv)
        {
            return $this->child('inv');
        }
        return $this->child('inv', $inv);
    }

    /**
     * Add an email address
     *
     * @param  EmailAddrInfo $e
     * @return self
     */
    public function addE(EmailAddrInfo $e)
    {
        $this->_e->add($e);
        return $this;
    }

    /**
     * Gets email address sequence
     *
     * @return Sequence
     */
    public function e()
    {
        return $this->_e;
    }

    /**
     * Add tz
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
     * Gets tz sequence
     *
     * @return Sequence
     */
    public function tz()
    {
        return $this->_tz;
    }

    /**
     * Gets or sets fr
     *
     * @param  string $fr
     * @return string|self
     */
    public function fr($fr = null)
    {
        if(null === $fr)
        {
            return $this->child('fr');
        }
        return $this->child('fr', trim($fr));
    }

    /**
     * Gets or sets aid
     *
     * @param  string $aid
     * @return string|self
     */
    public function aid($aid = null)
    {
        if(null === $aid)
        {
            return $this->property('aid');
        }
        return $this->property('aid', trim($aid));
    }

    /**
     * Gets or sets origid
     *
     * @param  string $origid
     * @return string|self
     */
    public function origid($origid = null)
    {
        if(null === $origid)
        {
            return $this->property('origid');
        }
        return $this->property('origid', trim($origid));
    }

    /**
     * Gets or sets rt
     *
     * @param  string $rt
     * @return string|self
     */
    public function rt($rt = null)
    {
        if(null === $rt)
        {
            return $this->property('rt');
        }
        return $this->property('rt', trim($rt));
    }

    /**
     * Gets or sets idnt
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

    /**
     * Gets or sets su
     *
     * @param  string $su
     * @return string|self
     */
    public function su($su = null)
    {
        if(null === $su)
        {
            return $this->property('su');
        }
        return $this->property('su', trim($su));
    }

    /**
     * Gets or sets irt
     *
     * @param  string $irt
     * @return string|self
     */
    public function irt($irt = null)
    {
        if(null === $irt)
        {
            return $this->property('irt');
        }
        return $this->property('irt', trim($irt));
    }

    /**
     * Gets or sets l
     *
     * @param  string $l
     * @return string|self
     */
    public function l($l = null)
    {
        if(null === $l)
        {
            return $this->property('l');
        }
        return $this->property('l', trim($l));
    }

    /**
     * Gets or sets f
     *
     * @param  string $f
     * @return string|self
     */
    public function f($f = null)
    {
        if(null === $f)
        {
            return $this->property('f');
        }
        return $this->property('f', trim($f));
    }

    /**
     * Add any
     *
     * @param  Base $any
     * @return self
     */
    public function addAny(Base $any)
    {
        $this->_any->add($tz);
        return $this;
    }

    /**
     * Gets any sequence
     *
     * @return TypedSequence
     */
    public function any()
    {
        return $this->_any;
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