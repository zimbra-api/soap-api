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
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
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
            $this->setProperty('content', trim($content));
        }
        if(null !== $pos)
        {
            $this->setProperty('pos', trim($pos));
        }
    }

    /**
     * Gets operation
     *
     * @return ItemActionOp
     */
    public function getOperation()
    {
        return $this->getProperty('op');
    }

    /**
     * Sets operation
     *
     * @param  ItemActionOp $op
     * @return self
     */
    public function setOperation(ItemActionOp $op)
    {
        return $this->setProperty('op', $op);
    }

    /**
     * Gets content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->getProperty('content');
    }

    /**
     * Sets content
     *
     * @param  string $content
     * @return self
     */
    public function setContent($content)
    {
        return $this->setProperty('content', trim($content));
    }

    /**
     * Gets bounds - x,y [width,height]
     *
     * @return string
     */
    public function getBounds()
    {
        return $this->getProperty('pos');
    }

    /**
     * Sets bounds - x,y [width,height]
     *
     * @param  string $pos
     * @return self
     */
    public function setBounds($pos)
    {
        return $this->setProperty('pos', trim($pos));
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
