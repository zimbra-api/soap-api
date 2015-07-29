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
     * @param string $op Comma separated list of mailbox operations
     * @param string $session Session ID
     * @return self
     */
    public function __construct(
        $account = null,
        $op = null,
        $session = null
    )
    {
        parent::__construct();
        if(null !== $account)
        {
            $this->setProperty('account', trim($account));
        }
        if(null !== $op)
        {
            $this->setProperty('op', trim($op));
        }
        if(null !== $session)
        {
            $this->setProperty('session', trim($session));
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
    public function getOp()
    {
        return $this->getProperty('op');
    }

    /**
     * Sets mailbox operations
     *
     * @param  string $op
     * @return self
     */
    public function setOp($op)
    {
        return $this->setProperty('op', trim($op));
    }

    /**
     * Gets session id
     *
     * @return string
     */
    public function getSession()
    {
        return $this->getSession('session');
    }

    /**
     * Sets session id
     *
     * @param  string $session
     * @return self
     */
    public function setSession($session)
    {
        return $this->setSession('session', trim($session));
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
