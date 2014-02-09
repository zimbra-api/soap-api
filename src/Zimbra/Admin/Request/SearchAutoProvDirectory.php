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

use Zimbra\Admin\Struct\DomainSelector as Domain;

/**
 * SearchAutoProvDirectory request class
 * Search Auto Prov Directory.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SearchAutoProvDirectory extends Base
{
    /**
     * Constructor method for SearchAutoProvDirectory
     * @param Domain $domain Domain selector for the domain name to limit the search to (do not use if searching for domains)
     * @param string $keyAttr Name of attribute for the key.
     * @param string $query Query string - should be an LDAP-style filter string (RFC 2254)
     * @param string $name Name to fill the auto provisioning search template configured on the domain
     * @param int $maxResults Maximum results that the backend will attempt to fetch from the directory before returning an account
     * @param int $limit The maximum number of accounts to return (0 is default and means all)
     * @param int $offset The starting offset (0, 25, etc)
     * @param bool $refresh Whether to always re-search in LDAP even when cached entries are available. 0 (false) is the default.
     * @param string $attrs Comma separated list of attributes
     * @return self
     */
    public function __construct(
        Domain $domain,
        $keyAttr,
        $query = null,
        $name = null,
        $maxResults = null,
        $limit = null,
        $offset = null,
        $refresh = null,
        $attrs = null
    )
    {
        parent::__construct();
        $this->child('domain', $domain);
        $this->property('keyAttr', trim($keyAttr));
        if(null !== $query)
        {
            $this->property('query', trim($query));
        }
        if(null !== $name)
        {
            $this->property('name', trim($name));
        }
        if(null !== $maxResults)
        {
            $this->property('maxResults', (int) $maxResults);
        }
        if(null !== $limit)
        {
            $this->property('limit', (int) $limit);
        }
        if(null !== $offset)
        {
            $this->property('offset', (int) $offset);
        }
        if(null !== $refresh)
        {
            $this->property('refresh', (bool) $refresh);
        }
        if(null !== $attrs)
        {
            $this->property('attrs', trim($attrs));
        }
    }

    /**
     * Gets or sets domain
     *
     * @param  Domain $domain
     * @return Domain|self
     */
    public function domain(Domain $domain = null)
    {
        if(null === $domain)
        {
            return $this->child('domain');
        }
        return $this->child('domain', $domain);
    }

    /**
     * Gets or sets keyAttr
     *
     * @param  string $keyAttr
     * @return string|self
     */
    public function keyAttr($keyAttr = null)
    {
        if(null === $keyAttr)
        {
            return $this->property('keyAttr');
        }
        return $this->property('keyAttr', trim($keyAttr));
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
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->property('name');
        }
        return $this->property('name', trim($name));
    }

    /**
     * Gets or sets maxResults
     *
     * @param  int $maxResults
     * @return int|self
     */
    public function maxResults($maxResults = null)
    {
        if(null === $maxResults)
        {
            return $this->property('maxResults');
        }
        return $this->property('maxResults', (int) $maxResults);
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
     * Gets or sets refresh
     *
     * @param  bool $refresh
     * @return bool|self
     */
    public function refresh($refresh = null)
    {
        if(null === $refresh)
        {
            return $this->property('refresh');
        }
        return $this->property('refresh', (bool) $refresh);
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
        return $this->property('attrs', trim($attrs));
    }
}
