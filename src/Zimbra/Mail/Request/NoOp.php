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
 * NoOp request class
 * A request that does nothing and always returns nothing.
 * Used to keep a session alive, and return any pending notifications. 
 *
 * If "wait" is set, and if the current session allows them, this request will block until there are new notifications for the client.
 * Note that the soap envelope must reference an existing session that has notifications enabled, and the notification sequencing number should be specified. 
 *
 * If "wait" is set, the caller can specify whether notifications on delegate sessions will cause the operation to return.
 * If "delegate" is unset, delegate mailbox notifications will be ignored. "delegate" is set by default. 
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class NoOp extends Base
{
    /**
     * Constructor method for AutoComplete
     * @param  bool $wait
     * @param  bool $delegate
     * @param  bool $limitToOneBlocked
     * @param  int  $timeout
     * @return self
     */
    public function __construct(
        $wait = null,
        $delegate = null,
        $limitToOneBlocked = null,
        $timeout = null
    )
    {
        parent::__construct();
        if(null !== $wait)
        {
            $this->property('wait', (bool) $wait);
        }
        if(null !== $delegate)
        {
            $this->property('delegate', (bool) $delegate);
        }
        if(null !== $limitToOneBlocked)
        {
            $this->property('limitToOneBlocked', (bool) $limitToOneBlocked);
        }
        if(null !== $timeout)
        {
            $this->property('timeout', (int) $timeout);
        }
    }

    /**
     * Get or set wait
     * Wait setting
     *
     * @param  bool $wait
     * @return bool|self
     */
    public function wait($wait = null)
    {
        if(null === $wait)
        {
            return $this->property('wait');
        }
        return $this->property('wait', (bool) $wait);
    }

    /**
     * Get or set delegate
     * If "wait" is set, the caller can use this setting to determine whether notifications on delegate sessions will cause the operation to return.
     * If "delegate" is unset, delegate mailbox notifications will be ignored.
     * "delegate" is set by default.
     *
     * @param  bool $delegate
     * @return bool|self
     */
    public function delegate($delegate = null)
    {
        if(null === $delegate)
        {
            return $this->property('delegate');
        }
        return $this->property('delegate', (bool) $delegate);
    }

    /**
     * Get or set limitToOneBlocked
     * If specified, the server will only allow a given user to have one single waiting-NoOp on the server at a time,
     * it will complete (with waitDisallowed set) any existing limited hanging NoOpRequests when a new request comes in.
     *
     * @param  bool $limitToOneBlocked
     * @return bool|self
     */
    public function limitToOneBlocked($limitToOneBlocked = null)
    {
        if(null === $limitToOneBlocked)
        {
            return $this->property('limitToOneBlocked');
        }
        return $this->property('limitToOneBlocked', (bool) $limitToOneBlocked);
    }

    /**
     * Get or set timeout
     * The client may specify a custom timeout-length for their request if they know something about the particular underlying network.
     * The server may or may not honor this request (depending on server configured max/min values: see LocalConfig variables zimbra_noop_default_timeout, zimbra_noop_min_timeout and zimbra_noop_max_timeout)
     *
     * @param  int $timeout
     * @return int|self
     */
    public function timeout($timeout = null)
    {
        if(null === $timeout)
        {
            return $this->property('timeout');
        }
        return $this->property('timeout', (int) $timeout);
    }
}
