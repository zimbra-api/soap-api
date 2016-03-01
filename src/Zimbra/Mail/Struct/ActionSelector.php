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
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ActionSelector extends Base
{
    /**
     * Constructor method for AccountACEInfo
     * @param EnumBase $operation Operation
     * @param string $ids Comma separated list of item IDs to act on.
     * @param string $constraint List of characters; constrains the set of affected items in a conversation
     * @param int    $tag Tag. Deprecated - use "tn" instead
     * @param string $folder Folder ID
     * @param string $rgb RGB color in format #rrggbb where r,g and b are hex digits
     * @param int    $color Color numeric; range 0-127; defaults to 0 if not present; client can display only 0-7
     * @param string $name Name
     * @param string $flags Flags
     * @param string $tags Tags - Comma separated list of integers. DEPRECATED - use "tn" instead
     * @param string $tagNames Comma-separated list of tag names
     * @return self
     */
    public function __construct(
        EnumBase $operation,
        $ids = null,
        $constraint = null,
        $tag = null,
        $folder = null,
        $rgb = null,
        $color = null,
        $name = null,
        $flags = null,
        $tags = null,
        $tagNames = null
    )
    {
        parent::__construct();
        $this->setProperty('op', $operation);

        if(null !== $ids)
        {
            $this->setProperty('id', trim($ids));
        }
        if(null !== $constraint)
        {
            $this->setProperty('tcon', trim($constraint));
        }
        if(null !== $tag)
        {
            $this->setProperty('tag', (int) $tag);
        }
        if(null !== $folder)
        {
            $this->setProperty('l', trim($folder));
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
        if(null !== $name)
        {
            $this->setProperty('name', trim($name));
        }
        if(null !== $flags)
        {
            $this->setProperty('f', trim($flags));
        }
        if(null !== $tags)
        {
            $this->setProperty('t', trim($tags));
        }
        if(null !== $tagNames)
        {
            $this->setProperty('tn', trim($tagNames));
        }
    }

    /**
     * Gets ids
     *
     * @return string
     */
    public function getIds()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets ids
     *
     * @param  string $ids
     * @return self
     */
    public function setIds($ids)
    {
        return $this->setProperty('id', trim($ids));
    }

    /**
     * Gets constraint
     *
     * @return string
     */
    public function getConstraint()
    {
        return $this->getProperty('tcon');
    }

    /**
     * Sets constraint
     *
     * @param  string $constraint
     * @return string|self
     */
    public function setConstraint($constraint)
    {
        return $this->setProperty('tcon', trim($constraint));
    }

    /**
     * Gets tag
     *
     * @return int
     */
    public function getTag()
    {
        return $this->getProperty('tag');
    }

    /**
     * Sets tag
     *
     * @param  int $tag
     * @return self
     */
    public function setTag($tag)
    {
        return $this->setProperty('tag', (int) $tag);
    }

    /**
     * Gets folder id
     *
     * @return string
     */
    public function getFolder()
    {
        return $this->getProperty('l');
    }

    /**
     * Sets folder id
     *
     * @param  string $folder
     * @return self
     */
    public function setFolder($folder)
    {
        return $this->setProperty('l', trim($folder));
    }

    /**
     * Gets rgb color
     *
     * @return string
     */
    public function getRgb()
    {
        return $this->getProperty('rgb');
    }

    /**
     * Sets rgb color
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
        return $this->setProperty('color', ($color > 0 && $color < 128) ? $color : 0);
    }

    /**
     * Gets tag name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets tag name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets flags
     *
     * @return string
     */
    public function getFlags()
    {
        return $this->getProperty('f');
    }

    /**
     * Sets flags
     *
     * @param  string $flags
     * @return self
     */
    public function setFlags($flags)
    {
        return $this->setProperty('f', trim($flags));
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
     * @param  string $tags
     * @return self
     */
    public function setTags($tags)
    {
        return $this->setProperty('t', trim($tags));
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
     * @param  string $tagNames
     * @return self
     */
    public function setTagNames($tagNames)
    {
        return $this->setProperty('tn', trim($tagNames));
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
