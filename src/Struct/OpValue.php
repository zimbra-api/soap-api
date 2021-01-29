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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot, XmlValue};

/**
 * OpValue class
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="addr")
 */
class OpValue
{
    /**
     * @Accessor(getter="getOp", setter="setOp")
     * @SerializedName("op")
     * @Type("string")
     * @XmlAttribute
     */
    private $op;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor method for OpValue
     * @param  string $op
     * @param  string $value
     * @return self
     */
    public function __construct(string $op = '+', ?string $value = NULL)
    {
        $this->setOp($op);
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Gets operation
     *
     * @return string
     */
    public function getOp(): string
    {
        return $this->op;
    }

    /**
     * sets operation
     *
     * @param  string $op
     * @return self
     */
    public function setOp(string $op = '+'): self
    {
        if (in_array(trim($op), ['+', '-'])) {
            $this->op = $op;
        }
        else {
            $this->op = '+';
        }
        return $this;
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  string $name
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
