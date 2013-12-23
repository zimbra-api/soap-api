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
 * ByYearDayRule struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ByYearDayRule
{
    /**
     * BYYEARDAY yearday list. Format : [[+]|-]num[,...]" where num is between 1 and 366
     * e.g. <byyearday yrdaylist="1,+2,-1"/> means January 1st, January 2nd, and December 31st.
     * @var string
     */
    private $_yrdaylist;

    /**
     * Constructor method for ByYearDayRule
     * @param  string $yrdaylist
     * @return self
     */
    public function __construct($yrdaylist)
    {
        $yrdaylist = explode(',', $yrdaylist);
        $arr = array();
        foreach ($yrdaylist as $day)
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
        $this->_yrdaylist = implode(',', $arr);
    }

    /**
     * Gets or sets yrdaylist
     *
     * @param  string $yrdaylist
     * @return string|self
     */
    public function yrdaylist($yrdaylist = null)
    {
        if(null === $yrdaylist)
        {
            return $this->_yrdaylist;
        }
        $yrdaylist = explode(',', $yrdaylist);
        $arr = array();
        foreach ($yrdaylist as $day)
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
        $this->_yrdaylist = implode(',', $arr);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'byyearday')
    {
        $name = !empty($name) ? $name : 'byyearday';
        $arr = array('yrdaylist' => $this->_yrdaylist);
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'byyearday')
    {
        $name = !empty($name) ? $name : 'byyearday';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('yrdaylist', $this->_yrdaylist);
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
