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
use Zimbra\Admin\Struct\{
    AccountInfo, AliasInfo, CalendarResourceInfo, CosInfo, DistributionListInfo, DomainInfo
};
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * SearchAccountsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SearchAccountsResponse implements SoapResponseInterface
{
    /**
     * 1 (true) if more accounts left to return
     * @Accessor(getter="getMore", setter="setMore")
     * @SerializedName("more")
     * @Type("bool")
     * @XmlAttribute
     */
    private $more;

    /**
     * Total number of accounts that matched search (not affected by limit/searchTotal)
     * @Accessor(getter="getSearchTotal", setter="setSearchTotal")
     * @SerializedName("searchTotal")
     * @Type("integer")
     * @XmlAttribute
     */
    private $searchTotal;

    /**
     * Information on calendar resources
     * 
     * @Accessor(getter="getCalendarResources", setter="setCalendarResources")
     * @Type("array<Zimbra\Admin\Struct\CalendarResourceInfo>")
     * @XmlList(inline=true, entry="calresource", namespace="urn:zimbraAdmin")
     */
    private $calResources = [];

    /**
     * Information on distribution lists
     * 
     * @Accessor(getter="getDistributionLists", setter="setDistributionLists")
     * @Type("array<Zimbra\Admin\Struct\DistributionListInfo>")
     * @XmlList(inline=true, entry="dl", namespace="urn:zimbraAdmin")
     */
    private $dls = [];

    /**
     * Information on aliases
     * 
     * @Accessor(getter="getAliases", setter="setAliases")
     * @Type("array<Zimbra\Admin\Struct\AliasInfo>")
     * @XmlList(inline=true, entry="alias", namespace="urn:zimbraAdmin")
     */
    private $aliases = [];

    /**
     * Information on accounts
     * 
     * @Accessor(getter="getAccounts", setter="setAccounts")
     * @Type("array<Zimbra\Admin\Struct\AccountInfo>")
     * @XmlList(inline=true, entry="account", namespace="urn:zimbraAdmin")
     */
    private $accounts = [];

    /**
     * Information on domains
     * 
     * @Accessor(getter="getDomains", setter="setDomains")
     * @Type("array<Zimbra\Admin\Struct\DomainInfo>")
     * @XmlList(inline=true, entry="domain", namespace="urn:zimbraAdmin")
     */
    private $domains = [];

    /**
     * Information on Classes of Service (COS)
     * 
     * @Accessor(getter="getCOSes", setter="setCOSes")
     * @Type("array<Zimbra\Admin\Struct\CosInfo>")
     * @XmlList(inline=true, entry="cos", namespace="urn:zimbraAdmin")
     */
    private $coses = [];

    /**
     * Constructor method for SearchAccountsResponse
     *
     * @param bool $more
     * @param int $searchTotal
     * @param array $calResources
     * @param array $dls
     * @param array $aliases
     * @param array $accounts
     * @param array $domains
     * @param array $coses
     * @return self
     */
    public function __construct(
        bool $more = FALSE,
        int $searchTotal = 0,
        array $calResources = [],
        array $dls = [],
        array $aliases = [],
        array $accounts = [],
        array $domains = [],
        array $coses = []
    )
    {
        $this->setMore($more)
             ->setSearchTotal($searchTotal)
             ->setCalendarResources($calResources)
             ->setDistributionLists($dls)
             ->setAliases($aliases)
             ->setAccounts($accounts)
             ->setDomains($domains)
             ->setCOSes($coses);
    }

    /**
     * Get more
     *
     * @return bool
     */
    public function getMore(): bool
    {
        return $this->more;
    }

    /**
     * Set more
     *
     * @param  bool $more
     * @return self
     */
    public function setMore(bool $more): self
    {
        $this->more = $more;
        return $this;
    }

    /**
     * Get searchTotal
     *
     * @return int
     */
    public function getSearchTotal(): int
    {
        return $this->searchTotal;
    }

    /**
     * Set searchTotal
     *
     * @param  int $searchTotal
     * @return self
     */
    public function setSearchTotal(int $searchTotal): self
    {
        $this->searchTotal = $searchTotal;
        return $this;
    }

    /**
     * Add cal resource
     *
     * @param  CalendarResourceInfo $resource
     * @return self
     */
    public function addCalendarResource(CalendarResourceInfo $resource): self
    {
        $this->calResources[] = $resource;
        return $this;
    }

    /**
     * Set calResources
     *
     * @param  array $resources
     * @return self
     */
    public function setCalendarResources(array $resources): self
    {
        $this->calResources = array_filter($resources, static fn ($resource) => $resource instanceof CalendarResourceInfo);
        return $this;
    }

    /**
     * Get calResources
     *
     * @return array
     */
    public function getCalendarResources(): array
    {
        return $this->calResources;
    }

    /**
     * Add dl
     *
     * @param  DistributionListInfo $dl
     * @return self
     */
    public function addDistributionList(DistributionListInfo $dl): self
    {
        $this->dls[] = $dl;
        return $this;
    }

    /**
     * Set dls
     *
     * @param  array $dls
     * @return self
     */
    public function setDistributionLists(array $dls): self
    {
        $this->dls = array_filter($dls, static fn ($dl) => $dl instanceof DistributionListInfo);
        return $this;
    }

    /**
     * Get dls
     *
     * @return array
     */
    public function getDistributionLists(): array
    {
        return $this->dls;
    }

    /**
     * Add alias
     *
     * @param  AliasInfo $alias
     * @return self
     */
    public function addAlias(AliasInfo $alias): self
    {
        $this->aliases[] = $alias;
        return $this;
    }

    /**
     * Set aliases
     *
     * @param  array $aliases
     * @return self
     */
    public function setAliases(array $aliases): self
    {
        $this->aliases = array_filter($aliases, static fn ($alias) => $alias instanceof AliasInfo);
        return $this;
    }

    /**
     * Get aliases
     *
     * @return array
     */
    public function getAliases(): array
    {
        return $this->aliases;
    }

    /**
     * Add an account
     *
     * @param  AccountInfo $account
     * @return self
     */
    public function addAccount(AccountInfo $account): self
    {
        $this->accounts[] = $account;
        return $this;
    }

    /**
     * Set accounts
     *
     * @param  array $accounts
     * @return self
     */
    public function setAccounts(array $accounts): self
    {
        $this->accounts = array_filter($accounts, static fn ($account) => $account instanceof AccountInfo);
        return $this;
    }

    /**
     * Get accounts
     *
     * @return array
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }

    /**
     * Add a domain information
     *
     * @param  DomainInfo $domain
     * @return self
     */
    public function addDomain(DomainInfo $domain): self
    {
        $this->domains[] = $domain;
        return $this;
    }

    /**
     * Set domain informations
     *
     * @param  array $domains
     * @return self
     */
    public function setDomains(array $domains): self
    {
        $this->domains = array_filter($domains, static fn ($domain) => $domain instanceof DomainInfo);
        return $this;
    }

    /**
     * Get domain informations
     *
     * @return array
     */
    public function getDomains(): array
    {
        return $this->domains;
    }

    /**
     * Add cos
     *
     * @param  CosInfo $cos
     * @return self
     */
    public function addCos(CosInfo $cos): self
    {
        $this->coses[] = $cos;
        return $this;
    }

    /**
     * Set coses
     *
     * @param  array $coses
     * @return self
     */
    public function setCOSes(array $coses): self
    {
        $this->coses = array_filter($coses, static fn ($cos) => $cos instanceof CosInfo);
        return $this;
    }

    /**
     * Get coses
     *
     * @return array
     */
    public function getCOSes(): array
    {
        return $this->coses;
    }
}
