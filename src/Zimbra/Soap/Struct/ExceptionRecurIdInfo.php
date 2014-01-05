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
 * ExceptionRecurIdInfo struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ExceptionRecurIdInfo
{
    /**
     * Date and/or time. Format is : YYYYMMDD['T'HHMMSS[Z]]
     * e.g:
     *     20050612  June 12, 2005
     *     20050315T18302305Z  March 15, 2005 6:30:23.05 PM UTC
     * @var string
     */
    private $_d;

    /**
     * Java timezone identifier
     * @var string
     */
    private $_tz;

    /**
     * Range type - 1 means NONE, 2 means THISANDFUTURE, 3 means THISANDPRIOR
     * @var int
     */
    private $_rangeType;

    /**
     * Constructor method for ExceptionRecurIdInfo
     * @param  string $uid
     * @param  string $value
     * @return self
     */
    public function __construct($d, $tz = null, $rangeType = null)
    {
        $this->_d = trim($d);
        $this->_tz = trim($tz);
        if(null !== $rangeType)
        {
            $this->_rangeType = in_array((int) $rangeType, array(-1, 2, 3)) ? (int) $rangeType : null;
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
     * Gets or sets rangeType
     *
     * @param  int $rangeType
     * @return int|self
     */
    public function rangeType($rangeType = null)
    {
        if(null === $rangeType)
        {
            return $this->_rangeType;
        }
        $this->_rangeType = in_array((int) $rangeType, array(-1, 2, 3)) ? (int) $rangeType : null;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'exceptId')
    {
        $name = !empty($name) ? $name : 'exceptId';
        $arr = array(
            'd' => $this->_d
        );
        if(!empty($this->_tz))
        {
            $arr['tz'] = $this->_tz;
        }
        if(is_int($this->_rangeType))
        {
            $arr['rangeType'] = $this->_rangeType;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'exceptId')
    {
        $name = !empty($name) ? $name : 'exceptId';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('d', $this->_d);
        if(!empty($this->_tz))
        {
            $xml->addAttribute('tz', $this->_tz);
        }
        if(is_int($this->_rangeType))
        {
            $xml->addAttribute('rangeType', $this->_rangeType);
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