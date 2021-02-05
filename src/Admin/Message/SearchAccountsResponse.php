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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};
use Zimbra\Admin\Struct\CalendarResourceInfo;
use Zimbra\Admin\Struct\DistributionListInfo;
use Zimbra\Admin\Struct\AliasInfo;
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\DomainInfo;
use Zimbra\Admin\Struct\CosInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * SearchAccountsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="SearchAccountsResponse")
 */
class SearchAccountsResponse implements ResponseInterface
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
     * @SerializedName("calresource")
     * @Type("array<Zimbra\Admin\Struct\CalendarResourceInfo>")
     * @XmlList(inline = true, entry = "calresource")
     */
    private $calResources;

    /**
     * Information on distribution lists
     * 
     * @Accessor(getter="getDistributionLists", setter="setDistributionLists")
     * @SerializedName("dl")
     * @Type("array<Zimbra\Admin\Struct\DistributionListInfo>")
     * @XmlList(inline = true, entry = "dl")
     */
    private $dls;

    /**
     * Information on aliases
     * 
     * @Accessor(getter="getAliases", setter="setAliases")
     * @SerializedName("alias")
     * @Type("array<Zimbra\Admin\Struct\AliasInfo>")
     * @XmlList(inline = true, entry = "alias")
     */
    private $aliases;

    /**
     * Information on accounts
     * 
     * @Accessor(getter="getAccounts", setter="setAccounts")
     * @SerializedName("account")
     * @Type("array<Zimbra\Admin\Struct\AccountInfo>")
     * @XmlList(inline = true, entry = "account")
     */
    private $accounts;

    /**
     * Information on domains
     * 
     * @Accessor(getter="getDomains", setter="setDomains")
     * @SerializedName("domain")
     * @Type("array<Zimbra\Admin\Struct\DomainInfo>")
     * @XmlList(inline = true, entry = "domain")
     */
    private $domains;

    /**
     * Information on Classes of Service (COS)
     * 
     * @Accessor(getter="getCOSes", setter="setCOSes")
     * @SerializedName("cos")
     * @Type("array<Zimbra\Admin\Struct\CosInfo>")
     * @XmlList(inline = true, entry = "cos")
     */
    private $coses;

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
        bool $more,
        int $searchTotal,
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
     * Gets more
     *
     * @return bool
     */
    public function getMore(): bool
    {
        return $this->more;
    }

    /**
     * Sets more
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
     * Gets searchTotal
     *
     * @return int
     */
    public function getSearchTotal(): int
    {
        return $this->searchTotal;
    }

    /**
     * Sets searchTotal
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
     * Sets calResources
     *
     * @param  array $calResources
     * @return self
     */
    public function setCalendarResources(array $calResources): self
    {
        $this->calResources = [];
        foreach ($calResources as $resource) {
            if ($resource instanceof CalendarResourceInfo) {
                $this->calResources[] = $resource;
            }
        }
        return $this;
    }

    /**
     * Gets calResources
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
     * Sets dls
     *
     * @param  array $dls
     * @return self
     */
    public function setDistributionLists(array $dls): self
    {
        $this->dls = [];
        foreach ($dls as $dl) {
            if ($dl instanceof DistributionListInfo) {
                $this->dls[] = $dl;
            }
        }
        return $this;
    }

    /**
     * Gets dls
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
     * Sets aliases
     *
     * @param  array $aliases
     * @return self
     */
    public function setAliases(array $aliases): self
    {
        $this->aliases = [];
        foreach ($aliases as $alias) {
            if ($alias instanceof AliasInfo) {
                $this->aliases[] = $alias;
            }
        }
        return $this;
    }

    /**
     * Gets aliases
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
     * Sets accounts
     *
     * @param  array $accounts
     * @return self
     */
    public function setAccounts(array $accounts): self
    {
        $this->accounts = [];
        foreach ($accounts as $account) {
            if ($account instanceof AccountInfo) {
                $this->accounts[] = $account;
            }
        }
        return $this;
    }

    /**
     * Gets accounts
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
     * Sets domain informations
     *
     * @param  array $domains
     * @return self
     */
    public function setDomains(array $domains): self
    {
        $this->domains = [];
        foreach ($domains as $domain) {
            if ($domain instanceof DomainInfo) {
                $this->domains[] = $domain;
            }
        }
        return $this;
    }

    /**
     * Gets domain informations
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
     * Sets coses
     *
     * @param  array $coses
     * @return self
     */
    public function setCOSes(array $coses): self
    {
        $this->coses = [];
        foreach ($coses as $cos) {
            if ($cos instanceof CosInfo) {
                $this->coses[] = $cos;
            }
        }
        return $this;
    }

    /**
     * Gets coses
     *
     * @return array
     */
    public function getCOSes(): array
    {
        return $this->coses;
    }
}