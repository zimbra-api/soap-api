<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Account\Struct\EntrySearchFilterInfo;
use Zimbra\Common\Struct\{
    AttributeSelector, AttributeSelectorTrait, CursorInfo, SoapEnvelopeInterface, SoapRequest
};

/**
 * SearchCalendarResourcesRequest class
 * Search Global Address List (GAL) for calendar resources
 * "attrs" attribute - comma-separated list of attrs to return ("displayName", "zimbraId", "zimbraCalResType")
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SearchCalendarResourcesRequest extends SoapRequest implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * "Quick" flag.
     * For performance reasons, the index system accumulates messages with not-indexed-yet state until a certain
     * threshold and indexes them as a batch. To return up-to-date search results, the index system also indexes those
     * pending messages right before a search. To lower latencies, this option gives a hint to the index system not to
     * trigger this catch-up index prior to the search by giving up the freshness of the search results, i.e. recent
     * messages may not be included in the search results.
     * 
     * @Accessor(getter="getQuick", setter="setQuick")
     * @SerializedName("quick")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getQuick', setter: 'setQuick')]
    #[SerializedName('quick')]
    #[Type('bool')]
    #[XmlAttribute]
    private $quick;

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
    #[Accessor(getter: 'getSortBy', setter: 'setSortBy')]
    #[SerializedName('sortBy')]
    #[Type('string')]
    #[XmlAttribute]
    private $sortBy;

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
    #[Accessor(getter: 'getLimit', setter: 'setLimit')]
    #[SerializedName('limit')]
    #[Type('int')]
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
    #[Accessor(getter: 'getOffset', setter: 'setOffset')]
    #[SerializedName('offset')]
    #[Type('int')]
    #[XmlAttribute]
    private $offset;

    /**
     * Client locale identification.
     * 
     * @Accessor(getter="getLocale", setter="setLocale")
     * @SerializedName("locale")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     * 
     * @var string
     */
    #[Accessor(getter: 'getLocale', setter: 'setLocale')]
    #[SerializedName('locale')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraAccount')]
    private $locale;

    /**
     * Cursor specification
     * 
     * @Accessor(getter="getCursor", setter="setCursor")
     * @SerializedName("cursor")
     * @Type("Zimbra\Common\Struct\CursorInfo")
     * @XmlElement(namespace="urn:zimbraAccount")
     * 
     * @var CursorInfo
     */
    #[Accessor(getter: 'getCursor', setter: 'setCursor')]
    #[SerializedName('cursor')]
    #[Type(CursorInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private ?CursorInfo $cursor;

    /**
     * GAL Account ID
     * 
     * @Accessor(getter="getGalAccountId", setter="setGalAccountId")
     * @SerializedName("galAcctId")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getGalAccountId', setter: 'setGalAccountId')]
    #[SerializedName('galAcctId')]
    #[Type('string')]
    #[XmlAttribute]
    private $galAccountId;

    /**
     * If specified, passed through to the GAL search as the search key
     * 
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName('name')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraAccount')]
    private $name;

    /**
     * Search Filter
     * 
     * @Accessor(getter="getSearchFilter", setter="setSearchFilter")
     * @SerializedName("searchFilter")
     * @Type("Zimbra\Account\Struct\EntrySearchFilterInfo")
     * @XmlElement(namespace="urn:zimbraAccount")
     * 
     * @var EntrySearchFilterInfo
     */
    #[Accessor(getter: 'getSearchFilter', setter: 'setSearchFilter')]
    #[SerializedName('searchFilter')]
    #[Type(EntrySearchFilterInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private ?EntrySearchFilterInfo $searchFilter;

    /**
     * Constructor
     * 
     * @param  CursorInfo $cursor
     * @param  EntrySearchFilterInfo $searchFilter
     * @param  bool $quick
     * @param  string $sortBy
     * @param  int $limit
     * @param  int $offset
     * @param  string $locale
     * @param  string $galAccountId
     * @param  string $name
     * @param  string $attrs
     * @return self
     */
    public function __construct(
        ?CursorInfo $cursor = NULL,
        ?EntrySearchFilterInfo $searchFilter = NULL,
        ?bool $quick = NULL,
        ?string $sortBy = NULL,
        ?int $limit = NULL,
        ?int $offset = NULL,
        ?string $locale = NULL,
        ?string $galAccountId = NULL,
        ?string $name = NULL,
        ?string $attrs = NULL
    )
    {
        $this->cursor = $cursor;
        $this->searchFilter = $searchFilter;
        if (NULL !== $quick) {
            $this->setQuick($quick);
        }
        if (NULL !== $sortBy) {
            $this->setSortBy($sortBy);
        }
        if (NULL !== $limit) {
            $this->setLimit($limit);
        }
        if (NULL !== $offset) {
            $this->setOffset($offset);
        }
        if (NULL !== $locale) {
            $this->setLocale($locale);
        }
        if (NULL !== $galAccountId) {
            $this->setGalAccountId($galAccountId);
        }
        if (NULL !== $name) {
            $this->setName($name);
        }
        if (NULL !== $attrs) {
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
     * Get cursor
     *
     * @return CursorInfo
     */
    public function getCursor(): ?CursorInfo
    {
        return $this->cursor;
    }

    /**
     * Set cursor
     *
     * @param  CursorInfo $cursor
     * @return self
     */
    public function setCursor(CursorInfo $cursor): self
    {
        $this->cursor = $cursor;
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
     * Get locale
     *
     * @return string
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * Set locale
     *
     * @param  string $locale
     * @return self
     */
    public function setLocale(string $locale): self
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * Get galAccountId
     *
     * @return string
     */
    public function getGalAccountId(): ?string
    {
        return $this->galAccountId;
    }

    /**
     * Set galAccountId
     *
     * @param  string $galAccountId
     * @return self
     */
    public function setGalAccountId(string $galAccountId): self
    {
        $this->galAccountId = $galAccountId;
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
     * Get quick
     *
     * @return bool
     */
    public function getQuick(): ?bool
    {
        return $this->quick;
    }

    /**
     * Set quick
     *
     * @param  bool $quick
     * @return self
     */
    public function setQuick(bool $quick): self
    {
        $this->quick = $quick;
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
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
