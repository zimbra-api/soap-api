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

use PhpCollection\Map;

/**
 * StructInterface is a interface which define soap struct
 *
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
interface StructInterface
{
    /**
     * Gets xml namespace
     *
     * @return string
     */
    function getXmlNamespace();

    /**
     * Sets xml namespace
     *
     * @param  string $namespace
     * @return self
     */
    function setXmlNamespace($namespace);

    /**
     * Gets value
     *
     * @return string
     */
    function getValue();

    /**
     * Sets value
     *
     * @return self
     */
    function setValue($value);

    /**
     * Gets a property
     *
     * @param  string $name
     * @return mix
     */
    function getProperty($name);

    /**
     * Sets a property
     *
     * @param  string $name
     * @param  mix $value
     * @return self
     */
    function setProperty($name, $value);

    /**
     * Remove a property
     *
     * @param  string $name
     * @return self
     */
    function removeProperty($name);

    /**
     * Gets a child
     *
     * @param  string $name
     * @return mix
     */
    function getChild($name);

    /**
     * Sets a child
     *
     * @param  string $name
     * @param  mix $value
     * @return self
     */
    function setChild($name, $value);

    /**
     * Remove a child
     *
     * @param  string $name
     * @return self
     */
    function removeChild($name);

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    function toArray($name = null);

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    function toXml($name = null);
}
