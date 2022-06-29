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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Common\Struct\{AttributeSelector, AttributeSelectorTrait};
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * SearchAutoProvDirectoryRequest class
 * Search Auto Prov Directory
 * Only one of <name> or <query> can be provided.
 * If neither is provided, the configured search filter for auto provision will be used. 
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SearchAutoProvDirectoryRequest extends Request implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * Name of attribute for the key.
     * Value of the key attribute will appear in the <key> element in the response.
     * It is recommended to pick a key attribute that is single-valued and can unique identify an entry in the external auto provision directory.
     * If the key attribute contains multiple values then multiple <key> elements will appear in the response.
     * Entries are returned in ascending key order.
     * @Accessor(getter="getKeyAttr", setter="setKeyAttr")
     * @SerializedName("keyAttr")
     * @Type("string")
     * @XmlAttribute
     */
    private $keyAttr;

    /**
     * Query string - should be an LDAP-style filter string (RFC 2254)
     * @Accessor(getter="getQuery", setter="setQuery")
     * @SerializedName("query")
     * @Type("string")
     * @XmlAttribute
     */
    private $query;

    /**
     * Name to fill the auto provisioning search template configured on the domain 
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Maximum results that the backend will attempt to fetch from the directory before returning an account.TOO_MANY_SEARCH_RESULTS error.
     * @Accessor(getter="getMaxResults", setter="setMaxResults")
     * @SerializedName("maxResults")
     * @Type("integer")
     * @XmlAttribute
     */
    private $maxResults;

    /**
     * The maximum number of accounts to return (0 is default and means all)
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
     * Refresh - whether to always re-search in LDAP even when 
     * cached entries are available.  0 (false) is the default.
     * @Accessor(getter="isRefresh", setter="setRefresh")
     * @SerializedName("refresh")
     * @Type("bool")
     * @XmlAttribute
     */
    private $refresh;

    /**
     * The domain name to limit the search to
     * @Accessor(getter="getDomain", setter="setDomain")
     * @SerializedName("domain")
     * @Type("Zimbra\Admin\Struct\DomainSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private DomainSelector $domain;

    /**
     * Constructor method for SearchAutoProvDirectoryRequest
     * 
     * @param  DomainSelector $domain
     * @param  string $keyAttr
     * @param  string $query
     * @param  string $name
     * @param  int $maxResults
     * @param  int $limit
     * @param  int $offset
     * @param  bool $refresh
     * @param  string $attrs
     * @return self
     */
    public function __construct(
        DomainSelector $domain,
        string $keyAttr = '',
        ?string $query = NULL,
        ?string $name = NULL,
        ?int $maxResults = NULL,
        ?int $limit = NULL,
        ?int $offset = NULL,
        ?bool $refresh = NULL,
        ?string $attrs = NULL
    )
    {
        $this->setKeyAttr($keyAttr)
             ->setDomain($domain);
        if (NULL !== $query) {
            $this->setQuery($query);
        }
        if (NULL !== $name) {
            $this->setName($name);
        }
        if (NULL !== $maxResults) {
            $this->setMaxResults($maxResults);
        }
        if (NULL !== $limit) {
            $this->setLimit($limit);
        }
        if (NULL !== $offset) {
            $this->setOffset($offset);
        }
        if (NULL !== $refresh) {
            $this->setRefresh($refresh);
        }
        if (NULL !== $attrs) {
            $this->setAttrs($attrs);
        }
    }

    /**
     * Gets keyAttr
     *
     * @return string
     */
    public function getKeyAttr(): ?string
    {
        return $this->keyAttr;
    }

    /**
     * Sets keyAttr
     *
     * @param  string $keyAttr
     * @return self
     */
    public function setKeyAttr(string $keyAttr): self
    {
        $this->keyAttr = $keyAttr;
        return $this;
    }

    /**
     * Gets domain
     *
     * @return DomainSelector
     */
    public function getDomain(): DomainSelector
    {
        return $this->domain;
    }

    /**
     * Sets domain
     *
     * @param  DomainSelector $domain
     * @return self
     */
    public function setDomain(DomainSelector $domain): self
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * Gets query
     *
     * @return string
     */
    public function getQuery(): ?string
    {
        return $this->query;
    }

    /**
     * Sets query
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
     * Gets maxResults
     *
     * @return int
     */
    public function getMaxResults(): ?int
    {
        return $this->maxResults;
    }

    /**
     * Sets maxResults
     *
     * @param  int $maxResults
     * @return self
     */
    public function setMaxResults(int $maxResults): self
    {
        $this->maxResults = $maxResults;
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
        return new SearchAutoProvDirectoryEnvelope(
            new SearchAutoProvDirectoryBody($this)
        );
    }
}
