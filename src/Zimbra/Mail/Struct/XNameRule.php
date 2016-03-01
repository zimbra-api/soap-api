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
 * XNameRule struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class XNameRule extends Base
{
    /**
     * Constructor method for XNameRule
     *
     * @param string $name
     * @param string $value
     * @return self
     */
    public function __construct($name = null, $value = null)
    {
        parent::__construct();
        if(null !== $name)
        {
            $this->setProperty('name', trim($name));
        }
        if(null !== $value)
        {
            $this->setProperty('value', trim($value));
        }
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->getProperty('value');
    }

    /**
     * Sets value
     *
     * @param  string $value
     * @return self
     */
    public function setValue($value)
    {
        return $this->setProperty('value', trim($value));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'rule-x-name')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'rule-x-name')
    {
        return parent::toXml($name);
    }
}
