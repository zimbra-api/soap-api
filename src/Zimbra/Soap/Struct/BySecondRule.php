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
 * BySecondRule struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class BySecondRule
{
    /**
     * Comma separated list of seconds where second is a number between 0 and 59
     * @var string
     */
    private $_seclist;

    /**
     * Constructor method for BySecondRule
     * @param  string $seclist
     * @return self
     */
    public function __construct($seclist)
    {
        $seclist = explode(',', $seclist);
        $arr = array();
        foreach ($seclist as $sec)
        {
            if(is_numeric($sec))
            {
                $sec = (int) $sec;
                if($sec >= 0 && $sec < 60 && !in_array($sec, $arr))
                {
                    $arr[] = $sec;
                }
            }
        }
        $this->_seclist = implode(',', $arr);
    }

    /**
     * Gets or sets seclist
     *
     * @param  string $seclist
     * @return string|self
     */
    public function seclist($seclist = null)
    {
        if(null === $seclist)
        {
            return $this->_seclist;
        }
        $seclist = explode(',', $seclist);
        $arr = array();
        foreach ($seclist as $sec)
        {
            if(is_numeric($sec))
            {
                $sec = (int) $sec;
                if($sec >= 0 && $sec < 60 && !in_array($sec, $arr))
                {
                    $arr[] = $sec;
                }
            }
        }
        $this->_seclist = implode(',', $arr);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'bysecond')
    {
        $name = !empty($name) ? $name : 'bysecond';
        $arr = array('seclist' => $this->_seclist);
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'bysecond')
    {
        $name = !empty($name) ? $name : 'bysecond';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('seclist', $this->_seclist);
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
