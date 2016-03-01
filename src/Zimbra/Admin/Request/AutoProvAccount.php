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

use Zimbra\Admin\Struct\DomainSelector as Domain;
use Zimbra\Admin\Struct\PrincipalSelector as Principal;

/**
 * AutoProvAccount request class
 * Auto-provision an domain.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AutoProvAccount extends Base
{
    /**
     * Constructor method for AutoProvAccount
     * @param Domain $domain The domain
     * @param Principal $principal The principal
     * @param string $password The password
     * @return self
     */
    public function __construct(Domain $domain, Principal $principal , $password = null)
    {
        parent::__construct();
        $this->setChild('domain', $domain);
        $this->setChild('principal', $principal);
        if(null !== $password)
        {
            $this->setChild('password', trim($password));
        }
    }

    /**
     * Gets the domain.
     *
     * @return Domain
     */
    public function getDomain()
    {
        return $this->getChild('domain');
    }

    /**
     * Sets the domain.
     *
     * @param  Domain $domain
     * @return self
     */
    public function setDomain(Domain $domain)
    {
        return $this->setChild('domain', $domain);
    }

    /**
     * Gets the principal.
     *
     * @return Principal
     */
    public function getPrincipal()
    {
        return $this->getChild('principal');
    }

    /**
     * Sets the principal.
     *
     * @param  Principal $principal
     * @return self
     */
    public function setPrincipal(Principal $principal)
    {
        return $this->setChild('principal', $principal);
    }

    /**
     * Gets password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->getChild('password');
    }

    /**
     * Sets password
     *
     * @param  string $password
     * @return self
     */
    public function setPassword($password)
    {
        return $this->setChild('password', trim($password));
    }
}
