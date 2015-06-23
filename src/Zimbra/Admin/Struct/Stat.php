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

use Zimbra\Struct\Base;

/**
 * Stat struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class Stat extends Base
{
    /**
     * Constructor method for Stat
     * @param  string $value Stat value
     * @param  string $name Stat name
     * @param  string $description Stat description
     * @return self
     */
    public function __construct($value = null, $name = null, $description = null)
    {
        parent::__construct($value);
        if(null !== $name)
        {
            $this->setProperty('name', trim($name));
        }
        if(null !== $description)
        {
            $this->setProperty('description', trim($description));
        }
    }

    /**
     * Gets the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets the name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets the description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->getProperty('description');
    }

    /**
     * Sets the description
     *
     * @param  string $description
     * @return self
     */
    public function setDescription($description)
    {
        return $this->setProperty('description', trim($description));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'stat')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'stat')
    {
        return parent::toXml($name);
    }
}
