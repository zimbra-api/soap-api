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
use Zimbra\Admin\Struct\CosSelector as Cos;
use Zimbra\Admin\Struct\DomainSelector as Domain;
use Zimbra\Admin\Struct\ServerSelector as Server;
use Zimbra\Common\Enum\AdminFilterType;
use Zimbra\Common\Struct\AccountSelector as Account;
use Zimbra\Mail\Struct\FilterRule;
use Zimbra\Soap\Request;

/**
 * ModifyFilterRulesRequest request class
 * Modify Filter rules
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ModifyFilterRulesRequest extends Request
{
    /**
     * Type can be either before or after
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Zimbra\Common\Enum\AdminFilterType")
     * @XmlAttribute
     */
    private AdminFilterType $type;

    /**
     * Account
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Common\Struct\AccountSelector")
     * @XmlElement
     */
    private ?Account $account = NULL;

    /**
     * Domain
     * @Accessor(getter="getDomain", setter="setDomain")
     * @SerializedName("domain")
     * @Type("Zimbra\Admin\Struct\DomainSelector")
     * @XmlElement
     */
    private ?Domain $domain = NULL;

    /**
     * COS
     * @Accessor(getter="getCos", setter="setCos")
     * @SerializedName("cos")
     * @Type("Zimbra\Admin\Struct\CosSelector")
     * @XmlElement
     */
    private ?Cos $cos = NULL;

    /**
     * Server
     * @Accessor(getter="getServer", setter="setServer")
     * @SerializedName("server")
     * @Type("Zimbra\Admin\Struct\ServerSelector")
     * @XmlElement
     */
    private ?Server $server = NULL;

    /**
     * Filter filterRules
     * 
     * @Accessor(getter="getFilterRules", setter="setFilterRules")
     * @SerializedName("filterRules")
     * @Type("array<Zimbra\Mail\Struct\FilterRule>")
     * @XmlList(inline = false, entry = "filterRule")
     */
    private $filterRules = [];

    /**
     * Constructor method for ModifyFilterRulesRequest
     * 
     * @param  AdminFilterType $type
     * @param  Account $account
     * @param  Domain $domain
     * @param  Cos $cos
     * @param  Server $server
     * @param  array $filterRules
     * @return self
     */
    public function __construct(
        AdminFilterType $type,
        ?Account $account = NULL,
        ?Domain $domain = NULL,
        ?Cos $cos = NULL,
        ?Server $server = NULL,
        array $filterRules = []
    )
    {
        $this->setType($type)
             ->setFilterRules($filterRules);
        if ($account instanceof Account) {
            $this->setAccount($account);
        }
        if ($domain instanceof Domain) {
            $this->setDomain($domain);
        }
        if ($cos instanceof Cos) {
            $this->setCos($cos);
        }
        if ($server instanceof Server) {
            $this->setServer($server);
        }
    }

    /**
     * Gets type
     *
     * @return AdminFilterType
     */
    public function getType(): AdminFilterType
    {
        return $this->type;
    }

    /**
     * Sets type
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
     * Gets the account.
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
     * Gets the server.
     *
     * @return Server
     */
    public function getServer(): ?Server
    {
        return $this->server;
    }

    /**
     * Sets the server.
     *
     * @param  Server $server
     * @return self
     */
    public function setServer(Server $server): self
    {
        $this->server = $server;
        return $this;
    }

    /**
     * Sets the domain.
     *
     * @return Domain
     */
    public function getDomain(): ?Domain
    {
        return $this->domain;
    }

    /**
     * Sets the domain.
     *
     * @param  Domain $domain
     * @return self
     */
    public function setDomain(Domain $domain): self
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * Gets the cos.
     *
     * @return Cos
     */
    public function getCos(): Cos
    {
        return $this->cos;
    }

    /**
     * Sets the cos.
     *
     * @param  Cos $cos
     * @return self
     */
    public function setCos(Cos $cos): self
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
     * Sets filter filterRules
     *
     * @param  array $filterRules
     * @return self
     */
    public function setFilterRules(array $filterRules): self
    {
        $this->filterRules = [];
        foreach ($filterRules as $rule) {
            if ($rule instanceof FilterRule) {
                $this->filterRules[] = $rule;
            }
        }
        return $this;
    }

    /**
     * Gets filter filterRules
     *
     * @return array
     */
    public function getFilterRules(): array
    {
        return $this->filterRules;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof ModifyFilterRulesEnvelope)) {
            $this->envelope = new ModifyFilterRulesEnvelope(
                new ModifyFilterRulesBody($this)
            );
        }
    }
}
