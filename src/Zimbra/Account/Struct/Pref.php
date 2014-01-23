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
 * Pref struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class Pref extends Base
{
    /**
     * Constructor method for pref
     * @param  string $name
     * @param  string $value
     * @param  int   $modified
     * @return self
     */
    public function __construct($name, $value = null, $modified = null)
    {
		parent::__construct(trim($value));
        $this->property('name', trim($name));
        if(null !== $modified)
        {
            $this->property('modified', (int) $modified);
        }
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
     * Gets or sets modified
     *
     * @param  int $modified
     * @return int|self
     */
    public function modified($modified = null)
    {
        if(null === $modified)
        {
            return $this->property('modified');
        }
        return $this->property('modified', (int) $modified);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'pref')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'pref')
    {
        return parent::toXml($name);
    }
}
