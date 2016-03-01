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
 * ValueAttrib struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ValueAttrib extends Base
{
    /**
     * Constructor method for ValueAttrib
     * @param  string $value
     * @return self
     */
    public function __construct($value)
    {
        parent::__construct();
        $this->setProperty('value', trim($value));
    }

    /**
     * Gets the value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->getProperty('value');
    }

    /**
     * Sets the value
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
    public function toArray($name = 'a')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'a')
    {
        return parent::toXml($name);
    }
}
