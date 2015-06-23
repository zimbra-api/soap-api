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
 * CreateLDAPEntry request class
 * Create an LDAP entry.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateLDAPEntry extends BaseAttr
{
    /**
     * Constructor method for CreateLDAPEntry
     * @param string $dn A valid LDAP DN String (RFC 2253) that describes the new DN to create
     * @param array  $attrs
     * @return self
     */
    public function __construct($dn, array $attrs = [])
    {
        parent::__construct($attrs);
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
