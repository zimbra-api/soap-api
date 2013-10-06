<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * ZimletAclStatusPri class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ZimletAclStatusPri
{
    /**
     * Name of Class Of Service (COS)
     * @var string
     */
    private $_name;

    /**
     * Zimlet ACL
     * @var ZimletAcl
     */
    private $_acl;

    /**
     * Status - valid values for valueattribute - enabled|disabled
     * @var ValueAttrib
     */
    private $_status;

    /**
     * Priority
     * @var IntegerValueAttrib
     */
    private $_priority;

    /**
     * Constructor method for ZimletAclStatusPri
     * @param  string $name
     * @param  ZimletAcl $name
     * @return self
     */
    public function __construct(
        $name,
        ZimletAcl $acl = null,
        ValueAttrib $status = null,
        IntegerValueAttrib $priority = null)
    {
        $this->_name = trim($name);
        if($acl instanceof ZimletAcl)
        {
            $this->_acl = $acl;
        }
        if($status instanceof ValueAttrib)
        {
            $value = $status->value();
            if(in_array($value, array('enabled', 'disabled')))
            {
                $this->_status = $status;
            }
        }
        if($priority instanceof IntegerValueAttrib)
        {
            $this->_priority = $priority;
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
            return $this->_name;
        }
        $this->_name = trim($name);
        return $this;
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
            return $this->_acl;
        }
        $this->_acl = $acl;
        return $this;
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
            return $this->_status;
        }
        $value = $status->value();
        if(in_array($value, array('enabled', 'disabled')))
        {
            $this->_status = $status;
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
            return $this->_priority;
        }
        $this->_priority = $priority;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'zimlet')
    {
        $name = !empty($name) ? $name : 'zimlet';
        $arr = array(
            'name' => $this->_name,
        );
        if($this->_acl instanceof ZimletAcl)
        {
            $arr += $this->_acl->toArray('acl');
        }
        if($this->_status instanceof ValueAttrib)
        {
            $arr += $this->_status->toArray('status');
        }
        if($this->_priority instanceof IntegerValueAttrib)
        {
            $arr += $this->_priority->toArray('priority');
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'zimlet')
    {
        $name = !empty($name) ? $name : 'zimlet';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('name', $this->_name);
        if($this->_acl instanceof ZimletAcl)
        {
            $xml->append($this->_acl->toXml('acl'));
        }
        if($this->_status instanceof ValueAttrib)
        {
            $xml->append($this->_status->toXml('status'));
        }
        if($this->_priority instanceof IntegerValueAttrib)
        {
            $xml->append($this->_priority->toXml('priority'));
        }
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
