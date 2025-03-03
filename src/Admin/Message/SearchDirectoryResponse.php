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
    XmlList
};
use Zimbra\Admin\Struct\{
    AccountInfo,
    AliasInfo,
    CalendarResourceInfo,
    CosInfo,
    DistributionListInfo,
    DomainInfo
};
use Zimbra\Common\Struct\SoapResponse;

/**
 * SearchDirectoryResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SearchDirectoryResponse extends SoapResponse
{
    /**
     * number of counts
     *
     * @var int
     */
    #[Accessor(getter: "getNum", setter: "setNum")]
    #[SerializedName("num")]
    #[Type("int")]
    #[XmlAttribute]
    private int $num;

    /**
     * 1 (true) if more accounts left to return
     *
     * @var bool
     */
    #[Accessor(getter: "isMore", setter: "setMore")]
    #[SerializedName("more")]
    #[Type("bool")]
    #[XmlAttribute]
    private bool $more;

    /**
     * Total number of accounts that matched search (not affected by limit/searchTotal)
     *
     * @var int
     */
    #[Accessor(getter: "getSearchTotal", setter: "setSearchTotal")]
    #[SerializedName("searchTotal")]
    #[Type("int")]
    #[XmlAttribute]
    private int $searchTotal;

    /**
     * Information on calendar resources
     *
     * @var array
     */
    #[Accessor(getter: "getCalendarResources", setter: "setCalendarResources")]
    #[Type("array<Zimbra\Admin\Struct\CalendarResourceInfo>")]
    #[XmlList(inline: true, entry: "calresource", namespace: "urn:zimbraAdmin")]
    private array $calResources = [];

    /**
     * Information on distribution lists
     *
     * @var array
     */
    #[Accessor(getter: "getDistributionLists", setter: "setDistributionLists")]
    #[Type("array<Zimbra\Admin\Struct\DistributionListInfo>")]
    #[XmlList(inline: true, entry: "dl", namespace: "urn:zimbraAdmin")]
    private array $dls = [];

    /**
     * Information on aliases
     *
     * @var array
     */
    #[Accessor(getter: "getAliases", setter: "setAliases")]
    #[Type("array<Zimbra\Admin\Struct\AliasInfo>")]
    #[XmlList(inline: true, entry: "alias", namespace: "urn:zimbraAdmin")]
    private array $aliases = [];

    /**
     * Information on accounts
     *
     * @var array
     */
    #[Accessor(getter: "getAccounts", setter: "setAccounts")]
    #[Type("array<Zimbra\Admin\Struct\AccountInfo>")]
    #[XmlList(inline: true, entry: "account", namespace: "urn:zimbraAdmin")]
    private array $accounts = [];

    /**
     * Information on domains
     *
     * @var array
     */
    #[Accessor(getter: "getDomains", setter: "setDomains")]
    #[Type("array<Zimbra\Admin\Struct\DomainInfo>")]
    #[XmlList(inline: true, entry: "domain", namespace: "urn:zimbraAdmin")]
    private array $domains = [];

    /**
     * Information on Classes of Service (COS)
     *
     * @var array
     */
    #[Accessor(getter: "getCOSes", setter: "setCOSes")]
    #[Type("array<Zimbra\Admin\Struct\CosInfo>")]
    #[XmlList(inline: true, entry: "cos", namespace: "urn:zimbraAdmin")]
    private array $coses = [];

    /**
     * Constructor
     *
     * @param int $num
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
        int $num = 0,
        bool $more = false,
        int $searchTotal = 0,
        array $calResources = [],
        array $dls = [],
        array $aliases = [],
        array $accounts = [],
        array $domains = [],
        array $coses = []
    ) {
        $this->setNum($num)
            ->setMore($more)
            ->setSearchTotal($searchTotal)
            ->setCalendarResources($calResources)
            ->setDistributionLists($dls)
            ->setAliases($aliases)
            ->setAccounts($accounts)
            ->setDomains($domains)
            ->setCOSes($coses);
    }

    /**
     * Get num
     *
     * @return int
     */
    public function getNum(): int
    {
        return $this->num;
    }

    /**
     * Set num
     *
     * @param  int $num
     * @return self
     */
    public function setNum(int $num): self
    {
        $this->num = $num;
        return $this;
    }

    /**
     * Get more
     *
     * @return bool
     */
    public function isMore(): bool
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
     * Set calResources
     *
     * @param  array $resources
     * @return self
     */
    public function setCalendarResources(array $resources): self
    {
        $this->calResources = array_filter(
            $resources,
            static fn($resource) => $resource instanceof CalendarResourceInfo
        );
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
     * Set dls
     *
     * @param  array $dls
     * @return self
     */
    public function setDistributionLists(array $dls): self
    {
        $this->dls = array_filter(
            $dls,
            static fn($dl) => $dl instanceof DistributionListInfo
        );
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
     * Set aliases
     *
     * @param  array $aliases
     * @return self
     */
    public function setAliases(array $aliases): self
    {
        $this->aliases = array_filter(
            $aliases,
            static fn($alias) => $alias instanceof AliasInfo
        );
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
     * Set accounts
     *
     * @param  array $accounts
     * @return self
     */
    public function setAccounts(array $accounts): self
    {
        $this->accounts = array_filter(
            $accounts,
            static fn($account) => $account instanceof AccountInfo
        );
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
     * Set domain informations
     *
     * @param  array $domains
     * @return self
     */
    public function setDomains(array $domains): self
    {
        $this->domains = array_filter(
            $domains,
            static fn($domain) => $domain instanceof DomainInfo
        );
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
     * Set coses
     *
     * @param  array $coses
     * @return self
     */
    public function setCOSes(array $coses): self
    {
        $this->coses = array_filter(
            $coses,
            static fn($cos) => $cos instanceof CosInfo
        );
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
