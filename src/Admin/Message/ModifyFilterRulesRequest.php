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
    XmlElement,
    XmlList
};
use Zimbra\Admin\Struct\{CosSelector, DomainSelector, ServerSelector};
use Zimbra\Common\Enum\AdminFilterType;
use Zimbra\Common\Struct\{AccountSelector, SoapEnvelopeInterface, SoapRequest};
use Zimbra\Mail\Struct\FilterRule;

/**
 * ModifyFilterRulesRequest request class
 * Modify Filter rules
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifyFilterRulesRequest extends SoapRequest
{
    /**
     * Type can be either before or after
     *
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Enum<Zimbra\Common\Enum\AdminFilterType>")
     * @XmlAttribute
     *
     * @var AdminFilterType
     */
    #[Accessor(getter: "getType", setter: "setType")]
    #[SerializedName("type")]
    #[Type("Enum<Zimbra\Common\Enum\AdminFilterType>")]
    #[XmlAttribute]
    private AdminFilterType $type;

    /**
     * Account
     *
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Common\Struct\AccountSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var AccountSelector
     */
    #[Accessor(getter: "getAccount", setter: "setAccount")]
    #[SerializedName("account")]
    #[Type(AccountSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?AccountSelector $account;

    /**
     * Domain
     *
     * @Accessor(getter="getDomain", setter="setDomain")
     * @SerializedName("domain")
     * @Type("Zimbra\Admin\Struct\DomainSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @var DomainSelector
     */
    #[Accessor(getter: "getDomain", setter: "setDomain")]
    #[SerializedName("domain")]
    #[Type(DomainSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?DomainSelector $domain;

    /**
     * COS
     *
     * @Accessor(getter="getCos", setter="setCos")
     * @SerializedName("cos")
     * @Type("Zimbra\Admin\Struct\CosSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var CosSelector
     */
    #[Accessor(getter: "getCos", setter: "setCos")]
    #[SerializedName("cos")]
    #[Type(CosSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?CosSelector $cos;

    /**
     * Server
     *
     * @Accessor(getter="getServer", setter="setServer")
     * @SerializedName("server")
     * @Type("Zimbra\Admin\Struct\ServerSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var ServerSelector
     */
    #[Accessor(getter: "getServer", setter: "setServer")]
    #[SerializedName("server")]
    #[Type(ServerSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?ServerSelector $server;

    /**
     * Filter filterRules
     *
     * @Accessor(getter="getFilterRules", setter="setFilterRules")
     * @SerializedName("filterRules")
     * @Type("array<Zimbra\Mail\Struct\FilterRule>")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @XmlList(inline=false, entry="filterRule", namespace="urn:zimbraMail")
     *
     * @var array
     */
    #[Accessor(getter: "getFilterRules", setter: "setFilterRules")]
    #[SerializedName("filterRules")]
    #[Type("array<Zimbra\Mail\Struct\FilterRule>")]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    #[XmlList(inline: false, entry: "filterRule", namespace: "urn:zimbraMail")]
    private $filterRules = [];

    /**
     * Constructor
     *
     * @param  AdminFilterType $type
     * @param  AccountSelector $account
     * @param  DomainSelector $domain
     * @param  CosSelector $cos
     * @param  ServerSelector $server
     * @param  array $filterRules
     * @return self
     */
    public function __construct(
        ?AdminFilterType $type = null,
        ?AccountSelector $account = null,
        ?DomainSelector $domain = null,
        ?CosSelector $cos = null,
        ?ServerSelector $server = null,
        array $filterRules = []
    ) {
        $this->setType($type ?? new AdminFilterType("before"))->setFilterRules(
            $filterRules
        );
        $this->account = $account;
        $this->domain = $domain;
        $this->cos = $cos;
        $this->server = $server;
    }

    /**
     * Get type
     *
     * @return AdminFilterType
     */
    public function getType(): AdminFilterType
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param  AdminFilterType $type
     * @return self
     */
    public function setType(AdminFilterType $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get the account.
     *
     * @return AccountSelector
     */
    public function getAccount(): ?AccountSelector
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
     * Get the server.
     *
     * @return ServerSelector
     */
    public function getServer(): ?ServerSelector
    {
        return $this->server;
    }

    /**
     * Set the server.
     *
     * @param  ServerSelector $server
     * @return self
     */
    public function setServer(ServerSelector $server): self
    {
        $this->server = $server;
        return $this;
    }

    /**
     * Set the domain.
     *
     * @return DomainSelector
     */
    public function getDomain(): ?DomainSelector
    {
        return $this->domain;
    }

    /**
     * Set the domain.
     *
     * @param  DomainSelector $domain
     * @return self
     */
    public function setDomain(DomainSelector $domain): self
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * Get the cos.
     *
     * @return CosSelector
     */
    public function getCos(): ?CosSelector
    {
        return $this->cos;
    }

    /**
     * Set the cos.
     *
     * @param  CosSelector $cos
     * @return self
     */
    public function setCos(CosSelector $cos): self
    {
        $this->cos = $cos;
        return $this;
    }

    /**
     * Add a filter rule
     *
     * @param  FilterRule $rule
     * @return self
     */
    public function addFilterRule(FilterRule $rule): self
    {
        $this->filterRules[] = $rule;
        return $this;
    }

    /**
     * Set filter filterRules
     *
     * @param  array $filterRules
     * @return self
     */
    public function setFilterRules(array $filterRules): self
    {
        $this->filterRules = array_filter(
            $filterRules,
            static fn($rule) => $rule instanceof FilterRule
        );
        return $this;
    }

    /**
     * Get filter filterRules
     *
     * @return array
     */
    public function getFilterRules(): array
    {
        return $this->filterRules;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ModifyFilterRulesEnvelope(new ModifyFilterRulesBody($this));
    }
}
