<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Account\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\CursorInfo;
use Zimbra\Soap\Struct\EntrySearchFilterInfo as SearchFilter;

/**
 * SearchCalendarResources class
 * Search Global Address List (GAL) for calendar resources 
 * "attrs" attribute - comma-separated list of attrs to return ("displayName", "zimbraId", "zimbraCalResType")
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SearchCalendarResources extends Request
{
    /**
     * Client locale identification. 
     * @var string
     */
    private $_locale;

    /**
     * Cursor specification
     * @var CursorInfo
     */
    private $_cursor;

    /**
     * The name
     * @var string
     */
    private $_name;

    /**
     * Search filter specification
     * @var SearchFilter
     */
    private $_searchFilter;

    /**
     * "Quick" flag.
     * For performance reasons, the index system accumulates messages with not-indexed-yet state until a certain threshold and indexes them as a batch.
     * To return up-to-date search results, the index system also indexes those pending messages right before a search.
     * To lower latencies, this option gives a hint to the index system not to trigger this catch-up index prior to the search by giving up the freshness of the search results,
     * i.e. recent messages may not be included in the search results.
     * @var bool
     */
    private $_quick;

    /**
     * Name of attribute to sort on. default is the calendar resource name.
     * @var string
     */
    private $_sortBy;

    /**
     * An integer specifying the 0-based offset into the results list to return as the first result for this search operation
     * @var int
     */
    private $_limit;

    /**
     * The 0-based offset into the results list to return as the first result for this search operation.
     * @var int
     */
    private $_offset;

    /**
     * GAL Account ID
     * @var string
     */
    private $_galAcctId;

    /**
     * Comma separated list of attributes
     * @var string
     */
    private $_attrs;

    /**
     * Constructor method for searchCalendarResources
     * @param CursorInfo $cursor
     * @param EntrySearchFilterInfo $searchFilter
     * @param string $name
     * @param string $locale
     * @param bool $quick
     * @param string $sortBy
     * @param int $limit
     * @param int $offset
     * @param string $galAcctId
     * @param string $attrs
     * @return self
     */
    public function __construct(
        CursorInfo $cursor = null,
        SearchFilter $searchFilter = null,
        $name = null,
        $locale = null,
        $quick = null,
        $sortBy = null,
        $limit = null,
        $offset = null,
        $galAcctId = null,
        $attrs = null
    )
    {
        parent::__construct();
        if($cursor instanceof CursorInfo)
        {
            $this->_cursor = $cursor;
        }
        if($searchFilter instanceof SearchFilter)
        {
            $this->_searchFilter = $searchFilter;
        }
        $this->_locale = trim($locale);
        $this->_name = trim($name);
        if(null !== $quick)
        {
            $this->_quick = (bool) $quick;
        }
        $this->_sortBy = trim($sortBy);
        if(null !== $limit)
        {
            $this->_limit = (int) $limit;
        }
        if(null !== $offset)
        {
            $this->_offset = (int) $offset;
        }
        $this->_galAcctId = trim($galAcctId);
        $this->_attrs = trim($attrs);
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
            return $this->_locale;
        }
        $this->_locale = trim($locale);
        return $this;
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
            return $this->_cursor;
        }
        $this->_cursor = $cursor;
        return $this;
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
            return $this->_name;
        }
        $this->_name = trim($name);
        return $this;
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
            return $this->_searchFilter;
        }
        $this->_searchFilter = $searchFilter;
        return $this;
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
            return $this->_quick;
        }
        $this->_quick = (bool) $quick;
        return $this;
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
            return $this->_sortBy;
        }
        $this->_sortBy = trim($sortBy);
        return $this;
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
            return $this->_limit;
        }
        $this->_limit = (int) $limit;
        return $this;
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
            return $this->_offset;
        }
        $this->_offset = (int) $offset;
        return $this;
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
            return $this->_galAcctId;
        }
        $this->_galAcctId = trim($galAcctId);
        return $this;
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
            return $this->_attrs;
        }
        $this->_attrs = trim($attrs);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(!empty($this->_locale))
        {
            $this->array['locale'] = $this->_locale;
        }
        if(!empty($this->_name))
        {
            $this->array['name'] = $this->_name;
        }
        if(is_bool($this->_quick))
        {
            $this->array['quick'] = $this->_quick ? 1 : 0;
        }
        if(!empty($this->_sortBy))
        {
            $this->array['sortBy'] = $this->_sortBy;
        }
        if(is_int($this->_limit))
        {
            $this->array['limit'] = $this->_limit;
        }
        if(is_int($this->_offset))
        {
            $this->array['offset'] = $this->_offset;
        }
        if(!empty($this->_galAcctId))
        {
            $this->array['galAcctId'] = $this->_galAcctId;
        }
        if(!empty($this->_attrs))
        {
            $this->array['attrs'] = $this->_attrs;
        }

        if($this->_cursor instanceof CursorInfo)
        {
            $this->array += $this->_cursor->toArray();
        }
        if($this->_searchFilter instanceof SearchFilter)
        {
            $this->array += $this->_searchFilter->toArray();
        }

        return parent::toArray();
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if(!empty($this->_locale))
        {
            $this->xml->addAttribute('locale', $this->_locale);
        }
        if(!empty($this->_name))
        {
            $this->xml->addAttribute('name', $this->_name);
        }
        if(is_bool($this->_quick))
        {
            $this->xml->addAttribute('quick', (bool) $this->_quick ? 1 : 0);
        }
        if(!empty($this->_sortBy))
        {
            $this->xml->addAttribute('sortBy', $this->_sortBy);
        }
        if(is_int($this->_limit))
        {
            $this->xml->addAttribute('limit', $this->_limit);
        }
        if(is_int($this->_offset))
        {
            $this->xml->addAttribute('offset', $this->_offset);
        }
        if(!empty($this->_galAcctId))
        {
            $this->xml->addAttribute('galAcctId', $this->_galAcctId);
        }
        if(!empty($this->_attrs))
        {
            $this->xml->addAttribute('attrs', $this->_attrs);
        }
        if($this->_cursor instanceof CursorInfo)
        {
            $this->xml->append($this->_cursor->toXml());
        }
        if($this->_searchFilter instanceof SearchFilter)
        {
            $this->xml->append($this->_searchFilter->toXml());
        }

        return parent::toXml();
    }
}
