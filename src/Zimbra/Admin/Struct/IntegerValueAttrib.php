<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * IntegerValueAttrib struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="a")
 */
class IntegerValueAttrib
{
    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("value")
     * @Type("integer")
     * @XmlAttribute
     */
    private $value;

    /**
     * Constructor method for IntegerValueAttrib
     * @param  int $value
     * @return self
     */
    public function __construct($value = NULL)
    {
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Gets value
     *
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  int $value
     * @return self
     */
    public function setValue($value): self
    {
        $this->value = (int) $value;
        return $this;
    }
}
