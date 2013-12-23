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
 * DtVal struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DtVal
{
    /**
     * Start DATE-TIME
     * @var DtTimeInfo
     */
    private $_s;

    /**
     * End DATE-TIME 
     * @var DtTimeInfo
     */
    private $_e;

    /**
     * Duration information
     * @var DurationInfo
     */
    private $_dur;

    /**
     * Constructor method for DtVal
     * @param DtTimeInfo $s
     * @param DtTimeInfo $e
     * @param DurationInfo $dur
     * @return self
     */
    public function __construct(
        DtTimeInfo $s = null,
        DtTimeInfo $e = null,
        DurationInfo $dur = null
    )
    {
        if($s instanceof DtTimeInfo)
        {
            $this->_s = $s;
        }
        if($e instanceof DtTimeInfo)
        {
            $this->_e = $e;
        }
        if($dur instanceof DurationInfo)
        {
            $this->_dur = $dur;
        }
    }

    /**
     * Gets or sets s
     *
     * @param  DtTimeInfo $s
     * @return DtTimeInfo|self
     */
    public function s(DtTimeInfo $s = null)
    {
        if(null === $s)
        {
            return $this->_s;
        }
        $this->_s = $s;
        return $this;
    }

    /**
     * Gets or sets e
     *
     * @param  DtTimeInfo $e
     * @return DtTimeInfo|self
     */
    public function e(DtTimeInfo $e = null)
    {
        if(null === $e)
        {
            return $this->_e;
        }
        $this->_e = $e;
        return $this;
    }

    /**
     * Gets or sets dur
     *
     * @param  DurationInfo $dur
     * @return DurationInfo|self
     */
    public function dur(DurationInfo $dur = null)
    {
        if(null === $dur)
        {
            return $this->_dur;
        }
        $this->_dur = $dur;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'dtval')
    {
        $name = !empty($name) ? $name : 'dtval';
        $arr = array();
        if($this->_s instanceof DtTimeInfo)
        {
            $arr += $this->_s->toArray('s');
        }
        if($this->_e instanceof DtTimeInfo)
        {
            $arr += $this->_e->toArray('e');
        }
        if($this->_dur instanceof DurationInfo)
        {
            $arr += $this->_dur->toArray('dur');
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'dtval')
    {
        $name = !empty($name) ? $name : 'dtval';
        $xml = new SimpleXML('<'.$name.' />');
        if($this->_s instanceof DtTimeInfo)
        {
            $xml->append($this->_s->toXml('s'));
        }
        if($this->_e instanceof DtTimeInfo)
        {
            $xml->append($this->_e->toXml('e'));
        }
        if($this->_dur instanceof DurationInfo)
        {
            $xml->append($this->_dur->toXml('dur'));
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