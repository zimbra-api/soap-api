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
 * NewContactGroupMember struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class NewContactGroupMember extends Base
{
    /**
     * Constructor method for NewContactGroupMember
     * @param string $type Member type
     * @param string $value Member value
     * @return self
     */
    public function __construct($type, $value)
    {
        parent::__construct();
        $this->setProperty('type', trim($type));
        $this->setProperty('value', trim($value));
    }

    /**
     * Gets type
     *
     * @return string
     */
    public function getType()
    {
        return $this->getProperty('type');
    }

    /**
     * Sets type
     *
     * @param  string $type
     * @return self
     */
    public function setType($type)
    {
        return $this->setProperty('type', trim($type));
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
    public function toArray($name = 'm')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'm')
    {
        return parent::toXml($name);
    }
}
