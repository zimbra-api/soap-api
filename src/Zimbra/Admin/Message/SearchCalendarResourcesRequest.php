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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\EntrySearchFilterInfo;
use Zimbra\Soap\Request;
use Zimbra\Struct\AttributeSelector;
use Zimbra\Struct\AttributeSelectorTrait;

/**
 * SearchCalendarResourcesRequest class
 * Search Auto Prov Directory
 * Only one of <name> or <sortBy> can be provided.
 * If neither is provided, the configured search filter for auto provision will be used. 
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="SearchCalendarResourcesRequest")
 */
class SearchCalendarResourcesRequest extends Request implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * The maximum number of calendar resources to return (0 is default and means all)
     * @Accessor(getter="getLimit", setter="setLimit")
     * @SerializedName("limit")
     * @Type("integer")
     * @XmlAttribute
     */
    private $limit;

    /**
     * The starting offset (0, 25, etc)
     * @Accessor(getter="getOffset", setter="setOffset")
     * @SerializedName("offset")
     * @Type("integer")
     * @XmlAttribute
     */
    private $offset;

    /**
     * The domain name to limit the search to
     * @Accessor(getter="getDomain", setter="setDomain")
     * @SerializedName("domain")
     * @Type("string")
     * @XmlAttribute
     */
    private $domain;

    /**
     * applyCos - Flag whether or not to apply the COS policy to calendar resource.
     * Specify 0 (false) if only requesting attrs that aren't inherited from COS
     * @Accessor(getter="getApplyCos", setter="setApplyCos")
     * @SerializedName("applyCos")
     * @Type("bool")
     * @XmlAttribute
     */
    private $applyCos;

    /**
     * Name of attribute to sort on. default is the calendar resource name.
     * @Accessor(getter="getSortBy", setter="setSortBy")
     * @SerializedName("sortBy")
     * @Type("string")
     * @XmlAttribute
     */
    private $sortBy;

    /**
     * Whether to sort in ascending order. Default is 1 (true)
     * @Accessor(getter="getSortAscending", setter="setSortAscending")
     * @SerializedName("sortAscending")
     * @Type("bool")
     * @XmlAttribute
     */
    private $sortAscending;

    /**
     * Search Filter
     * @Accessor(getter="getSearchFilter", setter="setSearchFilter")
     * @SerializedName("searchFilter")
     * @Type("Zimbra\Admin\Struct\EntrySearchFilterInfo")
     * @XmlElement
     */
    private $searchFilter;

    /**
     * Constructor method for SearchCalendarResourcesRequest
     * 
     * @param  EntrySearchFilterInfo $searchFilter
     * @param  int $limit
     * @param  int $offset
     * @param  string $domain
     * @param  bool $applyCos
     * @param  string $sortBy
     * @param  int $sortAscending
     * @param  string $attrs
     * @return self
     */
    public function __construct(
        ?EntrySearchFilterInfo $searchFilter = NULL,
        ?int $limit = NULL,
        ?int $offset = NULL,
        ?string $domain = NULL,
        ?bool $applyCos = NULL,
        ?string $sortBy = NULL,
        ?bool $sortAscending = NULL,
        ?string $attrs = NULL
    )
    {
        if ($searchFilter instanceof EntrySearchFilterInfo) {
            $this->setSearchFilter($searchFilter);
        }
        if (NULL !== $limit) {
            $this->setLimit($limit);
        }
        if (NULL !== $offset) {
            $this->setOffset($offset);
        }
        if (NULL !== $domain) {
            $this->setDomain($domain);
        }
        if (NULL !== $applyCos) {
            $this->setApplyCos($applyCos);
        }
        if (NULL !== $sortBy) {
            $this->setSortBy($sortBy);
        }
        if (NULL !== $sortAscending) {
            $this->setSortAscending($sortAscending);
        }
        if (NULL !== $attrs) {
            $this->setAttrs($attrs);
        }
    }

    /**
     * Gets searchFilter
     *
     * @return EntrySearchFilterInfo
     */
    public function getSearchFilter(): ?EntrySearchFilterInfo
    {
        return $this->searchFilter;
    }

    /**
     * Sets searchFilter
     *
     * @param  EntrySearchFilterInfo $searchFilter
     * @return self
     */
    public function setSearchFilter(EntrySearchFilterInfo $searchFilter): self
    {
        $this->searchFilter = $searchFilter;
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
     * Gets applyCos
     *
     * @return bool
     */
    public function getApplyCos(): ?bool
    {
        return $this->applyCos;
    }

    /**
     * Sets applyCos
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
    public function getSortAscending(): ?bool
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
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof SearchCalendarResourcesEnvelope)) {
            $this->envelope = new SearchCalendarResourcesEnvelope(
                new SearchCalendarResourcesBody($this)
            );
        }
    }
}
