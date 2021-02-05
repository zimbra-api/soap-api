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
 * FilterAction class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="action")
 */
class FilterAction
{
    /**
     * Index - specifies a guaranteed order for the action elements
     * @Accessor(getter="getIndex", setter="setIndex")
     * @SerializedName("index")
     * @Type("integer")
     * @XmlAttribute
     */
    private $index;

    /**
     * Constructor method for FilterAction
     * @param int $index
     * @return self
     */
    public function __construct(?int $index = NULL)
    {
        if (NULL !== $index) {
            $this->setIndex($index);
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
}