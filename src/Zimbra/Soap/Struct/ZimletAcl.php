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
     * @var string
     */
    private $_acl;

    /**
     * Constructor method for ZimletAcl
     * @param  string $cos
     * @return self
     */
    public function __construct($cos = null, $acl = null)
    {
        $this->_cos = trim($cos);
        if(in_array(trim($acl), array('grant', 'deny')))
        {
            $this->_acl = trim($acl);
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
     * @param  string $acl
     * @return string|self
     */
    public function acl($acl = null)
    {
        if(null === $acl)
        {
            return $this->_acl;
        }
        if(in_array(trim($acl), array('grant', 'deny')))
        {
            $this->_acl = trim($acl);
        }
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
        if(!empty($this->_acl))
        {
            $arr['acl'] = $this->_acl;
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
        if(!empty($this->_acl))
        {
            $xml->addAttribute('acl', $this->_acl);
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
