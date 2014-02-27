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
class SearchDirectory extends Base
{
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
     * @param array $types Comma-separated list of types to return.
     * @param string $sortBy Name of attribute to sort on. Default is the account name.
     * @param bool $sortAscending Whether to sort in ascending order. Default is 1 (true).
     * @param bool $countOnly Whether response should be count only. Default is 0 (false)
     * @param string $attrs Comma separated list of attributes
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
        array $types = array(),
        $sortBy = null,
        $sortAscending = null,
        $countOnly = null,
        $attrs = null
    )
    {
        parent::__construct();
        if(null !== $query)
        {
            $this->property('query', trim($query));
        }
        if(null !== $maxResults)
        {
            $this->property('maxResults', (int) $maxResults);
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
        if(null !== $applyConfig)
        {
            $this->property('applyConfig', (bool) $applyConfig);
        }
        $this->_types = new TypedSequence('Zimbra\Enum\DirectorySearchType', $types);
        if(null !== $sortBy)
        {
            $this->property('sortBy', trim($sortBy));
        }

        if(null !== $sortAscending)
        {
            $this->property('sortAscending', (bool) $sortAscending);
        }
        if(null !== $countOnly)
        {
            $this->property('countOnly', (bool) $countOnly);
        }
        if(null !== $attrs)
        {
            $this->property('attrs', trim($attrs));
        }

        $this->on('before', function(Base $sender)
        {
            $types = $sender->types();
            if(!empty($types))
            {
                $sender->property('types', $sender->types());
            }
        });
    }

    /**
     * Gets or sets query
     *
     * @param  string $query
     * @return string|self
     */
    public function query($query = null)
    {
        if(null === $query)
        {
            return $this->property('query');
        }
        return $this->property('query', trim($query));
    }

    /**
     * Gets or sets maxResults
     *
     * @param  int $maxResults
     * @return int|self
     */
    public function maxResults($maxResults = null)
    {
        if(null === $maxResults)
        {
            return $this->property('maxResults');
        }
        return $this->property('maxResults', (int) $maxResults);
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
     * Gets or sets applyConfig
     *
     * @param  bool $applyConfig
     * @return bool|self
     */
    public function applyConfig($applyConfig = null)
    {
        if(null === $applyConfig)
        {
            return $this->property('applyConfig');
        }
        return $this->property('applyConfig', (bool) $applyConfig);
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
     * Gets or sets types
     *
     * @param  string $types
     * @return string|self
     */
    public function types()
    {
        return implode(',', $this->_types->all());
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
     * Gets or sets countOnly
     *
     * @param  bool $countOnly
     * @return bool|self
     */
    public function countOnly($countOnly = null)
    {
        if(null === $countOnly)
        {
            return $this->property('countOnly');
        }
        return $this->property('countOnly', (bool) $countOnly);
    }

    /**
     * Gets or sets attrs
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
