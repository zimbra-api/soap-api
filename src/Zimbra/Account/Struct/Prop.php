<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyzimlet and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use Zimbra\Struct\Base;

/**
 * Property struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class Prop extends Base
{
    /**
     * Constructor method for property
     * @param  string $name
     * @param  string $value
     * @param  long   $modified
     * @return self
     */
    public function __construct($zimlet, $name, $value = null)
    {
		parent::__construct(trim($value));
        $this->setProperty('zimlet', trim($zimlet));
        $this->setProperty('name', trim($name));
    }

    /**
     * Gets zimlet name
     *
     * @return string
     */
    public function getZimlet()
    {
        return $this->getProperty('zimlet');
    }

    /**
     * Sets zimlet name
     *
     * @param  string $zimlet
     * @return self
     */
    public function setZimlet($zimlet)
    {
        return $this->setProperty('zimlet', trim($zimlet));
    }

    /**
     * Gets property name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets property name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'prop')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'prop')
    {
        return parent::toXml($name);
    }
}
