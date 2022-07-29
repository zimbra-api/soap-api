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
use Zimbra\Common\Struct\{AttributeSelector, AttributeSelectorTrait};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * SearchDirectoryRequest class
 * Search directory
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SearchDirectoryRequest extends SoapRequest implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * Query string - should be an LDAP-style filter string (RFC 2254)
     * @Accessor(getter="getQuery", setter="setQuery")
     * @SerializedName("query")
     * @Type("string")
     * @XmlAttribute
     */
    private $query;

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
     * The domain name to limit the search to
     * @Accessor(getter="getDomain", setter="setDomain")
     * @SerializedName("domain")
     * @Type("string")
     * @XmlAttribute
     */
    private $domain;

    /**
     * applyCos - Flag whether or not to apply the COS policy to account.
     * Specify 0 (false) if only requesting attrs that aren't inherited from COS
     * @Accessor(getter="getApplyCos", setter="setApplyCos")
     * @SerializedName("applyCos")
     * @Type("bool")
     * @XmlAttribute
     */
    private $applyCos;

    /**
     * whether or not to apply the global config attrs to account.
     * specify 0 (false) if only requesting attrs that aren't inherited from global config
     * @Accessor(getter="getApplyConfig", setter="setApplyConfig")
     * @SerializedName("applyConfig")
     * @Type("bool")
     * @XmlAttribute
     */
    private $applyConfig;

    /**
     * Name of attribute to sort on. Default is the account name.
     * @Accessor(getter="getSortBy", setter="setSortBy")
     * @SerializedName("sortBy")
     * @Type("string")
     * @XmlAttribute
     */
    private $sortBy;

    /**
     * Comma-separated list of types to return.
     * Legal values are: accounts|distributionlists|aliases|resources|domains|coses (default is accounts)
     * @Accessor(getter="getTypes", setter="setTypes")
     * @SerializedName("types")
     * @Type("string")
     * @XmlAttribute
     */
    private $types;

    /**
     * Whether to sort in ascending order. Default is 1 (true)
     * @Accessor(getter="getSortAscending", setter="setSortAscending")
     * @SerializedName("sortAscending")
     * @Type("bool")
     * @XmlAttribute
     */
    private $sortAscending;

    /**
     * Whether response should be count only. Default is 0 (false)
     * @Accessor(getter="getCountOnly", setter="setCountOnly")
     * @SerializedName("countOnly")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isCountOnly;

    /**
     * Constructor method for SearchDirectoryRequest
     * 
     * @param  string $query
     * @param  int $maxResults
     * @param  int $limit
     * @param  int $offset
     * @param  string $domain
     * @param  bool $applyCos
     * @param  bool $applyConfig
     * @param  string $sortBy
     * @param  string $types
     * @param  bool $sortAscending
     * @param  bool $isCountOnly
     * @param  string $attrs
     * @return self
     */
    public function __construct(
        ?string $query = NULL,
        ?int $maxResults = NULL,
        ?int $limit = NULL,
        ?int $offset = NULL,
        ?string $domain = NULL,
        ?bool $applyCos = NULL,
        ?bool $applyConfig = NULL,
        ?string $sortBy = NULL,
        ?string $types = NULL,
        ?bool $sortAscending = NULL,
        ?bool $isCountOnly = NULL,
        ?string $attrs = NULL
    )
    {
        if (NULL !== $query) {
            $this->setQuery($query);
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
        if (NULL !== $domain) {
            $this->setDomain($domain);
        }
        if (NULL !== $applyCos) {
            $this->setApplyCos($applyCos);
        }
        if (NULL !== $applyConfig) {
            $this->setApplyConfig($applyConfig);
        }
        if (NULL !== $sortBy) {
            $this->setSortBy($sortBy);
        }
        if (NULL !== $types) {
            $this->setTypes($types);
        }
        if (NULL !== $sortAscending) {
            $this->setSortAscending($sortAscending);
        }
        if (NULL !== $isCountOnly) {
            $this->setCountOnly($isCountOnly);
        }
        if (NULL !== $attrs) {
            $this->setAttrs($attrs);
        }
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
     * Get maxResults
     *
     * @return int
     */
    public function getMaxResults(): ?int
    {
        return $this->maxResults;
    }

    /**
     * Set maxResults
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
     * Get applyConfig
     *
     * @return bool
     */
    public function getApplyConfig(): ?bool
    {
        return $this->applyConfig;
    }

    /**
     * Set applyConfig
     *
     * @param  bool $applyConfig
     * @return self
     */
    public function setApplyConfig(bool $applyConfig): self
    {
        $this->applyConfig = $applyConfig;
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
     * Get types
     *
     * @return string
     */
    public function getTypes(): ?string
    {
        return $this->types;
    }

    /**
     * Set types
     *
     * @param  string $types
     * @return self
     */
    public function setTypes(string $types): self
    {
        $this->types = $types;
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
     * Get isCountOnly
     *
     * @return bool
     */
    public function getCountOnly(): ?bool
    {
        return $this->isCountOnly;
    }

    /**
     * Set attrs
     *
     * @param  bool $attrs
     * @return self
     */
    public function setCountOnly(bool $isCountOnly): self
    {
        $this->isCountOnly = $isCountOnly;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new SearchDirectoryEnvelope(
            new SearchDirectoryBody($this)
        );
    }
}
