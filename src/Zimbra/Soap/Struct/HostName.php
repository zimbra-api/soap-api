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
 * HostName class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class HostName
{
    /**
     * Hostname
     * @var string
     */
    private $_hn;

    /**
     * Constructor method for HostName
     * @param  string $hn
     * @return self
     */
    public function __construct($hn)
    {
        $this->_hn = trim($hn);
    }

    /**
     * Gets or sets hn
     *
     * @param  string $hn
     * @return string|self
     */
    public function hn($hn = null)
    {
        if(null === $hn)
        {
            return $this->_hn;
        }
        $this->_hn = trim($hn);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'hostname')
    {
        $name = !empty($name) ? $name : 'hostname';
        $arr = array(
            'hn' => $this->_hn,
        );
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'hostname')
    {
        $name = !empty($name) ? $name : 'hostname';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('hn', $this->_hn);
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
