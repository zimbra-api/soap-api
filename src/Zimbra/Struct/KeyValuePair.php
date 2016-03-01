<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

/**
 * KeyValuePair struct class
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class KeyValuePair extends Base
{
    /**
     * Constructor method for KeyValuePair
     * @param string $key
     * @param string $value
     * @return self
     */
    public function __construct($key, $value = null)
    {
        parent::__construct($value);
        $this->setProperty('n', $key);
    }

    /**
     * Gets a key
     *
     * @param  string $key
     * @return string
     */
    public function getKey()
    {
        return $this->getProperty('n');
    }

    /**
     * Sets a key
     *
     * @param  string $key
     * @return self
     */
    public function setKey($key)
    {
        return $this->setProperty('n', $key);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'a')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'a')
    {
        return parent::toXml($name);
    }
}
