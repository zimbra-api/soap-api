<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\AccountSelector as Account;

/**
 * DelegateAuth class
 * Used to request a new auth token that is valid for the specified account.
 * The id of the auth token will be the id of the target account, and the requesting admin's id will be stored in the auth token for auditing purposes.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DelegateAuth extends Request
{
    /**
     * Details of target account
     * @var Account
     */
    private $_account;

    /**
     * Lifetime in seconds of the newly-created authtoken. defaults to 1 hour. Can't be longer then zimbraAuthTokenLifetime.
     * @var integer
     */
    private $_duration;

    /**
     * Constructor method for DelegateAuth
     * @param  Account $account
     * @param  int $duration
     * @return self
     */
    public function __construct(Account $account, $duration = null)
    {
        parent::__construct();
        $this->_account = $account;
        if(null !== $duration)
        {
            $this->_duration = (int) $duration;
        }
    }

    /**
     * Gets or sets account
     *
     * @param  Account $account
     * @return Account|self
     */
    public function account(Account $account = null)
    {
        if(null === $account)
        {
            return $this->_account;
        }
        $this->_account = $account;
        return $this;
    }

    /**
     * Gets or sets duration
     *
     * @param  integer $duration
     * @return integer|self
     */
    public function duration($duration = null)
    {
        if(null === $duration)
        {
            return $this->_duration;
        }
        $this->_duration = (int) $duration;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = $this->_account->toArray();
        if(is_int($this->_duration))
        {
            $this->array['duration'] = $this->_duration;
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
        $this->xml->append($this->_account->toXml());
        if(is_int($this->_duration))
        {
            $this->xml->addAttribute('duration', $this->_duration);
        }
        return parent::toXml();
    }
}
