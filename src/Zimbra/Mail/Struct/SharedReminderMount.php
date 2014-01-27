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
 * SharedReminderMount class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class SharedReminderMount extends Base
{
    /**
     * Constructor method for SharedReminderMount
     * @param string $id Mountpoint ID
     * @param bool $reminder Set to enable (or unset to disable) reminders for shared appointments/tasks
     * @return self
     */
    public function __construct($id, $reminder = null)
    {
        parent::__construct();
        $this->property('id', trim($id));
        if(null !== $reminder)
        {
            $this->property('reminder', (bool) $reminder);
        }
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
     * Get or set reminder
     *
     * @param  bool $reminder
     * @return bool|self
     */
    public function reminder($reminder = null)
    {
        if(null === $reminder)
        {
            return $this->property('reminder');
        }
        return $this->property('reminder', (bool) $reminder);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'link')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'link')
    {
        return parent::toXml($name);
    }
}
