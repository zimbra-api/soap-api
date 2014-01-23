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
 * Stat struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class Stat extends Base
{
    /**
     * Constructor method for Stat
     * @param  string $name Stat name
     * @param  string $description Stat description
     * @return self
     */
    public function __construct($name = null, $description = null)
    {
        parent::__construct();
        if(null !== $name)
        {
            $this->property('name', trim($name));
        }
        if(null !== $description)
        {
            $this->property('description', trim($description));
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
     * Gets or sets description
     *
     * @param  string $description
     * @return string|self
     */
    public function description($description = null)
    {
        if(null === $description)
        {
            return $this->property('description');
        }
        return $this->property('description', trim($description));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'stat')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'stat')
    {
        return parent::toXml($name);
    }
}
