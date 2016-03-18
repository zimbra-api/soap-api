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

use Zimbra\Common\TypedSequence;
use Zimbra\Enum\DirectorySearchType as SearchType;
use Zimbra\Struct\AttributeSelectorTrait;
use Zimbra\Struct\AttributeSelector;

/**
 * SearchDirectory request class
 * Search directory.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SearchDirectory extends Base implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * Comma-separated list of types to return. Legal values are:
     * accounts|distributionlists|aliases|resources|domains|coses
     * (default is accounts)
     * @var string
     */
    private $_types;

    /**
     * Constructor method for SearchDirectory
     * @param string $query Query string - should be an LDAP-style filter string (RFC 2254)
     * @param int $maxResults Maximum results that the backend will attempt to fetch from the directory before returning an account
     * @param int $limit The maximum number of accounts to return (0 is default and means all)
     * @param int $offset The starting offset (0, 25, etc)
     * @param string $domain The domain name to limit the search to.
     * @param bool $applyCos Flag whether or not to apply the COS policy to account.
     * @param bool $applyConfig Whether or not to apply the global config attrs to account.
     * @param array $types An array of types to return.
     * @param string $sortBy Name of attribute to sort on. Default is the account name.
     * @param bool $sortAscending Whether to sort in ascending order. Default is 1 (true).
     * @param bool $countOnly Whether response should be count only. Default is 0 (false)
     * @param array $attrs A list of attributes
     * @return self
     */
    public function __construct(
        $query = null,
        $maxResults = null,
        $limit = null,
        $offset = null,
        $domain = null,
        $applyCos = null,
        $applyConfig = null,
        array $types = [],
        $sortBy = null,
        $sortAscending = null,
        $countOnly = null,
        array $attrs = []
    )
    {
        parent::__construct();
        $this->setProperty('query', trim($query));
        if(null !== $maxResults)
        {
            $this->setProperty('maxResults', (int) $maxResults);
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
        if(null !== $applyConfig)
        {
            $this->setProperty('applyConfig', (bool) $applyConfig);
        }
        $this->_types = new TypedSequence('Zimbra\Enum\DirectorySearchType', $types);
        if(null !== $sortBy)
        {
            $this->setProperty('sortBy', trim($sortBy));
        }

        if(null !== $sortAscending)
        {
            $this->setProperty('sortAscending', (bool) $sortAscending);
        }
        if(null !== $countOnly)
        {
            $this->setProperty('countOnly', (bool) $countOnly);
        }
        $this->setAttrs($attrs);

        $this->on('before', function(Base $sender)
        {
            $types = $sender->getTypes();
            if(!empty($types))
            {
                $sender->setProperty('types', $sender->getTypes());
            }
            $attrs = $sender->getAttrs();
            if(!empty($attrs))
            {
                $sender->setProperty('attrs', $attrs);
            }
        });
    }

    /**
     * Gets query
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->getProperty('query');
    }

    /**
     * Sets query
     *
     * @param  string $query
     * @return self
     */
    public function setQuery($query)
    {
        return $this->setProperty('query', trim($query));
    }

    /**
     * Gets max results
     *
     * @return int
     */
    public function getMaxResults()
    {
        return $this->getProperty('maxResults');
    }

    /**
     * Sets max results
     *
     * @param  int $maxResults
     * @return self
     */
    public function setMaxResults($maxResults)
    {
        return $this->setProperty('maxResults', (int) $maxResults);
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
     * Gets applyConfig
     *
     * @return bool
     */
    public function getApplyConfig()
    {
        return $this->getProperty('applyConfig');
    }

    /**
     * Sets applyConfig
     *
     * @param  bool $applyConfig
     * @return self
     */
    public function setApplyConfig($applyConfig)
    {
        return $this->setProperty('applyConfig', (bool) $applyConfig);
    }

    /**
     * Add a search type
     *
     * @param  SearchType $type
     * @return self
     */
    public function addType(SearchType $type)
    {
        $this->_types->add($type);
        return $this;
    }

    /**
     * Sets types
     *
     * @param array $types An array of types to return.
     * @return self
     */
    public function setTypes(array $types)
    {
        $this->_types = new TypedSequence('Zimbra\Enum\DirectorySearchType', $types);
        return $this;
    }

    /**
     * Gets types
     *
     * @return string
     */
    public function getTypes()
    {
        return implode(',', $this->_types->all());
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

    /**
     * Gets countOnly
     *
     * @return bool
     */
    public function getCountOnly()
    {
        return $this->getProperty('countOnly');
    }

    /**
     * Sets countOnly
     *
     * @param  bool $countOnly
     * @return self
     */
    public function setCountOnly($countOnly)
    {
        return $this->setProperty('countOnly', (bool) $countOnly);
    }
}
