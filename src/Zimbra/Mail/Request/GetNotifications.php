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

use Zimbra\Soap\Request;

/**
 * GetNotifications request class
 * Get notifications
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetNotifications extends Request
{
    /**
     * Constructor method for GetNotifications
     * @param  bool $markSeen
     * @return self
     */
    public function __construct($markSeen = null)
    {
        parent::__construct();
        if(null !== $markSeen)
        {
            $this->property('markSeen', (bool) $markSeen);
        }
    }

    /**
     * Get or set markSeen
     * If set then all the notifications will be marked as seen.
     * Default: unset
     *
     * @param  bool $markSeen
     * @return bool|self
     */
    public function markSeen($markSeen = null)
    {
        if(null === $markSeen)
        {
            return $this->property('markSeen');
        }
        return $this->property('markSeen', (bool) $markSeen);
    }
}
