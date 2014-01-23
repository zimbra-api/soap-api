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

use Zimbra\Enum\ZimletStatus;
use Zimbra\Struct\Base;

/**
 * ZimletAclStatusPri struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ZimletAclStatusPri extends Base
{
    /**
     * Constructor method for ZimletAclStatusPri
     * @param  string $name Name of Class Of Service (COS)
     * @param  ZimletAcl $acl Zimlet ACL
     * @param  ValueAttrib $status Status - valid values for valueattribute - enabled|disabled
     * @param  IntegerValueAttrib $priority Priority
     * @return self
     */
    public function __construct(
        $name,
        ZimletAcl $acl = null,
        ValueAttrib $status = null,
        IntegerValueAttrib $priority = null
    )
    {
        parent::__construct();
        $this->property('name', trim($name));
        if($acl instanceof ZimletAcl)
        {
            $this->child('acl', $acl);
        }
        if($status instanceof ValueAttrib)
        {
            $value = $status->value();
            if(ZimletStatus::has($value))
            {
                $this->child('status', $status);
            }
        }
        if($priority instanceof IntegerValueAttrib)
        {
            $this->child('priority', $priority);
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
     * Gets or sets acl
     *
     * @param  ZimletAcl $acl
     * @return ZimletAcl|self
     */
    public function acl(ZimletAcl $acl = null)
    {
        if(null === $acl)
        {
            return $this->child('acl');
        }
        return $this->child('acl', $acl);
    }

    /**
     * Gets or sets status
     *
     * @param  ValueAttrib $status
     * @return ValueAttrib|self
     */
    public function status(ValueAttrib $status = null)
    {
        if(null === $status)
        {
            return $this->child('status');
        }
        $value = $status->value();
        if(ZimletStatus::has($value))
        {
            $this->child('status', $status);
        }
        return $this;
    }

    /**
     * Gets or sets priority
     *
     * @param  IntegerValueAttrib $priority
     * @return IntegerValueAttrib|self
     */
    public function priority(IntegerValueAttrib $priority = null)
    {
        if(null === $priority)
        {
            return $this->child('priority');
        }
        return $this->child('priority', $priority);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'zimlet')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'zimlet')
    {
        return parent::toXml($name);
    }
}
