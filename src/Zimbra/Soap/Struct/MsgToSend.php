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

/**
 * MsgToSend struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class MsgToSend extends Msg
{
    /**
     * Saved draft ID
     * @var string
     */
    private $_did;

    /**
     * If set, message gets constructed based on the "did" (id of the draft).
     * @var bool
     */
    private $_sfd;


    /**
     * Constructor method for Msg
     * @param string $did
     * @param bool   $sfd
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
        $did = null,
        $sfd = null,
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
        parent::__construct(
            $aid,
            $origid,
            $rt,
            $idnt,
            $su,
            $irt,
            $l,
            $f,
            $content,
            $header,
            $mp,
            $attach,
            $inv,
            $e,
            $tz,
            $fr,
            $any
        );
        $this->_did = trim($did);
        if(null !== $sfd)
        {
            $this->_sfd = (bool) $sfd;
        }
    }

    /**
     * Gets or sets did
     *
     * @param  string $did
     * @return string|self
     */
    public function did($did = null)
    {
        if(null === $did)
        {
            return $this->_did;
        }
        $this->_did = trim($did);
        return $this;
    }

    /**
     * Gets or sets sfd
     *
     * @param  bool $sfd
     * @return bool|self
     */
    public function sfd($sfd = null)
    {
        if(null === $sfd)
        {
            return $this->_sfd;
        }
        $this->_sfd = (bool) $sfd;
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
        $arr = parent::toArray($name);
        if(!empty($this->_did))
        {
            $arr[$name]['did'] = $this->_did;
        }
        if(is_bool($this->_sfd))
        {
            $arr[$name]['sfd'] = $this->_sfd ? 1 : 0;
        }

        return $arr;
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
        $xml = parent::toXml($name);
        if(!empty($this->_did))
        {
            $xml->addAttribute('did', $this->_did);
        }
        if(is_bool($this->_sfd))
        {
            $xml->addAttribute('sfd', $this->_sfd ? 1 : 0);
        }

        return $xml;
    }
}
