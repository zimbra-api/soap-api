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
        $this->property('name', trim($name));
        if(null !== $pd)
        {
            $this->property('pd', (bool) $pd);
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
     * Gets or sets pd
     *
     * @param  bool $pd
     * @return bool|self
     */
    public function pd($pd = null)
    {
        if(null === $pd)
        {
            return $this->property('pd');
        }
        return $this->property('pd', (bool) $pd);
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
