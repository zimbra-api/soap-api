<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\ConditionOperator as Operator;
use Zimbra\Common\Struct\SearchFilterCondition;

/**
 * EntrySearchFilterSingleCond class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class EntrySearchFilterSingleCond implements SearchFilterCondition
{
    /**
     * @Accessor(getter="getAttr", setter="setAttr")
     * @SerializedName("attr")
     * @Type("string")
     * @XmlAttribute
     */
    private $attr;

    /**
     * @Accessor(getter="getOp", setter="setOp")
     * @SerializedName("op")
     * @Type("Zimbra\Common\Enum\ConditionOperator")
     * @XmlAttribute
     */
    private Operator $op;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("value")
     * @Type("string")
     * @XmlAttribute
     */
    private $value;

    /**
     * @Accessor(getter="isNot", setter="setNot")
     * @SerializedName("not")
     * @Type("boolean")
     * @XmlAttribute
     */
    private $not;

    /**
     * Constructor method for EntrySearchFilterSingleCond
     * @param string $attr
     * @param Operator $op
     * @param string $value
     * @param bool $not
     * @return self
     */
    public function __construct(
        string $attr = '',
        ?Operator $op = NULL,
        string $value = '',
        ?bool $not = NULL
    )
    {
        $this->setAttr($attr)
             ->setOp($op ?? Operator::EQ())
             ->setValue($value);
        if (NULL !== $not) {
            $this->setNot($not);
        }
    }

    /**
     * Gets attribute name
     *
     * @return string
     */
    public function getAttr(): string
    {
        return $this->attr;
    }

    /**
     * Sets attribute name
     *
     * @param  string $attr
     * @return self
     */
    public function setAttr(string $attr): self
    {
        $this->attr = $attr;
        return $this;
    }

    /**
     * Gets operator
     *
     * @return Operator
     */
    public function getOp(): Operator
    {
        return $this->op;
    }

    /**
     * Sets operator
     *
     * @param  Operator $op
     * @return self
     */
    public function setOp(Operator $op): self
    {
        $this->op = $op;
        return $this;
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Gets not flag
     *
     * @return bool
     */
    public function isNot(): ?bool
    {
        return $this->not;
    }

    /**
     * Sets not flag
     *
     * @param  bool $not
     * @return self
     */
    public function setNot(bool $not): self
    {
        $this->not = $not;
        return $this;
    }
}
