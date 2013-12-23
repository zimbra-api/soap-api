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
 * IntervalRule struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class IntervalRule
{
    /**
     * Rule interval count - a positive integer
     * @var int
     */
    private $_ival;

    /**
     * Constructor method for IntervalRule
     * @param  int $ival
     * @return self
     */
    public function __construct($ival)
    {
        $this->_ival = abs((int) $ival);
    }

    /**
     * Gets or sets ival
     *
     * @param  int $ival
     * @return int|self
     */
    public function ival($ival = null)
    {
        if(null === $ival)
        {
            return $this->_ival;
        }
        $this->_ival = abs((int) $ival);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'interval')
    {
        $name = !empty($name) ? $name : 'interval';
        $arr = array('ival' => $this->_ival);
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'interval')
    {
        $name = !empty($name) ? $name : 'interval';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('ival', $this->_ival);
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
