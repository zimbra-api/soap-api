<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * NewSearchFolderSpec struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class NewSearchFolderSpec
{
    /**
     * Name
     * @var string
     */
    private $_name;

    /**
     * Query
     * @var string
     */
    private $_query;

    /**
     * Search types
     * @var string
     */
    private $_types;

    /**
     * Sort by
     * @var string
     */
    private $_sortBy;

    /**
     * Flags
     * @var string
     */
    private $_f;

    /**
     * Color numeric; range 0-127; defaults to 0 if not present; client can display only 0-7
     * @var int
     */
    private $_color;

    /**
     * Parent folder ID
     * @var string
     */
    private $_l;

    /**
     * Constructor method for NewSearchFolderSpec
     * @param string $name
     * @param string $query
     * @param string $types
     * @param string $sortBy
     * @param string $f
     * @param int $color
     * @param string $l
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
        $this->_name = trim($name);
        $this->_query = trim($query);
        $this->_types = trim($types);
        $this->_sortBy = trim($sortBy);
        $this->_f = trim($f);
        if(null !== $color)
        {
            $color = (int) $color;
            $this->_color = ($color > 0 && $color < 128) ? $color : 0;
        }
        $this->_l = trim($l);
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
     * Gets or sets types
     *
     * @param  string $types
     * @return string|self
     */
    public function types($types = null)
    {
        if(null === $types)
        {
            return $this->_types;
        }
        $this->_types = trim($types);
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
     * Gets or sets f
     *
     * @param  string $f
     * @return string|self
     */
    public function f($f = null)
    {
        if(null === $f)
        {
            return $this->_f;
        }
        $this->_f = trim($f);
        return $this;
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
            return $this->_color;
        }
        $color = (int) $color;
        $this->_color = ($color > 0 && $color < 128) ? $color : 0;
        return $this;
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
            return $this->_l;
        }
        $this->_l = trim($l);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'search')
    {
        $name = !empty($name) ? $name : 'search';
        $arr = array(
            'name' => $this->_name,
            'query' => $this->_query,
        );
        if(!empty($this->_types))
        {
            $arr['types'] = $this->_types;
        }
        if(!empty($this->_sortBy))
        {
            $arr['sortBy'] = $this->_sortBy;
        }
        if(!empty($this->_f))
        {
            $arr['f'] = $this->_f;
        }
        if(is_int($this->_color))
        {
            $arr['color'] = $this->_color;
        }
        if(!empty($this->_l))
        {
            $arr['l'] = $this->_l;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'search')
    {
        $name = !empty($name) ? $name : 'search';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('name', $this->_name)
            ->addAttribute('query', $this->_query);
        if(!empty($this->_types))
        {
            $xml->addAttribute('types', $this->_types);
        }
        if(!empty($this->_sortBy))
        {
            $xml->addAttribute('sortBy', $this->_sortBy);
        }
        if(!empty($this->_f))
        {
            $xml->addAttribute('f', $this->_f);
        }
        if(is_int($this->_color))
        {
            $xml->addAttribute('color', $this->_color);
        }
        if(!empty($this->_l))
        {
            $xml->addAttribute('l', $this->_l);
        }
        return $xml;
    }

    /**
     * Method returning the xml string representative this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
