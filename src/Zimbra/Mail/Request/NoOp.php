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
            $this->setProperty('wait', (bool) $wait);
        }
        if(null !== $delegate)
        {
            $this->setProperty('delegate', (bool) $delegate);
        }
        if(null !== $limitToOneBlocked)
        {
            $this->setProperty('limitToOneBlocked', (bool) $limitToOneBlocked);
        }
        if(null !== $timeout)
        {
            $this->setProperty('timeout', (int) $timeout);
        }
    }

    /**
     * Gets wait setting
     *
     * @return bool
     */
    public function getWait()
    {
        return $this->getProperty('wait');
    }

    /**
     * Sets wait setting
     *
     * @param  bool $wait 
     * @return self
     */
    public function setWait($wait)
    {
        return $this->setProperty('wait', (bool) $wait);
    }

    /**
     * Gets delegate
     *
     * @return bool
     */
    public function getIncludeDelegates()
    {
        return $this->getProperty('delegate');
    }

    /**
     * Sets delegate
     *
     * @param  bool $delegate
     * @return self
     */
    public function setIncludeDelegates($delegate)
    {
        return $this->setProperty('delegate', (bool) $delegate);
    }

    /**
     * Gets enforce limit
     *
     * @return bool
     */
    public function getEnforceLimit()
    {
        return $this->getProperty('limitToOneBlocked');
    }

    /**
     * Sets enforce limit
     *
     * @param  bool $limitToOneBlocked
     * @return self
     */
    public function setEnforceLimit($limitToOneBlocked)
    {
        return $this->setProperty('limitToOneBlocked', (bool) $limitToOneBlocked);
    }

    /**
     * Gets timeout
     *
     * @return int
     */
    public function getTimeout()
    {
        return $this->getProperty('timeout');
    }

    /**
     * Sets timeout
     *
     * @param  int $timeout
     * @return self
     */
    public function setTimeout($timeout)
    {
        return $this->setProperty('timeout', (int) $timeout);
    }
}
