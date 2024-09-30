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
use Zimbra\Admin\Struct\EntrySearchFilterInfo;
use Zimbra\Common\Struct\{
    AttributeSelector,
    AttributeSelectorTrait,
    SoapEnvelopeInterface,
    SoapRequest
};

/**
 * SearchCalendarResourcesRequest class
 * Search for Calendar Resources
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SearchCalendarResourcesRequest extends SoapRequest implements
    AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * The maximum number of calendar resources to return (0 is default and means all)
     *
     * @Accessor(getter="getLimit", setter="setLimit")
     * @SerializedName("limit")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getLimit", setter: "setLimit")]
    #[SerializedName("limit")]
    #[Type("int")]
    #[XmlAttribute]
    private $limit;

    /**
     * The starting offset (0, 25, etc)
     *
     * @Accessor(getter="getOffset", setter="setOffset")
     * @SerializedName("offset")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getOffset", setter: "setOffset")]
    #[SerializedName("offset")]
    #[Type("int")]
    #[XmlAttribute]
    private $offset;

    /**
     * The domain name to limit the search to
     *
     * @Accessor(getter="getDomain", setter="setDomain")
     * @SerializedName("domain")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getDomain", setter: "setDomain")]
    #[SerializedName("domain")]
    #[Type("string")]
    #[XmlAttribute]
    private $domain;

    /**
     * applyCos - Flag whether or not to apply the COS policy to calendar resource.
     * Specify 0 (false) if only requesting attrs that aren't inherited from COS
     *
     * @Accessor(getter="getApplyCos", setter="setApplyCos")
     * @SerializedName("applyCos")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getApplyCos", setter: "setApplyCos")]
    #[SerializedName("applyCos")]
    #[Type("bool")]
    #[XmlAttribute]
    private $applyCos;

    /**
     * Name of attribute to sort on. default is the calendar resource name.
     *
     * @Accessor(getter="getSortBy", setter="setSortBy")
     * @SerializedName("sortBy")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getSortBy", setter: "setSortBy")]
    #[SerializedName("sortBy")]
    #[Type("string")]
    #[XmlAttribute]
    private $sortBy;

    /**
     * Whether to sort in ascending order. Default is 1 (true)
     *
     * @Accessor(getter="getSortAscending", setter="setSortAscending")
     * @SerializedName("sortAscending")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getSortAscending", setter: "setSortAscending")]
    #[SerializedName("sortAscending")]
    #[Type("bool")]
    #[XmlAttribute]
    private $sortAscending;

    /**
     * Search Filter
     *
     * @Accessor(getter="getSearchFilter", setter="setSearchFilter")
     * @SerializedName("searchFilter")
     * @Type("Zimbra\Admin\Struct\EntrySearchFilterInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var EntrySearchFilterInfo
     */
    #[Accessor(getter: "getSearchFilter", setter: "setSearchFilter")]
    #[SerializedName("searchFilter")]
    #[Type(EntrySearchFilterInfo::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?EntrySearchFilterInfo $searchFilter;

    /**
     * Constructor
     *
     * @param  EntrySearchFilterInfo $searchFilter
     * @param  int $limit
     * @param  int $offset
     * @param  string $domain
     * @param  bool $applyCos
     * @param  string $sortBy
     * @param  bool $sortAscending
     * @param  string $attrs
     * @return self
     */
    public function __construct(
        ?EntrySearchFilterInfo $searchFilter = null,
        ?int $limit = null,
        ?int $offset = null,
        ?string $domain = null,
        ?bool $applyCos = null,
        ?string $sortBy = null,
        ?bool $sortAscending = null,
        ?string $attrs = null
    ) {
        $this->searchFilter = $searchFilter;
        if (null !== $limit) {
            $this->setLimit($limit);
        }
        if (null !== $offset) {
            $this->setOffset($offset);
        }
        if (null !== $domain) {
            $this->setDomain($domain);
        }
        if (null !== $applyCos) {
            $this->setApplyCos($applyCos);
        }
        if (null !== $sortBy) {
            $this->setSortBy($sortBy);
        }
        if (null !== $sortAscending) {
            $this->setSortAscending($sortAscending);
        }
        if (null !== $attrs) {
            $this->setAttrs($attrs);
        }
    }

    /**
     * Get searchFilter
     *
     * @return EntrySearchFilterInfo
     */
    public function getSearchFilter(): ?EntrySearchFilterInfo
    {
        return $this->searchFilter;
    }

    /**
     * Set searchFilter
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
     * Get applyCos
     *
     * @return bool
     */
    public function getApplyCos(): ?bool
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
    public function getSortAscending(): ?bool
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new SearchCalendarResourcesEnvelope(
            new SearchCalendarResourcesBody($this)
        );
    }
}
