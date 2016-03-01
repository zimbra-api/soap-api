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
        $this->setProperty('name', trim($name));
        if($acl instanceof ZimletAcl)
        {
            $this->setChild('acl', $acl);
        }
        if($status instanceof ValueAttrib)
        {
            $this->setStatus($status);
        }
        if($priority instanceof IntegerValueAttrib)
        {
            $this->setChild('priority', $priority);
        }
    }

    /**
     * Gets the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets the name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets the acl
     *
     * @return ZimletAcl
     */
    public function getAcl()
    {
        return $this->getChild('acl');
    }

    /**
     * Sets the acl
     *
     * @param  ZimletAcl $acl
     * @return self
     */
    public function setAcl(ZimletAcl $acl)
    {
        return $this->setChild('acl', $acl);
    }

    /**
     * Gets the status
     *
     * @return ValueAttrib
     */
    public function getStatus()
    {
        return $this->getChild('status');
    }

    /**
     * Sets the status
     *
     * @param  ValueAttrib $status
     * @return self
     */
    public function setStatus(ValueAttrib $status)
    {
        if(ZimletStatus::has($status->getValue()))
        {
            $this->setChild('status', $status);
        }
        return $this;
    }

    /**
     * Gets the priority
     *
     * @return IntegerValueAttrib
     */
    public function getPriority()
    {
        return $this->getChild('priority');
    }

    /**
     * Sets the priority
     *
     * @param  IntegerValueAttrib $priority
     * @return self
     */
    public function setPriority(IntegerValueAttrib $priority)
    {
        return $this->setChild('priority', $priority);
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
