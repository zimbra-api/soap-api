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
    private static $_validAttrs = array('displayName', 'zimbraId', 'zimbraAccountStatus');

    /**
     * Valid types
     * @var array
     */
    private static $_validTypes = array('accounts', 'resources');

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
        $this->property('query', trim($query));
        if(null !== $limit)
        {
            $this->property('limit', (int) $limit);
        }
        if(null !== $offset)
        {
            $this->property('offset', (int) $offset);
        }
        if(null !== $domain)
        {
            $this->property('domain', trim($domain));
        }
        if(null !== $applyCos)
        {
            $this->property('applyCos', (bool) $applyCos);
        }

        $attrs = explode(',', $attrs);
        $arrAttr = array();
        foreach ($attrs as $attr)
        {
            $attr = trim($attr);
            if(in_array($attr, self::$_validAttrs) && !in_array($attr, $arrAttr))
            {
                $arrAttr[] = $attr;
            }
        }
        if(count($arrAttr))
        {
            $this->property('attrs', implode(',', $arrAttr));
        }

        if(null !== $sortBy)
        {
            $this->property('sortBy', trim($sortBy));
        }

        $types = explode(',', trim($types));
        $arrType = array();
        foreach ($types as $type)
        {
            $type = trim($type);
            if(in_array($type, self::$_validTypes) && !in_array($type, $arrType))
            {
                $arrType[] = $type;
            }
        }
        if(count($arrType))
        {
            $this->property('types', implode(',', $arrType));
        }

        if(null !== $sortAscending)
        {
            $this->property('sortAscending', (bool) $sortAscending);
        }
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
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

    /**
     * Gets or sets domain
     *
     * @param  string $domain
     * @return string|self
     */
    public function domain($domain = null)
    {
        if(null === $domain)
        {
            return $this->property('domain');
        }
        return $this->property('domain', trim($domain));
    }

    /**
     * Gets or sets applyCos
     *
     * @param  bool $applyCos
     * @return bool|self
     */
    public function applyCos($applyCos = null)
    {
        if(null === $applyCos)
        {
            return $this->property('applyCos');
        }
        return $this->property('applyCos', (bool) $applyCos);
    }

    /**
     * Gets or sets attrs
     *
     * @param  string $attrs
     * @return string|self
     */
    public function attrs($attrs = null)
    {
        if(null === $attrs)
        {
            return $this->property('attrs');
        }
        $attrs = explode(',', $attrs);
        $arrAttr = array();
        foreach ($attrs as $attr)
        {
            $attr = trim($attr);
            if(in_array($attr, self::$_validAttrs) && !in_array($attr, $arrAttr))
            {
                $arrAttr[] = $attr;
            }
        }
        return $this->property('attrs', implode(',', $arrAttr));
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
     * Gets or sets types
     *
     * @param  string $types
     * @return string|self
     */
    public function types($types = null)
    {
        if(null === $types)
        {
            return $this->property('types');
        }
        $types = explode(',', trim($types));
        $arrType = array();
        foreach ($types as $type)
        {
            $type = trim($type);
            if(in_array($type, self::$_validTypes) && !in_array($type, $arrType))
            {
                $arrType[] = $type;
            }
        }
        return $this->property('types', implode(',', $arrType));
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
}
