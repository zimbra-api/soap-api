<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Struct\Base;

/**
 * ModifySearchFolderSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifySearchFolderSpec extends Base
{
    /**
     * Constructor method for ModifySearchFolderSpec
     * @param string $id ID
     * @param string $query Query
     * @param string $types Search types
     * @param string $sortBy Sort by
     * @return self
     */
    public function __construct(
        $id,
        $query,
        $types = null,
        $sortBy = null
    )
    {
        parent::__construct();
        $this->setProperty('id', trim($id));
        $this->setProperty('query', trim($query));
        if(null !== $types)
        {
            $this->setProperty('types', trim($types));
        }
        if(null !== $sortBy)
        {
            $this->setProperty('sortBy', trim($sortBy));
        }
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
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
     * Gets search types
     *
     * @return string
     */
    public function getSearchTypes()
    {
        return $this->getProperty('types');
    }

    /**
     * Sets search types
     *
     * @param  string $types
     * @return self
     */
    public function setSearchTypes($types)
    {
        return $this->setProperty('types', trim($types));
    }

    /**
     * Gets sort by
     *
     * @return string
     */
    public function getSortBy()
    {
        return $this->getProperty('sortBy');
    }

    /**
     * Sets sort by
     *
     * @param  string $sortBy
     * @return self
     */
    public function setSortBy($sortBy)
    {
        return $this->setProperty('sortBy', trim($sortBy));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'search')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'search')
    {
        return parent::toXml($name);
    }
}
