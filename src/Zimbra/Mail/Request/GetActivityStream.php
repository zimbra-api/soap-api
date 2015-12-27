<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Mail\Struct\ActivityFilter;

/**
 * GetActivityStream request class
 * Get activity stream
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetActivityStream extends Base
{
    /**
     * Constructor method for GetActivityStream
     * @param  string $id
     * @param  int $queryOffset
     * @param  int $queryLimit
     * @param  ActivityFilter $filter
     * @return self
     */
    public function __construct(
        $id,
        $queryOffset = null,
        $queryLimit = null,
        ActivityFilter $filter = null
    )
    {
        parent::__construct();
        $this->setProperty('id', trim($id));
        if(null !== $queryOffset)
        {
            $this->setProperty('offset', (int) $queryOffset);
        }
        if(null !== $queryLimit)
        {
            $this->setProperty('limit', (int) $queryLimit);
        }
        if($filter instanceof ActivityFilter)
        {
            $this->setChild('filter', $filter);
        }
    }

    /**
     * Gets item ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets item ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets offset
     *
     * @return int
     */
    public function getQueryOffset()
    {
        return $this->getProperty('offset');
    }

    /**
     * Sets offset
     *
     * @param  int $queryOffset
     * @return self
     */
    public function setQueryOffset($queryOffset)
    {
        return $this->setProperty('offset', (int) $queryOffset);
    }

    /**
     * Gets limit
     *
     * @return int
     */
    public function getQueryLimit()
    {
        return $this->getProperty('limit');
    }

    /**
     * Sets limit
     *
     * @param  int $queryLimit
     * @return self
     */
    public function setQueryLimit($queryLimit)
    {
        return $this->setProperty('limit', (int) $queryLimit);
    }

    /**
     * Gets filter
     *
     * @return ActivityFilter
     */
    public function getFilter()
    {
        return $this->getChild('filter');
    }

    /**
     * Sets filter
     *
     * @param  ActivityFilter $filter
     * @return self
     */
    public function setFilter(ActivityFilter $filter)
    {
        return $this->setChild('filter', $filter);
    }
}
