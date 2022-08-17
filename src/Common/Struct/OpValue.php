<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};

/**
 * OpValue class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class OpValue
{
    /**
     * @Accessor(getter="getOp", setter="setOp")
     * @SerializedName("op")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getOp', setter: 'setOp')]
    #[SerializedName(name: 'op')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $op;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     * 
     * @var string
     */
    #[Accessor(getter: 'getValue', setter: 'setValue')]
    #[Type(name: 'string')]
    #[XmlValue(cdata: false)]
    private $value;

    /**
     * Constructor
     * 
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
     * Get operation
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
     * Get value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
