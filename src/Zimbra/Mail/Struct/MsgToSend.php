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
     * @param MimePartInfo $mp
     * @param AttachmentsInfo $attach
     * @param InvitationInfo $inv
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
     * @param array $headers
     * @param array $emails
     * @param array $timezones
     * @param array $extras
     * @return self
     */
    public function __construct(
        $content = null,
        MimePartInfo $mp = null,
        AttachmentsInfo $attach = null,
        InvitationInfo $inv = null,
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
        array $headers = [],
        array $emails = [],
        array $timezones = [],
        array $extras = []
    )
    {
        parent::__construct(
            $content,
            $mp,
            $attach,
            $inv,
            $fr,
            $aid,
            $origid,
            $rt,
            $idnt,
            $su,
            $irt,
            $l,
            $f,
            $headers,
            $emails,
            $timezones,
            $extras
        );
        if(null !== $did)
        {
            $this->setProperty('did', trim($did));
        }
        if(null !== $sfd)
        {
            return $this->setProperty('sfd', (bool) $sfd);
        }
    }

    /**
     * Gets saved draft ID
     *
     * @return string
     */
    public function getDraftId()
    {
        return $this->getProperty('did');
    }

    /**
     * Sets saved draft ID
     *
     * @param  string $did
     * @return self
     */
    public function setDraftId($did)
    {
        return $this->setProperty('did', trim($did));
    }

    /**
     * Gets send from draft
     *
     * @return bool
     */
    public function getSendFromDraft()
    {
        return $this->getProperty('sfd');
    }

    /**
     * Sets send from draft
     *
     * @param  bool $sfd
     * @return self
     */
    public function setSendFromDraft($sfd)
    {
        return $this->setProperty('sfd', (bool) $sfd);
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
