<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\ActivityFilter;

/**
 * GetActivityStream request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetActivityStream extends Request
{
    /**
     * Item ID. If the id is for a Document, the response will include the activities for the requested Document.
     * If it is for a Folder, the response will include the activities for all the Documents in the folder and subfolders.
     * @var string
     */
    private $_id;

    /**
     * Optionally <filter> can be used to filter the response based on the user that performed the activity,
     * operation, or both. the server will cache previously established filter search results,
     * and return the identifier in session attribute.
     * The client is expected to reuse the session identifier in the subsequent filter search to improve the performance.
     * @var ActivityFilter
     */
    private $_filter;

    /**
     * Offset - for getting the next page worth of activities
     * @var int
     */
    private $_offset;

    /**
     * Limit - maximum number of activities to be returned
     * @var int
     */
    private $_limit;

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
        $this->_id = trim($id);
        if($filter instanceof ActivityFilter)
        {
            $this->_filter = $filter;
        }
        if(null !== $offset)
        {
            $this->_offset = (int) $offset;
        }
        if(null !== $limit)
        {
            $this->_limit = (int) $limit;
        }
    }

    /**
     * Get or set id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->_id;
        }
        $this->_id = trim($id);
        return $this;
    }

    /**
     * Get or set filter
     *
     * @param  ActivityFilter $filter
     * @return ActivityFilter|self
     */
    public function filter(ActivityFilter $filter = null)
    {
        if(null === $filter)
        {
            return $this->_filter;
        }
        $this->_filter = $filter;
        return $this;
    }

    /**
     * Get or set offset
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
     * Get or set limit
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
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array['id'] = $this->_id;
        if(is_int($this->_offset))
        {
            $this->array['offset'] = $this->_offset;
        }
        if(is_int($this->_limit))
        {
            $this->array['limit'] = $this->_limit;
        }
        if($this->_filter instanceof ActivityFilter)
        {
            $this->array += $this->_filter->toArray('filter');
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
        $this->xml->addAttribute('id', $this->_id);
        if(is_int($this->_offset))
        {
            $this->xml->addAttribute('offset', $this->_offset);
        }
        if(is_int($this->_limit))
        {
            $this->xml->addAttribute('limit', $this->_limit);
        }
        if($this->_filter instanceof ActivityFilter)
        {
            $this->xml->append($this->_filter->toXml('filter'));
        }
        return parent::toXml();
    }
}
