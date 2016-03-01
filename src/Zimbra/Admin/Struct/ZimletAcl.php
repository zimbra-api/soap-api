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

use Zimbra\Enum\AclType;
use Zimbra\Struct\Base;

/**
 * ZimletAcl struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ZimletAcl extends Base
{
    /**
     * Constructor method for ZimletAcl
     * @param  string $cos Name of Class Of Service (COS)
     * @param  AclType $acl ACL
     * @return self
     */
    public function __construct($cos = null, AclType $acl = null)
    {
        parent::__construct();
        $this->setProperty('cos', trim($cos));
        if($acl instanceof AclType)
        {
            $this->setProperty('acl', $acl);
        }
    }

    /**
     * Gets the cos
     *
     * @return string
     */
    public function getCos()
    {
        return $this->getProperty('cos');
    }

    /**
     * Sets the cos
     *
     * @param  string $cos
     * @return self
     */
    public function setCos($cos)
    {
        return $this->setProperty('cos', trim($cos));
    }

    /**
     * Gets the acl
     *
     * @return AclType
     */
    public function getAcl()
    {
        return $this->getProperty('acl');
    }

    /**
     * Sets the acl
     *
     * @param  AclType $acl
     * @return self
     */
    public function setAcl(AclType $acl)
    {
        return $this->setProperty('acl', $acl);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'acl')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'acl')
    {
        return parent::toXml($name);
    }
}
