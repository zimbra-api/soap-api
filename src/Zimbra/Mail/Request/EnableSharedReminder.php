<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Mail\Struct\SharedReminderMount;

/**
 * EnableSharedReminder request class
 * Enable/disable reminders for shared appointments/tasks on a mountpoint
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class EnableSharedReminder extends Base
{
    /**
     * Constructor method for EnableSharedReminder
     * @param  SharedReminderMount $mount
     * @return self
     */
    public function __construct(SharedReminderMount $mount)
    {
        parent::__construct();
        $this->setChild('link', $mount);
    }

    /**
     * Gets specification for mount point
     *
     * @return SharedReminderMount
     */
    public function getMount()
    {
        return $this->getChild('link');
    }

    /**
     * Sets specification for mount point
     *
     * @param  SharedReminderMount $link
     * @return self
     */
    public function setMount(SharedReminderMount $mount)
    {
        return $this->setChild('link', $mount);
    }
}
