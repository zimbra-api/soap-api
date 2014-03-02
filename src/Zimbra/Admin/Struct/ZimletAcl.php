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
        $this->property('cos', trim($cos));
        if($acl instanceof AclType)
        {
            $this->property('acl', $acl);
        }
    }

    /**
     * Gets or sets value
     *
     * @param  string $cos
     * @return string|self
     */
    public function cos($cos = null)
    {
        if(null === $cos)
        {
            return $this->property('cos');
        }
        return $this->property('cos', trim($cos));
    }

    /**
     * Gets or sets acl
     *
     * @param  AclType $acl
     * @return AclType|self
     */
    public function acl(AclType $acl = null)
    {
        if(null === $acl)
        {
            return $this->property('acl');
        }
        return $this->property('acl', $acl);
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
