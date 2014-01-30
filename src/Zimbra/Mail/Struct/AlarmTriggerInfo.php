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
            $this->child('abs', $abs);
        }
        if($rel instanceof DurationInfo)
        {
            $this->child('rel', $rel);
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
            return $this->child('abs');
        }
        return $this->child('abs', $abs);
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
            return $this->child('rel');
        }
        return $this->child('rel', $rel);
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
