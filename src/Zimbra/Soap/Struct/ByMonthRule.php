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
 * ByMonthRule struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ByMonthRule
{
    /**
     * Comma separated list of months where month is a number between 1 and 12
     * @var string
     */
    private $_molist;

    /**
     * Constructor method for ByMonthRule
     * @param  string $molist
     * @return self
     */
    public function __construct($molist)
    {
        $molist = explode(',', $molist);
        $arr = array();
        foreach ($molist as $mo)
        {
            if(is_numeric($mo))
            {
                $mo = (int) $mo;
                if($mo > 0 && $mo < 13 && !in_array($mo, $arr))
                {
                    $arr[] = $mo;
                }
            }
        }
        $this->_molist = implode(',', $arr);
    }

    /**
     * Gets or sets molist
     *
     * @param  string $molist
     * @return string|self
     */
    public function molist($molist = null)
    {
        if(null === $molist)
        {
            return $this->_molist;
        }
        $molist = explode(',', $molist);
        $arr = array();
        foreach ($molist as $mo)
        {
            if(is_numeric($mo))
            {
                $mo = (int) $mo;
                if($mo > 0 && $mo < 13 && !in_array($mo, $arr))
                {
                    $arr[] = $mo;
                }
            }
        }
        $this->_molist = implode(',', $arr);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'bymonth')
    {
        $name = !empty($name) ? $name : 'bymonth';
        $arr = array('molist' => $this->_molist);
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'bymonth')
    {
        $name = !empty($name) ? $name : 'bymonth';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('molist', $this->_molist);
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
