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

use Zimbra\Struct\Base;

/**
 * NewNoteSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class NewNoteSpec extends Base
{
    /**
     * Constructor method for NewNoteSpec
     * @param string $l Parent Folder ID
     * @param string $content Content
     * @param int $color Color numeric; range 0-127; defaults to 0 if not present; client can display only 0-7
     * @param string $pos Bounds - x,y[width,height] where x,y,width and height are all integers
     * @return self
     */
    public function __construct(
        $l,
        $content,
        $color = null,
        $pos = null
    )
    {
        parent::__construct();
        $this->setProperty('l', trim($l));
        $this->setProperty('content', trim($content));
        if(null !== $color)
        {
            $color = (int) $color;
            $this->setProperty('color', ($color > 0 && $color < 128) ? $color : 0);
        }
        if(null !== $pos)
        {
            $this->setProperty('pos', trim($pos));
        }
    }

    /**
     * Gets folder
     *
     * @return string
     */
    public function getFolder()
    {
        return $this->getProperty('l');
    }

    /**
     * Sets folder
     *
     * @param  string $l
     * @return self
     */
    public function setFolder($l)
    {
        return $this->setProperty('l', trim($l));
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
    public function toArray($name = 'note')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'note')
    {
        return parent::toXml($name);
    }
}
