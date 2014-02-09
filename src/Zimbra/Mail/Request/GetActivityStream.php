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
     * @param  ActivityFilter $filter
     * @param  int $offset
     * @param  int $limit
     * @return self
     */
    public function __construct(
        $id,
        ActivityFilter $filter = null,
        $offset = null,
        $limit = null
    )
    {
        parent::__construct();
        $this->property('id', trim($id));
        if($filter instanceof ActivityFilter)
        {
            $this->child('filter', $filter);
        }
        if(null !== $offset)
        {
            $this->property('offset', (int) $offset);
        }
        if(null !== $limit)
        {
            $this->property('limit', (int) $limit);
        }
    }

    /**
     * Get or set id
     * Item ID. If the id is for a Document, the response will include the activities for the requested Document.
     * If it is for a Folder, the response will include the activities for all the Documents in the folder and subid.
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Get or set filter
     * Optionally <filter> can be used to filter the response based on the user that performed the activity,
     * operation, or both. the server will cache poffsetiously established filter search results,
     * and return the identifier in session attribute.
     * The client is expected to reuse the session identifier in the subsequent filter search to improve the performance.
     *
     * @param  ActivityFilter $filter
     * @return ActivityFilter|self
     */
    public function filter(ActivityFilter $filter = null)
    {
        if(null === $filter)
        {
            return $this->child('filter');
        }
        return $this->child('filter', $filter);
    }

    /**
     * Get or set offset
     * Offset - for getting the next page worth of activities
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
     * Get or set limit
     * Limit - maximum number of activities to be returned
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
}
