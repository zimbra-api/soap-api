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
 * ConstraintInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ConstraintInfo
{
    /**
     * Minimum value
     * 
     * @var string
     */
    #[Accessor(getter: 'getMin', setter: 'setMin')]
    #[SerializedName('min')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraAdmin')]
    private $min;

    /**
     * Maximum value
     * 
     * @var string
     */
    #[Accessor(getter: 'getMax', setter: 'setMax')]
    #[SerializedName('max')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraAdmin')]
    private $max;

    /**
     * Acceptable Values
     * 
     * @var array
     */
    #[Accessor(getter: 'getValues', setter: 'setValues')]
    #[SerializedName('values')]
    #[Type('array<string>')]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    #[XmlList(inline: false, entry: 'v', namespace: 'urn:zimbraAdmin')]
    private $values = [];

    /**
     * Constructor
     * 
     * @param  string $min
     * @param  string $max
     * @param  array $values
     * @return self
     */
    public function __construct(?string $min = null, ?string $max = null, array $values = [])
    {
        if (null !== $min) {
            $this->setMin($min);
        }
        if (null !== $max) {
            $this->setMax($max);
        }
        $this->setValues($values);
    }

    /**
     * Get minimum value
     *
     * @return string
     */
    public function getMin(): string
    {
        return $this->min;
    }

    /**
     * Set minimum value
     *
     * @param  string $min
     * @return self
     */
    public function setMin(string $min): self
    {
        $this->min = $min;
        return $this;
    }

    /**
     * Get maximum value
     *
     * @return string
     */
    public function getMax(): string
    {
        return $this->max;
    }

    /**
     * Set maximum value
     *
     * @param  string $max
     * @return self
     */
    public function setMax(string $max): self
    {
        $this->max = $max;
        return $this;
    }

    /**
     * Get acceptable values
     *
     * @return array
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * Set acceptable values
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

    /**
     * Adds a values
     *
     * @param  string $value
     * @return self
     */
    public function addValue($value): self
    {
        $value = trim($value);
        if (!empty($value) && !in_array($value, $this->values)) {
            $this->values[] = $value;
        }
        return $this;
    }
}