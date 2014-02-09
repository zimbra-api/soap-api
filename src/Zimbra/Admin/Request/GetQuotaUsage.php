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
        $this->property('domain', trim($domain));
        if(null !== $allServers)
        {
            $this->property('allServers', (bool) $allServers);
        }
        if(null !== $limit)
        {
            $this->property('limit', (int) $limit);
        }
        if(null !== $offset)
        {
            $this->property('offset', (int) $offset);
        }
        if($sortBy instanceof QuotaSortBy)
        {
            $this->property('sortBy', $sortBy);
        }
        if(null !== $sortAscending)
        {
            $this->property('sortAscending', (bool) $sortAscending);
        }
        if(null !== $refresh)
        {
            $this->property('refresh', (bool) $refresh);
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
            return $this->property('domain');
        }
        return $this->property('domain', trim($domain));
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
            return $this->property('allServers');
        }
        return $this->property('allServers', (bool) $allServers);
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
     * Gets or sets sortBy
     *
     * @param  QuotaSortBy $sortBy
     * @return QuotaSortBy|self
     */
    public function sortBy(QuotaSortBy $sortBy = null)
    {
        if(null === $sortBy)
        {
            return $this->property('sortBy');
        }
        return $this->property('sortBy', $sortBy);
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
}
