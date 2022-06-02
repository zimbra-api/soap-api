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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\AccountSelector as Account;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * ChangePrimaryEmailRequest class
 * Change Account
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ChangePrimaryEmailRequest extends Request
{
    /**
     * Specifies the account to be changed
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Common\Struct\AccountSelector")
     * @XmlElement
     */
    private Account $account;

    /**
     * New account name
     * @Accessor(getter="getNewName", setter="setNewName")
     * @SerializedName("newName")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $newName;

    /**
     * Constructor method for ChangePrimaryEmailRequest
     * 
     * @param Account $account
     * @param string  $newName
     * @return self
     */
    public function __construct(Account $account, string $newName)
    {
        $this->setAccount($account)
             ->setNewName($newName);
    }

    /**
     * Gets the account.
     *
     * @return Account
     */
    public function getAccount(): Account
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
     * Gets new account name
     *
     * @return string
     */
    public function getNewName(): string
    {
        return $this->newName;
    }

    /**
     * Sets new account name
     *
     * @param  string $newName
     * @return self
     */
    public function setNewName(string $newName): self
    {
        $this->newName = $newName;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new ChangePrimaryEmailEnvelope(
            new ChangePrimaryEmailBody($this)
        );
    }
}
