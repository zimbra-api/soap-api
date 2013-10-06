<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\DomainSelector as Domain;

/**
 * SearchAutoProvDirectory class
 * Search Auto Prov Directory.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SearchAutoProvDirectory extends Request
{
    /**
     * Domain selector for the domain name to limit the search to (do not use if searching for domains)
     * @var Domain
     */
    private $_domain;

    /**
     * Name of attribute for the key.
     * @var string
     */
    private $_keyAttr;

    /**
     * Query string - should be an LDAP-style filter string (RFC 2254)
     * @var string
     */
    private $_query;

    /**
     * Name to fill the auto provisioning search template configured on the domain
     * @var string
     */
    private $_name;

    /**
     * Maximum results that the backend will attempt to fetch from the directory before returning an account
     * @var int
     */
    private $_maxResults;

    /**
     * The maximum number of accounts to return (0 is default and means all)
     * @var int
     */
    private $_limit;

    /**
     * The starting offset (0, 25, etc)
     * @var int
     */
    private $_offset;

    /**
     * Whether to always re-search in LDAP even when cached entries are available. 0 (false) is the default.
     * @var boolean
     */
    private $_refresh;

    /**
     * Comma separated list of attributes
     * @var string
     */
    private $_attrs;

    /**
     * Constructor method for SearchAutoProvDirectory
     * @see parent::__construct()
     * @param Domain $domain
     * @param string $keyAttr
     * @param string $query
     * @param string $name
     * @param int $maxResults
     * @param int $limit
     * @param int $offset
     * @param bool $refresh
     * @param string $attrs
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
        $this->_domain = $domain;
        $this->_keyAttr = trim($keyAttr);
        $this->_query = trim($query);
        $this->_name = trim($name);
        if(null !== $maxResults)
        {
            $this->_maxResults = (int) $maxResults;
        }
        if(null !== $limit)
        {
            $this->_limit = (int) $limit;
        }
        if(null !== $offset)
        {
            $this->_offset = (int) $offset;
        }
        if(null !== $refresh)
        {
            $this->_refresh = (bool) $refresh;
        }
        $this->_attrs = trim($attrs);
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
            return $this->_domain;
        }
        $this->_domain = $domain;
        return $this;
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
            return $this->_keyAttr;
        }
        $this->_keyAttr = trim($keyAttr);
        return $this;
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
            return $this->_query;
        }
        $this->_query = trim($query);
        return $this;
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
            return $this->_name;
        }
        $this->_name = trim($name);
        return $this;
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
            return $this->_maxResults;
        }
        $this->_maxResults = (int) $maxResults;
        return $this;
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
            return $this->_limit;
        }
        $this->_limit = (int) $limit;
        return $this;
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
            return $this->_offset;
        }
        $this->_offset = (int) $offset;
        return $this;
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
            return $this->_refresh;
        }
        $this->_refresh = (bool) $refresh;
        return $this;
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
            return $this->_attrs;
        }
        $this->_attrs = trim($attrs);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'keyAttr' => $this->_keyAttr
        );
        if(!empty($this->_query))
        {
            $this->array['query'] = $this->_query;
        }
        if(!empty($this->_name))
        {
            $this->array['name'] = $this->_name;
        }
        if(is_int($this->_maxResults))
        {
            $this->array['maxResults'] = $this->_maxResults;
        }
        if(is_int($this->_limit))
        {
            $this->array['limit'] = $this->_limit;
        }
        if(is_int($this->_offset))
        {
            $this->array['offset'] = $this->_offset;
        }
        if(is_bool($this->_refresh))
        {
            $this->array['refresh'] = $this->_refresh ? 1 : 0;
        }
        if(!empty($this->_attrs))
        {
            $this->array['attrs'] = $this->_attrs;
        }
        $this->array += $this->_domain->toArray();
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->addAttribute('keyAttr', $this->_keyAttr);
        if(!empty($this->_query))
        {
            $this->xml->addAttribute('query', $this->_query);
        }
        if(!empty($this->_name))
        {
            $this->xml->addAttribute('name', $this->_name);
        }
        if(is_int($this->_maxResults))
        {
            $this->xml->addAttribute('maxResults', $this->_maxResults);
        }
        if(is_int($this->_limit))
        {
            $this->xml->addAttribute('limit', $this->_limit);
        }
        if(is_int($this->_offset))
        {
            $this->xml->addAttribute('offset', $this->_offset);
        }
        if(is_bool($this->_refresh))
        {
            $this->xml->addAttribute('refresh', $this->_refresh ? 1 : 0);
        }
        if(!empty($this->_attrs))
        {
            $this->xml->addAttribute('attrs', $this->_attrs);
        }
        $this->xml->append($this->_domain->toXml());
        return parent::toXml();
    }
}
