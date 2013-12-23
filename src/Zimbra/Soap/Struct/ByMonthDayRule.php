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
 * ByMonthDayRule struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ByMonthDayRule
{
    /**
     * Comma separated list of day numbers from either the start (positive) or the end (negative) of the month - format : [[+]|-]num[,...] where num between 1 to 31 
     * e.g. modaylist="1,+2,-7" means first day of the month, plus the 2nd day of the month, plus the 7th from last day of the month.
     * @var string
     */
    private $_modaylist;

    /**
     * Constructor method for ByMonthDayRule
     * @param  string $modaylist
     * @return self
     */
    public function __construct($modaylist)
    {
        $modaylist = explode(',', $modaylist);
        $arr = array();
        foreach ($modaylist as $day)
        {
            if(is_numeric($day))
            {
                $day = (int) $day;
                if($day != 0 && $day > -32 && $day < 32 && !in_array($day, $arr))
                {
                    $arr[] = $day;
                }
            }
        }
        $this->_modaylist = implode(',', $arr);
    }

    /**
     * Gets or sets modaylist
     *
     * @param  string $modaylist
     * @return string|self
     */
    public function modaylist($modaylist = null)
    {
        if(null === $modaylist)
        {
            return $this->_modaylist;
        }
        $modaylist = explode(',', $modaylist);
        $arr = array();
        foreach ($modaylist as $day)
        {
            if(is_numeric($day))
            {
                $day = (int) $day;
                if($day != 0 && $day > -32 && $day < 32 && !in_array($day, $arr))
                {
                    $arr[] = $day;
                }
            }
        }
        $this->_modaylist = implode(',', $arr);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'bymonthday')
    {
        $name = !empty($name) ? $name : 'bymonthday';
        $arr = array('modaylist' => $this->_modaylist);
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'bymonthday')
    {
        $name = !empty($name) ? $name : 'bymonthday';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('modaylist', $this->_modaylist);
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
