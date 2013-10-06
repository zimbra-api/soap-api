<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\CursorInfo;
use Zimbra\Soap\Struct\EntrySearchFilterInfo as SearchFilter;

/**
 * SearchCalendarResources class
 * Search for Calendar Resources
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SearchCalendarResources extends Request
{
    /**
     * Search filter specification
     * @var SearchFilter
     */
    private $_searchFilter;

    /**
     * The maximum number of calendar resources to return (0 is default and means all)
     * @var int
     */
    private $_limit;

    /**
     * The starting offset (0, 25, etc)
     * @var int
     */
    private $_offset;

    /**
     * The domain name to limit the search to
     * @var string
     */
    private $_domain;

    /**
     * Flag whether or not to apply the COS policy to calendar resource.
     * Specify 0 (false) if only requesting attrs that aren't inherited from COS.
     * @var bool
     */
    private $_applyCos;

    /**
     * Name of attribute to sort on. default is the calendar resource name.
     * @var string
     */
    private $_sortBy;

    /**
     * Whether to sort in ascending order. Default is 1 (true)
     * @var bool
     */
    private $_sortAscending;

    /**
     * Comma separated list of attributes
     * @var string
     */
    private $_attrs;

    /**
     * Constructor method for SearchCalendarResources
     * @param EntrySearchFilterInfo $searchFilter
     * @param int $limit
     * @param int $offset
     * @param string $domain
     * @param bool $applyCos
     * @param string $sortBy
     * @param bool $
     * @param string $attrs
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
            $this->_searchFilter = $searchFilter;
        }
        if(null !== $limit)
        {
            $this->_limit = (int) $limit;
        }
        if(null !== $offset)
        {
            $this->_offset = (int) $offset;
        }
        $this->_domain = trim($domain);
        if(null !== $applyCos)
        {
            $this->_applyCos = (bool) $applyCos;
        }
        $this->_sortBy = trim($sortBy);
        if(null !== $sortAscending)
        {
            $this->_sortAscending = (bool) $sortAscending;
        }
        $this->_attrs = trim($attrs);
    }

    /**
     * Gets or sets searchFilter
     *
     * @param  EntrySearchFilterInfo $searchFilter
     * @return EntrySearchFilterInfo|self
     */
    public function searchFilter(EntrySearchFilterInfo $searchFilter = null)
    {
        if(null === $searchFilter)
        {
            return $this->_searchFilter;
        }
        $this->_searchFilter = $searchFilter;
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
     * Gets or sets domain
     *
     * @param  string $domain
     * @return string|self
     */
    public function domain($domain = null)
    {
        if(null === $domain)
        {
            return $this->_domain;
        }
        $this->_domain = trim($domain);
        return $this;
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
            return $this->_applyCos;
        }
        $this->_applyCos = (bool) $applyCos;
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
     * Gets or sets sortAscending
     *
     * @param  bool $sortAscending
     * @return bool|self
     */
    public function sortAscending($sortAscending = null)
    {
        if(null === $sortAscending)
        {
            return $this->_sortAscending;
        }
        $this->_sortAscending = (bool) $sortAscending;
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
        if(is_int($this->_limit))
        {
            $this->array['limit'] = $this->_limit;
        }
        if(is_int($this->_offset))
        {
            $this->array['offset'] = $this->_offset;
        }
        if(!empty($this->_domain))
        {
            $this->array['domain'] = $this->_domain;
        }
        if(is_bool($this->_applyCos))
        {
            $this->array['applyCos'] = $this->_applyCos ? 1 : 0;
        }
        if(!empty($this->_sortBy))
        {
            $this->array['sortBy'] = $this->_sortBy;
        }
        if(is_bool($this->_sortAscending))
        {
            $this->array['sortAscending'] = $this->_sortAscending ? 1 : 0;
        }
        if(!empty($this->_attrs))
        {
            $this->array['attrs'] = $this->_attrs;
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
        if(is_int($this->_limit))
        {
            $this->xml->addAttribute('limit', $this->_limit);
        }
        if(is_int($this->_offset))
        {
            $this->xml->addAttribute('offset', $this->_offset);
        }
        if(!empty($this->_domain))
        {
            $this->xml->addAttribute('domain', $this->_domain);
        }
        if(is_bool($this->_applyCos))
        {
            $this->xml->addAttribute('applyCos', (bool) $this->_applyCos ? 1 : 0);
        }
        if(!empty($this->_sortBy))
        {
            $this->xml->addAttribute('sortBy', $this->_sortBy);
        }
        if(is_bool($this->_sortAscending))
        {
            $this->xml->addAttribute('sortAscending', (bool) $this->_sortAscending ? 1 : 0);
        }
        if(!empty($this->_attrs))
        {
            $this->xml->addAttribute('attrs', $this->_attrs);
        }
        if($this->_searchFilter instanceof SearchFilter)
        {
            $this->xml->append($this->_searchFilter->toXml());
        }

        return parent::toXml();
    }
}
