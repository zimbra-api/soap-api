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
 * ModifyNotification struct class
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="mod")
 */
class ModifyNotification
{
    /**
     * Bitmask of modification change
     * @Accessor(getter="getChangeBitmask", setter="setChangeBitmask")
     * @SerializedName("change")
     * @Type("int")
     * @XmlAttribute
     */
    private $changeBitmask;

    /**
     * Constructor method for ModifyNotification
     * @param  int $changeBitmask
     * @return self
     */
    public function __construct(int $changeBitmask)
    {
        $this->setChangeBitmask($changeBitmask);
    }

    /**
     * Gets bitmask of modification change
     *
     * @return int
     */
    public function getChangeBitmask(): int
    {
        return $this->changeBitmask;
    }

    /**
     * Sets bitmask of modification change
     *
     * @param  int $changeBitmask
     * @return self
     */
    public function setChangeBitmask(int $changeBitmask): self
    {
        $this->changeBitmask = $changeBitmask;
        return $this;
    }
}
