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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ConstraintInfo
{
    /**
     * Minimum value
     * @Accessor(getter="getMin", setter="setMin")
     * @SerializedName("min")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $min;

    /**
     * Maximum value
     * @Accessor(getter="getMax", setter="setMax")
     * @SerializedName("max")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $max;

    /**
     * Acceptable Values
     * @Accessor(getter="getValues", setter="setValues")
     * @SerializedName("values")
     * @Type("array<string>")
     * @XmlList(inline = false, entry = "v")
     */
    private $values = [];

    /**
     * Constructor method for ConstraintInfo
     * @param  string $min
     * @param  string $max
     * @param  array $values
     * @return self
     */
    public function __construct(?string $min = NULL, ?string $max = NULL, array $values = [])
    {
        if (NULL !== $min) {
            $this->setMin($min);
        }
        if (NULL !== $max) {
            $this->setMax($max);
        }
        $this->setValues($values);
    }

    /**
     * Gets minimum value
     *
     * @return string
     */
    public function getMin(): string
    {
        return $this->min;
    }

    /**
     * Sets minimum value
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
     * Gets maximum value
     *
     * @return string
     */
    public function getMax(): string
    {
        return $this->max;
    }

    /**
     * Sets maximum value
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
     * Gets acceptable values
     *
     * @return array
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * Sets acceptable values
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
     * Adds a values
     *
     * @param  string $values
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