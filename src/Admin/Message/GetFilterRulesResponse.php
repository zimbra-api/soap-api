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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};
use Zimbra\Admin\Struct\{CosSelector, DomainSelector, ServerSelector};
use Zimbra\Common\Enum\AdminFilterType;
use Zimbra\Common\Struct\{AccountSelector, SoapResponse};
use Zimbra\Mail\Struct\FilterRule;

/**
 * GetFilterRulesResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetFilterRulesResponse extends SoapResponse
{
    /**
     * Type can be either before or after
     * 
     * @var AdminFilterType
     */
    #[Accessor(getter: 'getType', setter: 'setType')]
    #[SerializedName(name: 'type')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\AdminFilterType>')]
    #[XmlAttribute]
    private $type;

    /**
     * Account
     * 
     * @var AccountSelector
     */
    #[Accessor(getter: 'getAccount', setter: 'setAccount')]
    #[SerializedName(name: 'account')]
    #[Type(name: AccountSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $account;

    /**
     * Domain
     * 
     * @var DomainSelector
     */
    #[Accessor(getter: 'getDomain', setter: 'setDomain')]
    #[SerializedName(name: 'domain')]
    #[Type(name: DomainSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $domain;

    /**
     * COS
     * 
     * @var CosSelector
     */
    #[Accessor(getter: 'getCos', setter: 'setCos')]
    #[SerializedName(name: 'cos')]
    #[Type(name: CosSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $cos;

    /**
     * Server
     * 
     * @var ServerSelector
     */
    #[Accessor(getter: 'getServer', setter: 'setServer')]
    #[SerializedName(name: 'server')]
    #[Type(name: ServerSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $server;

    /**
     * Filter rules
     * 
     * @var array
     */
    #[Accessor(getter: 'getFilterRules', setter: 'setFilterRules')]
    #[SerializedName(name: 'filterRules')]
    #[Type(name: 'array<Zimbra\Mail\Struct\FilterRule>')]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    #[XmlList(inline: false, entry: 'filterRule', namespace: 'urn:zimbraMail')]
    private $rules = [];

    /**
     * Constructor
     *
     * @param  AdminFilterType $type
     * @param  AccountSelector $account
     * @param  DomainSelector $domain
     * @param  CosSelector $cos
     * @param  ServerSelector $server
     * @param  array $rules
     * @return self
     */
    public function __construct(
        ?AdminFilterType $type = NULL,
        ?AccountSelector $account = NULL,
        ?DomainSelector $domain = NULL,
        ?CosSelector $cos = NULL,
        ?ServerSelector $server = NULL,
        array $rules = []
    )
    {
        $this->setFilterRules($rules);
        if ($type instanceof AdminFilterType) {
            $this->setType($type);
        }
        if ($account instanceof AccountSelector) {
            $this->setAccount($account);
        }
        if ($domain instanceof DomainSelector) {
            $this->setDomain($domain);
        }
        if ($cos instanceof CosSelector) {
            $this->setCos($cos);
        }
        if ($server instanceof ServerSelector) {
            $this->setServer($server);
        }
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
    public function getCos(): CosSelector
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
     * Set filter rules
     *
     * @param  array $rules
     * @return self
     */
    public function setFilterRules(array $rules): self
    {
        $this->rules = array_filter($rules, static fn ($rule) => $rule instanceof FilterRule);
        return $this;
    }

    /**
     * Get filter rules
     *
     * @return array
     */
    public function getFilterRules(): array
    {
        return $this->rules;
    }
}
