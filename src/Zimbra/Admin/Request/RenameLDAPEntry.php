<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

/**
 * RenameLDAPEntry request class
 * Rename LDAP Entry.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RenameLDAPEntry extends Base
{
    /**
     * Constructor method for RenameLDAPEntry
     * @param string $dn A valid LDAP DN String (RFC 2253) that identifies the LDAP object
     * @param string $new_dn New DN - a valid LDAP DN String (RFC 2253) that describes the new DN to be given to the LDAP object
     * @return self
     */
    public function __construct($dn, $new_dn)
    {
        parent::__construct();
        $this->setProperty('dn', trim($dn));
        $this->setProperty('new_dn', trim($new_dn));
    }

    /**
     * Gets dn
     *
     * @return string
     */
    public function getDn()
    {
        return $this->getProperty('dn');
    }

    /**
     * Sets dn
     *
     * @param  string $dn
     * @return self
     */
    public function setDn($dn)
    {
        return $this->setProperty('dn', trim($dn));
    }

    /**
     * Gets new dn
     *
     * @return string
     */
    public function getNewDn()
    {
        return $this->getProperty('new_dn');
    }

    /**
     * Sets new dn
     *
     * @param  string $new_dn
     * @return self
     */
    public function setNewDn($new_dn)
    {
        return $this->setProperty('new_dn', trim($new_dn));
    }
}
