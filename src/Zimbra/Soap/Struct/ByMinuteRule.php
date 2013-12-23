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
 * ByMinuteRule struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ByMinuteRule
{
    /**
     * Comma separated list of minutes where minute is a number between 0 and 59
     * @var string
     */
    private $_minlist;

    /**
     * Constructor method for ByMinuteRule
     * @param  string $minlist
     * @return self
     */
    public function __construct($minlist)
    {
        $minlist = explode(',', $minlist);
        $arr = array();
        foreach ($minlist as $min)
        {
            if(is_numeric($min))
            {
                $min = (int) $min;
                if($min >= 0 && $min < 60 && !in_array($min, $arr))
                {
                    $arr[] = $min;
                }
            }
        }
        $this->_minlist = implode(',', $arr);
    }

    /**
     * Gets or sets minlist
     *
     * @param  string $minlist
     * @return string|self
     */
    public function minlist($minlist = null)
    {
        if(null === $minlist)
        {
            return $this->_minlist;
        }
        $minlist = explode(',', $minlist);
        $arr = array();
        foreach ($minlist as $min)
        {
            if(is_numeric($min))
            {
                $min = (int) $min;
                if($min >= 0 && $min < 60 && !in_array($min, $arr))
                {
                    $arr[] = $min;
                }
            }
        }
        $this->_minlist = implode(',', $arr);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'byminute')
    {
        $name = !empty($name) ? $name : 'byminute';
        $arr = array('minlist' => $this->_minlist);
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'byminute')
    {
        $name = !empty($name) ? $name : 'byminute';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('minlist', $this->_minlist);
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
