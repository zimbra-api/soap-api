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

use Zimbra\Soap\Enum\Base;
use Zimbra\Utils\SimpleXML;

/**
 * ActionSelector struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ActionSelector
{
    /**
     * Operation
     * @var Base
     */
    protected $_op;

    /**
     * Comma separated list of item IDs to act on.
     * Required except for TagActionRequest, where the tags items can be specified using their tag names as an alternative.
     * @var string
     */
    private $_id;

    /**
     * List of characters; constrains the set of affected items in a conversation
     *    t: include items in the Trash
     *    j: include items in Spam/Junk
     *    s: include items in the user's Sent folder (not necessarily "Sent")
     *    d: include items in Drafts folder
     *    o: include items in any other folder
     * A leading '-' means to negate the constraint (e.g. "-t" means all messages not in Trash)
     * @var string
     */
    private $_tcon;

    /**
    * Tag
     * Deprecated - use "tn" instead
     * @var int
     */
    private $_tag;

    /**
     * Folder ID
     * @var string
     */
    private $_l;

    /**
     * RGB color in format #rrggbb where r,g and b are hex digits
     * @var string
     */
    private $_rgb;

    /**
     * color numeric; range 0-127; defaults to 0 if not present; client can display only 0-7
     * @var int
     */
    private $_color;

    /**
     * Name
     * @var string
     */
    private $_name;

    /**
     * Flags
     * @var string
     */
    private $_f;

    /**
     * Tags - Comma separated list of integers.
     * DEPRECATED - use "tn" instead
     * @var string
     */
    private $_t;

    /**
     * Comma-separated list of tag names
     * @var string
     */
    private $_tn;

    /**
     * Constructor method for AccountACEInfo
     * @param Base $op
     * @param string $id
     * @param string $tcon
     * @param int    $tag
     * @param string $l
     * @param string $rgb
     * @param int    $color
     * @param string $name
     * @param string $f
     * @param string $t
     * @param string $tn
     * @return self
     */
    public function __construct(
        Base $op,
        $id = null,
        $tcon = null,
        $tag = null,
        $l = null,
        $rgb = null,
        $color = null,
        $name = null,
        $f = null,
        $t = null,
        $tn = null
    )
    {
        $this->_op = $op;
        $this->_id = trim($id);
        $this->_tcon = trim($tcon);
        $this->_l = trim($l);
        $this->_rgb = trim($rgb);
        if(null !== $tag)
        {
            $this->_tag = (int) $tag;
        }
        if(null !== $color)
        {
            $color = (int) $color;
            $this->_color = ($color > 0 && $color < 128) ? $color : 0;
        }
        $this->_name = trim($name);
        $this->_f = trim($f);
        $this->_t = trim($t);
        $this->_tn = trim($tn);
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
            return $this->_id;
        }
        $this->_id = trim($id);
        return $this;
    }

    /**
     * Gets or sets tcon
     *
     * @param  string $tcon
     * @return string|self
     */
    public function tcon($tcon = null)
    {
        if(null === $tcon)
        {
            return $this->_tcon;
        }
        $this->_tcon = trim($tcon);
        return $this;
    }

    /**
     * Gets or sets zid
     *
     * @param  int $zid
     * @return int|self
     */
    public function tag($tag = null)
    {
        if(null === $tag)
        {
            return $this->_tag;
        }
        $this->_tag = (int) $tag;
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
        $this->_rgb = trim($rgb);
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
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->_name;
        }
        $this->_name = trim($name);
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
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'action')
    {
        $name = !empty($name) ? $name : 'action';
        $arr = array(
            'op' => (string) $this->_op,
        );
        if(!empty($this->_id))
        {
            $arr['id'] = $this->_id;
        }
        if(!empty($this->_tcon))
        {
            $arr['tcon'] = $this->_tcon;
        }
        if(is_int($this->_tag))
        {
            $arr['tag'] = $this->_tag;
        }
        if(!empty($this->_l))
        {
            $arr['l'] = $this->_l;
        }
        if(!empty($this->_rgb))
        {
            $arr['rgb'] = $this->_rgb;
        }
        if(is_int($this->_color))
        {
            $arr['color'] = $this->_color;
        }
        if(!empty($this->_name))
        {
            $arr['name'] = $this->_name;
        }
        if(!empty($this->_f))
        {
            $arr['f'] = $this->_f;
        }
        if(!empty($this->_t))
        {
            $arr['t'] = $this->_t;
        }
        if(!empty($this->_tn))
        {
            $arr['tn'] = $this->_tn;
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'action')
    {
        $name = !empty($name) ? $name : 'action';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('op', (string) $this->_op);
        if(!empty($this->_id))
        {
            $xml->addAttribute('id', $this->_id);
        }
        if(!empty($this->_tcon))
        {
            $xml->addAttribute('tcon', $this->_tcon);
        }
        if(is_int($this->_tag))
        {
            $xml->addAttribute('tag', $this->_tag);
        }
        if(!empty($this->_l))
        {
            $xml->addAttribute('l', $this->_l);
        }
        if(!empty($this->_rgb))
        {
            $xml->addAttribute('rgb', $this->_rgb);
        }
        if(is_int($this->_color))
        {
            $xml->addAttribute('color', $this->_color);
        }
        if(!empty($this->_name))
        {
            $xml->addAttribute('name', $this->_name);
        }
        if(!empty($this->_f))
        {
            $xml->addAttribute('f', $this->_f);
        }
        if(!empty($this->_t))
        {
            $xml->addAttribute('t', $this->_t);
        }
        if(!empty($this->_tn))
        {
            $xml->addAttribute('tn', $this->_tn);
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
