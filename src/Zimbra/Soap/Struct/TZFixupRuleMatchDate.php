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
 * TZFixupRuleMatchDate class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class TZFixupRuleMatchDate
{
    /**
     * Match month. Value between 1 (January) and 12 (December)
     * @var int
     */
    private $_mon;

    /**
     * Match day of month (1..31)
     * @var int
     */
    private $_mday;

    /**
     * Constructor method for TZFixupRuleMatchDate
     * @param int $mon
     * @param int $mday
     * @return self
     */
    public function __construct($mon, $mday)
    {
        $this->_mon = in_array((int) $mon, range(1, 12)) ? (int) $mon : 1;
        $this->_mday = in_array((int) $mday, range(1, 31)) ? (int) $mday : 1;
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
     * Gets or sets mday
     *
     * @param  int $mday
     * @return int|self
     */
    public function mday($mday = null)
    {
        if(null === $mday)
        {
            return $this->_mday;
        }
        $this->_mday = in_array((int) $mday, range(1, 31)) ? (int) $mday : 1;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'date')
    {
        $name = !empty($name) ? $name : 'date';
        $arr = array(
            'mon' => $this->_mon,
            'mday' => $this->_mday,
        );
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'date')
    {
        $name = !empty($name) ? $name : 'date';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('mon', $this->_mon)
            ->addAttribute('mday', $this->_mday);
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