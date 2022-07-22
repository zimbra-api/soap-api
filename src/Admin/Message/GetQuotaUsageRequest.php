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
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetQuotaUsageRequest extends Request
{
    /**
     * Domain - the domain name to limit the search to
     * @Accessor(getter="getDomain", setter="setDomain")
     * @SerializedName("domain")
     * @Type("string")
     * @XmlAttribute
     */
    private $domain;

    /**
     * whether to fetch quota usage for all domain accounts from across all mailbox servers,
     * default is false, applicable when domain attribute is specified
     * @Accessor(getter="isAllServers", setter="setAllServers")
     * @SerializedName("allServers")
     * @Type("bool")
     * @XmlAttribute
     */
    private $allServers;

    /**
     * Limit - the number of accounts to return (0 is default and means all)
     * @Accessor(getter="getLimit", setter="setLimit")
     * @SerializedName("limit")
     * @Type("integer")
     * @XmlAttribute
     */
    private $limit;

    /**
     * Offset - the starting offset (0, 25, etc)
     * @Accessor(getter="getOffset", setter="setOffset")
     * @SerializedName("offset")
     * @Type("integer")
     * @XmlAttribute
     */
    private $offset;

    /**
     * SortBy - valid values: "percentUsed", "totalUsed", "quotaLimit"
     * @Accessor(getter="getSortBy", setter="setSortBy")
     * @SerializedName("sortBy")
     * @Type("string")
     * @XmlAttribute
     */
    private $sortBy;

    /**
     * Whether to sort in ascending order 0 (false) is default, so highest quotas are returned first
     * @Accessor(getter="isSortAscending", setter="setSortAscending")
     * @SerializedName("sortAscending")
     * @Type("bool")
     * @XmlAttribute
     */
    private $sortAscending;

    /**
     * Refresh - whether to always recalculate the data even when cached values are available. 0 (false) is the default.
     * @Accessor(getter="isRefresh", setter="setRefresh")
     * @SerializedName("refresh")
     * @Type("bool")
     * @XmlAttribute
     */
    private $refresh;

    /**
     * Constructor method for GetQuotaUsageRequest
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
     * Gets domain
     *
     * @return string
     */
    public function getDomain(): ?string
    {
        return $this->domain;
    }

    /**
     * Sets domain
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
     * Gets allServers
     *
     * @return bool
     */
    public function isAllServers(): ?bool
    {
        return $this->allServers;
    }

    /**
     * Sets allServers
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
     * Gets limit
     *
     * @return int
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * Sets limit
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
     * Gets offset
     *
     * @return int
     */
    public function getOffset(): ?int
    {
        return $this->offset;
    }

    /**
     * Sets offset
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
     * Gets sortBy
     *
     * @return string
     */
    public function getSortBy(): ?string
    {
        return $this->sortBy;
    }

    /**
     * Sets sortBy
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
     * Gets sortAscending
     *
     * @return bool
     */
    public function isSortAscending(): ?bool
    {
        return $this->sortAscending;
    }

    /**
     * Sets sortAscending
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
     * Gets refresh
     *
     * @return bool
     */
    public function isRefresh(): ?bool
    {
        return $this->refresh;
    }

    /**
     * Sets refresh
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
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new GetQuotaUsageEnvelope(
            new GetQuotaUsageBody($this)
        );
    }
}
