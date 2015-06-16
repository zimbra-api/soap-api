<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

/**
 * Identity struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class Identity extends AttrsImpl
{
    /**
     * Constructor method for Identity
     * @param string $name
     * @param string $id
     * @param array  $attrs
     * @return self
     */
    public function __construct($name = null, $id = null, array $attrs = array())
    {
        parent::__construct($attrs);
        if(null !== $name)
        {
            $this->setProperty('name', trim($name));
        }
        if(null !== $id)
        {
            $this->setProperty('id', trim($id));
        }
    }

    /**
     * Gets identity name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets identity name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets identity ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets identity ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id = null)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'identity')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'identity')
    {
        return parent::toXml($name);
    }
}
