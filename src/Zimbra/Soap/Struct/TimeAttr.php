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
 * TimeAttr class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class TimeAttr
{
    /**
     * timestamp
     * @var string
     */
    private $_time;

    /**
     * Constructor method for TimeAttr
     * @param  string $time
     * @return self
     */
    public function __construct($time)
    {
        $this->_time = trim($time);
    }

    /**
     * Gets or sets time
     *
     * @param  string $time
     * @return string|self
     */
    public function time($time = null)
    {
        if(null === $time)
        {
            return $this->_time;
        }
        $this->_time = trim($time);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'attr')
    {
        $name = !empty($name) ? $name : 'attr';
        $arr = array(
            'time' => $this->_time
        );
        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'attr')
    {
        $name = !empty($name) ? $name : 'attr';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('time', $this->_time);
        return $xml;
    }

    /**
     * Method returning the xml string representative this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
