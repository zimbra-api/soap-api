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
 * NumAttr struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class NumAttr
{
    /**
     * Number
     * @var int
     */
    private $_num;

    /**
     * Constructor method for NumAttr
     * @param  int $num
     * @return self
     */
    public function __construct($num)
    {
        $this->_num = (int) $num;
    }

    /**
     * Gets or sets num
     *
     * @param  int $num
     * @return int|self
     */
    public function num($num = null)
    {
        if(null === $num)
        {
            return $this->_num;
        }
        $this->_num = (int) $num;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'count')
    {
        $name = !empty($name) ? $name : 'count';
        $arr = array('num' => $this->_num);
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'count')
    {
        $name = !empty($name) ? $name : 'count';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('num', $this->_num);
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
