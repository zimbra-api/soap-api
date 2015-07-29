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
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
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
        $this->setProperty('id', trim($id));
        if(null !== $reminder)
        {
            $this->setProperty('reminder', (bool) $reminder);
        }
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets show reminders flag
     *
     * @return bool
     */
    public function getShowReminders()
    {
        return $this->getProperty('reminder');
    }

    /**
     * Sets show reminders flag
     *
     * @param  bool $reminder
     * @return self
     */
    public function setShowReminders($reminder)
    {
        return $this->setProperty('reminder', (bool) $reminder);
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
