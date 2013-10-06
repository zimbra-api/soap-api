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
 * TZFixupRuleMatchRule class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class TZFixupRuleMatchRule
{
    /**
     * Match month. Value between 1 (January) and 12 (December)
     * @var int
     */
    private $_mon;

    /**
     * Match week. -1 means last week of month else between 1 and 4
     * @var int
     */
    private $_week;

    /**
     * Match week day. Value between 1 (Sunday) and 7 (Saturday)
     * @var int
     */
    private $_wkday;

    /**
     * Constructor method for TZFixupRuleMatchRule
     * @param int $mon
     * @param int $week
     * @param int $wkday
     * @return self
     */
    public function __construct($mon, $week, $wkday)
    {
        $this->_mon = in_array((int) $mon, range(1, 12)) ? (int) $mon : 1;
        $this->_week = in_array((int) $week, array(1, 2, 3, 4)) ? (int) $week : -1;
        $this->_wkday = in_array((int) $wkday, range(1, 7)) ? (int) $wkday : 1;
    }

    /**
     * Gets or sets mon
     *
     * @param  int $mon
     * @return int|self
     */
    public function mon($mon = null)
    {
        if(null === $mon)
        {
            return $this->_mon;
        }
        $this->_mon = in_array((int) $mon, range(1, 12)) ? (int) $mon : 1;
        return $this;
    }

    /**
     * Gets or sets week
     *
     * @param  int $week
     * @return int|self
     */
    public function week($week = null)
    {
        if(null === $week)
        {
            return $this->_week;
        }
        $this->_week = in_array((int) $week, array(1, 2, 3, 4)) ? (int) $week : -1;
        return $this;
    }

    /**
     * Gets or sets wkday
     *
     * @param  int $wkday
     * @return int|self
     */
    public function wkday($wkday = null)
    {
        if(null === $wkday)
        {
            return $this->_wkday;
        }
        $this->_wkday = in_array((int) $wkday, range(1, 7)) ? (int) $wkday : 1;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'rule')
    {
        $name = !empty($name) ? $name : 'rule';
        $arr = array(
            'mon' => $this->_mon,
            'week' => $this->_week,
            'wkday' => $this->_wkday,
        );
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'rule')
    {
        $name = !empty($name) ? $name : 'rule';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('mon', $this->_mon)
            ->addAttribute('week', $this->_week)
            ->addAttribute('wkday', $this->_wkday);
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