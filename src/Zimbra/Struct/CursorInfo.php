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
            $this->property('id', trim($id));
        }
        if(null !== $sortVal)
        {
            $this->property('sortVal', trim($sortVal));
        }
        if(null !== $endSortVal)
        {
            $this->property('endSortVal', trim($endSortVal));
        }
        if(null !== $includeOffset)
        {
            $this->property('includeOffset', (bool) $includeOffset);
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
            return $this->property('id');
        }
        return $this->property('id', trim($id));
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
            return $this->property('sortVal');
        }
        return $this->property('sortVal', trim($sortVal));
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
            return $this->property('endSortVal');
        }
        return $this->property('endSortVal', trim($endSortVal));
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
            return $this->property('includeOffset');
        }
        return $this->property('includeOffset', (bool) $includeOffset);
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
