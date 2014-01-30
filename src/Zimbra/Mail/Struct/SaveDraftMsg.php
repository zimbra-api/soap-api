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
     * @param array $header
     * @param MimePartInfo $mp
     * @param AttachmentsInfo $attach
     * @param InvitationInfo $inv
     * @param array $e
     * @param array $tz
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
        if(null !== $id)
        {
            $this->property('id', (int) $id);
        }
        if(null !== $forAcct)
        {
            $this->property('forAcct', trim($forAcct));
        }
        if(null !== $t)
        {
            $this->property('t', trim($t));
        }
        if(null !== $tn)
        {
            $this->property('tn', trim($tn));
        }
        if(null !== $rgb && Text::isRgb(trim($rgb)))
        {
            $this->property('rgb', trim($rgb));
        }
        if(null !== $color)
        {
            $color = (int) $color;
            $this->property('color', ($color > 0 && $color < 128) ? $color : 0);
        }
        if(null !== $autoSendTime)
        {
            $this->property('autoSendTime', (int) $autoSendTime);
        }
    }

    /**
     * Gets or sets id
     *
     * @param  int $id
     * @return int|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', (int) $id);
    }

    /**
     * Gets or sets forAcct
     *
     * @param  string $forAcct
     * @return string|self
     */
    public function forAcct($forAcct = null)
    {
        if(null === $forAcct)
        {
            return $this->property('forAcct');
        }
        return $this->property('forAcct', trim($forAcct));
    }

    /**
     * Gets or sets t
     *
     * @param  string $t
     * @return string|self
     */
    public function t($t = null)
    {
        if(null === $t)
        {
            return $this->property('t');
        }
        return $this->property('t', trim($t));
    }

    /**
     * Gets or sets tn
     *
     * @param  string $tn
     * @return string|self
     */
    public function tn($tn = null)
    {
        if(null === $tn)
        {
            return $this->property('tn');
        }
        return $this->property('tn', trim($tn));
    }

    /**
     * Gets or sets rgb
     *
     * @param  string $rgb
     * @return string|self
     */
    public function rgb($rgb = null)
    {
        if(null === $rgb)
        {
            return $this->property('rgb');
        }
        return $this->property('rgb', Text::isRgb(trim($rgb)) ? trim($rgb) : '');
    }

    /**
     * Gets or sets color
     *
     * @param  int $color
     * @return int|self
     */
    public function color($color = null)
    {
        if(null === $color)
        {
            return $this->property('color');
        }
        return $this->property('color', ($color > 0 && $color < 128) ? $color : 0);
    }

    /**
     * Gets or sets autoSendTime
     *
     * @param  int $autoSendTime
     * @return int|self
     */
    public function autoSendTime($autoSendTime = null)
    {
        if(null === $autoSendTime)
        {
            return $this->property('autoSendTime');
        }
        return $this->property('autoSendTime', (int) $autoSendTime);
    }
}
