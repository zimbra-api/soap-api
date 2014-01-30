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
 * NewContactAttr struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class NewContactAttr extends Base
{
    /**
     * Constructor method for NewContactAttr
     * @param string $n Attribute name
     * @param string $value Attribute data
     * @param string $aid Upload ID
     * @param string $id Item ID. Used in combination with subpart-name
     * @param string $part Subpart Name
     * @return self
     */
    public function __construct(
        $n,
        $value = null,
        $aid = null,
        $id = null,
        $part = null
    )
    {
        parent::__construct(trim($value));
        $this->property('n', trim($n));
        if(null !== $aid)
        {
            $this->property('aid', trim($aid));
        }
        if(null !== $id)
        {
            $this->property('id', trim($id));
        }
        if(null !== $part)
        {
            $this->property('part', trim($part));
        }
    }

    /**
     * Gets or sets n
     *
     * @param  string $n
     * @return string|self
     */
    public function n($n = null)
    {
        if(null === $n)
        {
            return $this->property('n');
        }
        return $this->property('n', trim($n));
    }

    /**
     * Gets or sets aid
     *
     * @param  string $aid
     * @return string|self
     */
    public function aid($aid = null)
    {
        if(null === $aid)
        {
            return $this->property('aid');
        }
        return $this->property('aid', trim($aid));
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Gets or sets part
     *
     * @param  string $part
     * @return string|self
     */
    public function part($part = null)
    {
        if(null === $part)
        {
            return $this->property('part');
        }
        return $this->property('part', trim($part));
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
