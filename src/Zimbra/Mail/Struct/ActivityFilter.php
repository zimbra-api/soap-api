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
 * ActivityFilter struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ActivityFilter extends Base
{
    /**
     * Constructor method for ActivityFilter
     * @param string $account Account ID
     * @param string $ops Comma separated list of mailbox operations
     * @param string $sessionId Session ID
     * @return self
     */
    public function __construct(
        $account = null,
        $ops = null,
        $sessionId = null
    )
    {
        parent::__construct();
        if(null !== $account)
        {
            $this->setProperty('account', trim($account));
        }
        if(null !== $ops)
        {
            $this->setProperty('op', trim($ops));
        }
        if(null !== $sessionId)
        {
            $this->setProperty('session', trim($sessionId));
        }
    }

    /**
     * Gets acount id
     *
     * @return string
     */
    public function getAccount()
    {
        return $this->getProperty('account');
    }

    /**
     * Sets acount id
     *
     * @param  string $account
     * @return self
     */
    public function setAccount($account)
    {
        return $this->setProperty('account', trim($account));
    }

    /**
     * Gets mailbox operations
     *
     * @return string
     */
    public function getOps()
    {
        return $this->getProperty('op');
    }

    /**
     * Sets mailbox operations
     *
     * @param  string $ops
     * @return self
     */
    public function setOps($ops)
    {
        return $this->setProperty('op', trim($ops));
    }

    /**
     * Gets session id
     *
     * @return string
     */
    public function getSessionId()
    {
        return $this->getProperty('session');
    }

    /**
     * Sets session id
     *
     * @param  string $sessionId
     * @return self
     */
    public function setSessionId($sessionId)
    {
        return $this->setProperty('session', trim($sessionId));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'filter')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'filter')
    {
        return parent::toXml($name);
    }
}
