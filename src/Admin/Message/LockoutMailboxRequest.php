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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};
use Zimbra\Enum\LockoutOperation;
use Zimbra\Soap\Request;
use Zimbra\Struct\AccountNameSelector as Account;

/**
 * LockoutMailboxRequest request class
 * Puts the mailbox of the specified account into maintenance lockout or removes it from maintenance lockout
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="LockoutMailboxRequest")
 */
class LockoutMailboxRequest extends Request
{
    /**
     * Account
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Struct\AccountNameSelector")
     * @XmlElement
     */
    private $account;

    /**
     * one of 'start' or 'end'
     * @Accessor(getter="getOperation", setter="setOperation")
     * @SerializedName("op")
     * @Type("Zimbra\Enum\LockoutOperation")
     * @XmlAttribute
     */
    private $operation;

    /**
     * Constructor method for LockoutMailboxRequest
     *
     * @param  Account $account
     * @param  LockoutOperation $operation
     * @return self
     */
    public function __construct(Account $account, ?LockoutOperation $operation = NULL)
    {
        $this->setAccount($account);
        if ($operation instanceof LockoutOperation) {
            $this->setOperation($operation);
        }
    }

    /**
     * Sets the account.
     *
     * @return Account
     */
    public function getAccount(): ?Account
    {
        return $this->account;
    }

    /**
     * Sets the account.
     *
     * @param  Account $account
     * @return self
     */
    public function setAccount(Account $account): self
    {
        $this->account = $account;
        return $this;
    }

    /**
     * Gets operation
     *
     * @return LockoutOperation
     */
    public function getOperation(): ?LockoutOperation
    {
        return $this->operation;
    }

    /**
     * Sets operation
     *
     * @param  LockoutOperation $operation
     * @return self
     */
    public function setOperation(LockoutOperation $operation): self
    {
        $this->operation = $operation;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof LockoutMailboxEnvelope)) {
            $this->envelope = new LockoutMailboxEnvelope(
                new LockoutMailboxBody($this)
            );
        }
    }
}