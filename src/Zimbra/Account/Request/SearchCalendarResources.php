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

use Zimbra\Struct\CursorInfo;
use Zimbra\Struct\EntrySearchFilterInfo as SearchFilter;
use Zimbra\Struct\AttributeSelectorTrait;
use Zimbra\Struct\AttributeSelector;

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
class SearchCalendarResources extends Base implements AttributeSelector
{
    use AttributeSelectorTrait;

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
        array $attrs = []
    )
    {
        parent::__construct();
        if(null !== $locale)
        {
            $this->setChild('locale', trim($locale));
        }
        if($cursor instanceof CursorInfo)
        {
            $this->setChild('cursor', $cursor);
        }
        if(null !== $name)
        {
            $this->setChild('name', trim($name));
        }
        if($searchFilter instanceof SearchFilter)
        {
            $this->setChild('searchFilter', $searchFilter);
        }
        if(null !== $quick)
        {
            $this->setProperty('quick', (bool) $quick);
        }
        if(null !== $sortBy)
        {
            $this->setProperty('sortBy', trim($sortBy));
        }
        if(null !== $limit)
        {
            $this->setProperty('limit', (int) $limit);
        }
        if(null !== $offset)
        {
            $this->setProperty('offset', (int) $offset);
        }
        if(null !== $galAcctId)
        {
            $this->setProperty('galAcctId', trim($galAcctId));
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
     * Gets locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->getChild('locale');
    }

    /**
     * Sets locale
     *
     * @param  string $locale
     * @return self
     */
    public function setLocale($locale)
    {
        return $this->setChild('locale', trim($locale));
    }

    /**
     * Gets the cursor
     *
     * @return CursorInfo
     */
    public function getCursor()
    {
        return $this->getChild('cursor');
    }

    /**
     * Sets the cursor
     *
     * @param  CursorInfo $cursor
     * @return self
     */
    public function setCursor(CursorInfo $cursor)
    {
        return $this->setChild('cursor', $cursor);
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getChild('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setChild('name', trim($name));
    }

    /**
     * Gets the searchFilter
     *
     * @return SearchFilter
     */
    public function getSearchFilter()
    {
        return $this->getChild('searchFilter');
    }

    /**
     * Sets the searchFilter
     *
     * @param  SearchFilter $searchFilter
     * @return self
     */
    public function setSearchFilter(SearchFilter $searchFilter)
    {
        return $this->setChild('searchFilter', $searchFilter);
    }

    /**
     * Gets owner of
     *
     * @return bool
     */
    public function getQuick()
    {
        return $this->getProperty('quick');
    }

    /**
     * Sets owner of
     *
     * @param  bool $quick
     * @return self
     */
    public function setQuick($quick)
    {
        return $this->setProperty('quick', (bool) $quick);
    }

    /**
     * Gets attributes
     *
     * @return bool
     */
    public function getSortBy()
    {
        return $this->getProperty('sortBy');
    }

    /**
     * Sets attributes
     *
     * @param  bool $sortBy
     * @return self
     */
    public function setSortBy($sortBy)
    {
        return $this->setProperty('sortBy', trim($sortBy));
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
     * Gets GAL account ID
     *
     * @return bool
     */
    public function getGalAccountId()
    {
        return $this->getProperty('galAcctId');
    }

    /**
     * Sets GAL account ID
     *
     * @param  bool $galAcctId
     * @return self
     */
    public function setGalAccountId($galAcctId)
    {
        return $this->setProperty('galAcctId', trim($galAcctId));
    }
}
