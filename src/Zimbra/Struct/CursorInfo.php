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

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * CursorInfo struct class
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="cursor")
 */
class CursorInfo
{
    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $_id;

    /**
     * @Accessor(getter="getSortVal", setter="setSortVal")
     * @SerializedName("sortVal")
     * @Type("string")
     * @XmlAttribute
     */
    private $_sortVal;

    /**
     * @Accessor(getter="getEndSortVal", setter="setEndSortVal")
     * @SerializedName("endSortVal")
     * @Type("string")
     * @XmlAttribute
     */
    private $_endSortVal;

    /**
     * @Accessor(getter="getIncludeOffset", setter="setIncludeOffset")
     * @SerializedName("includeOffset")
     * @Type("boolean")
     * @XmlAttribute
     */
    private $_includeOffset;

    /**
     * Constructor method for CursorInfo
     * @param string $id
     * @param string $sortVal
     * @param string $endSortVal
     * @param bool $includeOffset
     * @return self
     */
    public function __construct(
        $id = NULL,
        $sortVal = NULL,
        $endSortVal = NULL,
        $includeOffset = NULL
    )
    {
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $sortVal) {
            $this->setSortVal($sortVal);
        }
        if (NULL !== $endSortVal) {
            $this->setEndSortVal($endSortVal);
        }
        if (NULL !== $includeOffset) {
            $this->setIncludeOffset($includeOffset);
        }
    }

    /**
     * Gets an id
     *
     * @return string
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Sets an id
     *
     * @param  string $id
     * @return string|self
     */
    public function setId($id)
    {
        $this->_id = trim($id);
        return $this;
    }

    /**
     * Gets sortVal
     *
     * @return string
     */
    public function getSortVal()
    {
        return $this->_sortVal;
    }

    /**
     * Sets sortVal
     *
     * @param  string $sortVal
     * @return self
     */
    public function setSortVal($sortVal)
    {
        $this->_sortVal = trim($sortVal);
        return $this;
    }

    /**
     * Gets an endSortVal
     *
     * @return string
     */
    public function getEndSortVal()
    {
        return $this->_endSortVal;
    }

    /**
     * Sets endSortVal
     *
     * @param  string $endSortVal
     * @return self
     */
    public function setEndSortVal($endSortVal)
    {
        $this->_endSortVal = trim($endSortVal);
        return $this;
    }

    /**
     * Gets an includeOffset
     *
     * @param  bool $includeOffset
     * @return bool
     */
    public function getIncludeOffset()
    {
        return $this->_includeOffset;
    }

    /**
     * Sets includeOffset
     *
     * @param  bool $includeOffset
     * @return self
     */
    public function setIncludeOffset($includeOffset)
    {
        $this->_includeOffset = (bool) $includeOffset;
        return $this;
    }
}
