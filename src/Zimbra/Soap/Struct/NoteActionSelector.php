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

use Zimbra\Soap\Enum\ItemActionOp;

/**
 * NoteActionSelector struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class NoteActionSelector extends ActionSelector
{
    /**
     * Content
     * @var DocumentActionGrant
     */
    private $_content;

    /**
     * Bounds - x,y[width,height] where x,y,width and height are all integers
     * @var string
     */
    private $_pos;

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
     * @param DocumentActionGrant $content
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
        $this->_content = trim($content);
        $this->_pos = trim($pos);
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
            return $this->_op;
        }
        $this->_op = $op;
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
     * Gets or sets pos
     *
     * @param  string $pos
     * @return string|self
     */
    public function pos($pos = null)
    {
        if(null === $pos)
        {
            return $this->_pos;
        }
        $this->_pos = trim($pos);
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
        $arr = parent::toArray($name);
        if(!empty($this->_content))
        {
            $arr[$name]['content'] = $this->_content;
        }
        if(!empty($this->_pos))
        {
            $arr[$name]['pos'] = $this->_pos;
        }

        return $arr;
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
        $xml = parent::toXml($name);
        if(!empty($this->_pos))
        {
            $xml->addAttribute('pos', $this->_pos);
        }
        if(!empty($this->_content))
        {
            $xml->addAttribute('content', $this->_content);
        }
        return $xml;
    }
}
