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
use Zimbra\Common\Enum\ConditionOperator;
use Zimbra\Common\Struct\SearchFilterCondition;

/**
 * EntrySearchFilterSingleCond class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class EntrySearchFilterSingleCond implements SearchFilterCondition
{
    /**
     * @Accessor(getter="getAttr", setter="setAttr")
     * @SerializedName("attr")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getAttr", setter: "setAttr")]
    #[SerializedName("attr")]
    #[Type("string")]
    #[XmlAttribute]
    private $attr;

    /**
     * @Accessor(getter="getOp", setter="setOp")
     * @SerializedName("op")
     * @Type("Enum<Zimbra\Common\Enum\ConditionOperator>")
     * @XmlAttribute
     *
     * @var ConditionOperator
     */
    #[Accessor(getter: "getOp", setter: "setOp")]
    #[SerializedName("op")]
    #[Type("Enum<Zimbra\Common\Enum\ConditionOperator>")]
    #[XmlAttribute]
    private ConditionOperator $op;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("value")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getValue", setter: "setValue")]
    #[SerializedName("value")]
    #[Type("string")]
    #[XmlAttribute]
    private $value;

    /**
     * @Accessor(getter="isNot", setter="setNot")
     * @SerializedName("not")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "isNot", setter: "setNot")]
    #[SerializedName("not")]
    #[Type("bool")]
    #[XmlAttribute]
    private $not;

    /**
     * Constructor
     *
     * @param string $attr
     * @param ConditionOperator $op
     * @param string $value
     * @param bool $not
     * @return self
     */
    public function __construct(
        string $attr = "",
        ?ConditionOperator $op = null,
        string $value = "",
        ?bool $not = null
    ) {
        $this->setAttr($attr)
            ->setOp($op ?? new ConditionOperator("eq"))
            ->setValue($value);
        if (null !== $not) {
            $this->setNot($not);
        }
    }

    /**
     * Get attribute name
     *
     * @return string
     */
    public function getAttr(): string
    {
        return $this->attr;
    }

    /**
     * Set attribute name
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
     * Get operator
     *
     * @return ConditionOperator
     */
    public function getOp(): ConditionOperator
    {
        return $this->op;
    }

    /**
     * Set operator
     *
     * @param  ConditionOperator $op
     * @return self
     */
    public function setOp(ConditionOperator $op): self
    {
        $this->op = $op;
        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue(): string
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

    /**
     * Get not flag
     *
     * @return bool
     */
    public function isNot(): ?bool
    {
        return $this->not;
    }

    /**
     * Set not flag
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
