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
use Zimbra\Struct\AttributeSelectorTrait;
use Zimbra\Struct\AttributeSelector;

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
class SearchAutoProvDirectory extends Base implements AttributeSelector
{
    use AttributeSelectorTrait;

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
        array $attrs = []
    )
    {
        parent::__construct();
        $this->setChild('domain', $domain);
        $this->setProperty('keyAttr', trim($keyAttr));
        if(null !== $query)
        {
            $this->setProperty('query', trim($query));
        }
        if(null !== $name)
        {
            $this->setProperty('name', trim($name));
        }
        if(null !== $maxResults)
        {
            $this->setProperty('maxResults', (int) $maxResults);
        }
        if(null !== $limit)
        {
            $this->setProperty('limit', (int) $limit);
        }
        if(null !== $offset)
        {
            $this->setProperty('offset', (int) $offset);
        }
        if(null !== $refresh)
        {
            $this->setProperty('refresh', (bool) $refresh);
        }

        $this->setAttrs($attrs);
        $this->on('before', function(Base $sender)
        {
            $attrs = $sender->getAttrs();
            if(!empty($attrs))
            {
                $sender->setProperty('attrs', $attrs);
            }
        });
    }

    /**
     * Gets the domain.
     *
     * @return Domain
     */
    public function getDomain()
    {
        return $this->getChild('domain');
    }

    /**
     * Sets the domain.
     *
     * @param  Domain $domain
     * @return self
     */
    public function setDomain(Domain $domain)
    {
        return $this->setChild('domain', $domain);
    }

    /**
     * Gets keyAttr
     *
     * @return string
     */
    public function getKeyAttr()
    {
        return $this->getProperty('keyAttr');
    }

    /**
     * Sets keyAttr
     *
     * @param  string $keyAttr
     * @return self
     */
    public function setKeyAttr($keyAttr)
    {
        return $this->setProperty('keyAttr', trim($keyAttr));
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
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets max results
     *
     * @return int
     */
    public function getMaxResults()
    {
        return $this->getProperty('maxResults');
    }

    /**
     * Sets max results
     *
     * @param  int $maxResults
     * @return self
     */
    public function setMaxResults($maxResults)
    {
        return $this->setProperty('maxResults', (int) $maxResults);
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
     * Gets refresh
     *
     * @return bool
     */
    public function getRefresh()
    {
        return $this->getProperty('refresh');
    }

    /**
     * Sets refresh
     *
     * @param  bool $refresh
     * @return self
     */
    public function setRefresh($refresh)
    {
        return $this->setProperty('refresh', (bool) $refresh);
    }
}
