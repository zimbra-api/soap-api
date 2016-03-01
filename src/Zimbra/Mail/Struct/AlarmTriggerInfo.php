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

use Zimbra\Struct\Base;

/**
 * AlarmTriggerInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AlarmTriggerInfo extends Base
{
    /**
     * Constructor method for AlarmTriggerInfo
     * @param  DateAttr $abs Absolute abs information
     * @param  DurationInfo $rel Relative abs information
     * @return self
     */
    public function __construct(DateAttr $abs = null, DurationInfo $rel = null)
    {
        parent::__construct();
        if($abs instanceof DateAttr)
        {
            $this->setChild('abs', $abs);
        }
        if($rel instanceof DurationInfo)
        {
            $this->setChild('rel', $rel);
        }
    }

    /**
     * Gets absolute trigger information
     *
     * @return DateAttr
     */
    public function getAbsolute()
    {
        return $this->getChild('abs');
    }

    /**
     * Sets absolute trigger information
     *
     * @param  DateAttr $absolute
     * @return self
     */
    public function setAbsolute(DateAttr $absolute)
    {
        return $this->setChild('abs', $absolute);
    }

    /**
     * Gets relative trigger information
     *
     * @return DurationInfo
     */
    public function getRelative()
    {
        return $this->getChild('rel');
    }

    /**
     * Sets relative trigger information
     *
     * @param  DurationInfo $relative
     * @return self
     */
    public function setRelative(DurationInfo $relative)
    {
        return $this->setChild('rel', $relative);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'trigger')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'trigger')
    {
        return parent::toXml($name);
    }
}
