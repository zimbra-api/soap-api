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
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * GetLDAPEntriesRequest class
 * fetches ldap entry (or entries) by a search-base ({ldap-search-base}) and a search query ({query}).
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetLDAPEntriesRequest extends Request
{
    /**
     * LDAP search base.  An LDAP-style filter string that defines an LDAP search base (RFC 2254)
     * @Accessor(getter="getLdapSearchBase", setter="setLdapSearchBase")
     * @SerializedName("ldapSearchBase")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $ldapSearchBase;

    /**
     * Name of attribute to sort on. default is null
     * @Accessor(getter="getSortBy", setter="setSortBy")
     * @SerializedName("sortBy")
     * @Type("string")
     * @XmlAttribute()
     */
    private $sortBy;

    /**
     * Flag whether to sort in ascending order 1 (true) is default
     * @Accessor(getter="getSortAscending", setter="setSortAscending")
     * @SerializedName("sortAscending")
     * @Type("bool")
     * @XmlAttribute
     */
    private $sortAscending;

    /**
     * The number of mailboxes to return (0 is default and means all)
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
     * Query string. Should be an LDAP-style filter string (RFC 2254)
     * @Accessor(getter="getQuery", setter="setQuery")
     * @SerializedName("query")
     * @Type("string")
     * @XmlAttribute
     */
    private $query;

    /**
     * Constructor method for GetLDAPEntriesRequest
     * 
     * @param  string $ldapSearchBase
     * @param  string $sortBy
     * @param  bool $sortAscending
     * @param  int $limit
     * @param  int $offset
     * @param  string $query
     * @return self
     */
    public function __construct(
        string $ldapSearchBase,
        ?string $sortBy = NULL,
        ?bool $sortAscending = NULL,
        ?int $limit = NULL,
        ?int $offset = NULL,
        ?string $query = NULL
    )
    {
        $this->setLdapSearchBase($ldapSearchBase);
        if (NULL !== $sortBy) {
            $this->setSortBy($sortBy);
        }
        if (NULL !== $sortAscending) {
            $this->setSortAscending($sortAscending);
        }
        if (NULL !== $limit) {
            $this->setLimit($limit);
        }
        if (NULL !== $offset) {
            $this->setOffset($offset);
        }
        if (NULL !== $query) {
            $this->setQuery($query);
        }
    }

    /**
     * Gets ldap search base
     *
     * @return string
     */
    public function getLdapSearchBase(): ?string
    {
        return $this->ldapSearchBase;
    }

    /**
     * Sets ldap search base
     *
     * @param  string $ldapSearchBase
     * @return self
     */
    public function setLdapSearchBase(string $ldapSearchBase): self
    {
        $this->ldapSearchBase = $ldapSearchBase;
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
     * Gets sortAscending flag
     *
     * @return bool
     */
    public function getSortAscending(): ?bool
    {
        return $this->sortAscending;
    }

    /**
     * Sets sortAscending flag
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
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new GetLDAPEntriesEnvelope(
            new GetLDAPEntriesBody($this)
        );
    }
}
