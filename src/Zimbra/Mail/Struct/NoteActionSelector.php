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

use Zimbra\Enum\ItemActionOp;

/**
 * NoteActionSelector struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 op Nguyen Van Nguyen.
 */
class NoteActionSelector extends ActionSelector
{
    /**
     * Constructor method for AccountACEInfo
     * @param ItemActionOp $op
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
     * @param string $content
     * @param string $pos
     * @return self
     */
    public function __construct(
        ItemActionOp $op,
        $id = null,
        $tcon = null,
        $tag = null,
        $l = null,
        $rgb = null,
        $color = null,
        $name = null,
        $f = null,
        $t = null,
        $tn = null,
        $content = null,
        $pos = null
    )
    {
        parent::__construct(
            $op,
            $id,
            $tcon,
            $tag,
            $l,
            $rgb,
            $color,
            $name,
            $f,
            $t,
            $tn
        );
        if(null !== $content)
        {
            $this->property('content', trim($content));
        }
        if(null !== $pos)
        {
            $this->property('pos', trim($pos));
        }
    }

    /**
     * Gets or sets op
     *
     * @param  ItemActionOp $op
     * @return ItemActionOp|self
     */
    public function op(ItemActionOp $op = null)
    {
        if(null === $op)
        {
            return $this->property('op');
        }
        return $this->property('op', $op);
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
            return $this->property('content');
        }
        return $this->property('content', trim($content));
    }

    /**
     * Gets or sets pos
     * Bounds - x,y[width,height] where x,y,width and height are all integers
     *
     * @param  string $pos
     * @return string|self
     */
    public function pos($pos = null)
    {
        if(null === $pos)
        {
            return $this->property('pos');
        }
        return $this->property('pos', trim($pos));
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
