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
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
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
        $this->property('l', trim($l));
        $this->property('content', trim($content));
        if(null !== $color)
        {
            $color = (int) $color;
            $this->property('color', ($color > 0 && $color < 128) ? $color : 0);
        }
        if(null !== $pos)
        {
            $this->property('pos', trim($pos));
        }
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
     * Gets or sets pos
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
