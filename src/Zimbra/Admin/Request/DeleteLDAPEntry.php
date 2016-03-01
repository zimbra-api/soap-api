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
 * DeleteLDAPEntry request class
 * Delete an LDAP entry.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DeleteLDAPEntry extends Base
{
    /**
     * Constructor method for DeleteLDAPEntry
     * @param  string $dn A valdn LDAP DN String (RFC 2253) that describes the DN to delete
     * @return self
     */
    public function __construct($dn)
    {
        parent::__construct();
        $this->setProperty('dn', trim($dn));
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
}
