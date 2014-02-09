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

use Zimbra\Admin\Struct\EntrySearchFilterInfo as SearchFilter;

/**
 * SearchCalendarResources request class
 * Search for Calendar Resources
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SearchCalendarResources extends Base
{
    /**
     * Constructor method for SearchCalendarResources
     * @param EntrySearchFilterInfo $searchFilter Search filter specification
     * @param int $limit The maximum number of calendar resources to return (0 is default and means all)
     * @param int $offset The starting offset (0, 25, etc)
     * @param string $domain The domain name to limit the search to
     * @param bool $applyCos Flag whether or not to apply the COS policy to calendar resource. Specify 0 (false) if only requesting attrs that aren't inherited from COS.
     * @param string $sortBy Name of attribute to sort on. default is the calendar resource name.
     * @param bool $sortAscending Whether to sort in ascending order. Default is 1 (true)
     * @param string $attrs Comma separated list of attributes
     * @return self
     */
    public function __construct(
        SearchFilter $searchFilter = null,
        $limit = null,
        $offset = null,
        $domain = null,
        $applyCos = null,
        $sortBy = null,
        $sortAscending = null,
        $attrs = null
    )
    {
        parent::__construct();
        if($searchFilter instanceof SearchFilter)
        {
            $this->child('searchFilter', $searchFilter);
        }
        if(null !== $limit)
        {
            $this->property('limit', (int) $limit);
        }
        if(null !== $offset)
        {
            $this->property('offset', (int) $offset);
        }
        if(null !== $domain)
        {
            $this->property('domain', trim($domain));
        }
        if(null !== $applyCos)
        {
            $this->property('applyCos', (bool) $applyCos);
        }
        if(null !== $sortBy)
        {
            $this->property('sortBy', trim($sortBy));
        }
        if(null !== $sortAscending)
        {
            $this->property('sortAscending', (bool) $sortAscending);
        }
        if(null !== $attrs)
        {
            $this->property('attrs', trim($attrs));
        }
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
     * Gets or sets applyCos
     *
     * @param  bool $applyCos
     * @return bool|self
     */
    public function applyCos($applyCos = null)
    {
        if(null === $applyCos)
        {
            return $this->property('applyCos');
        }
        return $this->property('applyCos', (bool) $applyCos);
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
     * Gets or sets attrs.
     *
     * @param  string $attrs
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
