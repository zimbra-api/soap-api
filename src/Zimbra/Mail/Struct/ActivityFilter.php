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
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class ActivityFilter extends Base
{
    /**
     * Constructor method for ActivityFilter
     * @param string $account Account ID
     * @param string $op Comma separated list of Mailbox operations
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
            $this->property('account', trim($account));
        }
        if(null !== $op)
        {
            $this->property('op', trim($op));
        }
        if(null !== $session)
        {
            $this->property('session', trim($session));
        }
    }

    /**
     * Gets or sets account
     *
     * @param  string $account
     * @return string|self
     */
    public function account($account = null)
    {
        if(null === $account)
        {
            return $this->property('account');
        }
        return $this->property('account', trim($account));
    }

    /**
     * Gets or sets op
     *
     * @param  string $op
     * @return string|self
     */
    public function op($op = null)
    {
        if(null === $op)
        {
            return $this->property('op');
        }
        return $this->property('op', trim($op));
    }

    /**
     * Gets or sets session
     *
     * @param  string $session
     * @return string|self
     */
    public function session($session = null)
    {
        if(null === $session)
        {
            return $this->property('session');
        }
        return $this->property('session', trim($session));
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
