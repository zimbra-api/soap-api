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
 * GranteeChooser struct class
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GranteeChooser extends Base
{
    /**
     * Constructor method for GranteeChooser
     * @param string $type
     * @param string $id
     * @param string $name
     * @return self
     */
    public function __construct($type = null, $id = null, $name = null)
    {
        parent::__construct();
        if(null !== $type)
        {
            $this->setProperty('type', trim($type));
        }
        if(null !== $id)
        {
            $this->setProperty('id', trim($id));
        }
        if(null !== $name)
        {
            $this->setProperty('name', trim($name));
        }
    }

    /**
     * Gets a type
     *
     * @return string
     */
    public function getType()
    {
        return $this->getProperty('type');
    }

    /**
     * Sets a type
     *
     * @param  string $type
     * @return self
     */
    public function setType($type)
    {
        return $this->setProperty('type', trim($type));
    }

    /**
     * Gets an id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets an id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets a name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets a name
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
    public function toArray($name = 'grantee')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'grantee')
    {
        return parent::toXml($name);
    }
}
