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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Common\Enum\LockoutOperation;
use Zimbra\Common\Struct\{AccountNameSelector, SoapEnvelopeInterface, SoapRequest};

/**
 * LockoutMailboxRequest request class
 * Puts the mailbox of the specified account into maintenance lockout or removes it from maintenance lockout
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class LockoutMailboxRequest extends SoapRequest
{
    /**
     * Account
     * 
     * @var AccountNameSelector
     */
    #[Accessor(getter: 'getAccount', setter: 'setAccount')]
    #[SerializedName('account')]
    #[Type(AccountNameSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private AccountNameSelector $account;

    /**
     * one of 'start' or 'end'
     * 
     * @var LockoutOperation
     */
    #[Accessor(getter: 'getOperation', setter: 'setOperation')]
    #[SerializedName('op')]
    #[Type('Enum<Zimbra\Common\Enum\LockoutOperation>')]
    #[XmlAttribute]
    private ?LockoutOperation $operation;

    /**
     * Constructor
     *
     * @param  AccountNameSelector $account
     * @param  LockoutOperation $operation
     * @return self
     */
    public function __construct(
        AccountNameSelector $account, ?LockoutOperation $operation = NULL
    )
    {
        $this->setAccount($account);
        $this->operation = $operation;
    }

    /**
     * Set the account.
     *
     * @return AccountNameSelector
     */
    public function getAccount(): ?AccountNameSelector
    {
        return $this->account;
    }

    /**
     * Set the account.
     *
     * @param  AccountNameSelector $account
     * @return self
     */
    public function setAccount(AccountNameSelector $account): self
    {
        $this->account = $account;
        return $this;
    }

    /**
     * Get operation
     *
     * @return LockoutOperation
     */
    public function getOperation(): ?LockoutOperation
    {
        return $this->operation;
    }

    /**
     * Set operation
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new LockoutMailboxEnvelope(
            new LockoutMailboxBody($this)
        );
    }
}
