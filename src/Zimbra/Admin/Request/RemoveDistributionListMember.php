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

use PhpCollection\Sequence;

/**
 * RemoveDistributionListMember request class
 * Remove Distribution List Member
 * Unlike add, remove of a non-existent member causes an exception and no modification to the list.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RemoveDistributionListMember extends Base
{
    /**
     * Members
     * @var Sequence
     */
    private $_members;

    /**
     * Accounts
     * @var Sequence
     */
    private $_accounts;

    /**
     * Constructor method for RemoveDistributionListMember
     * @param  string $id Zimbra ID
     * @param  array  $members Members
     * @param  array  $accounts Specify Accounts insteaf of members if you want to remove all addresses that belong to an account from the list
     * @return self
     */
    public function __construct($id, array $members, array $accounts = [])
    {
        parent::__construct();
        $this->setProperty('id', trim($id));
        $this->setMembers($members);
        $this->setAccounts($accounts);

        $this->on('before', function(Base $sender)
        {
            if($sender->getMembers()->count())
            {
                $sender->setChild('dlm', $sender->getMembers()->all());
            }
            if($sender->getAccounts()->count())
            {
                $sender->setChild('account', $sender->getAccounts()->all());
            }
        });
    }

    /**
     * Gets Zimbra ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets Zimbra ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Add a member
     *
     * @param  string $member
     * @return self
     */
    public function addMember($member)
    {
        $member = trim($member);
        if(!empty($member) && !$this->_members->contains($member))
        {
            $this->_members->add($member);
        }
        return $this;
    }

    /**
     * Sets member sequence
     *
     * @param  array  $members Members
     * @return self
     */
    public function setMembers(array $members)
    {
        $this->_members = new Sequence($members);
        foreach ($members as $dlm)
        {
            $dlm = trim($dlm);
            if(!empty($dlm) && !$this->_members->contains($dlm))
            {
                $this->_members->add($dlm);
            }
        }
        if(!count($this->_members))
        {
            throw new \InvalidArgumentException('RemoveDistributionListMember must have at least a member');
        }
        return $this;
    }

    /**
     * Gets member sequence
     *
     * @return Sequence
     */
    public function getMembers()
    {
        return $this->_members;
    }

    /**
     * Add a account
     *
     * @param  string $account
     * @return self
     */
    public function addAccount($account)
    {
        $account = trim($account);
        if(!empty($account) && !$this->_accounts->contains($account))
        {
            $this->_accounts->add($account);
        }
        return $this;
    }

    /**
     * Sets account sequence
     *
     * @param  array  $accounts Account
     * @return self
     */
    public function setAccounts(array $accounts)
    {
        $this->_accounts = new Sequence($accounts);
        foreach ($accounts as $dlm)
        {
            $dlm = trim($dlm);
            if(!empty($dlm) && !$this->_accounts->contains($dlm))
            {
                $this->_accounts->add($dlm);
            }
        }
        return $this;
    }

    /**
     * Gets account sequence
     *
     * @return Sequence
     */
    public function getAccounts()
    {
        return $this->_accounts;
    }
}
