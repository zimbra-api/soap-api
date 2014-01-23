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

use Zimbra\Soap\Request;

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
class RenameLDAPEntry extends Request
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
        $this->property('dn', trim($dn));
        $this->property('new_dn', trim($new_dn));
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
            return $this->property('dn');
        }
        return $this->property('dn', trim($dn));
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
            return $this->property('new_dn');
        }
        return $this->property('new_dn', trim($new_dn));
    }
}
