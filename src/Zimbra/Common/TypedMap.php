<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common;

use PhpCollection\Map;

/**
 * TypedMap class
 *
 * @package   Zimbra
 * @category  Common
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class TypedMap extends Map
{
    /**
     * Class type
     * @var string
     */
    private $_type;

    /**
     * Constructor method for TypedMap
     * @param string $type
     * @param array $elements
     * @return self
     */
    public function __construct($type, array $elements = [])
    {
        parent::__construct();
        $this->_type = $type;
        $this->setAll($elements);
    }

    /**
     * Appends an element at the end of the sequence.
     * @param string $key
     * @param T $value
     * @return self
     */
    public function set($key, $value)
    {
        if($value instanceof $this->_type)
        {
            parent::set($key, $value);
        }
        else
        {
            throw new \UnexpectedValueException(
                "TypedMap<$this->_type> can only hold objects of $this->_type class."
            );
        }
        return $this;
    }

    /**
     * Sets all key/value pairs in the map.
     * @param array<string,T> $kvMap
     * @return self
     */
    public function setAll(array $kvMap)
    {
        foreach ($kvMap as $key => $value)
        {
            $this->set($key, $value);
        }
        return $this;
    }
}
