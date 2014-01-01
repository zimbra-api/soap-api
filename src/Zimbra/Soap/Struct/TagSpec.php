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
 * TagSpec struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class TagSpec
{
    /**
     * Tag name
     * @var string
     */
    private $_name;

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
     * Constructor method for TagSpec
     * @param string $name
     * @param string $rgb
     * @param int $color
     * @return self
     */
    public function __construct(
        $name,
        $rgb = null,
        $color = null
    )
    {
        $this->_name = trim($name);
        $this->_rgb = Text::isRgb(trim($rgb)) ? trim($rgb) : '';
        if(null !== $color)
        {
            $color = (int) $color;
            $this->_color = ($color > 0 && $color < 128) ? $color : 0;
        }
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
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'tag')
    {
        $name = !empty($name) ? $name : 'tag';
        $arr = array(
            'name' => $this->_name,
        );
        if(!empty($this->_rgb))
        {
            $arr['rgb'] = $this->_rgb;
        }
        if(is_int($this->_color))
        {
            $arr['color'] = $this->_color;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'tag')
    {
        $name = !empty($name) ? $name : 'tag';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('name', $this->_name);
        if(!empty($this->_rgb))
        {
            $xml->addAttribute('rgb', $this->_rgb);
        }
        if(is_int($this->_color))
        {
            $xml->addAttribute('color', $this->_color);
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
