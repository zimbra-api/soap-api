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
 * BySetPosRule struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class BySetPosRule
{
    /**
     * Format [[+]|-]num[,...] where num is from 1 to 366 
     * <bysetpos> MUST only be used in conjunction with another <byXXX> element.
     * @var string
     */
    private $_poslist;

    /**
     * Constructor method for BySetPosRule
     * @param  string $poslist
     * @return self
     */
    public function __construct($poslist)
    {
        $poslist = explode(',', $poslist);
        $arr = array();
        foreach ($poslist as $day)
        {
            if(is_numeric($day))
            {
                $day = (int) $day;
                if($day != 0 && $day > -367 && $day < 367 && !in_array($day, $arr))
                {
                    $arr[] = $day;
                }
            }
        }
        $this->_poslist = implode(',', $arr);
    }

    /**
     * Gets or sets poslist
     *
     * @param  string $poslist
     * @return string|self
     */
    public function poslist($poslist = null)
    {
        if(null === $poslist)
        {
            return $this->_poslist;
        }
        $poslist = explode(',', $poslist);
        $arr = array();
        foreach ($poslist as $day)
        {
            if(is_numeric($day))
            {
                $day = (int) $day;
                if($day != 0 && $day > -367 && $day < 367 && !in_array($day, $arr))
                {
                    $arr[] = $day;
                }
            }
        }
        $this->_poslist = implode(',', $arr);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'bysetpos')
    {
        $name = !empty($name) ? $name : 'bysetpos';
        $arr = array('poslist' => $this->_poslist);
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'bysetpos')
    {
        $name = !empty($name) ? $name : 'bysetpos';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('poslist', $this->_poslist);
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
