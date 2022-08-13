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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetQuotaUsageRequest class
 * Get Quota Usage
 * The target server should be specified in the soap header (see soap.txt, targetServer).
 * When sorting by "quotaLimit", 0 is treated as the highest value possible.
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetQuotaUsageRequest extends SoapRequest
{
    /**
     * Domain - the domain name to limit the search to
     * 
     * @Accessor(getter="getDomain", setter="setDomain")
     * @SerializedName("domain")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getDomain', setter: 'setDomain')]
    #[SerializedName(name: 'domain')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $domain;

    /**
     * whether to fetch quota usage for all domain accounts from across all mailbox servers,
     * default is false, applicable when domain attribute is specified
     * 
     * @Accessor(getter="isAllServers", setter="setAllServers")
     * @SerializedName("allServers")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'isAllServers', setter: 'setAllServers')]
    #[SerializedName(name: 'allServers')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $allServers;

    /**
     * Limit - the number of accounts to return (0 is default and means all)
     * 
     * @Accessor(getter="getLimit", setter="setLimit")
     * @SerializedName("limit")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getLimit', setter: 'setLimit')]
    #[SerializedName(name: 'limit')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $limit;

    /**
     * Offset - the starting offset (0, 25, etc)
     * 
     * @Accessor(getter="getOffset", setter="setOffset")
     * @SerializedName("offset")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getOffset', setter: 'setOffset')]
    #[SerializedName(name: 'offset')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $offset;

    /**
     * SortBy - valid values: "percentUsed", "totalUsed", "quotaLimit"
     * 
     * @Accessor(getter="getSortBy", setter="setSortBy")
     * @SerializedName("sortBy")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getSortBy', setter: 'setSortBy')]
    #[SerializedName(name: 'sortBy')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $sortBy;

    /**
     * Whether to sort in ascending order 0 (false) is default, so highest quotas are returned first
     * 
     * @Accessor(getter="isSortAscending", setter="setSortAscending")
     * @SerializedName("sortAscending")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'isSortAscending', setter: 'setSortAscending')]
    #[SerializedName(name: 'sortAscending')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $sortAscending;

    /**
     * Refresh - whether to always recalculate the data even when cached values are available.
     * 0 (false) is the default.
     * 
     * @Accessor(getter="isRefresh", setter="setRefresh")
     * @SerializedName("refresh")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'isRefresh', setter: 'setRefresh')]
    #[SerializedName(name: 'refresh')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $refresh;

    /**
     * Constructor
     *
     * @param  string $domain
     * @param  bool $allServers
     * @param  int $limit
     * @param  int $offset
     * @param  string $sortBy
     * @param  bool $sortAscending
     * @param  bool $refresh
     * @return self
     */
    public function __construct(
        ?string $domain = NULL,
        ?bool $allServers = NULL,
        ?int $limit = NULL,
        ?int $offset = NULL,
        ?string $sortBy = NULL,
        ?bool $sortAscending = NULL,
        ?bool $refresh = NULL
    )
    {
        if (NULL !== $domain) {
            $this->setDomain($domain);
        }
        if (NULL !== $allServers) {
            $this->setAllServers($allServers);
        }
        if (NULL !== $limit) {
            $this->setLimit($limit);
        }
        if (NULL !== $offset) {
            $this->setOffset($offset);
        }
        if (NULL !== $sortBy) {
            $this->setSortBy($sortBy);
        }
        if (NULL !== $sortAscending) {
            $this->setSortAscending($sortAscending);
        }
        if (NULL !== $refresh) {
            $this->setRefresh($refresh);
        }
    }

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain(): ?string
    {
        return $this->domain;
    }

    /**
     * Set domain
     *
     * @param  string $domain
     * @return self
     */
    public function setDomain(string $domain): self
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * Get allServers
     *
     * @return bool
     */
    public function isAllServers(): ?bool
    {
        return $this->allServers;
    }

    /**
     * Set allServers
     *
     * @param  bool $allServers
     * @return self
     */
    public function setAllServers(bool $allServers): self
    {
        $this->allServers = $allServers;
        return $this;
    }

    /**
     * Get limit
     *
     * @return int
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * Set limit
     *
     * @param  int $limit
     * @return self
     */
    public function setLimit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * Get offset
     *
     * @return int
     */
    public function getOffset(): ?int
    {
        return $this->offset;
    }

    /**
     * Set offset
     *
     * @param  int $offset
     * @return self
     */
    public function setOffset(int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * Get sortBy
     *
     * @return string
     */
    public function getSortBy(): ?string
    {
        return $this->sortBy;
    }

    /**
     * Set sortBy
     *
     * @param  string $sortBy
     * @return self
     */
    public function setSortBy(string $sortBy): self
    {
        $this->sortBy = $sortBy;
        return $this;
    }

    /**
     * Get sortAscending
     *
     * @return bool
     */
    public function isSortAscending(): ?bool
    {
        return $this->sortAscending;
    }

    /**
     * Set sortAscending
     *
     * @param  bool $sortAscending
     * @return self
     */
    public function setSortAscending(bool $sortAscending): self
    {
        $this->sortAscending = $sortAscending;
        return $this;
    }

    /**
     * Get refresh
     *
     * @return bool
     */
    public function isRefresh(): ?bool
    {
        return $this->refresh;
    }

    /**
     * Set refresh
     *
     * @param  bool $refresh
     * @return self
     */
    public function setRefresh(bool $refresh): self
    {
        $this->refresh = $refresh;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetQuotaUsageEnvelope(
            new GetQuotaUsageBody($this)
        );
    }
}
