<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Common\TypedSequence;
use Zimbra\Enum\InterestType;
use Zimbra\Struct\WaitSetSpec;

/**
 * AdminCreateWaitSet request class
 * Create a waitset to listen for changes on one or more accounts
 * Called once to initialize a WaitSet and to set its "default interest types"
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AdminCreateWaitSet extends Base
{
    /**
     * Default interest types
     * @var array
     */
    private $_defTypes;

    /**
     * Constructor method for AdminCreateWaitSet
     * @param  WaitSetSpec $accounts The WaitSet add spec
     * @param  array $defTypes Default interest types
     * @param  bool  $allAccounts The allAccounts
     * @return self
     */
    public function __construct(WaitSetSpec $accounts = null, array $defTypes = [], $allAccounts = null)
    {
        parent::__construct();
        $this->setChild('add', $accounts);
        if(null !== $allAccounts)
        {
            $this->setProperty('allAccounts', (bool) $allAccounts);
        }
        $this->setDefaultInterests($defTypes);

        $this->on('before', function(Base $sender)
        {
            $sender->setProperty('defTypes', $sender->getDefaultInterests());
        });
    }

    /**
     * Gets the account.
     *
     * @return Account
     */
    public function getAccounts()
    {
        return $this->getChild('add');
    }

    /**
     * Sets the account.
     *
     * @param  Account $account
     * @return self
     */
    public function setAccounts(WaitSetSpec $account)
    {
        return $this->setChild('add', $account);
    }

    /**
     * Add a default interest type
     *
     * @param  InterestType $type
     * @return self
     */
    public function addDefaultInterest(InterestType $type)
    {
        $this->_defTypes->add($type);
        return $this;
    }

    /**
     * Sets default interest types
     *
     * @param  array $defTypes
     * @return self
     */
    public function setDefaultInterests(array $defTypes)
    {
        $this->_defTypes = new TypedSequence('Zimbra\Enum\InterestType', $defTypes);
        return $this;
    }

    /**
     * Gets default interest types
     *
     * @return string
     */
    public function getDefaultInterests()
    {
        return count($this->_defTypes) ? implode(',', $this->_defTypes->all()) : 'all';
    }

    /**
     * Gets all accounts flag
     *
     * @return bool
     */
    public function getAllAccounts()
    {
        return $this->getProperty('allAccounts');
    }

    /**
     * Sets all accounts flag
     *
     * @param  string $allAccounts
     * @return self
     */
    public function setAllAccounts($allAccounts)
    {
        return $this->setProperty('allAccounts', (bool) $allAccounts);
    }
}
