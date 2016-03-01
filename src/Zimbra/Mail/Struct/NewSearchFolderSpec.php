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
 * NewSearchFolderSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class NewSearchFolderSpec extends Base
{
    /**
     * Constructor method for NewSearchFolderSpec
     * @param string $name Name
     * @param string $query Query
     * @param string $types Search types
     * @param string $sortBy Sort by
     * @param string $f Flags
     * @param int $color Color numeric; range 0-127; defaults to 0 if not present; client can display only 0-7
     * @param string $l Parent folder ID
     * @return self
     */
    public function __construct(
        $name,
        $query,
        $types = null,
        $sortBy = null,
        $f = null,
        $color = null,
        $l = null
    )
    {
        parent::__construct();
        $this->setProperty('name', trim($name));
        $this->setProperty('query', trim($query));
        if(null !== $types)
        {
            $this->setProperty('types', trim($types));
        }
        if(null !== $sortBy)
        {
            $this->setProperty('sortBy', trim($sortBy));
        }
        if(null !== $f)
        {
            $this->setProperty('f', trim($f));
        }
        if(null !== $color)
        {
            $color = (int) $color;
            $this->setProperty('color', ($color > 0 && $color < 128) ? $color : 0);
        }
        if(null !== $l)
        {
            $this->setProperty('l', trim($l));
        }
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
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
     * Gets flags
     *
     * @return string
     */
    public function getFlags()
    {
        return $this->getProperty('f');
    }

    /**
     * Sets flags
     *
     * @param  string $f
     * @return self
     */
    public function setFlags($f)
    {
        return $this->setProperty('f', trim($f));
    }

    /**
     * Gets color
     *
     * @return int
     */
    public function getColor()
    {
        return $this->getProperty('color');
    }

    /**
     * Sets color
     *
     * @param  int $color
     * @return self
     */
    public function setColor($color)
    {
        $color = (int) $color;
        return $this->setProperty('color', ($color > 0 && $color < 128) ? $color : 0);
    }

    /**
     * Gets parent folder ID
     *
     * @return string
     */
    public function getParentFolderId()
    {
        return $this->getProperty('l');
    }

    /**
     * Sets parent folder ID
     *
     * @param  string $l
     * @return self
     */
    public function setParentFolderId($l)
    {
        return $this->setProperty('l', trim($l));
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
