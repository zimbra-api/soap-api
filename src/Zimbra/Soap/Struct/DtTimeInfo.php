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
 * DtTimeInfo struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DtTimeInfo
{
    /**
     * Date and/or time. Format is : YYYYMMDD['T'HHMMSS[Z]] 
     * @var string
     */
    private $_d;

    /**
     * Java timezone identifier
     * @var string
     */
    private $_tz;

    /**
     * UTC time as milliseconds since the epoch. Set if non-all-day
     * @var int
     */
    private $_u;

    /**
     * Constructor method for DtTimeInfo
     * @param string $d
     * @param string $tz
     * @param int $u
     * @return self
     */
    public function __construct(
        $d = null,
        $tz = null,
        $u = null
    )
    {
        $this->_d = trim($d);
        $this->_tz = trim($tz);
        if(null !== $u)
        {
	        $this->_u = (int) $u;
        }
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
     * Gets or sets tz
     *
     * @param  string $tz
     * @return string|self
     */
    public function tz($tz = null)
    {
        if(null === $tz)
        {
            return $this->_tz;
        }
        $this->_tz = trim($tz);
        return $this;
    }

    /**
     * Gets or sets u
     *
     * @param  int $u
     * @return int|self
     */
    public function u($u = null)
    {
        if(null === $u)
        {
            return $this->_u;
        }
        $this->_u = (int) $u;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'dt')
    {
        $name = !empty($name) ? $name : 'dt';
        if(!empty($this->_d))
        {
            $arr['d'] = $this->_d;
        }
        if(!empty($this->_tz))
        {
            $arr['tz'] = $this->_tz;
        }
        if(is_int($this->_u))
        {
            $arr['u'] = $this->_u;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'dt')
    {
        $name = !empty($name) ? $name : 'dt';
        $xml = new SimpleXML('<'.$name.' />');
        if(!empty($this->_d))
        {
            $xml->addAttribute('d', $this->_d);
        }
        if(!empty($this->_tz))
        {
            $xml->addAttribute('tz', $this->_tz);
        }
        if(is_int($this->_u))
        {
            $xml->addAttribute('u', $this->_u);
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