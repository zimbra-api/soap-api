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

/**
 * MsgToSend struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class MsgToSend extends Msg
{
    /**
     * Constructor method for Msg
     * @param string $content
     * @param array $header
     * @param MimePartInfo $mp
     * @param AttachmentsInfo $attach
     * @param InvitationInfo $inv
     * @param array $e
     * @param array $tz
     * @param string $fr
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
     * @param array $any
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
        array $any = array()
    )
    {
        parent::__construct(
            $content,
            $header,
            $mp,
            $attach,
            $inv,
            $e,
            $tz,
            $fr,
            $aid,
            $origid,
            $rt,
            $idnt,
            $su,
            $irt,
            $l,
            $f,
            $any
        );
        if(null !== $did)
        {
            $this->property('did', trim($did));
        }
        if(null !== $sfd)
        {
            return $this->property('sfd', (bool) $sfd);
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
            return $this->property('did');
        }
        return $this->property('did', trim($did));
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
            return $this->property('sfd');
        }
        return $this->property('sfd', (bool) $sfd);
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
