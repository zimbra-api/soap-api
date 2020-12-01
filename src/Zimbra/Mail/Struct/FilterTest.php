<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * FilterTest class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="test")
 */
class FilterTest
{
    /**
     * Index - specifies a guaranteed order for the test elements
     * @Accessor(getter="getIndex", setter="setIndex")
     * @SerializedName("index")
     * @Type("integer")
     * @XmlAttribute
     */
    private $index;

    /**
     * Specifies a "not" condition for the test
     * @Accessor(getter="isNegative", setter="setNegative")
     * @SerializedName("negative")
     * @Type("bool")
     * @XmlAttribute
     */
    private $negative;

    /**
     * Constructor method for FilterTest
     * 
     * @param int $index
     * @param bool $negative
     * @return self
     */
    public function __construct(?int $index = NULL, ?bool $negative = NULL)
    {
        if (NULL !== $index) {
            $this->setIndex($index);
        }
        if (NULL !== $negative) {
            $this->setNegative($negative);
        }
    }

    /**
     * Gets index
     *
     * @return int
     */
    public function getIndex(): ?int
    {
        return $this->index;
    }

    /**
     * Sets index
     *
     * @param  int $index
     * @return self
     */
    public function setIndex(int $index)
    {
        $this->index = $index;
        return $this;
    }

    /**
     * Gets negative
     *
     * @return bool
     */
    public function isNegative(): ?bool
    {
        return $this->negative;
    }

    /**
     * Sets negative
     *
     * @param  bool $negative
     * @return self
     */
    public function setNegative(bool $negative)
    {
        $this->negative = $negative;
        return $this;
    }
}
