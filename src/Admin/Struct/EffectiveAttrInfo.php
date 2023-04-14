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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};

/**
 * EffectiveAttrInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class EffectiveAttrInfo
{
    /**
     * Attribute name
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName('n')]
    #[Type('string')]
    #[XmlAttribute]
    private $name;

    /**
     * Constraint information
     * 
     * @var ConstraintInfo
     */
    #[Accessor(getter: 'getConstraint', setter: 'setConstraint')]
    #[SerializedName('constraint')]
    #[Type(ConstraintInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private ?ConstraintInfo $constraint;

    /**
     * Inherited default value(or values if the attribute is multi-valued)
     * 
     * @var array
     */
    #[Accessor(getter: 'getValues', setter: 'setValues')]
    #[SerializedName('default')]
    #[Type('array<string>')]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    #[XmlList(inline: false, entry: 'v', namespace: 'urn:zimbraAdmin')]
    private $values = [];

    /**
     * Constructor
     * 
     * @param string $name
     * @param ConstraintInfo $constraint
     * @param array $values
     * @return self
     */
    public function __construct(
        string $name = '', ?ConstraintInfo $constraint = NULL, array $values = []
    )
    {
        $this->setName($name)
             ->setValues($values);
        $this->constraint = $constraint;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
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
     * Get constraint
     *
     * @return ConstraintInfo
     */
    public function getConstraint(): ?ConstraintInfo
    {
        return $this->constraint;
    }

    /**
     * Set constraint
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
     * Get values
     *
     * @return array
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * Set values
     *
     * @param  array $values
     * @return self
     */
    public function setValues(array $values): self
    {
        $this->values = array_unique(
            array_map(static fn ($value) => trim($value), $values)
        );
        return $this;
    }
}
