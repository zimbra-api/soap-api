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
 * EmailAddrInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class EmailAddrInfo extends Base
{
    /**
     * Constructor method for EmailAddrInfo
     * @param  string $a Email address
     * @param  string $t  Address type - (f)rom, (t)o, (c)c, (b)cc, (r)eply-to, (s)ender, read-receipt (n)otification, (rf) resent-from
     * @param  string $p The comment/name part of an address
     * @return self
     */
    public function __construct($a, $t = null, $p = null)
    {
        parent::__construct();
        $this->property('a', trim($a));
        if(null !== $t)
        {
            $this->property('t', trim($t));
        }
        if(null !== $p)
        {
            $this->property('p', trim($p));
        }
    }

    /**
     * Gets or sets a
     *
     * @param  string $a
     * @return string|self
     */
    public function a($a = null)
    {
        if(null === $a)
        {
            return $this->property('a');
        }
        return $this->property('a', trim($a));
    }

    /**
     * Gets or sets t
     *
     * @param  string $t
     * @return string|self
     */
    public function t($t = null)
    {
        if(null === $t)
        {
            return $this->property('t');
        }
        return $this->property('t', trim($t));
    }

    /**
     * Gets or sets p
     *
     * @param  string $p
     * @return string|self
     */
    public function p($p = null)
    {
        if(null === $p)
        {
            return $this->property('p');
        }
        return $this->property('p', trim($p));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'e')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'e')
    {
        return parent::toXml($name);
    }
}
