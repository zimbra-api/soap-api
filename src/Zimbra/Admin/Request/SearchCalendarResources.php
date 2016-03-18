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

use Zimbra\Struct\EntrySearchFilterInfo as SearchFilter;
use Zimbra\Struct\AttributeSelectorTrait;
use Zimbra\Struct\AttributeSelector;

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
class SearchCalendarResources extends Base implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * Constructor method for SearchCalendarResources
     * @param EntrySearchFilterInfo $searchFilter Search filter specification
     * @param int $limit The maximum number of calendar resources to return (0 is default and means all)
     * @param int $offset The starting offset (0, 25, etc)
     * @param string $domain The domain name to limit the search to
     * @param bool $applyCos Flag whether or not to apply the COS policy to calendar resource. Specify 0 (false) if only requesting attrs that aren't inherited from COS.
     * @param string $sortBy Name of attribute to sort on. default is the calendar resource name.
     * @param bool $sortAscending Whether to sort in ascending order. Default is 1 (true)
     * @param array $attrs A list of attributes
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
        array $attrs = []
    )
    {
        parent::__construct();
        if($searchFilter instanceof SearchFilter)
        {
            $this->setChild('searchFilter', $searchFilter);
        }
        if(null !== $limit)
        {
            $this->setProperty('limit', (int) $limit);
        }
        if(null !== $offset)
        {
            $this->setProperty('offset', (int) $offset);
        }
        if(null !== $domain)
        {
            $this->setProperty('domain', trim($domain));
        }
        if(null !== $applyCos)
        {
            $this->setProperty('applyCos', (bool) $applyCos);
        }
        if(null !== $sortBy)
        {
            $this->setProperty('sortBy', trim($sortBy));
        }
        if(null !== $sortAscending)
        {
            $this->setProperty('sortAscending', (bool) $sortAscending);
        }

        $this->setAttrs($attrs);
        $this->on('before', function(Base $sender)
        {
            $attrs = $sender->getAttrs();
            if(!empty($attrs))
            {
                $sender->setProperty('attrs', $attrs);
            }
        });
    }

    /**
     * Gets the searchFilter.
     *
     * @return SearchFilter
     */
    public function getSearchFilter()
    {
        return $this->getChild('searchFilter');
    }

    /**
     * Sets the searchFilter.
     *
     * @param  SearchFilter $searchFilter
     * @return self
     */
    public function setSearchFilter(SearchFilter $searchFilter)
    {
        return $this->setChild('searchFilter', $searchFilter);
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
     * Gets applyCos
     *
     * @return bool
     */
    public function getApplyCos()
    {
        return $this->getProperty('applyCos');
    }

    /**
     * Sets applyCos
     *
     * @param  bool $applyCos
     * @return self
     */
    public function setApplyCos($applyCos)
    {
        return $this->setProperty('applyCos', (bool) $applyCos);
    }

    /**
     * Gets sortBy
     *
     * @return string
     */
    public function getSortBy()
    {
        return $this->getProperty('sortBy');
    }

    /**
     * Sets sortBy
     *
     * @param  string $sortBy
     * @return self
     */
    public function setSortBy($sortBy)
    {
        return $this->setProperty('sortBy', trim($sortBy));
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
}
