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

use Zimbra\Soap\Request;

/**
 * RenameLDAPEntry class
 * Rename LDAP Entry.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class RenameLDAPEntry extends Request
{
    /**
     * Zimbra ID
     * @var string
     */
    private $_dn;

    /**
     * New Distribution List name
     * @var string
     */
    private $_new_dn;

    /**
     * Constructor method for RenameLDAPEntry
     * @param string $dn
     * @param string $new_dn
     * @return self
     */
    public function __construct($dn, $new_dn)
    {
        parent::__construct();
        $this->_dn = trim($dn);
        $this->_new_dn = trim($new_dn);
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
     * Gets or sets new_dn
     *
     * @param  string $new_dn
     * @return string|self
     */
    public function new_dn($new_dn = null)
    {
        if(null === $new_dn)
        {
            return $this->_new_dn;
        }
        $this->_new_dn = trim($new_dn);
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
            'new_dn' => $this->_new_dn,
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
        $this->xml->addAttribute('dn', $this->_dn)
                  ->addAttribute('new_dn', $this->_new_dn);
        return parent::toXml();
    }
}
