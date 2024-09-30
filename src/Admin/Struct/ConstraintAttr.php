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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};

/**
 * ConstraintAttr struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ConstraintAttr
{
    /**
     * Constraint name
     *
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private $name;

    /**
     * Constraint information
     *
     * @Accessor(getter="getConstraint", setter="setConstraint")
     * @SerializedName("constraint")
     * @Type("Zimbra\Admin\Struct\ConstraintInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var ConstraintInfo
     */
    #[Accessor(getter: "getConstraint", setter: "setConstraint")]
    #[SerializedName("constraint")]
    #[Type(ConstraintInfo::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ConstraintInfo $constraint;

    /**
     * Constructor
     *
     * @param  ConstraintInfo $constraint
     * @param  string $name
     * @return self
     */
    public function __construct(ConstraintInfo $constraint, string $name = "")
    {
        $this->setConstraint($constraint)->setName($name);
    }

    /**
     * Get constraint information
     *
     * @return ConstraintInfo
     */
    public function getConstraint(): ConstraintInfo
    {
        return $this->constraint;
    }

    /**
     * Set constraint information
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
     * Get the name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
}
