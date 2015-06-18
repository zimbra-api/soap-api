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

use Zimbra\Enum\GalSearchType as SearchType;
use Zimbra\Enum\MemberOfSelector as MemberOf;
use Zimbra\Enum\SortBy;
use Zimbra\Struct\CursorInfo;
use Zimbra\Struct\EntrySearchFilterInfo as SearchFilter;

/**
 * SearchGal request class
 * Search Global Address List (GAL)
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SearchGal extends Base
{
    /**
     * Constructor method for searchGal
     * @param string $locale Client locale identification.
     * @param CursorInfo $cursor Cursor specification
     * @param EntrySearchFilterInfo $searchFilter Search filter specification
     * @param string $ref The ref. If set then search GAL by this ref, which is a dn. If specified then "name" attribute is ignored.
     * @param string $name Query string. Note: ignored if {gal-search-ref-DN} is specified
     * @param SearchType $type Type of addresses to auto-complete on
     * @param bool   $needExp Flag whether the {exp} flag is needed in the response for group entries. Default is unset.
     * @param bool   $needIsOwner The needIsOwner. Set this if the "isOwner" flag is needed in the response for group entries. Default is unset.
     * @param MemberOf $needIsMember Specify if the "isMember" flag is needed in the response for group entries.
     * @param bool   $needSMIMECerts Internal attr, for proxied GSA search from GetSMIMEPublicCerts only
     * @param string $galAcctId GAL Account ID
     * @param bool   $quick "Quick" flag. 
     * @param SortBy $sortBy SortBy setting. Default value is "dateDesc"
     * @param int    $limit The maximum number of results to return. It defaults to 10 if not specified, and is
     * @param int    $offset Specifies the 0-based offset into the results list to return as the first result for this search operation.
     * @return self
     */
    public function __construct(
        $locale = null,
        CursorInfo $cursor = null,
        SearchFilter $searchFilter = null,
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
        $offset = null
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
        if($searchFilter instanceof SearchFilter)
        {
            $this->setChild('searchFilter', $searchFilter);
        }
        if(null !== $ref)
        {
            $this->setProperty('ref', trim($ref));
        }
        if(null !== $name)
        {
            $this->setProperty('name', trim($name));
        }
        if($type instanceof SearchType)
        {
            $this->setProperty('type', $type);
        }
        if(null !== $needExp)
        {
            $this->setProperty('needExp', (bool) $needExp);
        }
        if(null !== $needIsOwner)
        {
            $this->setProperty('needIsOwner', (bool) $needIsOwner);
        }
        if($needIsMember instanceof MemberOf)
        {
            $this->setProperty('needIsMember', $needIsMember);
        }
        if(null !== $needSMIMECerts)
        {
            $this->setProperty('needSMIMECerts', (bool) $needSMIMECerts);
        }
        if(null !== $galAcctId)
        {
            $this->setProperty('galAcctId', trim($galAcctId));
        }
        if(null !== $quick)
        {
            $this->setProperty('quick', (bool) $quick);
        }
        if($sortBy instanceof SortBy)
        {
            $this->setProperty('sortBy', $sortBy);
        }
        if(null !== $limit)
        {
            $this->setProperty('limit', (int) $limit);
        }
        if(null !== $offset)
        {
            $this->setProperty('offset', (int) $offset);
        }
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
     * Gets attributes
     *
     * @return bool
     */
    public function getRef()
    {
        return $this->getProperty('ref');
    }

    /**
     * Sets attributes
     *
     * @param  bool $ref
     * @return self
     */
    public function setRef($ref)
    {
        return $this->setProperty('ref', trim($ref));
    }

    /**
     * Gets attributes
     *
     * @return bool
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets attributes
     *
     * @param  bool $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Sets account member of enum
     *
     * @return SearchType
     */
    public function getType()
    {
        return $this->getProperty('type');
    }

    /**
     * Gets account member of enum
     *
     * @param  SearchType $type
     * @return self
     */
    public function setType(SearchType $type)
    {
        return $this->setProperty('type', $type);
    }

    /**
     * Gets owner of
     *
     * @return bool
     */
    public function getNeedExp()
    {
        return $this->getProperty('needExp');
    }

    /**
     * Sets owner of
     *
     * @param  bool $needExp
     * @return self
     */
    public function setNeedExp($needExp)
    {
        return $this->setProperty('needExp', (bool) $needExp);
    }

    /**
     * Gets owner of
     *
     * @return bool
     */
    public function getNeedIsOwner()
    {
        return $this->getProperty('needIsOwner');
    }

    /**
     * Sets owner of
     *
     * @param  bool $needIsOwner
     * @return self
     */
    public function setNeedIsOwner($needIsOwner)
    {
        return $this->setProperty('needIsOwner', (bool) $needIsOwner);
    }

    /**
     * Sets account member of enum
     *
     * @return MemberOf
     */
    public function getNeedIsMember()
    {
        return $this->getProperty('needIsMember');
    }

    /**
     * Gets account member of enum
     *
     * @param  MemberOf $needIsMember
     * @return self
     */
    public function setNeedIsMember(MemberOf $needIsMember)
    {
        return $this->setProperty('needIsMember', $needIsMember);
    }

    /**
     * Gets owner of
     *
     * @return bool
     */
    public function getNeedSMIMECerts()
    {
        return $this->getProperty('needSMIMECerts');
    }

    /**
     * Sets owner of
     *
     * @param  bool $needSMIMECerts
     * @return self
     */
    public function setNeedSMIMECerts($needSMIMECerts)
    {
        return $this->setProperty('needSMIMECerts', (bool) $needSMIMECerts);
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
     * Sets account member of enum
     *
     * @return SortBy
     */
    public function getSortBy()
    {
        return $this->getProperty('sortBy');
    }

    /**
     * Gets account member of enum
     *
     * @param  SortBy $sortBy
     * @return self
     */
    public function setSortBy(SortBy $sortBy)
    {
        return $this->setProperty('sortBy', $sortBy);
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
}
