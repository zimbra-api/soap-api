<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request\Attr;

/**
 * ModifyLDAPEntry class
 * Modify an LDAP Entry.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyLDAPEntry extends Attr
{
    /**
     * A valid LDAP DN String (RFC 2253) that identifies the LDAP object
     * @var string
     */
    private $_dn;

    /**
     * Constructor method for ModifyLDAPEntry
     * @param string $dn
     * @param array  $attrs
     * @return self
     */
    public function __construct($dn, array $attrs = array())
    {
        parent::__construct($attrs);
        $this->_dn = trim($dn);
    }

    /**
     * Gets or sets dn
     *
     * @param  string $dn
     * @return string|self
     */
    public function dn($dn = null)
    {
        if(null === $dn)
        {
            return $this->_dn;
        }
        $this->_dn = trim($dn);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'dn' => $this->_dn,
        );
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->addAttribute('dn', $this->_dn);
        return parent::toXml();
    }
}
