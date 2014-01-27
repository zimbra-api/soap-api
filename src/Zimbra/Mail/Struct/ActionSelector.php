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
use Zimbra\Enum\Base as EnumBase;
use Zimbra\Struct\Base;

/**
 * ActionSelector struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class ActionSelector extends Base
{
    /**
     * Constructor method for AccountACEInfo
     * @param EnumBase $op Operation
     * @param string $id Comma separated list of item IDs to act on.
     * @param string $tcon List of characters; constrains the set of affected items in a conversation
     * @param int    $tag Tag. Deprecated - use "tn" instead
     * @param string $l Folder ID
     * @param string $rgb RGB color in format #rrggbb where r,g and b are hex digits
     * @param int    $color Color numeric; range 0-127; defaults to 0 if not present; client can display only 0-7
     * @param string $name Name
     * @param string $f Flags
     * @param string $t Tags - Comma separated list of integers. DEPRECATED - use "tn" instead
     * @param string $tn Comma-separated list of tag names
     * @return self
     */
    public function __construct(
        EnumBase $op,
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
        parent::__construct();
        $this->property('op', $op);

        if(null !== $id)
        {
            $this->property('id', trim($id));
        }
        if(null !== $tcon)
        {
            $this->property('tcon', trim($tcon));
        }
        if(null !== $l)
        {
            $this->property('l', trim($l));
        }
        if(null !== $rgb && Text::isRgb(trim($rgb)))
        {
            $this->property('rgb', trim($rgb));
        }
        if(null !== $tag)
        {
            $this->property('tag', (int) $tag);
        }
        if(null !== $color)
        {
            $color = (int) $color;
            $this->property('color', ($color > 0 && $color < 128) ? $color : 0);
        }
        if(null !== $name)
        {
            $this->property('name', trim($name));
        }
        if(null !== $f)
        {
            $this->property('f', trim($f));
        }
        if(null !== $t)
        {
            $this->property('t', trim($t));
        }
        if(null !== $tn)
        {
            $this->property('tn', trim($tn));
        }
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
            return $this->property('id');
        }
        return $this->property('id', trim($id));
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
            return $this->property('tcon');
        }
        return $this->property('tcon', trim($tcon));
    }

    /**
     * Gets or sets tag
     *
     * @param  int $tag
     * @return int|self
     */
    public function tag($tag = null)
    {
        if(null === $tag)
        {
            return $this->property('tag');
        }
        return $this->property('tag', (int) $tag);
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
        $color = (int) $color;
        return $this->property('color', ($color > 0 && $color < 128) ? $color : 0);
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
            return $this->property('name');
        }
        return $this->property('name', trim($name));
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
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'action')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'action')
    {
        return parent::toXml($name);
    }
}
