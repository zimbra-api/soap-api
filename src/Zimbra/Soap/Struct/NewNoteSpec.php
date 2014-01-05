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

/**
 * NewNoteSpec struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class NewNoteSpec
{
    /**
     * Parent Folder ID
     * @var string
     */
    private $_l;

    /**
     * Content
     * @var string
     */
    private $_content;

    /**
     * Color numeric; range 0-127; defaults to 0 if not present; client can display only 0-7
     * @var int
     */
    private $_color;

    /**
     * Bounds - x,y[width,height] where x,y,width and height are all integers
     * @var string
     */
    private $_pos;

    /**
     * Constructor method for NewNoteSpec
     * @param string $l
     * @param string $content
     * @param int $color
     * @param string $pos
     * @return self
     */
    public function __construct(
        $l,
        $content,
        $color = null,
        $pos = null
    )
    {
        $this->_l = trim($l);
        $this->_content = trim($content);
        if(null !== $color)
        {
            $color = (int) $color;
            $this->_color = ($color > 0 && $color < 128) ? $color : 0;
        }
        $this->_pos = trim($pos);
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
    public function toArray($name = 'note')
    {
        $name = !empty($name) ? $name : 'note';
        $arr = array(
            'l' => $this->_l,
            'content' => $this->_content,
        );
        if(is_int($this->_color))
        {
            $arr['color'] = $this->_color;
        }
        if(!empty($this->_pos))
        {
            $arr['pos'] = $this->_pos;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'note')
    {
        $name = !empty($name) ? $name : 'note';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('l', $this->_l)
            ->addAttribute('content', $this->_content);
        if(is_int($this->_color))
        {
            $xml->addAttribute('color', $this->_color);
        }
        if(!empty($this->_pos))
        {
            $xml->addAttribute('pos', $this->_pos);
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
