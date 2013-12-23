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
 * AlarmTriggerInfo struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AlarmTriggerInfo
{
    /**
     * Absolute trigger information
     * @var DateAttr
     */
    private $_abs;

    /**
     * Relative trigger information
     * @var DurationInfo
     */
    private $_rel;

    /**
     * Constructor method for AlarmTriggerInfo
     * @param  DateAttr $uid
     * @param  DurationInfo $value
     * @return self
     */
    public function __construct(DateAttr $abs = null, DurationInfo $rel = null)
    {
        if($abs instanceof DateAttr)
        {
            $this->_abs = $abs;
        }
        if($rel instanceof DurationInfo)
        {
            $this->_rel = $rel;
        }
    }

    /**
     * Gets or sets abs
     *
     * @param  DateAttr $abs
     * @return DateAttr|self
     */
    public function abs(DateAttr $abs = null)
    {
        if(null === $abs)
        {
            return $this->_abs;
        }
        $this->_abs = $abs;
        return $this;
    }

    /**
     * Gets or sets rel
     *
     * @param  DurationInfo $rel
     * @return DurationInfo|self
     */
    public function rel(DurationInfo $rel = null)
    {
        if(null === $rel)
        {
            return $this->_rel;
        }
        $this->_rel = $rel;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'trigger')
    {
        $name = !empty($name) ? $name : 'trigger';
        $arr = array();
        if($this->_abs instanceof DateAttr)
        {
            $arr += $this->_abs->toArray('abs');
        }
        if($this->_rel instanceof DurationInfo)
        {
            $arr += $this->_rel->toArray('rel');
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'trigger')
    {
        $name = !empty($name) ? $name : 'trigger';
        $xml = new SimpleXML('<'.$name.' />');
        if($this->_abs instanceof DateAttr)
        {
            $xml->append($this->_abs->toXml('abs'));
        }
        if($this->_rel instanceof DurationInfo)
        {
            $xml->append($this->_rel->toXml('rel'));
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
