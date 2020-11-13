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
use Zimbra\Enum\ConditionOperator as Op;
use Zimbra\Struct\SearchFilterCondition;

/**
 * EntrySearchFilterSingleCond class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="cond")
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
     * @Type("Zimbra\Enum\ConditionOperator")
     * @XmlAttribute
     */
    private $op;

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
     * @param Op $op
     * @param string $value
     * @param bool $not
     * @return self
     */
    public function __construct(
        $attr,
        Op $op,
        $value,
        $not = NULL
    )
    {
        $this->setAttr($attr)
            ->setOp($op)
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
    public function setAttr($attr): self
    {
        $this->attr = trim($attr);
        return $this;
    }

    /**
     * Gets operator
     *
     * @return Op
     */
    public function getOp(): Op
    {
        return $this->op;
    }

    /**
     * Sets operator
     *
     * @param  string $op
     * @return self
     */
    public function setOp(Op $op): self
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
    public function setValue($value): self
    {
        $this->value = trim($value);
        return $this;
    }

    /**
     * Gets not flag
     *
     * @return bool
     */
    public function isNot(): bool
    {
        return $this->not;
    }

    /**
     * Sets not flag
     *
     * @param  bool $not
     * @return self
     */
    public function setNot($not): self
    {
        $this->not = (bool) $not;
        return $this;
    }
}
