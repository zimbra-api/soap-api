<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * CursorInfo class
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
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
    private $id;

    /**
     * @Accessor(getter="getSortVal", setter="setSortVal")
     * @SerializedName("sortVal")
     * @Type("string")
     * @XmlAttribute
     */
    private $sortVal;

    /**
     * @Accessor(getter="getEndSortVal", setter="setEndSortVal")
     * @SerializedName("endSortVal")
     * @Type("string")
     * @XmlAttribute
     */
    private $endSortVal;

    /**
     * @Accessor(getter="getIncludeOffset", setter="setIncludeOffset")
     * @SerializedName("includeOffset")
     * @Type("boolean")
     * @XmlAttribute
     */
    private $includeOffset;

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
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets an id
     *
     * @param  string $id
     * @return string|self
     */
    public function setId($id): self
    {
        $this->id = trim($id);
        return $this;
    }

    /**
     * Gets sortVal
     *
     * @return string
     */
    public function getSortVal(): string
    {
        return $this->sortVal;
    }

    /**
     * Sets sortVal
     *
     * @param  string $sortVal
     * @return self
     */
    public function setSortVal($sortVal): self
    {
        $this->sortVal = trim($sortVal);
        return $this;
    }

    /**
     * Gets an endSortVal
     *
     * @return string
     */
    public function getEndSortVal(): string
    {
        return $this->endSortVal;
    }

    /**
     * Sets endSortVal
     *
     * @param  string $endSortVal
     * @return self
     */
    public function setEndSortVal($endSortVal): self
    {
        $this->endSortVal = trim($endSortVal);
        return $this;
    }

    /**
     * Gets an includeOffset
     *
     * @param  bool $includeOffset
     * @return bool
     */
    public function getIncludeOffset(): bool
    {
        return $this->includeOffset;
    }

    /**
     * Sets includeOffset
     *
     * @param  bool $includeOffset
     * @return self
     */
    public function setIncludeOffset($includeOffset): self
    {
        $this->includeOffset = (bool) $includeOffset;
        return $this;
    }
}
