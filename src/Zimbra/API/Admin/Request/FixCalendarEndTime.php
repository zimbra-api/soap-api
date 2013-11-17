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
use Zimbra\Soap\Struct\NamedElement as Account;
use Zimbra\Utils\TypedSequence;

/**
 * FixCalendarEndTime class
 * Fix Calendar End Times.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class FixCalendarEndTime extends Request
{
    /**
     * Sync flag
     * @var bool
     */
    private $_sync;

    /**
     * Accounts
     * @var array
     */
    private $_accounts;

    /**
     * Constructor method for FixCalendarEndTime
     * @param  bool $sync
     * @param  array $accounts
     * @return self
     */
    public function __construct($sync = null, array $accounts = array())
    {
        parent::__construct();
        if(null !== $sync)
        {
            $this->_sync = (bool) $sync;
        }
        $this->_accounts = new TypedSequence('Zimbra\Soap\Struct\NamedElement', $accounts);
    }

    /**
     * Gets or sets sync
     *
     * @param  bool $sync
     * @return bool|self
     */
    public function sync($sync = null)
    {
        if(null === $sync)
        {
            return $this->_sync;
        }
        $this->_sync = (bool) $sync;
        return $this;
    }

    /**
     * Add an account
     *
     * @param  Account $attr
     * @return self
     */
    public function addAccount(Account $account)
    {
        $this->_accounts->add($account);
        return $this;
    }

    /**
     * Gets account equence
     *
     * @return Sequence
     */
    public function accounts()
    {
        return $this->_accounts;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(is_bool($this->_sync))
        {
            $this->array['sync'] = $this->_sync ? 1 : 0;
        }
        if(count($this->_accounts))
        {
            $this->array['account'] = array();
            foreach ($this->_accounts as $account)
            {
                $accountArr = $account->toArray('account');
                $this->array['account'][] = $accountArr['account'];
            }
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
        if(is_bool($this->_sync))
        {
            $this->xml->addAttribute('sync', $this->_sync ? 1 : 0);
        }
        foreach ($this->_accounts as $account)
        {
            $this->xml->append($account->toXml('account'));
        }
        return parent::toXml();
    }
}
