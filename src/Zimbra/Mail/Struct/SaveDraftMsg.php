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

use Zimbra\Common\Text;

/**
 * SaveDraftMsg struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SaveDraftMsg extends Msg
{
    /**
     * Constructor method for Msg
     * @param string $content
     * @param array $headers
     * @param MimePartInfo $mp
     * @param AttachmentsInfo $attach
     * @param InvitationInfo $inv
     * @param array $emails
     * @param array $timezones
     * @param string $fr
     * @param int $id
     * @param string $forAcct
     * @param string $t
     * @param string $tn
     * @param string $rgb
     * @param int $color
     * @param int $autoSendTime
     * @param string $aid
     * @param string $origid
     * @param string $rt
     * @param string $idnt
     * @param string $su
     * @param string $irt
     * @param string $l
     * @param string $f
     * @param array $extras
     * @return self
     */
    public function __construct(
        $content = null,
        MimePartInfo $mp = null,
        AttachmentsInfo $attach = null,
        InvitationInfo $inv = null,
        $fr = null,
        $id = null,
        $forAcct = null,
        $t = null,
        $tn = null,
        $rgb = null,
        $color = null,
        $autoSendTime = null,
        $aid = null,
        $origid = null,
        $rt = null,
        $idnt = null,
        $su = null,
        $irt = null,
        $l = null,
        $f = null,
        array $headers = array(),
        array $emails = array(),
        array $timezones = array(),
        array $extras = array()
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
        if(null !== $id)
        {
            $this->setProperty('id', (int) $id);
        }
        if(null !== $forAcct)
        {
            $this->setProperty('forAcct', trim($forAcct));
        }
        if(null !== $t)
        {
            $this->setProperty('t', trim($t));
        }
        if(null !== $tn)
        {
            $this->setProperty('tn', trim($tn));
        }
        if(null !== $rgb && Text::isRgb(trim($rgb)))
        {
            $this->setProperty('rgb', trim($rgb));
        }
        if(null !== $color)
        {
            $color = (int) $color;
            $this->setProperty('color', ($color > 0 && $color < 128) ? $color : 0);
        }
        if(null !== $autoSendTime)
        {
            $this->setProperty('autoSendTime', (int) $autoSendTime);
        }
    }

    /**
     * Gets id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  int $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', (int) $id);
    }

    /**
     * Gets account ID the draft is for
     *
     * @return string
     */
    public function getDraftAccountId()
    {
        return $this->getProperty('forAcct');
    }

    /**
     * Sets account ID the draft is for
     *
     * @param  string $forAcct
     * @return self
     */
    public function setDraftAccountId($forAcct)
    {
        return $this->setProperty('forAcct', trim($forAcct));
    }

    /**
     * Gets tags
     *
     * @return string
     */
    public function getTags()
    {
        return $this->getProperty('t');
    }

    /**
     * Sets tags
     *
     * @param  string $t
     * @return self
     */
    public function setTags($t)
    {
        return $this->setProperty('t', trim($t));
    }

    /**
     * Gets tag names
     *
     * @return string
     */
    public function getTagNames()
    {
        return $this->getProperty('tn');
    }

    /**
     * Sets tag names
     *
     * @param  string $tn
     * @return self
     */
    public function setTagNames($tn)
    {
        return $this->setProperty('tn', trim($tn));
    }

    /**
     * Gets rgb
     *
     * @return string
     */
    public function getRgb()
    {
        return $this->getProperty('rgb');
    }

    /**
     * Sets rgb
     *
     * @param  string $rgb
     * @return self
     */
    public function setRgb($rgb)
    {
        return $this->setProperty('rgb', Text::isRgb(trim($rgb)) ? trim($rgb) : '');
    }

    /**
     * Gets color
     *
     * @return int
     */
    public function getColor()
    {
        return $this->getProperty('color');
    }

    /**
     * Sets color
     *
     * @param  int $color
     * @return self
     */
    public function setColor($color)
    {
        $color = (int) $color;
        return $this->setProperty('color', ($color > 0 && $color < 128) ? $color : 0);
    }

    /**
     * Gets autoSendTime
     *
     * @return int
     */
    public function getAutoSendTime()
    {
        return $this->getProperty('autoSendTime');
    }

    /**
     * Sets autoSendTime
     *
     * @param  int $autoSendTime
     * @return self
     */
    public function setAutoSendTime($autoSendTime)
    {
        return $this->setProperty('autoSendTime', (int) $autoSendTime);
    }
}
