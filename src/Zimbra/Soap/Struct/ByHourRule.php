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
 * ByHourRule struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ByHourRule
{
    /**
     * Comma separated list of hours where hour is a number between 0 and 23
     * @var string
     */
    private $_hrlist;

    /**
     * Constructor method for ByHourRule
     * @param  string $hrlist
     * @return self
     */
    public function __construct($hrlist)
    {
        $hrlist = explode(',', $hrlist);
        $arr = array();
        foreach ($hrlist as $hr)
        {
            if(is_numeric($hr))
            {
                $hr = (int) $hr;
                if($hr >= 0 && $hr < 24 && !in_array($hr, $arr))
                {
                    $arr[] = $hr;
                }
            }
        }
        $this->_hrlist = implode(',', $arr);
    }

    /**
     * Gets or sets hrlist
     *
     * @param  string $hrlist
     * @return string|self
     */
    public function hrlist($hrlist = null)
    {
        if(null === $hrlist)
        {
            return $this->_hrlist;
        }
        $hrlist = explode(',', $hrlist);
        $arr = array();
        foreach ($hrlist as $hr)
        {
            if(is_numeric($hr))
            {
                $hr = (int) $hr;
                if($hr >= 0 && $hr < 24 && !in_array($hr, $arr))
                {
                    $arr[] = $hr;
                }
            }
        }
        $this->_hrlist = implode(',', $arr);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'byhour')
    {
        $name = !empty($name) ? $name : 'byhour';
        $arr = array('hrlist' => $this->_hrlist);
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'byhour')
    {
        $name = !empty($name) ? $name : 'byhour';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('hrlist', $this->_hrlist);
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
