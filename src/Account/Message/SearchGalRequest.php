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
use Zimbra\Enum\GalSearchType;
use Zimbra\Enum\MemberOfSelector;
use Zimbra\Soap\Request;
use Zimbra\Struct\CursorInfo;

/**
 * SearchGalRequest class
 * Search Global Address List (GAL)
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SearchGalRequest extends Request
{
    /**
     * If set then search GAL by this ref, which is a dn.  If specified then "name" attribute is ignored.
     * @Accessor(getter="getRef", setter="setRef")
     * @SerializedName("ref")
     * @Type("string")
     * @XmlAttribute
     */
    private $ref;

    /**
     * Query string.  Note: ignored if <b>ref</b> is specified
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * type of addresses to auto-complete on.
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Zimbra\Enum\GalSearchType")
     * @XmlAttribute
     */
    private $type;

    /**
     * flag whether the <b>{exp}</b> flag is needed in the response for group entries.
     * Default is unset.
     * @Accessor(getter="getNeedCanExpand", setter="setNeedCanExpand")
     * @SerializedName("needExp")
     * @Type("bool")
     * @XmlAttribute
     */
    private $needCanExpand;

    /**
     * Set this if the "isOwner" flag is needed in the response for group entries.
     * Default is unset.
     * @Accessor(getter="getNeedIsOwner", setter="setNeedIsOwner")
     * @SerializedName("needIsOwner")
     * @Type("bool")
     * @XmlAttribute
     */
    private $needIsOwner;

    /**
     * Specify if the "isMember" flag is needed in the response for group entries.
     * @Accessor(getter="getNeedIsMember", setter="setNeedIsMember")
     * @SerializedName("needIsMember")
     * @Type("Zimbra\Enum\MemberOfSelector")
     * @XmlAttribute
     */
    private $needIsMember;

    /**
     * Internal attr, for proxied GSA search from GetSMIMEPublicCerts only
     * @Accessor(getter="getNeedSMIMECerts", setter="setNeedSMIMECerts")
     * @SerializedName("needSMIMECerts")
     * @Type("bool")
     * @XmlAttribute
     */
    private $needSMIMECerts;

    /**
     * GAL Account ID
     * @Accessor(getter="getGalAccountId", setter="setGalAccountId")
     * @SerializedName("galAcctId")
     * @Type("string")
     * @XmlAttribute
     */
    private $galAccountId;

    /**
     * "Quick" flag.
     * For performance reasons, the index system accumulates messages with not-indexed-yet state until a certain
     * threshold and indexes them as a batch. To return up-to-date search results, the index system also indexes those
     * pending messages right before a search. To lower latencies, this option gives a hint to the index system not to
     * trigger this catch-up index prior to the search by giving up the freshness of the search results, i.e. recent
     * messages may not be included in the search results.
     * @Accessor(getter="getQuick", setter="setQuick")
     * @SerializedName("quick")
     * @Type("bool")
     * @XmlAttribute
     */
    private $quick;

    /**
     * Name of attribute to sort on. default is the calendar resource name.
     * @Accessor(getter="getSortBy", setter="setSortBy")
     * @SerializedName("sortBy")
     * @Type("string")
     * @XmlAttribute
     */
    private $sortBy;

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
     * Client locale identification.
     * @Accessor(getter="getLocale", setter="setLocale")
     * @SerializedName("locale")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $locale;

    /**
     * Cursor specification
     * @Accessor(getter="getCursor", setter="setCursor")
     * @SerializedName("cursor")
     * @Type("Zimbra\Struct\CursorInfo")
     * @XmlElement
     */
    private $cursor;

    /**
     * Search Filter
     * @Accessor(getter="getSearchFilter", setter="setSearchFilter")
     * @SerializedName("searchFilter")
     * @Type("Zimbra\Account\Struct\EntrySearchFilterInfo")
     * @XmlElement
     */
    private $searchFilter;

    /**
     * Constructor method for SearchGalRequest
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
     * @return self
     */
    public function __construct(
        ?CursorInfo $cursor = NULL,
        ?EntrySearchFilterInfo $searchFilter = NULL,
        ?string $ref = NULL,
        ?string $name = NULL,
        GalSearchType $type = NULL,
        ?bool $needCanExpand = NULL,
        ?bool $needIsOwner = NULL,
        MemberOfSelector $needIsMember = NULL,
        ?bool $needSMIMECerts = NULL,
        ?string $galAccountId = NULL,
        ?bool $quick = NULL,
        ?string $sortBy = NULL,
        ?int $limit = NULL,
        ?int $offset = NULL,
        ?string $locale = NULL
    )
    {
        if ($cursor instanceof CursorInfo) {
            $this->setCursor($cursor);
        }
        if ($searchFilter instanceof EntrySearchFilterInfo) {
            $this->setSearchFilter($searchFilter);
        }
        if (NULL !== $ref) {
            $this->setRef($ref);
        }
        if (NULL !== $name) {
            $this->setName($name);
        }
        if ($type instanceof GalSearchType) {
            $this->setType($type);
        }
        if (NULL !== $needCanExpand) {
            $this->setNeedCanExpand($needCanExpand);
        }
        if (NULL !== $needIsOwner) {
            $this->setNeedIsOwner($needIsOwner);
        }
        if ($needIsMember instanceof MemberOfSelector) {
            $this->setNeedIsMember($needIsMember);
        }
        if (NULL !== $needSMIMECerts) {
            $this->setNeedSMIMECerts($needSMIMECerts);
        }
        if (NULL !== $galAccountId) {
            $this->setGalAccountId($galAccountId);
        }
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
     * Gets cursor
     *
     * @return CursorInfo
     */
    public function getCursor(): ?CursorInfo
    {
        return $this->cursor;
    }

    /**
     * Sets cursor
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
     * Gets ref
     *
     * @return string
     */
    public function getRef(): ?string
    {
        return $this->ref;
    }

    /**
     * Sets ref
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
     * Gets name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Sets name
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
     * Gets type
     *
     * @return string
     */
    public function getType(): ?GalSearchType
    {
        return $this->type;
    }

    /**
     * Sets type
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
     * Gets needCanExpand
     *
     * @return bool
     */
    public function getNeedCanExpand(): ?bool
    {
        return $this->needCanExpand;
    }

    /**
     * Sets needCanExpand
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
     * Gets needIsOwner
     *
     * @return bool
     */
    public function getNeedIsOwner(): ?bool
    {
        return $this->needIsOwner;
    }

    /**
     * Sets needIsOwner
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
     * Gets needIsMember
     *
     * @return MemberOfSelector
     */
    public function getNeedIsMember(): ?MemberOfSelector
    {
        return $this->needIsMember;
    }

    /**
     * Sets needIsMember
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
     * Gets needSMIMECerts
     *
     * @return bool
     */
    public function getNeedSMIMECerts(): ?bool
    {
        return $this->needSMIMECerts;
    }

    /**
     * Sets needSMIMECerts
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
     * Gets galAccountId
     *
     * @return string
     */
    public function getGalAccountId(): ?string
    {
        return $this->galAccountId;
    }

    /**
     * Sets galAccountId
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
     * Gets quick
     *
     * @return bool
     */
    public function getQuick(): ?bool
    {
        return $this->quick;
    }

    /**
     * Sets quick
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
     * Gets locale
     *
     * @return string
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * Sets locale
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
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof SearchGalEnvelope)) {
            $this->envelope = new SearchGalEnvelope(
                new SearchGalBody($this)
            );
        }
    }
}
