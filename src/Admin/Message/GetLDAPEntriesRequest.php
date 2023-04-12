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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetLDAPEntriesRequest class
 * fetches ldap entry (or entries) by a search-base ({ldap-search-base}) and a search query ({query}).
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetLDAPEntriesRequest extends SoapRequest
{
    /**
     * LDAP search base.  An LDAP-style filter string that defines an LDAP search base (RFC 2254)
     * 
     * @var string
     */
    #[Accessor(getter: 'getLdapSearchBase', setter: 'setLdapSearchBase')]
    #[SerializedName('ldapSearchBase')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraAdmin')]
    private $ldapSearchBase;

    /**
     * Name of attribute to sort on. default is null
     * 
     * @var string
     */
    #[Accessor(getter: 'getSortBy', setter: 'setSortBy')]
    #[SerializedName('sortBy')]
    #[Type('string')]
    #[XmlAttribute]
    private $sortBy;

    /**
     * Flag whether to sort in ascending order 1 (true) is default
     * 
     * @var bool
     */
    #[Accessor(getter: 'getSortAscending', setter: 'setSortAscending')]
    #[SerializedName('sortAscending')]
    #[Type('bool')]
    #[XmlAttribute]
    private $sortAscending;

    /**
     * The number of mailboxes to return (0 is default and means all)
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
     * @var int
     */
    #[Accessor(getter: 'getOffset', setter: 'setOffset')]
    #[SerializedName('offset')]
    #[Type('int')]
    #[XmlAttribute]
    private $offset;

    /**
     * Query string. Should be an LDAP-style filter string (RFC 2254)
     * 
     * @var string
     */
    #[Accessor(getter: 'getQuery', setter: 'setQuery')]
    #[SerializedName('query')]
    #[Type('string')]
    #[XmlAttribute]
    private $query;

    /**
     * Constructor
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
        string $ldapSearchBase = '',
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
     * Get ldap search base
     *
     * @return string
     */
    public function getLdapSearchBase(): ?string
    {
        return $this->ldapSearchBase;
    }

    /**
     * Set ldap search base
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
     * Get sortAscending flag
     *
     * @return bool
     */
    public function getSortAscending(): ?bool
    {
        return $this->sortAscending;
    }

    /**
     * Set sortAscending flag
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
        return new GetLDAPEntriesEnvelope(
            new GetLDAPEntriesBody($this)
        );
    }
}
