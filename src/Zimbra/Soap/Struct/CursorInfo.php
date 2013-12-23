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
 * CursorInfo class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CursorInfo
{
    /**
     * Previous ID
     * @var string
     */
    private $_id;

    /**
     * Should be set to the value of the 'sf' (SortField) attribute
     * @var string
     */
    private $_sortVal;

    /**
     * Used for ranges to tell the cursor where to stop (non-inclusive) returning values
     * @var string
     */
    private $_endSortVal;

    /**
     * If true, the response will include the cursor position (starting from 0) in the entire hits.
     * This can't be used with text queries.
     * Don't abuse this option because this operation is relatively expensive
     * @var boolean
     */
    private $_includeOffset;

    /**
     * Constructor method for cursorInfo
     * @param string $id
     * @param string $sortVal
     * @param string $endSortVal
     * @param bool $includeOffset
     * @return self
     */
    public function __construct(
        $id = null,
        $sortVal = null,
        $endSortVal = null,
        $includeOffset = null
    )
    {
        $this->_id = trim($id);
        $this->_sortVal = trim($sortVal);
        $this->_endSortVal = trim($endSortVal);
        if(null !== $includeOffset)
        {
            $this->_includeOffset = (bool) $includeOffset;
        }
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
     * Gets or sets sortVal
     *
     * @param  string $sortVal
     * @return string|self
     */
    public function sortVal($sortVal = null)
    {
        if(null === $sortVal)
        {
            return $this->_sortVal;
        }
        $this->_sortVal = trim($sortVal);
        return $this;
    }

    /**
     * Gets or sets endSortVal
     *
     * @param  string $endSortVal
     * @return string|self
     */
    public function endSortVal($endSortVal = null)
    {
        if(null === $endSortVal)
        {
            return $this->_endSortVal;
        }
        $this->_endSortVal = trim($endSortVal);
        return $this;
    }

    /**
     * Gets or sets includeOffset
     *
     * @param  bool $includeOffset
     * @return bool|AccountACEInfo
     */
    public function includeOffset($includeOffset = null)
    {
        if(null === $includeOffset)
        {
            return $this->_includeOffset;
        }
        $this->_includeOffset = (bool) $includeOffset;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'cursor')
    {
        $name = !empty($name) ? $name : 'cursor';
        $arr = array();
        if(!empty($this->_id))
        {
            $arr['id'] = $this->_id;
        }
        if(!empty($this->_sortVal))
        {
            $arr['sortVal'] = $this->_sortVal;
        }
        if(!empty($this->_endSortVal))
        {
            $arr['endSortVal'] = $this->_endSortVal;
        }
        if(is_bool($this->_includeOffset))
        {
            $arr['includeOffset'] = $this->_includeOffset ? 1 : 0;
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'cursor')
    {
        $name = !empty($name) ? $name : 'cursor';
        $xml = new SimpleXML('<'.$name.' />');
        if(!empty($this->_id))
        {
            $xml->addAttribute('id', $this->_id);
        }
        if(!empty($this->_sortVal))
        {
            $xml->addAttribute('sortVal', $this->_sortVal);
        }
        if(!empty($this->_endSortVal))
        {
            $xml->addAttribute('endSortVal', $this->_endSortVal);
        }
        if(is_bool($this->_includeOffset))
        {
            $xml->addAttribute('includeOffset', $this->_includeOffset ? 1 : 0);
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
