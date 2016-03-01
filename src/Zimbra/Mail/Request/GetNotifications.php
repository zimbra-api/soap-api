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
class GetNotifications extends Base
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
            $this->setProperty('markSeen', (bool) $markSeen);
        }
    }

    /**
     * Gets mark seen
     *
     * @return bool
     */
    public function getMarkSeen()
    {
        return $this->getProperty('markSeen');
    }

    /**
     * Sets mark seen
     *
     * @param  bool $markSeen
     * @return self
     */
    public function setMarkSeen($markSeen)
    {
        return $this->setProperty('markSeen', (bool) $markSeen);
    }
}
