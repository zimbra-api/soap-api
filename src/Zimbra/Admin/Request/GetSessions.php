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

use Zimbra\Enum\GetSessionsSortBy as SortBy;
use Zimbra\Enum\SessionType;

/**
 * GetSessions request class
 * Get Sessions.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetSessions extends Base
{
    /**
     * Constructor method for GetSessions
     * @param SessionType $type Type - valid values soap|imap|admin
     * @param SortBy $sortBy The sortBy
     * @param int $limit Limit - the number of sessions to return per page (0 is default and means all)
     * @param int $offset Offset - the starting offset (0, 25, etc)
     * @param bool $refresh Refresh. If 1 (true), ignore any cached results and start fresh.
     * @return self
     */
    public function __construct(
        SessionType $type,
        SortBy $sortBy = null,
        $limit = null,
        $offset = null,
        $refresh = null
    )
    {
        parent::__construct();
        $this->setProperty('type', $type);
        if($sortBy instanceof SortBy)
        {
            $this->setProperty('sortBy', $sortBy);
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
    }

    /**
     * Gets type
     *
     * @return SessionType
     */
    public function getType()
    {
        return $this->getProperty('type');
    }

    /**
     * Sets type
     *
     * @param  SessionType $type
     * @return self
     */
    public function setType(SessionType $type)
    {
        return $this->setProperty('type', $type);
    }

    /**
     * Gets sortBy
     *
     * @return SortBy
     */
    public function getSortBy()
    {
        return $this->getProperty('sortBy');
    }

    /**
     * Sets sortBy
     *
     * @param  SortBy $sortBy
     * @return self
     */
    public function setSortBy(SortBy $sortBy)
    {
        return $this->setProperty('sortBy', $sortBy);
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
