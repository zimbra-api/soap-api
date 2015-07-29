<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

/**
 * ExceptionRuleInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ExceptionRuleInfo extends RecurIdInfo implements RecurRuleBase
{
    /**
     * Constructor method for RecurIdInfo
     * @param int $rangeType
     * @param string $recurId
     * @param RecurrenceInfo $add Dates or rules which ADD instances. ADDs are evaluated before EXCLUDEs
     * @param RecurrenceInfo $exclude Dates or rules which EXCLUDE instances
     * @param string $tz
     * @param string $ridZ
     * @return self
     */
    public function __construct(
        $rangeType,
        $recurId,
        RecurrenceInfo $add = null,
        RecurrenceInfo $exclude = null,
        $tz = null,
        $ridZ = null
    )
    {
        parent::__construct($rangeType, $recurId, $tz, $ridZ);
        if($add instanceof RecurrenceInfo)
        {
            $this->setChild('add', $add);
        }
        if($exclude instanceof RecurrenceInfo)
        {
            $this->setChild('exclude', $exclude);
        }
    }

    /**
     * Gets add
     *
     * @return RecurrenceInfo
     */
    public function getAdd()
    {
        return $this->getChild('add');
    }

    /**
     * Sets add
     *
     * @param  RecurrenceInfo $add
     * @return self
     */
    public function setAdd(RecurrenceInfo $add)
    {
        return $this->setChild('add', $add);
    }

    /**
     * Gets exclude
     *
     * @return RecurrenceInfo
     */
    public function getExclude()
    {
        return $this->getChild('exclude');
    }

    /**
     * Sets exclude
     *
     * @param  RecurrenceInfo $exclude
     * @return self
     */
    public function setExclude(RecurrenceInfo $exclude)
    {
        return $this->setChild('exclude', $exclude);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'except')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'except')
    {
        return parent::toXml($name);
    }
}
