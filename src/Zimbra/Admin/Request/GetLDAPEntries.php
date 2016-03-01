<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

/**
 * GetLDAPEntries request class
 * Get LDAP entries
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetLDAPEntries extends Base
{
    /**
     * Constructor method for GetLDAPEntries
     * @param string $query Query string. Should be an LDAP-style filter string (RFC 2254)
     * @param string $ldapSearchBase LDAP search base. An LDAP-style filter string that defines an LDAP search base (RFC 2254)
     * @param string $sortBy Name of attribute to sort on. default is null
     * @param bool $sortAscending Flag whether to sort in ascending order 1 (true) is default
     * @param int $limit Limit - the maximum number of LDAP objects (records) to return (0 is default and means all)
     * @param int $offset The starting offset (0, 25, etc)
     * @return self
     */
    public function __construct(
        $query,
        $ldapSearchBase,
        $sortBy = null,
        $sortAscending = null,
        $limit = null,
        $offset = null)
    {
        parent::__construct();
        $this->setProperty('query', trim($query));
        $this->setChild('ldapSearchBase', trim($ldapSearchBase));
        if(null !== $sortBy)
        {
            $this->setProperty('sortBy', trim($sortBy));
        }
        if(null !== $sortAscending)
        {
            $this->setProperty('sortAscending', (bool) $sortAscending);
        }
        if(null !== $limit)
        {
            $this->setProperty('limit', (int) $limit);
        }
        if(null !== $offset)
        {
            $this->setProperty('offset', (int) $offset);
        }
    }

    /**
     * Gets query
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->getProperty('query');
    }

    /**
     * Sets query
     *
     * @param  string $query
     * @return self
     */
    public function setQuery($query)
    {
        return $this->setProperty('query', trim($query));
    }

    /**
     * Gets ldapSearchBase
     *
     * @return string
     */
    public function getLdapSearchBase()
    {
        return $this->getChild('ldapSearchBase');
    }

    /**
     * Sets ldapSearchBase
     *
     * @param  string $ldapSearchBase
     * @return self
     */
    public function setLdapSearchBase($ldapSearchBase)
    {
        return $this->setChild('ldapSearchBase', trim($ldapSearchBase));
    }

    /**
     * Gets sortBy
     *
     * @return string
     */
    public function getSortBy()
    {
        return $this->getProperty('sortBy');
    }

    /**
     * Sets sortBy
     *
     * @param  string $sortBy
     * @return self
     */
    public function setSortBy($sortBy)
    {
        return $this->setProperty('sortBy', trim($sortBy));
    }

    /**
     * Gets sortAscending
     *
     * @return bool
     */
    public function getSortAscending()
    {
        return $this->getProperty('sortAscending');
    }

    /**
     * Sets sortAscending
     *
     * @param  bool $sortAscending
     * @return self
     */
    public function setSortAscending($sortAscending)
    {
        return $this->setProperty('sortAscending', (bool) $sortAscending);
    }

    /**
     * Gets limit
     *
     * @return int
     */
    public function getLimit()
    {
        return $this->getProperty('limit');
    }

    /**
     * Sets limit
     *
     * @param  int $limit
     * @return self
     */
    public function setLimit($limit)
    {
        return $this->setProperty('limit', (int) $limit);
    }

    /**
     * Gets offset
     *
     * @return int
     */
    public function getOffset()
    {
        return $this->getProperty('offset');
    }

    /**
     * Sets offset
     *
     * @param  int $offset
     * @return self
     */
    public function setOffset($offset)
    {
        return $this->setProperty('offset', (int) $offset);
    }
}
