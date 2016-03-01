<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Struct\Base;

/**
 * ModifyContactAttr struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyContactAttr extends Base
{
    /**
     * Constructor method for ModifyContactAttr
     * @param string $n Attribute name
     * @param string $value Attribute data
     * @param string $aid Upload ID
     * @param int $id Item ID. Used in combination with subpart-name
     * @param string $part Subpart Name.
     * @param string $op Operation
     * @return self
     */
    public function __construct(
        $n,
        $value = null,
        $aid = null,
        $id = null,
        $part = null,
        $op = null
    )
    {
        parent::__construct(trim($value));
        $this->setProperty('n', trim($n));
        if(null !== $aid)
        {
            $this->setProperty('aid', trim($aid));
        }
        if(null !== $id)
        {
            $this->setProperty('id', (int) $id);
        }
        if(null !== $part)
        {
            $this->setProperty('part', trim($part));
        }
        if(null !== $op)
        {
            $this->setProperty('op', trim($op));
        }
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('n');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('n', trim($name));
    }

    /**
     * Gets upload ID
     *
     * @return string
     */
    public function getAttachId()
    {
        return $this->getProperty('aid');
    }

    /**
     * Sets upload ID
     *
     * @param  string $aid
     * @return self
     */
    public function setAttachId($aid)
    {
        return $this->setProperty('aid', trim($aid));
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', (int) $id);
    }

    /**
     * Gets part
     *
     * @return string
     */
    public function getPart()
    {
        return $this->getProperty('part');
    }

    /**
     * Sets part
     *
     * @param  string $part
     * @return self
     */
    public function setPart($part)
    {
        return $this->setProperty('part', trim($part));
    }

    /**
     * Gets operation
     *
     * @return string
     */
    public function getOperation()
    {
        return $this->getProperty('op');
    }

    /**
     * Sets operation
     *
     * @param  string $op
     * @return self
     */
    public function setOperation($op)
    {
        return $this->setProperty('op', trim($op));
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
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'a')
    {
        return parent::toXml($name);
    }
}
