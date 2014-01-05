<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;

/**
 * NoOp request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class NoOp extends Request
{
    /**
     * Wait setting
     * @var bool
     */
    private $_wait;

    /**
     * If "wait" is set, the caller can use this setting to determine whether notifications on delegate sessions will cause the operation to return.
     * If "delegate" is unset, delegate mailbox notifications will be ignored.
     * "delegate" is set by default.
     * @var bool
     */
    private $_delegate;

    /**
     * If specified, the server will only allow a given user to have one single waiting-NoOp on the server at a time,
     * it will complete (with waitDisallowed set) any existing limited hanging NoOpRequests when a new request comes in.
     * @var bool
     */
    private $_limitToOneBlocked;

    /**
     * The client may specify a custom timeout-length for their request if they know something about the particular underlying network.
     * The server may or may not honor this request (depending on server configured max/min values: see LocalConfig variables zimbra_noop_default_timeout, zimbra_noop_min_timeout and zimbra_noop_max_timeout)
     * @var int
     */
    private $_timeout;

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
            $this->_wait = (bool) $wait;
        }
        if(null !== $delegate)
        {
            $this->_delegate = (bool) $delegate;
        }
        if(null !== $limitToOneBlocked)
        {
            $this->_limitToOneBlocked = (bool) $limitToOneBlocked;
        }
        if(null !== $timeout)
        {
            $this->_timeout = (int) $timeout;
        }
    }

    /**
     * Get or set wait
     *
     * @param  bool $wait
     * @return bool|self
     */
    public function wait($wait = null)
    {
        if(null === $wait)
        {
            return $this->_wait;
        }
        $this->_wait = (bool) $wait;
        return $this;
    }

    /**
     * Get or set delegate
     *
     * @param  bool $delegate
     * @return bool|self
     */
    public function delegate($delegate = null)
    {
        if(null === $delegate)
        {
            return $this->_delegate;
        }
        $this->_delegate = (bool) $delegate;
        return $this;
    }

    /**
     * Get or set limitToOneBlocked
     *
     * @param  bool $limitToOneBlocked
     * @return bool|self
     */
    public function limitToOneBlocked($limitToOneBlocked = null)
    {
        if(null === $limitToOneBlocked)
        {
            return $this->_limitToOneBlocked;
        }
        $this->_limitToOneBlocked = (bool) $limitToOneBlocked;
        return $this;
    }

    /**
     * Get or set timeout
     *
     * @param  int $timeout
     * @return int|self
     */
    public function timeout($timeout = null)
    {
        if(null === $timeout)
        {
            return $this->_timeout;
        }
        $this->_timeout = (int) $timeout;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(is_bool($this->_wait))
        {
            $this->array['wait'] = $this->_wait ? 1 : 0;
        }
        if(is_bool($this->_delegate))
        {
            $this->array['delegate'] = $this->_delegate ? 1 : 0;
        }
        if(is_bool($this->_limitToOneBlocked))
        {
            $this->array['limitToOneBlocked'] = $this->_limitToOneBlocked ? 1 : 0;
        }
        if(is_int($this->_timeout))
        {
            $this->array['timeout'] = $this->_timeout;
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if(is_bool($this->_wait))
        {
            $this->xml->addAttribute('wait', $this->_wait ? 1 : 0);
        }
        if(is_bool($this->_delegate))
        {
            $this->xml->addAttribute('delegate', $this->_delegate ? 1 : 0);
        }
        if(is_bool($this->_limitToOneBlocked))
        {
            $this->xml->addAttribute('limitToOneBlocked', $this->_limitToOneBlocked ? 1 : 0);
        }
        if(is_int($this->_timeout))
        {
            $this->xml->addAttribute('timeout', $this->_timeout);
        }
        return parent::toXml();
    }
}
