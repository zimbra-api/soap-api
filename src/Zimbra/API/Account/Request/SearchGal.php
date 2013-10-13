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
use Zimbra\Soap\Enum\GalSearchType as SearchType;
use Zimbra\Soap\Enum\MemberOfSelector as MemberOf;
use Zimbra\Soap\Enum\SortBy;
use Zimbra\Soap\Struct\CursorInfo;
use Zimbra\Soap\Struct\EntrySearchFilterInfo as SearchFilter;

/**
 * SearchGal class
 * Search Global Address List (GAL)
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SearchGal extends Request
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
     * Search filter specification
     * @var SearchFilter
     */
    private $_searchFilter;

    /**
     * The ref
     * If set then search GAL by this ref, which is a dn. If specified then "name" attribute is ignored.
     * @var string
     */
    private $_ref;

    /**
     * Query string. Note: ignored if {gal-search-ref-DN} is specified
     * @var string
     */
    private $_name;

    /**
     * Type of addresses to auto-complete on
     * @var string
     */
    private $_type;

    /**
     * Flag whether the {exp} flag is needed in the response for group entries. Default is unset.
     * @var boolean
     */
    private $_needExp;

    /**
     * The needIsOwner
     * Set this if the "isOwner" flag is needed in the response for group entries. Default is unset.
     * @var boolean
     */
    private $_needIsOwner;

    /**
     * Specify if the "isMember" flag is needed in the response for group entries.
     * @var MemberOf
     */
    private $_needIsMember;

    /**
     * Internal attr, for proxied GSA search from GetSMIMEPublicCerts only
     * @var bool
     */
    private $_needSMIMECerts;

    /**
     * GAL Account ID
     * @var string
     */
    private $_galAcctId;

    /**
     * "Quick" flag. 
     * @var bool
     */
    private $_quick;

    /**
     * SortBy setting.
     * Default value is "dateDesc"
     * Possible values: none|dateAsc|dateDesc|subjAsc|subjDesc|nameAsc|nameDesc|rcptAsc|rcptDesc|attachAsc|attachDesc|flagAsc|flagDesc|priorityAsc|priorityDesc
     * @var string
     */
    private $_sortBy;

    /**
     * The maximum number of results to return. It defaults to 10 if not specified, and is
     * @var int
     */
    private $_limit;

    /**
     * Specifies the 0-based offset into the results list to return as the first result for this search operation.
     * @var int
     */
    private $_offset;

    /**
     * Constructor method for searchGal
     * @param CursorInfo $cursor
     * @param EntrySearchFilterInfo $searchFilter
     * @param string $locale
     * @param string $ref
     * @param string $name
     * @param SearchType $type
     * @param bool   $needExp
     * @param bool   $needIsOwner
     * @param MemberOf $needIsMember
     * @param bool   $needSMIMECerts
     * @param string $galAcctId
     * @param bool   $quick
     * @param SortBy $sortBy
     * @param int    $limit
     * @param int    $offset
     * @return self
     */
    public function __construct(
        CursorInfo $cursor = null,
        SearchFilter $searchFilter = null,
        $locale = null,
        $ref = null,
        $name = null,
        SearchType $type = null,
        $needExp = null,
        $needIsOwner = null,
        MemberOf $needIsMember = null,
        $needSMIMECerts = null,
        $galAcctId = null,
        $quick = null,
        SortBy $sortBy = null,
        $limit = null,
        $offset = null)
    {
        parent::__construct();
		$this->_locale = trim($locale);
        if($cursor instanceof CursorInfo)
        {
            $this->_cursor = $cursor;
        }
        if($searchFilter instanceof SearchFilter)
        {
            $this->_searchFilter = $searchFilter;
        }
        $this->_ref = trim($ref);
        $this->_name = trim($name);
        if($type instanceof SearchType)
        {
            $this->_type = $type;
        }
        if(null !== $needExp)
        {
            $this->_needExp = (bool) $needExp;
        }
        if(null !== $needIsOwner)
        {
            $this->_needIsOwner = (bool) $needIsOwner;
        }
        if($needIsMember instanceof MemberOf)
        {
            $this->_needIsMember = $needIsMember;
        }
        if(null !== $needSMIMECerts)
        {
            $this->_needSMIMECerts = (bool) $needSMIMECerts;
        }
        $this->_galAcctId = trim($galAcctId);
        if(null !== $quick)
        {
            $this->_quick = (bool) $quick;
        }
        if($sortBy instanceof SortBy)
        {
            $this->_sortBy = $sortBy;
        }
        if(null !== $limit)
        {
            $this->_limit = (int) $limit;
        }
        if(null !== $offset)
        {
            $this->_offset = (int) $offset;
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
     * Gets or sets ref
     *
     * @param  string $ref
     * @return string|self
     */
    public function ref($ref = null)
    {
        if(null === $ref)
        {
            return $this->_ref;
        }
        $this->_ref = trim($ref);
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
     * Gets or sets type.
     *
     * @param  SearchType $type
     * @return SearchType|self
     */
    public function type(SearchType $type = null)
    {
        if(null === $type)
        {
            return $this->_type;
        }
		$this->_type = $type;
        return $this;
    }

    /**
     * Gets or sets needExp
     *
     * @param  bool $needExp
     * @return bool|self
     */
    public function needExp($needExp = null)
    {
        if(null === $needExp)
        {
            return $this->_needExp;
        }
        $this->_needExp = (bool) $needExp;
        return $this;
    }

    /**
     * Gets or sets needIsOwner
     *
     * @param  bool $needIsOwner
     * @return bool|self
     */
    public function needIsOwner($needIsOwner = null)
    {
        if(null === $needIsOwner)
        {
            return $this->_needIsOwner;
        }
        $this->_needIsOwner = (bool) $needIsOwner;
        return $this;
    }

    /**
     * Gets or sets needIsMember.
     *
     * @param  MemberOf $needIsMember
     * @return MemberOf|self
     */
    public function needIsMember(MemberOf $needIsMember = null)
    {
        if(null === $needIsMember)
        {
            return $this->_needIsMember;
        }
		$this->_needIsMember = $needIsMember;
        return $this;
    }

    /**
     * Gets or sets needSMIMECerts
     *
     * @param  bool $needSMIMECerts
     * @return bool|self
     */
    public function needSMIMECerts($needSMIMECerts = null)
    {
        if(null === $needSMIMECerts)
        {
            return $this->_needSMIMECerts;
        }
        $this->_needSMIMECerts = (bool) $needSMIMECerts;
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
     * @param  SortBy $sortBy
     * @return SortBy|self
     */
    public function sortBy(SortBy $sortBy = null)
    {
        if(null === $sortBy)
        {
            return $this->_sortBy;
        }
        $this->_sortBy = $sortBy;
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
        if(!empty($this->_ref))
        {
            $this->array['ref'] = $this->_ref;
        }
        if(!empty($this->_name))
        {
            $this->array['name'] = $this->_name;
        }
        if($this->_type instanceof SearchType)
        {
            $this->array['type'] = (string) $this->_type;
        }
        if(is_bool($this->_needExp))
        {
            $this->array['needExp'] = $this->_needExp ? 1 : 0;
        }
        if(is_bool($this->_needIsOwner))
        {
            $this->array['needIsOwner'] = $this->_needIsOwner ? 1 : 0;
        }
        if($this->_needIsMember instanceof MemberOf)
        {
            $this->array['needIsMember'] = (string) $this->_needIsMember;
        }
        if(!empty($this->_needSMIMECerts))
        {
            $this->array['needSMIMECerts'] = $this->_needSMIMECerts;
        }
        if(!empty($this->_galAcctId))
        {
            $this->array['galAcctId'] = $this->_galAcctId;
        }
        if(is_bool($this->_quick))
        {
            $this->array['quick'] = $this->_quick ? 1 : 0;
        }
        if($this->_sortBy instanceof SortBy)
        {
            $this->array['sortBy'] = (string) $this->_sortBy;
        }
        if(is_int($this->_limit))
        {
            $this->array['limit'] = $this->_limit;
        }
        if(is_int($this->_offset))
        {
            $this->array['offset'] = $this->_offset;
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
        if(!empty($this->_ref))
        {
            $this->xml->addAttribute('ref', $this->_ref);
        }
        if(!empty($this->_name))
        {
            $this->xml->addAttribute('name', $this->_name);
        }
        if($this->_type instanceof SearchType)
        {
            $this->xml->addAttribute('type', (string) $this->_type);
        }
        if(is_bool($this->_needExp))
        {
            $this->xml->addAttribute('needExp', $this->_needExp ? 1 : 0);
        }
        if(is_bool($this->_needIsOwner))
        {
            $this->xml->addAttribute('needIsOwner', $this->_needIsOwner ? 1 : 0);
        }
        if($this->_needIsMember instanceof MemberOf)
        {
            $this->xml->addAttribute('needIsMember', (string) $this->_needIsMember);
        }
        if(!empty($this->_needSMIMECerts))
        {
            $this->xml->addAttribute('needSMIMECerts', $this->_needSMIMECerts);
        }
        if(!empty($this->_galAcctId))
        {
            $this->xml->addAttribute('galAcctId', $this->_galAcctId);
        }
        if(is_bool($this->_quick))
        {
            $this->xml->addAttribute('quick', $this->_quick ? 1 : 0);
        }
        if($this->_sortBy instanceof SortBy)
        {
            $this->xml->addAttribute('sortBy', (string) $this->_sortBy);
        }
        if(is_int($this->_limit))
        {
            $this->xml->addAttribute('limit', $this->_limit);
        }
        if(is_int($this->_offset))
        {
            $this->xml->addAttribute('offset', $this->_offset);
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
