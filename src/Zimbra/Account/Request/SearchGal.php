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
use Zimbra\Enum\GalSearchType as SearchType;
use Zimbra\Enum\MemberOfSelector as MemberOf;
use Zimbra\Enum\SortBy;
use Zimbra\Struct\CursorInfo;

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
        $offset = null)
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
        if($searchFilter instanceof SearchFilter)
        {
            $this->child('searchFilter', $searchFilter);
        }
        if(null !== $ref)
        {
            $this->property('ref', trim($ref));
        }
        if(null !== $name)
        {
            $this->property('name', trim($name));
        }
        if($type instanceof SearchType)
        {
            $this->property('type', $type);
        }
        if(null !== $needExp)
        {
            $this->property('needExp', (bool) $needExp);
        }
        if(null !== $needIsOwner)
        {
            $this->property('needIsOwner', (bool) $needIsOwner);
        }
        if($needIsMember instanceof MemberOf)
        {
            $this->property('needIsMember', $needIsMember);
        }
        if(null !== $needSMIMECerts)
        {
            $this->property('needSMIMECerts', (bool) $needSMIMECerts);
        }
        if(null !== $galAcctId)
        {
            $this->property('galAcctId', trim($galAcctId));
        }
        if(null !== $quick)
        {
            $this->property('quick', (bool) $quick);
        }
        if($sortBy instanceof SortBy)
        {
            $this->property('sortBy', $sortBy);
        }
        if(null !== $limit)
        {
            $this->property('limit', (int) $limit);
        }
        if(null !== $offset)
        {
            $this->property('offset', (int) $offset);
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
     * Gets or sets ref
     *
     * @param  string $ref
     * @return string|self
     */
    public function ref($ref = null)
    {
        if(null === $ref)
        {
            return $this->property('ref');
        }
        return $this->property('ref', trim($ref));
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
            return $this->property('name');
        }
        return $this->property('name', trim($name));
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
            return $this->property('type');
        }
        return $this->property('type', $type);
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
            return $this->property('needExp');
        }
        return $this->property('needExp', (bool) $needExp);
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
            return $this->property('needIsOwner');
        }
        return $this->property('needIsOwner', (bool) $needIsOwner);
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
            return $this->property('needIsMember');
        }
        return $this->property('needIsMember', $needIsMember);
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
            return $this->property('needSMIMECerts');
        }
        return $this->property('needSMIMECerts', (bool) $needSMIMECerts);
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
     * @param  SortBy $sortBy
     * @return SortBy|self
     */
    public function sortBy(SortBy $sortBy = null)
    {
        if(null === $sortBy)
        {
            return $this->property('sortBy');
        }
        return $this->property('sortBy', $sortBy);
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
}
