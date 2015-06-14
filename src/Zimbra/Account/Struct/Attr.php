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

use Zimbra\Struct\Base;

/**
 * Attr struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class Attr extends Base
{
    /**
     * Constructor method for Attr
     * @param  string $name
     * @param  string $value
     * @param  bool   $pd
     * @return self
     */
    public function __construct($name, $value = null, $pd = null)
    {
        parent::__construct(trim($value));
        $this->setProperty('name', trim($name));
        if(null !== $pd)
        {
            $this->setProperty('pd', (bool) $pd);
        }
    }

    /**
     * Gets name of attribute
     *
     * @param  string $name
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name of attribute
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets permission has been denied flag
     *
     * @return bool
     */
    public function getPermDenied()
    {
        return $this->getProperty('pd');
    }

    /**
     * Sets permission has been denied flag
     *
     * @param  bool $pd
     * @return self
     */
    public function setPermDenied($pd)
    {
        return $this->setProperty('pd', (bool) $pd);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'attr')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'attr')
    {
        return parent::toXml($name);
    }
}
