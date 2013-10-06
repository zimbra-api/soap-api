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

/**
 * SearchDirectory class
 * Search directory.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SearchDirectory extends Request
{
    /**
     * Query string - should be an LDAP-style filter string (RFC 2254)
     * @var string
     */
    private $_query;

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
     * The domain name to limit the search to.
     * @var string
     */
    private $_domain;

    /**
     * Flag whether or not to apply the COS policy to account.
     * Specify 0 (false) if only requesting attrs that aren't inherited from COS.
     * @var bool
     */
    private $_applyCos;

    /**
     * Whether or not to apply the global config attrs to account.
     * Specify 0 (false) if only requesting attrs that aren't inherited from global config.
     * @var bool
     */
    private $_applyConfig;

    /**
     * Name of attribute to sort on. Default is the account name.
     * @var string
     */
    private $_sortBy;

    /**
     * Comma-separated list of types to return. Legal values are:
     * accounts|distributionlists|aliases|resources|domains|coses
     * (default is accounts)
     * @var string
     */
    private $_types;

    /**
     * Whether to sort in ascending order. Default is 1 (true).
     * @var bool
     */
    private $_sortAscending;

    /**
     * Whether response should be count only. Default is 0 (false)
     * @var bool
     */
    private $_countOnly;

    /**
     * Comma separated list of attributes
     * @var string
     */
    private $_attrs;

    /**
     * Valid types
     * @var array
     */
    private static $_validTypes = array(
        'accounts',
        'distributionlists',
        'aliases',
        'resources',
        'domains',
        'coses'
    );

    /**
     * Constructor method for SearchDirectory
     * @see parent::__construct()
     * @param string $query
     * @param int $maxResults
     * @param int $limit
     * @param int $offset
     * @param string $domain
     * @param bool $applyCos
     * @param bool $applyConfig
     * @param string $sortBy
     * @param string $types
     * @param bool $sortAscending
     * @param bool $countOnly
     * @param string $attrs
     * @return self
     */
    public function __construct(
        $query = null,
        $maxResults = null,
        $limit = null,
        $offset = null,
        $domain = null,
        $applyCos = null,
        $applyConfig = null,
        $sortBy = null,
        $types = null,
        $sortAscending = null,
        $countOnly = null,
        $attrs = null
    )
    {
        parent::__construct();
        $this->_query = trim($query);
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
        $this->_domain = trim($domain);
        if(null !== $applyCos)
        {
            $this->_applyCos = (bool) $applyCos;
        }
        if(null !== $applyConfig)
        {
            $this->_applyConfig = (bool) $applyConfig;
        }
        $this->_sortBy = trim($sortBy);

        foreach (explode(',', trim($types)) as $type)
        {
            if(in_array(trim($type), self::$_validTypes))
            {
                $this->_types = empty($this->_types) ? trim($type) : ',' . trim($type);
            }
        }

        $this->_types = trim($types);
        if(null !== $sortAscending)
        {
            $this->_sortAscending = (bool) $sortAscending;
        }
        if(null !== $countOnly)
        {
            $this->_countOnly = (bool) $countOnly;
        }
        $this->_attrs = trim($attrs);
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
     * Gets or sets domain
     *
     * @param  string $domain
     * @return string|self
     */
    public function domain($domain = null)
    {
        if(null === $domain)
        {
            return $this->_domain;
        }
        $this->_domain = trim($domain);
        return $this;
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
            return $this->_applyCos;
        }
        $this->_applyCos = (bool) $applyCos;
        return $this;
    }

    /**
     * Gets or sets applyConfig
     *
     * @param  bool $applyConfig
     * @return bool|self
     */
    public function applyConfig($applyConfig = null)
    {
        if(null === $applyConfig)
        {
            return $this->_applyConfig;
        }
        $this->_applyConfig = (bool) $applyConfig;
        return $this;
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
            return $this->_sortBy;
        }
        $this->_sortBy = trim($sortBy);
        return $this;
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
            return $this->_types;
        }
        $this->_types = '';
        foreach (explode(',', trim($types)) as $type)
        {
            if(in_array(trim($type), self::$_validTypes))
            {
                $this->_types = empty($this->_types) ? trim($type) : ',' . trim($type);
            }
        }
        return $this;
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
            return $this->_sortAscending;
        }
        $this->_sortAscending = (bool) $sortAscending;
        return $this;
    }

    /**
     * Gets or sets countOnly
     *
     * @param  bool $countOnly
     * @return bool|self
     */
    public function countOnly($countOnly = null)
    {
        if(null === $countOnly)
        {
            return $this->_countOnly;
        }
        $this->_countOnly = (bool) $countOnly;
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
        if(!empty($this->_query))
        {
            $this->array['query'] = $this->_query;
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
        if(!empty($this->_domain))
        {
            $this->array['domain'] = $this->_domain;
        }
        if(is_bool($this->_applyCos))
        {
            $this->array['applyCos'] = $this->_applyCos ? 1 : 0;
        }
        if(is_bool($this->_applyConfig))
        {
            $this->array['applyConfig'] = $this->_applyConfig ? 1 : 0;
        }
        if(!empty($this->_sortBy))
        {
            $this->array['sortBy'] = $this->_sortBy;
        }
        if(!empty($this->_types))
        {
            $this->array['types'] = $this->_types;
        }
        if(is_bool($this->_sortAscending))
        {
            $this->array['sortAscending'] = $this->_sortAscending ? 1 : 0;
        }
        if(is_bool($this->_countOnly))
        {
            $this->array['countOnly'] = $this->_countOnly ? 1 : 0;
        }
        if(!empty($this->_attrs))
        {
            $this->array['attrs'] = $this->_attrs;
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if(!empty($this->_query))
        {
            $this->xml->addAttribute('query', $this->_query);
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
        if(!empty($this->_domain))
        {
            $this->xml->addAttribute('domain', $this->_domain);
        }
        if(is_bool($this->_applyCos))
        {
            $this->xml->addAttribute('applyCos', $this->_applyCos ? 1 : 0);
        }
        if(is_bool($this->_applyConfig))
        {
            $this->xml->addAttribute('applyConfig', $this->_applyConfig ? 1 : 0);
        }
        if(!empty($this->_sortBy))
        {
            $this->xml->addAttribute('sortBy', $this->_sortBy);
        }
        if(!empty($this->_types))
        {
            $this->xml->addAttribute('types', $this->_types);
        }
        if(is_bool($this->_sortAscending))
        {
            $this->xml->addAttribute('sortAscending', $this->_sortAscending ? 1 : 0);
        }
        if(is_bool($this->_countOnly))
        {
            $this->xml->addAttribute('countOnly', $this->_countOnly ? 1 : 0);
        }
        if(!empty($this->_attrs))
        {
            $this->xml->addAttribute('attrs', $this->_attrs);
        }
        return parent::toXml();
    }
}
