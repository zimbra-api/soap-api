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

use Zimbra\Soap\Request;

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
class GetLDAPEntries extends Request
{
    /**
     * Constructor method for GetLDAPEntries
     * @param string $query Query string. Should be an LDAP-style filter string (RFC 2254)
     * @param string $ldapSearchBase LDAP search base. An LDAP-style filter string that defines an LDAP search base (RFC 2254)
     * @param string $ortBy Name of attribute to sort on. default is null
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
        $this->property('query', trim($query));
        $this->child('ldapSearchBase', trim($ldapSearchBase));
        if(null !== $sortBy)
        {
            $this->property('sortBy', trim($sortBy));
        }
        if(null !== $sortAscending)
        {
            $this->property('sortAscending', (bool) $sortAscending);
        }
        if(null !== $limit)
        {
            $this->property('limit', (int) $limit);
        }
        if(null !== $offset)
        {
            $this->property('offset', (int) $offset);
        }
    }

    /**
     * Gets or sets query
     *
     * @param  string $query
     * @return string|self
     */
    public function query($query = null)
    {
        if(null === $query)
        {
            return $this->property('query');
        }
        return $this->property('query', trim($query));
    }

    /**
     * Gets or sets ldapSearchBase
     *
     * @param  string $ldapSearchBase
     * @return string|self
     */
    public function ldapSearchBase($ldapSearchBase = null)
    {
        if(null === $ldapSearchBase)
        {
            return $this->child('ldapSearchBase');
        }
        return $this->child('ldapSearchBase', trim($ldapSearchBase));
    }

    /**
     * Gets or sets sortBy
     *
     * @param  string $sortBy
     * @return string|self
     */
    public function sortBy($sortBy = null)
    {
        if(null === $sortBy)
        {
            return $this->property('sortBy');
        }
        return $this->property('sortBy', trim($sortBy));
    }

    /**
     * Gets or sets sortAscending
     *
     * @param  bool $sortAscending
     * @return bool|self
     */
    public function sortAscending($sortAscending = null)
    {
        if(null === $sortAscending)
        {
            return $this->property('sortAscending');
        }
        return $this->property('sortAscending', (bool) $sortAscending);
    }

    /**
     * Gets or sets limit
     *
     * @param  int $limit
     * @return int|self
     */
    public function limit($limit = null)
    {
        if(null === $limit)
        {
            return $this->property('limit');
        }
        return $this->property('limit', (int) $limit);
    }

    /**
     * Gets or sets offset
     *
     * @param  int $offset
     * @return int|self
     */
    public function offset($offset = null)
    {
        if(null === $offset)
        {
            return $this->property('offset');
        }
        return $this->property('offset', (int) $offset);
    }
}
