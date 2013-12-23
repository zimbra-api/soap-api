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
 * ByWeekNoRule struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ByWeekNoRule
{
    /**
     * BYWEEKNO Week list. Format : [[+]|-]num[,...] where num is between 1 and 53
     * e.g. <byweekno wklist="1,+2,-1"/> means first week, 2nd week, and last week of the year.
     * @var string
     */
    private $_wklist;

    /**
     * Constructor method for ByWeekNoRule
     * @param  string $wklist
     * @return self
     */
    public function __construct($wklist)
    {
        $wklist = explode(',', $wklist);
        $arr = array();
        foreach ($wklist as $wk)
        {
            if(is_numeric($wk))
            {
                $wk = (int) $wk;
                if($wk != 0 && $wk > -54 && $wk < 54 && !in_array($wk, $arr))
                {
                    $arr[] = $wk;
                }
            }
        }
        $this->_wklist = implode(',', $arr);
    }

    /**
     * Gets or sets wklist
     *
     * @param  string $wklist
     * @return string|self
     */
    public function wklist($wklist = null)
    {
        if(null === $wklist)
        {
            return $this->_wklist;
        }
        $wklist = explode(',', $wklist);
        $arr = array();
        foreach ($wklist as $wk)
        {
            if(is_numeric($wk))
            {
                $wk = (int) $wk;
                if($wk != 0 && $wk > -54 && $wk < 54 && !in_array($wk, $arr))
                {
                    $arr[] = $wk;
                }
            }
        }
        $this->_wklist = implode(',', $arr);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'byweekno')
    {
        $name = !empty($name) ? $name : 'byweekno';
        $arr = array('wklist' => $this->_wklist);
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'byweekno')
    {
        $name = !empty($name) ? $name : 'byweekno';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('wklist', $this->_wklist);
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
