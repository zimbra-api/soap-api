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
 * DateTimeStringAttr struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DateTimeStringAttr
{
    /**
     * Date in format : YYYYMMDD[ThhmmssZ]
     * @var string
     */
    private $_d;

    /**
     * Constructor method for DateTimeStringAttr
     * @param  string $d
     * @return self
     */
    public function __construct($d)
    {
        $this->_d = trim($d);
    }

    /**
     * Gets or sets d
     *
     * @param  string $d
     * @return string|self
     */
    public function d($d = null)
    {
        if(null === $d)
        {
            return $this->_d;
        }
        $this->_d = trim($d);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'until')
    {
        $name = !empty($name) ? $name : 'until';
        $arr = array('d' => $this->_d);
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'until')
    {
        $name = !empty($name) ? $name : 'until';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('d', $this->_d);
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
