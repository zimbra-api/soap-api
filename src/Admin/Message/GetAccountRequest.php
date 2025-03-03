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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};
use Zimbra\Common\Struct\{
    AccountSelector,
    AttributeSelector,
    AttributeSelectorTrait,
    SoapEnvelopeInterface,
    SoapRequest
};

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
    #[Accessor(getter: "isApplyCos", setter: "setApplyCos")]
    #[SerializedName("applyCos")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $applyCos = null;

    /**
     * Flag whether or not to get effective value (minimum of zimbraMailQuota and zimbraMailDomainQuota)
     * 1 (true) zimbraMailQuota attribute will contain effective value
     * 0 (false) [default] zimbraMailQuota attribute will contain actual ldap value set
     *
     * @var bool
     */
    #[Accessor(getter: "isEffectiveQuota", setter: "setEffectiveQuota")]
    #[SerializedName("effectiveQuota")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $effectiveQuota = null;

    /**
     * Account
     *
     * @var AccountSelector
     */
    #[Accessor(getter: "getAccount", setter: "setAccount")]
    #[SerializedName("account")]
    #[Type(AccountSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private AccountSelector $account;

    /**
     * Constructor
     *
     * @param  AccountSelector $account
     * @param  bool $applyCos
     * @param  bool $effectiveQuota
     * @param  string $attrs
     * @return self
     */
    public function __construct(
        AccountSelector $account,
        ?bool $applyCos = null,
        ?bool $effectiveQuota = null,
        ?string $attrs = null
    ) {
        $this->setAccount($account);
        if (null !== $applyCos) {
            $this->setApplyCos($applyCos);
        }
        if (null !== $effectiveQuota) {
            $this->setEffectiveQuota($effectiveQuota);
        }
        if (null !== $attrs) {
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
     * Get effectiveQuota
     *
     * @return bool
     */
    public function isEffectiveQuota(): ?bool
    {
        return $this->effectiveQuota;
    }

    /**
     * Set effectiveQuota
     *
     * @param  bool $effectiveQuota
     * @return self
     */
    public function setEffectiveQuota(bool $effectiveQuota): self
    {
        $this->effectiveQuota = $effectiveQuota;
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
        return new GetAccountEnvelope(new GetAccountBody($this));
    }
}
