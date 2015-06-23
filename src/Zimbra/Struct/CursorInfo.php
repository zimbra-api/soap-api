<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

/**
 * CursorInfo struct class
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CursorInfo extends Base
{
    /**
     * Constructor method for CursorInfo
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
        parent::__construct();
        if(null !== $id)
        {
            $this->setProperty('id', trim($id));
        }
        if(null !== $sortVal)
        {
            $this->setProperty('sortVal', trim($sortVal));
        }
        if(null !== $endSortVal)
        {
            $this->setProperty('endSortVal', trim($endSortVal));
        }
        if(null !== $includeOffset)
        {
            $this->setProperty('includeOffset', (bool) $includeOffset);
        }
    }

    /**
     * Gets an id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets an id
     *
     * @param  string $id
     * @return string|self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets sortVal
     *
     * @return string
     */
    public function getSortVal()
    {
        return $this->getProperty('sortVal');
    }

    /**
     * Sets sortVal
     *
     * @param  string $sortVal
     * @return self
     */
    public function setSortVal($sortVal)
    {
        return $this->setProperty('sortVal', trim($sortVal));
    }

    /**
     * Gets an endSortVal
     *
     * @return string
     */
    public function getEndSortVal()
    {
        return $this->getProperty('endSortVal');
    }

    /**
     * Sets endSortVal
     *
     * @param  string $endSortVal
     * @return self
     */
    public function setEndSortVal($endSortVal)
    {
        return $this->setProperty('endSortVal', trim($endSortVal));
    }

    /**
     * Gets an includeOffset
     *
     * @param  bool $includeOffset
     * @return bool
     */
    public function getIncludeOffset()
    {
        return $this->getProperty('includeOffset');
    }

    /**
     * Sets includeOffset
     *
     * @param  bool $includeOffset
     * @return self
     */
    public function setIncludeOffset($includeOffset)
    {
        return $this->setProperty('includeOffset', (bool) $includeOffset);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'cursor')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'cursor')
    {
        return parent::toXml($name);
    }
}
