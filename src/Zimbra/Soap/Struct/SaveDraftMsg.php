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
use Zimbra\Utils\Text;

/**
 * SaveDraftMsg struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SaveDraftMsg extends Msg
{
    /**
     * Existing draft ID
     * @var int
     */
    private $_id;

    /**
     * Account ID the draft is for
     * @var string
     */
    private $_forAcct;

    /**
     * Tags - Comma separated list of integers. DEPRECATED - use "tn" instead
     * @var string
     */
    private $_t;

    /**
     * Comma-separated list of id names
     * @var string
     */
    private $_tn;

    /**
     * RGB color in format #rrggbb where r,g and b are hex digits
     * @var string
     */
    private $_rgb;

    /**
     * Color numeric; range 0-127; defaults to 0 if not present; client can display only 0-7
     * @var int
     */
    private $_color;

    /**
     * Auto send time in milliseconds since the epoch
     * @var int
     */
    private $_autoSendTime;

    /**
     * Constructor method for Msg
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
        if(null !== $id)
        {
            $this->_id = (int) $id;
        }
        $this->_forAcct = trim($forAcct);
        $this->_t = trim($t);
        $this->_tn = trim($tn);
        $this->_rgb = Text::isRgb(trim($rgb)) ? trim($rgb) : '';
        if(null !== $color)
        {
            $color = (int) $color;
            $this->_color = ($color > 0 && $color < 128) ? $color : 0;
        }
        if(null !== $autoSendTime)
        {
            $this->_autoSendTime = (int) $autoSendTime;
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
            return $this->_id;
        }
        $this->_id = (int) $id;
        return $this;
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
            return $this->_forAcct;
        }
        $this->_forAcct = trim($forAcct);
        return $this;
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
            return $this->_t;
        }
        $this->_t = trim($t);
        return $this;
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
            return $this->_tn;
        }
        $this->_tn = trim($tn);
        return $this;
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
            return $this->_rgb;
        }
        $this->_rgb = Text::isRgb(trim($rgb)) ? trim($rgb) : '';
        return $this;
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
            return $this->_color;
        }
        $color = (int) $color;
        $this->_color = ($color > 0 && $color < 128) ? $color : 0;
        return $this;
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
            return $this->_autoSendTime;
        }
        $this->_autoSendTime = (int) $autoSendTime;
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

        if(is_int($this->_id))
        {
            $arr[$name]['id'] = $this->_id;
        }
        if(!empty($this->_forAcct))
        {
            $arr[$name]['forAcct'] = $this->_forAcct;
        }
        if(!empty($this->_t))
        {
            $arr[$name]['t'] = $this->_t;
        }
        if(!empty($this->_tn))
        {
            $arr[$name]['tn'] = $this->_tn;
        }
        if(!empty($this->_rgb))
        {
            $arr[$name]['rgb'] = $this->_rgb;
        }
        if(is_int($this->_color))
        {
            $arr[$name]['color'] = $this->_color;
        }
        if(is_int($this->_autoSendTime))
        {
            $arr[$name]['autoSendTime'] = $this->_autoSendTime;
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
        if(is_int($this->_id))
        {
            $xml->addAttribute('id', $this->_id);
        }
        if(!empty($this->_forAcct))
        {
            $xml->addAttribute('forAcct', $this->_forAcct);
        }
        if(!empty($this->_t))
        {
            $xml->addAttribute('t', $this->_t);
        }
        if(!empty($this->_tn))
        {
            $xml->addAttribute('tn', $this->_tn);
        }
        if(!empty($this->_rgb))
        {
            $xml->addAttribute('rgb', $this->_rgb);
        }
        if(is_int($this->_color))
        {
            $xml->addAttribute('color', $this->_color);
        }
        if(is_int($this->_autoSendTime))
        {
            $xml->addAttribute('autoSendTime', $this->_autoSendTime);
        }
        return $xml;
    }
}
