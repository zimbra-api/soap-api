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
use Zimbra\Utils\TypedSequence;

/**
 * ByDayRule struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ByDayRule
{
    /**
     * By day weekday rule specification
     * @var TypedSequence
     */
    private $_wkday;

    /**
     * Constructor method for ByDayRule
     * @param  array $wkdays
     * @return self
     */
    public function __construct(array $wkdays = array())
    {
        $this->_wkday = new TypedSequence('Zimbra\Soap\Struct\WkDay', $wkdays);
    }

    /**
     * Add xparam
     *
     * @param  WkDay $xparam
     * @return self
     */
    public function addWkDay(WkDay $wkday)
    {
        $this->_wkday->add($wkday);
        return $this;
    }

    /**
     * Gets wkday sequence
     *
     * @return Sequence
     */
    public function wkday()
    {
        return $this->_wkday;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'byday')
    {
        $name = !empty($name) ? $name : 'byday';
        $arr = array();
        if(count($this->_wkday))
        {
            $arr['wkday'] = array();
            foreach ($this->_wkday as $wkday)
            {
                $wkdayArr = $wkday->toArray('wkday');
                $arr['wkday'][] = $wkdayArr['wkday'];
            }
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'byday')
    {
        $name = !empty($name) ? $name : 'byday';
        $xml = new SimpleXML('<'.$name.' />');
        foreach ($this->_wkday as $wkday)
        {
            $xml->append($wkday->toXml('wkday'));
        }
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
