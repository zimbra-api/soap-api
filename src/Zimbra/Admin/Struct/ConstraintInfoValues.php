<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * ConstraintInfoValues struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="values")
 */
class ConstraintInfoValues
{
    /**
     * Values
     * @Accessor(getter="getValues", setter="setValues")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "v")
     */
    private $_values;

    /**
     * Constructor method for ConstraintInfoValues
     * @param  array $values
     * @return self
     */
    public function __construct(array $values = [])
    {
        $this->setValues($values);
    }

    /**
     * Adds a values
     *
     * @param  string $values
     * @return self
     */
    public function addValue($value)
    {
        $value = trim($value);
        if (!empty($value) && !in_array($value, $this->_values)) {
            $this->_values[] = $value;
        }
        return $this;
    }

    /**
     * Sets values sequence
     *
     * @param  array $values
     * @return self
     */
    public function setValues(array $values)
    {
        $this->_values = [];
        foreach ($values as $value) {
            $this->addValue($value);
        }
        return $this;
    }

    /**
     * Gets values sequence
     *
     * @return array
     */
    public function getValues()
    {
        return $this->_values;
    }
}
