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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlList, XmlRoot};

/**
 * EffectiveAttrInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="attr")
 */
class EffectiveAttrInfo
{
    /**
     * Attribute name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("n")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Constraint information
     * @Accessor(getter="getConstraint", setter="setConstraint")
     * @SerializedName("constraint")
     * @Type("Zimbra\Admin\Struct\ConstraintInfo")
     * @XmlElement
     */
    private $constraint;

    /**
     * Inherited default value(or values if the attribute is multi-valued)
     * @Accessor(getter="getValues", setter="setValues")
     * @SerializedName("default")
     * @Type("array<string>")
     * @XmlList(inline = false, entry = "v")
     */
    private $values;

    /**
     * Constructor method for EffectiveAttrInfo
     * @param string $name
     * @param ConstraintInfo $constraint
     * @param array $values
     * @return self
     */
    public function __construct(string $name, ?ConstraintInfo $constraint = NULL, array $values = [])
    {
        $this->setName($name);
        if ($constraint instanceof ConstraintInfo) {
            $this->setConstraint($constraint);
        }
        $this->setValues($values);
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets constraint
     *
     * @return ConstraintInfo
     */
    public function getConstraint(): ?ConstraintInfo
    {
        return $this->constraint;
    }

    /**
     * Sets constraint
     *
     * @param  ConstraintInfo $constraint
     * @return self
     */
    public function setConstraint(ConstraintInfo $constraint): self
    {
        $this->constraint = $constraint;
        return $this;
    }

    /**
     * Gets values
     *
     * @return array
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * Sets values
     *
     * @param  array $values
     * @return self
     */
    public function setValues(array $values): self
    {
        $this->values = [];
        foreach ($values as $value) {
            $this->addValue($value);
        }
        return $this;
    }

    /**
     * Adds a value
     *
     * @param  string $value
     * @return self
     */
    public function addValue(string $value): self
    {
        if (!empty($value) && !in_array($value, $this->values)) {
            $this->values[] = $value;
        }
        return $this;
    }
}
