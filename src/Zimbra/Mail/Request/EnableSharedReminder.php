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
     * @param  SharedReminderMount $link
     * @return self
     */
    public function __construct(SharedReminderMount $link)
    {
        parent::__construct();
        $this->child('link', $link);
    }

    /**
     * Get or set link
     * Specification for mountpoint
     *
     * @param  SharedReminderMount $link
     * @return SharedReminderMount|self
     */
    public function link(SharedReminderMount $link = null)
    {
        if(null === $link)
        {
            return $this->child('link');
        }
        return $this->child('link', $link);
    }
}
