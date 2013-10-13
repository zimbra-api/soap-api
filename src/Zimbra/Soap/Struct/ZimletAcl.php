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

use Zimbra\Soap\Enum\AclType;
use Zimbra\Utils\SimpleXML;

/**
 * ZimletAcl class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ZimletAcl
{
    /**
     * Name of Class Of Service (COS)
     * @var string
     */
    private $_cos;

    /**
     * ACL
     * @var AclType
     */
    private $_acl;

    /**
     * Constructor method for ZimletAcl
     * @param  string $cos
     * @param  AclType $acl
     * @return self
     */
    public function __construct($cos = null, AclType $acl = null)
    {
        $this->_cos = trim($cos);
        if($acl instanceof AclType)
        {
            $this->_acl = $acl;
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
            return $this->_cos;
        }
        $this->_cos = trim($cos);
        return $this;
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
            return $this->_acl;
        }
        $this->_acl = $acl;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'acl')
    {
        $name = !empty($name) ? $name : 'acl';
        $arr = array();
        if(!empty($this->_cos))
        {
            $arr['cos'] = $this->_cos;
        }
        if($this->_acl instanceof AclType)
        {
            $arr['acl'] = (string) $this->_acl;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'acl')
    {
        $name = !empty($name) ? $name : 'acl';
        $xml = new SimpleXML('<'.$name.' />');
        if(!empty($this->_cos))
        {
            $xml->addAttribute('cos', $this->_cos);
        }
        if($this->_acl instanceof AclType)
        {
            $xml->addAttribute('acl', (string) $this->_acl);
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
