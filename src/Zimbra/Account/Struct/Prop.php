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
 * Prop struct class
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
     * Constructor method for Prop
     * @param  string $name
     * @param  string $value
     * @param  long   $modified
     * @return self
     */
    public function __construct($zimlet, $name, $value = null)
    {
		parent::__construct(trim($value));
        $this->property('zimlet', trim($zimlet));
        $this->property('name', trim($name));
    }

    /**
     * Gets or sets zimlet
     *
     * @param  int $zimlet
     * @return int|self
     */
    public function zimlet($zimlet = null)
    {
        if(null === $zimlet)
        {
            return $this->property('zimlet');
        }
        return $this->property('zimlet', trim($zimlet));
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->property('name');
        }
        return $this->property('name', trim($name));
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
