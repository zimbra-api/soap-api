<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use Zimbra\Enum\CalendarResourceBy as CalResBy;
use Zimbra\Struct\Base;

/**
 * CalendarResourceSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CalendarResourceSelector extends Base
{
    /**
     * Constructor method for CalendarResourceSelector
     * @param  Zimbra\Enum\CalendarResourceBy $by Select the meaning of {cal-resource-selector-key}
     * @param  string $value Specify calendar resource
     * @return self
     */
    public function __construct(CalResBy $by, $value = null)
    {
        parent::__construct(trim($value));
        $this->setProperty('by', $by);
    }

    /**
     * Gets by enum
     *
     * @return Zimbra\Enum\CalendarResourceBy
     */
    public function getBy()
    {
        return $this->getProperty('by');
    }

    /**
     * Sets by enum
     *
     * @param  Zimbra\Enum\CalendarResourceBy $by
     * @return self
     */
    public function setBy(CalResBy $by)
    {
        return $this->setProperty('by', $by);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'calresource')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'calresource')
    {
        return parent::toXml($name);
    }
}
