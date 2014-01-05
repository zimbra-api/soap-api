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
 * Msg struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Msg
{
    /**
     * Uploaded MIME body ID
     * @var string
     */
    private $_aid;

    /**
     * Original ID
     * @var string
     */
    private $_origid;

    /**
     * Reply type - r|w. (r)eplied or for(w)arded.
     * @var string
     */
    private $_rt;

    /**
     * Identity ID. The identity referenced by {identity-id} specifies the folder where the sent message is saved.
     * @var string
     */
    private $_idnt;

    /**
     * Subject
     * @var string
     */
    private $_su;

    /**
     * Message-ID header for message being replied to
     * @var string
     */
    private $_irt;

    /**
     * Folder ID
     * @var string
     */
    private $_l;

    /**
     * Flags
     * @var string
     */
    private $_f;

    /**
     * Content
     * @var string
     */
    private $_content;

    /**
     * Headers
     * @var List<Header>
     */
    private $_header;

    /**
     * Mime part information
     * @var MimePartInfo
     */
    private $_mp;

    /**
     * Attachments information
     * @var AttachmentsInfo
     */
    private $_attach;

    /**
     * Invite information
     * @var InvitationInfo
     */
    private $_inv;

    /**
     * Email address information
     * @var List<EmailAddrInfo>
     */
    private $_e;

    /**
     * Timezones
     * @var List<CalTZInfo>
     */
    private $_tz;

    /**
     * First few bytes of the message (probably between 40 and 100 bytes)
     * @var string
     */
    private $_fr;

    /**
     * Any element
     * @var array
     */
    private $_any;

    /**
     * Constructor method for Msg
     * @param string $aid
     * @param string $origid
     * @param string $rt
     * @param string $idnt
     * @param string $su
     * @param string $irt
     * @param string $l
     * @param string $f
     * @param string $content
     * @param array $header
     * @param MimePartInfo $mp
     * @param AttachmentsInfo $attach
     * @param InvitationInfo $inv
     * @param array $e
     * @param array $tz
     * @param string $fr
     * @param array $any
     * @return self
     */
    public function __construct(
        $aid = null,
        $origid = null,
        $rt = null,
        $idnt = null,
        $su = null,
        $irt = null,
        $l = null,
        $f = null,
        $content = null,
        array $header = array(),
        MimePartInfo $mp = null,
        AttachmentsInfo $attach = null,
        InvitationInfo $inv = null,
        array $e = array(),
        array $tz = array(),
        $fr = null,
        array $any = array()
    )
    {
        $this->_aid = trim($aid);
        $this->_origid = trim($origid);
        $this->_rt = trim($rt);
        $this->_idnt = trim($idnt);
        $this->_su = trim($su);
        $this->_irt = trim($irt);
        $this->_l = trim($l);
        $this->_f= trim($f);
        $this->_content = trim($content);

        $this->_header = new TypedSequence('Zimbra\Soap\Struct\Header', $header);

        if($mp instanceof MimePartInfo)
        {
            $this->_mp = $mp;
        }
        if($attach instanceof AttachmentsInfo)
        {
            $this->_attach = $attach;
        }
        if($inv instanceof InvitationInfo)
        {
            $this->_inv = $inv;
        }
        $this->_e = new TypedSequence('Zimbra\Soap\Struct\EmailAddrInfo', $e);
        $this->_tz = new TypedSequence('Zimbra\Soap\Struct\CalTZInfo', $tz);
        $this->_fr = trim($fr);
        $this->_any = $any;
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
            return $this->_aid;
        }
        $this->_aid = trim($aid);
        return $this;
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
            return $this->_origid;
        }
        $this->_origid = trim($origid);
        return $this;
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
            return $this->_rt;
        }
        $this->_rt = trim($rt);
        return $this;
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
            return $this->_idnt;
        }
        $this->_idnt = trim($idnt);
        return $this;
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
            return $this->_su;
        }
        $this->_su = trim($su);
        return $this;
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
            return $this->_irt;
        }
        $this->_irt = trim($irt);
        return $this;
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
            return $this->_l;
        }
        $this->_l = trim($l);
        return $this;
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
            return $this->_f;
        }
        $this->_f = trim($f);
        return $this;
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
            return $this->_content;
        }
        $this->_content = trim($content);
        return $this;
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
            return $this->_mp;
        }
        $this->_mp = $mp;
        return $this;
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
     * Gets or sets inv
     *
     * @param  InvitationInfo $inv
     * @return InvitationInfo|self
     */
    public function inv(InvitationInfo $inv = null)
    {
        if(null === $inv)
        {
            return $this->_inv;
        }
        $this->_inv = $inv;
        return $this;
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
            return $this->_fr;
        }
        $this->_fr = trim($fr);
        return $this;
    }

    /**
     * Gets or sets any
     *
     * @param  array $any
     * @return array|self
     */
    public function any(array $any = null)
    {
        if(null === $any)
        {
            return $this->_any;
        }
        $this->_any = $any;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'm')
    {
        $name = !empty($name) ? $name : 'm';
        $arr = array();
        if(!empty($this->_aid))
        {
            $arr['aid'] = $this->_aid;
        }
        if(!empty($this->_origid))
        {
            $arr['origid'] = $this->_origid;
        }
        if(!empty($this->_rt))
        {
            $arr['rt'] = $this->_rt;
        }
        if(!empty($this->_idnt))
        {
            $arr['idnt'] = $this->_idnt;
        }
        if(!empty($this->_su))
        {
            $arr['su'] = $this->_su;
        }
        if(!empty($this->_irt))
        {
            $arr['irt'] = $this->_irt;
        }
        if(!empty($this->_l))
        {
            $arr['l'] = $this->_l;
        }
        if(!empty($this->_f))
        {
            $arr['f'] = $this->_f;
        }
        if(!empty($this->_content))
        {
            $arr['content'] = $this->_content;
        }
        if(count($this->_header))
        {
            $arr['header'] = array();
            foreach ($this->_header as $header)
            {
                $headerArr = $header->toArray('header');
                $arr['header'][] = $headerArr['header'];
            }
        }
        if($this->_mp instanceof MimePartInfo)
        {
            $arr += $this->_mp->toArray('mp');
        }
        if($this->_attach instanceof AttachmentsInfo)
        {
            $arr += $this->_attach->toArray('attach');
        }
        if($this->_inv instanceof InvitationInfo)
        {
            $arr += $this->_inv->toArray('inv');
        }
        if(count($this->_e))
        {
            $arr['e'] = array();
            foreach ($this->_e as $e)
            {
                $eArr = $e->toArray('e');
                $arr['e'][] = $eArr['e'];
            }
        }
        if(count($this->_tz))
        {
            $arr['tz'] = array();
            foreach ($this->_tz as $tz)
            {
                $tzArr = $tz->toArray('tz');
                $arr['tz'][] = $tzArr['tz'];
            }
        }
        if(!empty($this->_fr))
        {
            $arr['fr'] = $this->_fr;
        }
        if(count($this->_any))
        {
            $arr += $this->_any;
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'm')
    {
        $name = !empty($name) ? $name : 'm';
        $xml = new SimpleXML('<'.$name.' />');
        if(!empty($this->_aid))
        {
            $xml->addAttribute('aid', $this->_aid);
        }
        if(!empty($this->_origid))
        {
            $xml->addAttribute('origid', $this->_origid);
        }
        if(!empty($this->_rt))
        {
            $xml->addAttribute('rt', $this->_rt);
        }
        if(!empty($this->_idnt))
        {
            $xml->addAttribute('idnt', $this->_idnt);
        }
        if(!empty($this->_su))
        {
            $xml->addAttribute('su', $this->_su);
        }
        if(!empty($this->_irt))
        {
            $xml->addAttribute('irt', $this->_irt);
        }
        if(!empty($this->_l))
        {
            $xml->addAttribute('l', $this->_l);
        }
        if(!empty($this->_f))
        {
            $xml->addAttribute('f', $this->_f);
        }
        if(!empty($this->_content))
        {
            $xml->addChild('content', $this->_content);
        }
        if(count($this->_header))
        {
            foreach ($this->_header as $header)
            {
                $xml->append($header->toXml('header'));
            }
        }
        if($this->_mp instanceof MimePartInfo)
        {
            $xml->append($this->_mp->toXml('mp'));
        }
        if($this->_attach instanceof AttachmentsInfo)
        {
            $xml->append($this->_attach->toXml('attach'));
        }
        if($this->_inv instanceof InvitationInfo)
        {
            $xml->append($this->_inv->toXml('inv'));
        }
        if(count($this->_e))
        {
            foreach ($this->_e as $e)
            {
                $xml->append($e->toXml('e'));
            }
        }
        if(count($this->_tz))
        {
            foreach ($this->_tz as $tz)
            {
                $xml->append($tz->toXml('tz'));
            }
        }
        if(!empty($this->_fr))
        {
            $xml->addChild('fr', $this->_fr);
        }
        if($this->_any instanceof SimpleXML)
        {
            $xml->append($this->_any);
        }
        if(count($this->_any))
        {
            $xml->addArray($this->_any);
        }

        return $xml;
    }

    /**
     * Method returning the xml string representative this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}