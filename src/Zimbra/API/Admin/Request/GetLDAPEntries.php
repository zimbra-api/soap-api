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

/**
 * GetLDAPEntries class
 * Get LDAP entries
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetLDAPEntries extends Request
{
    /**
     * Query string. Should be an LDAP-style filter string (RFC 2254)
     * @var string
     */
    private $_query;

    /**
     * LDAP search base. An LDAP-style filter string that defines an LDAP search base (RFC 2254)
     * @var string
     */
    private $_ldapSearchBase;

    /**
     * Name of attribute to sort on. default is null
     * @var string
     */
    private $_sortBy;

    /**
     * Flag whether to sort in ascending order 1 (true) is default
     * @var boolean
     */
    private $_sortAscending;

    /**
     * Limit - the maximum number of LDAP objects (records) to return (0 is default and means all)
     * @var int
     */
    private $_limit;

    /**
     * The starting offset (0, 25, etc)
     * @var int
     */
    private $_offset;

    /**
     * Constructor method for GetLDAPEntries
     * @param string $query
     * @param string $ldapSearchBase
     * @param string $ortBy
     * @param bool $sortAscending
     * @param int $limit
     * @param int $offset
     * @return self
     */
    public function __construct(
        $query,
        $ldapSearchBase,
        $sortBy = null,
        $sortAscending = null,
        $limit = null,
        $offset = null)
    {
        parent::__construct();
        $this->_query = trim($query);
        $this->_ldapSearchBase = trim($ldapSearchBase);
		$this->_sortBy = trim($sortBy);
        if(null !== $sortAscending)
        {
            $this->_sortAscending = (bool) $sortAscending;
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
     * Gets or sets query
     *
     * @param  string $query
     * @return string|self
     */
    public function query($query = null)
    {
        if(null === $query)
        {
            return $this->_query;
        }
        $this->_query = trim($query);
        return $this;
    }

    /**
     * Gets or sets ldapSearchBase
     *
     * @param  string $ldapSearchBase
     * @return string|self
     */
    public function ldapSearchBase($ldapSearchBase = null)
    {
        if(null === $ldapSearchBase)
        {
            return $this->_ldapSearchBase;
        }
        $this->_ldapSearchBase = trim($ldapSearchBase);
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
        $this->array = array(
            'query' => $this->_query,
            'ldapSearchBase' => $this->_ldapSearchBase,
        );
        if(!empty($this->_sortBy))
        {
            $this->array['sortBy'] = $this->_sortBy;
        }
        if(is_bool($this->_sortAscending))
        {
            $this->array['sortAscending'] = $this->_sortAscending ? 1 : 0;
        }
        if(is_int($this->_limit))
        {
            $this->array['limit'] = $this->_limit;
        }
        if(is_int($this->_offset))
        {
            $this->array['offset'] = $this->_offset;
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->addAttribute('query', $this->_query)
                  ->addChild('ldapSearchBase', $this->_ldapSearchBase);
        if(!empty($this->_sortBy))
        {
            $this->xml->addAttribute('sortBy', $this->_sortBy);
        }
        if(is_bool($this->_sortAscending))
        {
            $this->xml->addAttribute('sortAscending', $this->_sortAscending ? 1 : 0);
        }
        if(is_int($this->_limit))
        {
            $this->xml->addAttribute('limit', $this->_limit);
        }
        if(is_int($this->_offset))
        {
            $this->xml->addAttribute('offset', $this->_offset);
        }
        return parent::toXml();
    }
}
