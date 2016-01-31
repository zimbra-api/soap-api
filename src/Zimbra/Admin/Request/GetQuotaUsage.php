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

use Zimbra\Enum\QuotaSortBy;

/**
 * GetQuotaUsage request class
 * Get Quota Usage.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetQuotaUsage extends Base
{
    /**
     * Constructor method for GetQuotaUsage
     * @param string $domain Domain - the domain name to limit the search to
     * @param bool $allServers Ưhether to fetch quota usage for all domain accounts from across all mailbox servers, default is false, applicable when domain attribute is specified
     * @param int $limit Limit - the number of accounts to return (0 is default and means all)
     * @param int $offset Offset - the starting offset (0, 25, etc)
     * @param QuotaSortBy $sortBy SortBy - valid values: "percentUsed", "totalUsed", "quotaLimit"
     * @param bool $sortAscending Whether to sort in ascending order 0 (false) is default, so highest quotas are returned first
     * @param bool $refresh Refresh - whether to always recalculate the data even when cached values are available. 0 (false) is the default.
     * @return self
     */
    public function __construct(
        $domain = null,
        $allServers = null,
        $limit = null,
        $offset = null,
        QuotaSortBy $sortBy = null,
        $sortAscending = null,
        $refresh = null
    )
    {
        parent::__construct();
        if (null !== $domain)
        {
            $this->setProperty('domain', trim($domain));
        }
        if(null !== $allServers)
        {
            $this->setProperty('allServers', (bool) $allServers);
        }
        if(null !== $limit)
        {
            $this->setProperty('limit', (int) $limit);
        }
        if(null !== $offset)
        {
            $this->setProperty('offset', (int) $offset);
        }
        if($sortBy instanceof QuotaSortBy)
        {
            $this->setProperty('sortBy', $sortBy);
        }
        if(null !== $sortAscending)
        {
            $this->setProperty('sortAscending', (bool) $sortAscending);
        }
        if(null !== $refresh)
        {
            $this->setProperty('refresh', (bool) $refresh);
        }
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
     * Gets allServers
     *
     * @return bool
     */
    public function getAllServers()
    {
        return $this->getProperty('allServers');
    }

    /**
     * Sets allServers
     *
     * @param  bool $allServers
     * @return self
     */
    public function setAllServers($allServers)
    {
        return $this->setProperty('allServers', (bool) $allServers);
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
     * Gets sortBy
     *
     * @return QuotaSortBy
     */
    public function getSortBy()
    {
        return $this->getProperty('sortBy');
    }

    /**
     * Sets sortBy
     *
     * @param  QuotaSortBy $sortBy
     * @return self
     */
    public function setSortBy(QuotaSortBy $sortBy)
    {
        return $this->setProperty('sortBy', $sortBy);
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
