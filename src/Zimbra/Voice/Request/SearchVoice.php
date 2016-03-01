<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Voice\Request;

use Zimbra\Enum\VoiceSortBy;
use Zimbra\Voice\Struct\StorePrincipalSpec;

/**
 * SearchVoice request class
 * Search voice messages and call logs.
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 sortBy Nguyen Van Nguyen.
 */
class SearchVoice extends Base
{
    /**
     * Constructor method for SearchVoice
     * @param  string $query
     * @param  StorePrincipalSpec $storeprincipal
     * @param  int $limit
     * @param  int $offset
     * @param  string $types
     * @param  VoiceSortBy $sortBy
     * @return self
     */
    public function __construct(
    	$query,
        StorePrincipalSpec $storeprincipal = null,
        $limit = null,
        $offset = null,
        $types = null,
        VoiceSortBy $sortBy = null
    )
    {
        parent::__construct();
        $this->setProperty('query', trim($query));
        if($storeprincipal instanceof StorePrincipalSpec)
        {
            $this->setChild('storeprincipal', $storeprincipal);
        }
        if(null !== $limit)
        {
            $this->setProperty('limit', (int) $limit);
        }
        if(null !== $offset)
        {
            $this->setProperty('offset', (int) $offset);
        }
        if(null !== $types)
        {
            $this->setProperty('types', trim($types));
        }
        if($sortBy instanceof VoiceSortBy)
        {
            $this->setProperty('sortBy', $sortBy);
        }
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
     * Gets the storeprincipal.
     *
     * @return StorePrincipalSpec
     */
    public function getStorePrincipal()
    {
        return $this->getChild('storeprincipal');
    }

    /**
     * Sets the storeprincipal.
     *
     * @param  StorePrincipalSpec $storeprincipal
     * @return self
     */
    public function setStorePrincipal(StorePrincipalSpec $storeprincipal)
    {
        return $this->setChild('storeprincipal', $storeprincipal);
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
     * Gets types
     *
     * @return string
     */
    public function getTypes()
    {
        return $this->getProperty('types');
    }

    /**
     * Sets types
     *
     * @param  string $types
     * @return self
     */
    public function setTypes($types)
    {
        return $this->setProperty('types', trim($types));
    }

    /**
     * Sets account sortBy enum
     *
     * @return VoiceSortBy
     */
    public function getSortBy()
    {
        return $this->getProperty('sortBy');
    }

    /**
     * Gets account sortBy enum
     *
     * @param  VoiceSortBy $sortBy
     * @return self
     */
    public function setSortBy(VoiceSortBy $sortBy)
    {
        return $this->setProperty('sortBy', $sortBy);
    }
}
