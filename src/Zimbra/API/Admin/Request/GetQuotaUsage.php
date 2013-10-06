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
 * GetQuotaUsage class
 * Get Quota Usage.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetQuotaUsage extends Request
{
    /**
     * Domain - the domain name to limit the search to
     * @var string
     */
    private $_domain;

    /**
     * Ưhether to fetch quota usage for all domain accounts from across all mailbox servers, default is false, applicable when domain attribute is specified
     * @var bool
     */
    private $_allServers;

    /**
     * Limit - the number of accounts to return (0 is default and means all)
     * @var int
     */
    private $_limit;

    /**
     * Offset - the starting offset (0, 25, etc)
     * @var int
     */
    private $_offset;

    /**
     * SortBy - valid values: "percentUsed", "totalUsed", "quotaLimit"
     * @var string
     */
    private $_sortBy;

    /**
     * Whether to sort in ascending order 0 (false) is default, so highest quotas are returned first
     * @var bool
     */
    private $_sortAscending;

    /**
     * Refresh - whether to always recalculate the data even when cached values are available. 0 (false) is the default.
     * @var bool
     */
    private $_refresh;

    /**
     * Constructor method for GetQuotaUsage
     * @param string $domain
     * @param bool $allServers
     * @param int $limit
     * @param int $offset
     * @param string $sortBy
     * @param bool $sortAscending
     * @param bool $refresh
     * @return self
     */
    public function __construct(
        $domain = null,
        $allServers = null,
        $limit = null,
        $offset = null,
        $sortBy = null,
        $sortAscending = null,
        $refresh = null)
    {
        parent::__construct();
		$this->_domain = trim($domain);
        if(null !== $allServers)
        {
            $this->_allServers = (bool) $allServers;
        }
        if(null !== $limit)
        {
            $this->_limit = (int) $limit;
        }
        if(null !== $offset)
        {
            $this->_offset = (int) $offset;
        }
        if(in_array(trim($sortBy), array('percentUsed', 'totalUsed', 'quotaLimit')))
        {
            $this->_sortBy = trim($sortBy);
        }
        if(null !== $sortAscending)
        {
            $this->_sortAscending = (bool) $sortAscending;
        }
        if(null !== $refresh)
        {
            $this->_refresh = (bool) $refresh;
        }
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
     * Gets or sets allServers
     *
     * @param  bool $allServers
     * @return bool|self
     */
    public function allServers($allServers = null)
    {
        if(null === $allServers)
        {
            return $this->_allServers;
        }
        $this->_allServers = (bool) $allServers;
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
        $this->_limit = intval($limit);
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
        $this->_offset = intval($offset);
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
        if(in_array(trim($sortBy), array('percentUsed', 'totalUsed', 'quotaLimit')))
        {
            $this->_sortBy = trim($sortBy);
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
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(!empty($this->_domain))
        {
            $this->array['domain'] = $this->_domain;
        }
        if(is_bool($this->_allServers))
        {
            $this->array['allServers'] = $this->_allServers ? 1 : 0;
        }
        if(is_int($this->_limit))
        {
            $this->array['limit'] = $this->_limit;
        }
        if(is_int($this->_offset))
        {
            $this->array['offset'] = $this->_offset;
        }
        if(!empty($this->_sortBy))
        {
            $this->array['sortBy'] = $this->_sortBy;
        }
        if(is_bool($this->_sortAscending))
        {
            $this->array['sortAscending'] = $this->_sortAscending ? 1 : 0;
        }
        if(is_bool($this->_refresh))
        {
            $this->array['refresh'] = $this->_refresh ? 1 : 0;
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
        if(!empty($this->_domain))
        {
            $this->xml->addAttribute('domain', $this->_domain);
        }
        if(is_bool($this->_allServers))
        {
            $this->xml->addAttribute('allServers', $this->_allServers ? 1 : 0);
        }
        if(is_int($this->_limit))
        {
            $this->xml->addAttribute('limit', $this->_limit);
        }
        if(is_int($this->_offset))
        {
            $this->xml->addAttribute('offset', $this->_offset);
        }
        if(!empty($this->_sortBy))
        {
            $this->xml->addAttribute('sortBy', $this->_sortBy);
        }
        if(is_bool($this->_sortAscending))
        {
            $this->xml->addAttribute('sortAscending', $this->_sortAscending ? 1 : 0);
        }
        if(is_bool($this->_refresh))
        {
            $this->xml->addAttribute('refresh', $this->_refresh ? 1 : 0);
        }
        return parent::toXml();
    }
}
