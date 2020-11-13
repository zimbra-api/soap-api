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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};

/**
 * ConstraintAttr struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="a")
 */
class ConstraintAttr
{
    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * @Accessor(getter="getConstraint", setter="setConstraint")
     * @SerializedName("constraint")
     * @Type("Zimbra\Admin\Struct\ConstraintInfo")
     * @XmlElement
     */
    private $constraint;

    /**
     * Constructor method for ConstraintAttr
     * @param  ConstraintInfo $constraint Constraint information
     * @param  string $name Constraint name
     * @return self
     */
    public function __construct(ConstraintInfo $constraint, $name)
    {
        $this->setConstraint($constraint);
        $this->setName($name);
    }

    /**
     * Gets constraint information
     *
     * @return ConstraintInfo
     */
    public function getConstraint(): ConstraintInfo
    {
        return $this->constraint;
    }

    /**
     * Sets constraint information
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
     * Gets the name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name): self
    {
        $this->name = trim($name);
        return $this;
    }
}