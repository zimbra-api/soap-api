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
use Zimbra\Common\Struct\{AccountSelector, SoapEnvelopeInterface, SoapRequest};

/**
 * ChangePrimaryEmailRequest class
 * Change Account
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ChangePrimaryEmailRequest extends SoapRequest
{
    /**
     * Specifies the account to be changed
     * 
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Common\Struct\AccountSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var AccountSelector
     */
    #[Accessor(getter: 'getAccount', setter: 'setAccount')]
    #[SerializedName(name: 'account')]
    #[Type(name: AccountSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $account;

    /**
     * New account name
     * 
     * @Accessor(getter="getNewName", setter="setNewName")
     * @SerializedName("newName")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAdmin")
     * 
     * @var string
     */
    #[Accessor(getter: 'getNewName', setter: 'setNewName')]
    #[SerializedName(name: 'newName')]
    #[Type(name: 'string')]
    #[XmlElement(cdata: false,namespace: 'urn:zimbraAdmin')]
    private $newName;

    /**
     * Constructor
     * 
     * @param AccountSelector $account
     * @param string $newName
     * @return self
     */
    public function __construct(AccountSelector $account, string $newName = '')
    {
        $this->setAccount($account)
             ->setNewName($newName);
    }

    /**
     * Get the account.
     *
     * @return AccountSelector
     */
    public function getAccount(): AccountSelector
    {
        return $this->account;
    }

    /**
     * Set the account.
     *
     * @param  AccountSelector $account
     * @return self
     */
    public function setAccount(AccountSelector $account): self
    {
        $this->account = $account;
        return $this;
    }

    /**
     * Get new account name
     *
     * @return string
     */
    public function getNewName(): string
    {
        return $this->newName;
    }

    /**
     * Set new account name
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ChangePrimaryEmailEnvelope(
            new ChangePrimaryEmailBody($this)
        );
    }
}
