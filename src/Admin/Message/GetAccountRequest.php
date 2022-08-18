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
use Zimbra\Common\Struct\{AccountSelector, AttributeSelector, AttributeSelectorTrait};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetAccountRequest class
 * Get attributes related to an account
 * {attrs} - comma-seperated list of attrs to return
 * Note: this request is by default proxied to the account's home server
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAccountRequest extends SoapRequest implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * Flag whether or not to apply class of service (COS) rules
     * 1 (true) [default] COS rules apply and unset attrs on an account will get their value from the COS
     * 0 (false) only attributes directly set on the account will be returned
     * 
     * @var bool
     */
    #[Accessor(getter: 'isApplyCos', setter: 'setApplyCos')]
    #[SerializedName('applyCos')]
    #[Type('bool')]
    #[XmlAttribute]
    private $applyCos;

    /**
     * Account
     * 
     * @var AccountSelector
     */
    #[Accessor(getter: 'getAccount', setter: 'setAccount')]
    #[SerializedName('account')]
    #[Type(AccountSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $account;

    /**
     * Constructor
     * 
     * @param  AccountSelector $account
     * @param  bool $applyCos
     * @param  string $attrs
     * @return self
     */
    public function __construct(
        AccountSelector $account, ?bool $applyCos = NULL, ?string $attrs = NULL
    )
    {
        $this->setAccount($account);
        if (NULL !== $applyCos) {
            $this->setApplyCos($applyCos);
        }
        if (NULL !== $attrs) {
            $this->setAttrs($attrs);
        }
    }

    /**
     * Get applyCos
     *
     * @return bool
     */
    public function isApplyCos(): ?bool
    {
        return $this->applyCos;
    }

    /**
     * Set applyCos
     *
     * @param  bool $applyCos
     * @return self
     */
    public function setApplyCos(bool $applyCos): self
    {
        $this->applyCos = $applyCos;
        return $this;
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetAccountEnvelope(
            new GetAccountBody($this)
        );
    }
}
