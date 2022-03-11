<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Soap\Request;

/**
 * RemoveDistributionListMemberRequest request class
 * Remove Distribution List Member
 * Unlike add, remove of a non-existent member causes an exception and no modification to the list.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class RemoveDistributionListMemberRequest extends Request
{
    /**
     * Zimbra ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Members
     * 
     * @Accessor(getter="getMembers", setter="setMembers")
     * @SerializedName("dlm")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "dlm")
     */
    private $members;

    /**
     * Specify Accounts insteaf of members if you want to remove all addresses that belong to an account from the list
     * 
     * @Accessor(getter="getAccounts", setter="setAccounts")
     * @SerializedName("account")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "account")
     */
    private $accounts;

    /**
     * Constructor method for RemoveDistributionListMemberRequest
     *
     * @param  string $id
     * @param  array  $members
     * @param  array  $accounts
     * @return self
     */
    public function __construct(string $id, array $members = [], array $accounts = [])
    {
        $this->setId($id)
             ->setMembers($members)
             ->setAccounts($accounts);
    }

    /**
     * Gets zimbra id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets zimbra id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Add a member
     *
     * @param  string $member
     * @return self
     */
    public function addMember(string $member): self
    {
        $member = trim($member);
        if (!empty($member) && !in_array($member, $this->members)) {
            $this->members[] = $member;
        }
        return $this;
    }

    /**
     * Sets members
     *
     * @param  array $members Members
     * @return self
     */
    public function setMembers(array $members): self
    {
        $this->members = [];
        foreach ($members as $member) {
            $this->addMember($member);
        }
        return $this;
    }

    /**
     * Gets members
     *
     * @return array
     */
    public function getMembers(): array
    {
        return $this->members;
    }

    /**
     * Add account
     *
     * @param  string $account
     * @return self
     */
    public function addAccount(string $account): self
    {
        $account = trim($account);
        if (!empty($account) && !in_array($account, $this->accounts)) {
            $this->accounts[] = $account;
        }
        return $this;
    }

    /**
     * Sets accounts
     *
     * @param  array $accounts Accounts
     * @return self
     */
    public function setAccounts(array $accounts): self
    {
        $this->accounts = [];
        foreach ($accounts as $account) {
            $this->addAccount($account);
        }
        return $this;
    }

    /**
     * Gets accounts
     *
     * @return array
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof RemoveDistributionListMemberEnvelope)) {
            $this->envelope = new RemoveDistributionListMemberEnvelope(
                new RemoveDistributionListMemberBody($this)
            );
        }
    }
}
