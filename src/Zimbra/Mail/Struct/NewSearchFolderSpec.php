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
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
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
        $this->property('name', trim($name));
        $this->property('query', trim($query));
        if(null !== $types)
        {
            $this->property('types', trim($types));
        }
        if(null !== $sortBy)
        {
            $this->property('sortBy', trim($sortBy));
        }
        if(null !== $f)
        {
            $this->property('f', trim($f));
        }
        if(null !== $color)
        {
            $color = (int) $color;
            $this->property('color', ($color > 0 && $color < 128) ? $color : 0);
        }
        if(null !== $l)
        {
            $this->property('l', trim($l));
        }
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
     * Gets or sets types
     *
     * @param  string $types
     * @return string|self
     */
    public function types($types = null)
    {
        if(null === $types)
        {
            return $this->property('types');
        }
        return $this->property('types', trim($types));
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
     * Gets or sets f
     *
     * @param  string $f
     * @return string|self
     */
    public function f($f = null)
    {
        if(null === $f)
        {
            return $this->property('f');
        }
        return $this->property('f', trim($f));
    }

    /**
     * Gets or sets color
     *
     * @param  int $color
     * @return int|self
     */
    public function color($color = null)
    {
        if(null === $color)
        {
            return $this->property('color');
        }
        return $this->property('color', ($color > 0 && $color < 128) ? $color : 0);
    }

    /**
     * Gets or sets l
     *
     * @param  string $l
     * @return string|self
     */
    public function l($l = null)
    {
        if(null === $l)
        {
            return $this->property('l');
        }
        return $this->property('l', trim($l));
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
