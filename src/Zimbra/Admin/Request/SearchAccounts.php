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
 * SearchAccounts request class
 * Search Accounts.
 * Note: SearchAccountsRequest is deprecated. See SearchDirectoryRequest.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SearchAccounts extends Base
{
    /**
     * Valid attributes
     * @var array
     */
    private static $_validAttrs = ['displayName', 'zimbraId', 'zimbraAccountStatus'];

    /**
     * Valid types
     * @var array
     */
    private static $_validTypes = ['accounts', 'resources'];

    /**
     * Constructor method for SearchAccounts
     * @see parent::__construct()
     * @param string $query Query string - should be an LDAP-style filter string (RFC 2254)
     * @param int $limit The maximum number of accounts to return (0 is default and means all)
     * @param int $offset The starting offset (0, 25, etc)
     * @param string $domain The domain name to limit the search to
     * @param bool $applyCos Flag whether or not to apply the COS policy to account. Specify 0 (false) if only requesting attrs that aren't inherited from COS
     * @param string $attrs Comma-seperated list of attrs to return ("displayName", "zimbraId", "zimbraAccountStatus")
     * @param string $sortBy Name of attribute to sort on. Default is the account name.
     * @param string $types Comma-separated list of types to return. Legal values are: accounts|resources (default is accounts)
     * @param boolean $sortAscending Whether to sort in ascending order. Default is 1 (true)
     * @return self
     */
    public function __construct(
        $query,
        $limit = null,
        $offset = null,
        $domain = null,
        $applyCos = null,
        $attrs = null,
        $sortBy = null,
        $types = null,
        $sortAscending = null
    )
    {
        parent::__construct();
        $this->setProperty('query', trim($query));
        if(null !== $limit)
        {
            $this->setProperty('limit', (int) $limit);
        }
        if(null !== $offset)
        {
            $this->setProperty('offset', (int) $offset);
        }
        if(null !== $domain)
        {
            $this->setProperty('domain', trim($domain));
        }
        if(null !== $applyCos)
        {
            $this->setProperty('applyCos', (bool) $applyCos);
        }

        $this->setAttrs(trim($attrs));

        if(null !== $sortBy)
        {
            $this->setProperty('sortBy', trim($sortBy));
        }

        if(null !== $types)
        {
            $this->setTypes(trim($types));
        }

        if(null !== $sortAscending)
        {
            $this->setProperty('sortAscending', (bool) $sortAscending);
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

    /**
     * Gets domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->getProperty('domain');
    }

    /**
     * Sets domain
     *
     * @param  string $domain
     * @return self
     */
    public function setDomain($domain)
    {
        return $this->setProperty('domain', trim($domain));
    }

    /**
     * Gets applyCos
     *
     * @return bool
     */
    public function getApplyCos()
    {
        return $this->getProperty('applyCos');
    }

    /**
     * Sets applyCos
     *
     * @param  bool $applyCos
     * @return self
     */
    public function setApplyCos($applyCos)
    {
        return $this->setProperty('applyCos', (bool) $applyCos);
    }

    /**
     * Gets attrs
     *
     * @return string
     */
    public function getAttrs()
    {
        return $this->getProperty('attrs');
    }

    /**
     * Sets attrs
     *
     * @param  string $attrs
     * @return self
     */
    public function setAttrs($attrs)
    {
        $attrs = explode(',', $attrs);
        $arrAttr = [];
        foreach ($attrs as $attr)
        {
            $attr = trim($attr);
            if(in_array($attr, self::$_validAttrs) && !in_array($attr, $arrAttr))
            {
                $arrAttr[] = $attr;
            }
        }
        if (!empty($arrAttr))
        {
            $this->setProperty('attrs', implode(',', $arrAttr));
        }
        return $this;
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
     * Gets types
     *
     * @return string
     */
    public function getTypes()
    {
        return $this->getProperty('types');
    }

    /**
     * Sets types
     *
     * @param  string $types
     * @return self
     */
    public function setTypes($types)
    {
        $types = explode(',', trim($types));
        $arrType = [];
        foreach ($types as $type)
        {
            $type = trim($type);
            if(in_array($type, self::$_validTypes) && !in_array($type, $arrType))
            {
                $arrType[] = $type;
            }
        }
        if (!empty($arrType))
        {
            return $this->setProperty('types', implode(',', $arrType));
        }
        return $this;
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
}
