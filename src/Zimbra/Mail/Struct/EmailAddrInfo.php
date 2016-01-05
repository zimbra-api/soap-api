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

use Zimbra\Enum\AddressType;
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
     * @param  string      $a Email address
     * @param  AddressType $t Address type - (f)rom, (t)o, (c)c, (b)cc, (r)eply-to, (s)ender, read-receipt (n)otification, (rf) resent-from
     * @param  string      $p The comment/name part of an address
     * @return self
     */
    public function __construct($a, AddressType $t = null, $p = null)
    {
        parent::__construct();
        $this->setProperty('a', trim($a));
        if(null !== $t)
        {
            $this->setProperty('t', $t);
        }
        if(null !== $p)
        {
            $this->setProperty('p', trim($p));
        }
    }

    /**
     * Gets address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->getProperty('a');
    }

    /**
     * Sets address
     *
     * @param  string $a
     * @return self
     */
    public function setAddress($a)
    {
        return $this->setProperty('a', trim($a));
    }

    /**
     * Gets address type
     *
     * @return AddressType
     */
    public function getAddressType()
    {
        return $this->getProperty('t');
    }

    /**
     * Sets address type
     *
     * @param  AddressType $t
     * @return self
     */
    public function setAddressType(AddressType $t)
    {
        return $this->setProperty('t', $t);
    }

    /**
     * Gets personal
     *
     * @return string
     */
    public function getPersonal()
    {
        return $this->getProperty('p');
    }

    /**
     * Sets personal
     *
     * @param  string $p
     * @return self
     */
    public function setPersonal($p)
    {
        return $this->setProperty('p', trim($p));
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
