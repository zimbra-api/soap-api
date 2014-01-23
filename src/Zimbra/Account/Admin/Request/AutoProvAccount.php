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
use Zimbra\Soap\Request;

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
class AutoProvAccount extends Request
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
        $this->child('domain', $domain);
        $this->child('principal', $principal);
        if(null !== $password)
        {
            $this->child('password', trim($password));
        }
    }

    /**
     * Gets or sets domain
     *
     * @param  Domain $domain
     * @return Domain|self
     */
    public function domain(Domain $domain = null)
    {
        if(null === $domain)
        {
            return $this->child('domain');
        }
        return $this->child('domain', $domain);
    }

    /**
     * Gets or sets principal
     *
     * @param  Principal $principal
     * @return Principal|self
     */
    public function principal(Principal $principal = null)
    {
        if(null === $principal)
        {
            return $this->child('principal');
        }
        return $this->child('principal', $principal);
    }

    /**
     * Gets or sets password
     *
     * @param  string $password
     * @return string|self
     */
    public function password($password = null)
    {
        if(null === $password)
        {
            return $this->child('password');
        }
        return $this->child('password', trim($password));
    }
}
