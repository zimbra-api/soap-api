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
 * ExceptionRuleInfo struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ExceptionRuleInfo extends RecurIdInfo
{
    /**
     * Dates or rules which ADD instances. ADDs are evaluated before EXCLUDEs
     * @var RecurrenceInfo
     */
    private $_add;

    /**
     * Dates or rules which EXCLUDE instances
     * @var RecurrenceInfo
     */
    private $_exclude;

    /**
     * Constructor method for RecurIdInfo
     * @param int $rangeType
     * @param string $recurId
     * @param string $tz
     * @param string $ridZ
     * @param RecurrenceInfo $add
     * @param RecurrenceInfo $exclude
     * @return self
     */
    public function __construct(
        $rangeType,
        $recurId,
        $tz = null,
        $ridZ = null,
        RecurrenceInfo $add = null,
        RecurrenceInfo $exclude = null
    )
    {
        parent::__construct($rangeType, $recurId, $tz, $ridZ);
        if($add instanceof RecurrenceInfo)
        {
            $this->_add = $add;
        }
        if($exclude instanceof RecurrenceInfo)
        {
            $this->_exclude = $exclude;
        }
    }

    /**
     * Gets or sets add
     *
     * @param  RecurrenceInfo $add
     * @return RecurrenceInfo|self
     */
    public function add(RecurrenceInfo $add = null)
    {
        if(null === $add)
        {
            return $this->_add;
        }
        $this->_add = $add;
        return $this;
    }

    /**
     * Gets or sets exclude
     *
     * @param  RecurrenceInfo $exclude
     * @return RecurrenceInfo|self
     */
    public function exclude(RecurrenceInfo $exclude = null)
    {
        if(null === $exclude)
        {
            return $this->_exclude;
        }
        $this->_exclude = $exclude;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'except')
    {
        $name = !empty($name) ? $name : 'except';
        $arr = parent::toArray($name);
        if($this->_add instanceof RecurrenceInfo)
        {
            $arr[$name] += $this->_add->toArray('add');
        }
        if($this->_exclude instanceof RecurrenceInfo)
        {
            $arr[$name] += $this->_exclude->toArray('exclude');
        }
        return $arr;
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'except')
    {
        $name = !empty($name) ? $name : 'except';
        $xml = parent::toXml($name);
        if($this->_add instanceof RecurrenceInfo)
        {
            $xml->append($this->_add->toXml('add'));
        }
        if($this->_exclude instanceof RecurrenceInfo)
        {
            $xml->append($this->_exclude->toXml('exclude'));
        }
        return $xml;
    }
}
