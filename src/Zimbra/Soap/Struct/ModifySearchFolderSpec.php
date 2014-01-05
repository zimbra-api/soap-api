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
 * ModifySearchFolderSpec struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifySearchFolderSpec
{
    /**
     * ID
     * @var string
     */
    private $_id;

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
     * Constructor method for ModifySearchFolderSpec
     * @param string $id
     * @param string $query
     * @param string $types
     * @param string $sortBy
     * @return self
     */
    public function __construct(
        $id,
        $query,
        $types = null,
        $sortBy = null
    )
    {
        $this->_id = trim($id);
        $this->_query = trim($query);
        $this->_types = trim($types);
        $this->_sortBy = trim($sortBy);
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->_id;
        }
        $this->_id = trim($id);
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
     * @param  bool $types
     * @return bool|self
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
     * @param  int $sortBy
     * @return int|self
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
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'search')
    {
        $name = !empty($name) ? $name : 'search';
        $arr = array(
            'id' => $this->_id,
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
        $xml->addAttribute('id', $this->_id)
            ->addAttribute('query', $this->_query);
        if(!empty($this->_types))
        {
            $xml->addAttribute('types', $this->_types);
        }
        if(!empty($this->_sortBy))
        {
            $xml->addAttribute('sortBy', $this->_sortBy);
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
