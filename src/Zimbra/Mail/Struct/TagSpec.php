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
use Zimbra\Struct\Base;

/**
 * TagSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class TagSpec extends Base
{
    /**
     * Constructor method for TagSpec
     * @param string $name Tag name
     * @param string $rgb RGB color in format #rrggbb where r,g and b are hex digits
     * @param int $color Color numeric; range 0-127; defaults to 0 if not present; client can display only 0-7
     * @return self
     */
    public function __construct(
        $name,
        $rgb = null,
        $color = null
    )
    {
        parent::__construct();
        $this->setProperty('name', trim($name));
        if(null !== $rgb && Text::isRgb(trim($rgb)))
        {
            $this->setProperty('rgb', trim($rgb));
        }
        if(null !== $color)
        {
            $color = (int) $color;
            $this->setProperty('color', ($color > 0 && $color < 128) ? $color : 0);
        }
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets rgb
     *
     * @return string
     */
    public function getRgb()
    {
        return $this->getProperty('rgb');
    }

    /**
     * Sets rgb
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
        $color = (int) $color;
        return $this->setProperty('color', ($color > 0 && $color < 128) ? $color : 0);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'tag')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'tag')
    {
        return parent::toXml($name);
    }
}
