<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Request;

use Zimbra\Account\Struct\EntrySearchFilterInfo as SearchFilter;
use Zimbra\Struct\CursorInfo;

/**
 * SearchCalendarResources request class
 * Search Global Address List (GAL) for calendar resources 
 * "attrs" attribute - comma-separated list of attrs to return ("displayName", "zimbraId", "zimbraCalResType")
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SearchCalendarResources extends Base
{
    /**
     * Constructor method for searchCalendarResources
     * @param string $locale Client locale identification.
     * @param CursorInfo $cursor Cursor specification
     * @param string $name If specified, passed through to the GAL search as the search key
     * @param EntrySearchFilterInfo $searchFilter Search filter specification
     * @param bool $quick "Quick" flag.
     * @param string $sortBy Name of attribute to sort on. default is the calendar resource name.
     * @param int $limit An integer specifying the 0-based offset into the results list to return as the first result for this search operation
     * @param int $offset The 0-based offset into the results list to return as the first result for this search operation.
     * @param string $galAcctId GAL Account ID
     * @param string $attrs Comma separated list of attributes
     * @return self
     */
    public function __construct(
        $locale = null,
        CursorInfo $cursor = null,
        $name = null,
        SearchFilter $searchFilter = null,
        $quick = null,
        $sortBy = null,
        $limit = null,
        $offset = null,
        $galAcctId = null,
        $attrs = null
    )
    {
        parent::__construct();
        if(null !== $locale)
        {
            $this->child('locale', trim($locale));
        }
        if($cursor instanceof CursorInfo)
        {
            $this->child('cursor', $cursor);
        }
        if(null !== $name)
        {
            $this->child('name', trim($name));
        }
        if($searchFilter instanceof SearchFilter)
        {
            $this->child('searchFilter', $searchFilter);
        }
        if(null !== $quick)
        {
            $this->property('quick', (bool) $quick);
        }
        if(null !== $sortBy)
        {
            $this->property('sortBy', trim($sortBy));
        }
        if(null !== $limit)
        {
            $this->property('limit', (int) $limit);
        }
        if(null !== $offset)
        {
            $this->property('offset', (int) $offset);
        }
        if(null !== $galAcctId)
        {
            $this->property('galAcctId', trim($galAcctId));
        }
        if(null !== $attrs)
        {
            $this->property('attrs', trim($attrs));
        }
    }

    /**
     * Gets or sets locale
     *
     * @param  string $locale
     * @return string|self
     */
    public function locale($locale = null)
    {
        if(null === $locale)
        {
            return $this->child('locale');
        }
        return $this->child('locale', trim($locale));
    }

    /**
     * Gets or sets cursor
     *
     * @param  CursorInfo $cursor
     * @return CursorInfo|self
     */
    public function cursor(CursorInfo $cursor = null)
    {
        if(null === $cursor)
        {
            return $this->child('cursor');
        }
        return $this->child('cursor', $cursor);
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
            return $this->child('name');
        }
        return $this->child('name', trim($name));
    }

    /**
     * Gets or sets searchFilter
     *
     * @param  SearchFilter $searchFilter
     * @return SearchFilter|self
     */
    public function searchFilter(SearchFilter $searchFilter = null)
    {
        if(null === $searchFilter)
        {
            return $this->child('searchFilter');
        }
        return $this->child('searchFilter', $searchFilter);
    }

    /**
     * Gets or sets quick
     *
     * @param  bool $quick
     * @return bool|self
     */
    public function quick($quick = null)
    {
        if(null === $quick)
        {
            return $this->property('quick');
        }
        return $this->property('quick', (bool) $quick);
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
            return $this->property('sortBy');
        }
        return $this->property('sortBy', trim($sortBy));
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
     * Gets or sets galAcctId
     *
     * @param  string $galAcctId
     * @return string|self
     */
    public function galAcctId($galAcctId = null)
    {
        if(null === $galAcctId)
        {
            return $this->property('galAcctId');
        }
        return $this->property('galAcctId', trim($galAcctId));
    }

    /**
     * Gets or sets attrs.
     *
     * @param  string $attrs Comma separated list of attributes
     * @return string|self
     */
    public function attrs($attrs = null)
    {
        if(null === $attrs)
        {
            return $this->property('attrs');
        }
        return $this->property('attrs', trim($attrs));
    }
}
