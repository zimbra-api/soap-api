<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Enum;

/**
 * Base enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class Base
{
    /**
     * Enum value
     * @var mixed
     */
    private $_value;

    /**
     * Cache
     * @var array
     */
    private static $cache = [];

    /**
     * Default value
     * @var mixed
     */
    protected static $default;

    /**
     * Constructor method for CacheSelector
     * Creates a new value of some type
     * @param mixed $value
     * @throws \UnexpectedValueException if incompatible type is given.
     */
    protected function __construct($value = null)
    {
        if (is_null($value))
        {
            $value = static::$default;
        }
        static::initialize();

        if (!in_array($value, static::enums()))
        {
            throw new \UnexpectedValueException("Value '$value' is not part of the enum " . get_called_class());
        }
        $this->_value = $value;
    }

    /**
     * Initialize
     */
    protected static function initialize()
    {
        $className = get_called_class();
        if (!isset(self::$cache[$className]['values']))
        {
            $ref = new \ReflectionClass($className);
            self::$cache[$className]['values'] = $ref->getConstants();
        }
    }

    /**
     * Returns all possible enum values as an array
     *
     * @return array Constant name in key, constant value in value
     */
    public static function enums()
    {
        static::initialize();
        $className = get_called_class();
        return self::$cache[$className]['values'];
    }

    /**
     * Returns a value when called statically like so: MyEnum::SOME_VALUE() given SOME_VALUE is a class constant
     *
     * @param string $name
     * @param array  $arguments
     * @return static
     * @throws \BadMethodCallException
     */
    public static function __callStatic($name, $arguments)
    {
        $class = get_called_class();
        $const = $class . '::' . $name;
        if (!defined($const))
        {
            throw new \BadMethodCallException("No static method or enum constant '$name' in class " . $class());
        }
        return new static(constant($const));
    }

    /**
     * Check enum has value
     *
     * @param mix $value
     * @return bool
     */
    public static function has($value)
    {
        return in_array($value, static::enums());
    }

    /**
     * Gets enum value
     *
     * @return mix
     */
    public function value()
    {
        return $this->_value;
    }

    /**
     * Check value is enum
     *
     * @param mix $value
     * @return bool
     */
    public function is($value)
    {
        if ($value instanceof Base)
        {
            $value = $value->value();
        }
        return $value == $this->value();
    }

    /**
     * Check value in array
     *
     * @param array $values
     * @return bool
     */
    public function in(array $values)
    {
        $values = array_map(function($value)
        {
            if ($value instanceof Base)
            {
                $value = $value->value();
            }
            return $value;
        }, $values);
        return in_array($this->value(), $values);
    }

    /**
     * Method returning the string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->_value;
    }
}
