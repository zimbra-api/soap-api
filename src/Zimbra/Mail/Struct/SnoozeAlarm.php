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
 * SnoozeAlarm struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class SnoozeAlarm extends Base
{
    /**
     * Constructor method for SnoozeAlarm
     * @param string $id Calendar item ID
     * @param int $until When to show the alarm again in milliseconds since the epoch
     * @return self
     */
    public function __construct($id, $until)
    {
        parent::__construct();
        $this->property('id', trim($id));
        $this->property('until', (int) $until);
    }

    /**
     * Get or set id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Get or set until
     *
     * @param  int $until
     * @return int|self
     */
    public function until($until = null)
    {
        if(null === $until)
        {
            return $this->property('until');
        }
        return $this->property('until', (int) $until);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'alarm')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'alarm')
    {
        return parent::toXml($name);
    }
}
