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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};
use Zimbra\Account\Struct\EntrySearchFilterInfo;
use Zimbra\Common\Enum\{GalSearchType, MemberOfSelector};
use Zimbra\Common\Struct\{CursorInfo, SoapEnvelopeInterface, SoapRequest};

/**
 * SearchGalRequest class
 * Search Global Address List (GAL)
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SearchGalRequest extends SoapRequest
{
    /**
     * If set then search GAL by this ref, which is a dn.
     * If specified then "name" attribute is ignored.
     *
     * @Accessor(getter="getRef", setter="setRef")
     * @SerializedName("ref")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getRef", setter: "setRef")]
    #[SerializedName("ref")]
    #[Type("string")]
    #[XmlAttribute]
    private $ref;

    /**
     * Query string.
     * Note: ignored if <ref> is specified
     *
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private $name;

    /**
     * type of addresses to auto-complete on.
     * - "account" for regular user accounts, aliases and distribution lists
     * - "resource" for calendar resources
     * - "group" for groups
     * - "all" for combination of all types
     * if omitted, defaults to "all"
     *
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Enum<Zimbra\Common\Enum\GalSearchType>")
     * @XmlAttribute
     *
     * @var GalSearchType
     */
    #[Accessor(getter: "getType", setter: "setType")]
    #[SerializedName("type")]
    #[Type("Enum<Zimbra\Common\Enum\GalSearchType>")]
    #[XmlAttribute]
    private ?GalSearchType $type;

    /**
     * flag whether the <exp> flag is needed in the response for group entries.
     * Default is unset.
     *
     * @Accessor(getter="getNeedCanExpand", setter="setNeedCanExpand")
     * @SerializedName("needExp")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getNeedCanExpand", setter: "setNeedCanExpand")]
    #[SerializedName("needExp")]
    #[Type("bool")]
    #[XmlAttribute]
    private $needCanExpand;

    /**
     * Set this if the "isOwner" flag is needed in the response for group entries.
     * Default is unset.
     *
     * @Accessor(getter="getNeedIsOwner", setter="setNeedIsOwner")
     * @SerializedName("needIsOwner")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getNeedIsOwner", setter: "setNeedIsOwner")]
    #[SerializedName("needIsOwner")]
    #[Type("bool")]
    #[XmlAttribute]
    private $needIsOwner;

    /**
     * Specify if the "isMember" flag is needed in the response for group entries.
     * - all: the isMember flag returned is set if the user is a direct or indirect member ofthe group, otherwise it is unset
     * - directOnly: the isMember flag returned is set if the user is a direct member of the group, otherwise it is unset
     * - none (default): The isMember flag is not returned
     *
     * @Accessor(getter="getNeedIsMember", setter="setNeedIsMember")
     * @SerializedName("needIsMember")
     * @Type("Enum<Zimbra\Common\Enum\MemberOfSelector>")
     * @XmlAttribute
     *
     * @var MemberOfSelector
     */
    #[Accessor(getter: "getNeedIsMember", setter: "setNeedIsMember")]
    #[SerializedName("needIsMember")]
    #[Type("Enum<Zimbra\Common\Enum\MemberOfSelector>")]
    #[XmlAttribute]
    private ?MemberOfSelector $needIsMember;

    /**
     * Internal attr, for proxied GSA search from GetSMIMEPublicCerts only
     *
     * @Accessor(getter="getNeedSMIMECerts", setter="setNeedSMIMECerts")
     * @SerializedName("needSMIMECerts")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getNeedSMIMECerts", setter: "setNeedSMIMECerts")]
    #[SerializedName("needSMIMECerts")]
    #[Type("bool")]
    #[XmlAttribute]
    private $needSMIMECerts;

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
    #[Accessor(getter: "getGalAccountId", setter: "setGalAccountId")]
    #[SerializedName("galAcctId")]
    #[Type("string")]
    #[XmlAttribute]
    private $galAccountId;

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
    #[Accessor(getter: "getQuick", setter: "setQuick")]
    #[SerializedName("quick")]
    #[Type("bool")]
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
    #[Accessor(getter: "getSortBy", setter: "setSortBy")]
    #[SerializedName("sortBy")]
    #[Type("string")]
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
     * Client locale identification.
     *
     * @Accessor(getter="getLocale", setter="setLocale")
     * @SerializedName("locale")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     *
     * @var string
     */
    #[Accessor(getter: "getLocale", setter: "setLocale")]
    #[SerializedName("locale")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
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
    #[Accessor(getter: "getCursor", setter: "setCursor")]
    #[SerializedName("cursor")]
    #[Type(CursorInfo::class)]
    #[XmlElement(namespace: "urn:zimbraAccount")]
    private ?CursorInfo $cursor;

    /**
     * query string
     *
     * @Accessor(getter="getQuery", setter="setQuery")
     * @SerializedName("query")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     *
     * @var string
     */
    #[Accessor(getter: "getQuery", setter: "setQuery")]
    #[SerializedName("query")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private $query;

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
    #[Accessor(getter: "getSearchFilter", setter: "setSearchFilter")]
    #[SerializedName("searchFilter")]
    #[Type(EntrySearchFilterInfo::class)]
    #[XmlElement(namespace: "urn:zimbraAccount")]
    private ?EntrySearchFilterInfo $searchFilter;

    /**
     * Constructor
     *
     * @param  CursorInfo $cursor
     * @param  EntrySearchFilterInfo $searchFilter
     * @param  string $ref
     * @param  string $name
     * @param  GalSearchType $type
     * @param  bool $needCanExpand
     * @param  bool $needIsOwner
     * @param  MemberOfSelector $needIsMember
     * @param  bool $needSMIMECerts
     * @param  string $galAccountId
     * @param  bool $quick
     * @param  string $sortBy
     * @param  int $limit
     * @param  int $offset
     * @param  string $locale
     * @param  string $query
     * @return self
     */
    public function __construct(
        ?CursorInfo $cursor = null,
        ?EntrySearchFilterInfo $searchFilter = null,
        ?string $ref = null,
        ?string $name = null,
        ?GalSearchType $type = null,
        ?bool $needCanExpand = null,
        ?bool $needIsOwner = null,
        ?MemberOfSelector $needIsMember = null,
        ?bool $needSMIMECerts = null,
        ?string $galAccountId = null,
        ?bool $quick = null,
        ?string $sortBy = null,
        ?int $limit = null,
        ?int $offset = null,
        ?string $locale = null,
        ?string $query = null
    ) {
        $this->cursor = $cursor;
        $this->searchFilter = $searchFilter;
        $this->type = $type;
        $this->needIsMember = $needIsMember;
        if (null !== $ref) {
            $this->setRef($ref);
        }
        if (null !== $name) {
            $this->setName($name);
        }
        if (null !== $needCanExpand) {
            $this->setNeedCanExpand($needCanExpand);
        }
        if (null !== $needIsOwner) {
            $this->setNeedIsOwner($needIsOwner);
        }
        if (null !== $needSMIMECerts) {
            $this->setNeedSMIMECerts($needSMIMECerts);
        }
        if (null !== $galAccountId) {
            $this->setGalAccountId($galAccountId);
        }
        if (null !== $quick) {
            $this->setQuick($quick);
        }
        if (null !== $sortBy) {
            $this->setSortBy($sortBy);
        }
        if (null !== $limit) {
            $this->setLimit($limit);
        }
        if (null !== $offset) {
            $this->setOffset($offset);
        }
        if (null !== $locale) {
            $this->setLocale($locale);
        }
        if (null !== $query) {
            $this->setQuery($query);
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
     * Get ref
     *
     * @return string
     */
    public function getRef(): ?string
    {
        return $this->ref;
    }

    /**
     * Set ref
     *
     * @param  string $ref
     * @return self
     */
    public function setRef(string $ref): self
    {
        $this->ref = $ref;
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
     * Get type
     *
     * @return GalSearchType
     */
    public function getType(): ?GalSearchType
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param  GalSearchType $type
     * @return self
     */
    public function setType(GalSearchType $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get needCanExpand
     *
     * @return bool
     */
    public function getNeedCanExpand(): ?bool
    {
        return $this->needCanExpand;
    }

    /**
     * Set needCanExpand
     *
     * @param  bool $needCanExpand
     * @return self
     */
    public function setNeedCanExpand(bool $needCanExpand): self
    {
        $this->needCanExpand = $needCanExpand;
        return $this;
    }

    /**
     * Get needIsOwner
     *
     * @return bool
     */
    public function getNeedIsOwner(): ?bool
    {
        return $this->needIsOwner;
    }

    /**
     * Set needIsOwner
     *
     * @param  bool $needIsOwner
     * @return self
     */
    public function setNeedIsOwner(bool $needIsOwner): self
    {
        $this->needIsOwner = $needIsOwner;
        return $this;
    }

    /**
     * Get needIsMember
     *
     * @return MemberOfSelector
     */
    public function getNeedIsMember(): ?MemberOfSelector
    {
        return $this->needIsMember;
    }

    /**
     * Set needIsMember
     *
     * @param  MemberOfSelector $needIsMember
     * @return self
     */
    public function setNeedIsMember(MemberOfSelector $needIsMember): self
    {
        $this->needIsMember = $needIsMember;
        return $this;
    }

    /**
     * Get needSMIMECerts
     *
     * @return bool
     */
    public function getNeedSMIMECerts(): ?bool
    {
        return $this->needSMIMECerts;
    }

    /**
     * Set needSMIMECerts
     *
     * @param  bool $needSMIMECerts
     * @return self
     */
    public function setNeedSMIMECerts(bool $needSMIMECerts): self
    {
        $this->needSMIMECerts = $needSMIMECerts;
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
     * Get query
     *
     * @return string
     */
    public function getQuery(): ?string
    {
        return $this->query;
    }

    /**
     * Set query
     *
     * @param  string $query
     * @return self
     */
    public function setQuery(string $query): self
    {
        $this->query = $query;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new SearchGalEnvelope(new SearchGalBody($this));
    }
}
