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

use Zimbra\Enum\GetSessionsSortBy;
use Zimbra\Enum\SessionType;
use Zimbra\Soap\Request;

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
class GetSessions extends Request
{
    /**
     * Constructor method for GetSessions
     * @param SessionType $type Type - valid values soap|imap|admin
     * @param GetSessionsSortBy $sortBy The sortBy
     * @param int $limit Limit - the number of sessions to return per page (0 is default and means all)
     * @param int $offset Offset - the starting offset (0, 25, etc)
     * @param bool $refresh Refresh. If 1 (true), ignore any cached results and start fresh.
     * @return self
     */
    public function __construct(
        SessionType $type,
        GetSessionsSortBy $sortBy = null,
        $limit = null,
        $offset = null,
        $refresh = null
    )
    {
        parent::__construct();
        $this->property('type', $type);
        if($sortBy instanceof GetSessionsSortBy)
        {
            $this->property('sortBy', $sortBy);
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
    }

    /**
     * Gets or sets type
     *
     * @param  SessionType $type
     * @return SessionType|self
     */
    public function type(SessionType $type = null)
    {
        if(null === $type)
        {
            return $this->property('type');
        }
        return $this->property('type', $type);
    }

    /**
     * Gets or sets sortBy
     *
     * @param  GetSessionsSortBy $sortBy
     * @return GetSessionsSortBy|self
     */
    public function sortBy(GetSessionsSortBy $sortBy = null)
    {
        if(null === $sortBy)
        {
            return $this->property('sortBy');
        }
        return $this->property('sortBy', $sortBy);
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
