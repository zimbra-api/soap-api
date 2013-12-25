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
 * InstanceRecurIdInfo struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class InstanceRecurIdInfo
{
    /**
     * Range - THISANDFUTURE|THISANDPRIOR
     * @var string
     */
    protected $_range;

    /**
     * Date and/or time. Format is : YYYYMMDD['T'HHMMSS[Z]] 
     * e.g:
     *    20050612  June 12, 2005
     *    20050315T18302305Z  March 15, 2005 6:30:23.05 PM UTC
     * @var string
     */
    protected $_d;

    /**
     * Java timezone identifier
     * @var string
     */
    protected $_tz;

    /**
     * Constructor method for AccountACEInfo
     * @param string $range
     * @param string $d
     * @param string $tz
     * @return self
     */
    public function __construct(
        $range = null,
        $d = null,
        $tz = null
    )
    {
        $this->_range = trim($range);
        $this->_d = trim($d);
        $this->_tz = trim($tz);
    }

    /**
     * Gets or sets range
     *
     * @param  string $range
     * @return string|self
     */
    public function range($range = null)
    {
        if(null === $range)
        {
            return $this->_range;
        }
        $this->_range = trim($range);
        return $this;
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
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'inst')
    {
        $name = !empty($name) ? $name : 'inst';
        if(!empty($this->_range))
        {
            $arr['range'] = $this->_range;
        }
        if(!empty($this->_d))
        {
            $arr['d'] = $this->_d;
        }
        if(!empty($this->_tz))
        {
            $arr['tz'] = $this->_tz;
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'inst')
    {
        $name = !empty($name) ? $name : 'inst';
        $xml = new SimpleXML('<'.$name.' />');
        if(!empty($this->_range))
        {
            $xml->addAttribute('range', $this->_range);
        }
        if(!empty($this->_d))
        {
            $xml->addAttribute('d', $this->_d);
        }
        if(!empty($this->_tz))
        {
            $xml->addAttribute('tz', $this->_tz);
        }
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
