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
use Zimbra\Soap\Struct\DomainSelector as Domain;
use Zimbra\Soap\Struct\PrincipalSelector as Principal;

/**
 * AutoProvAccount class
 * Auto-provision an account.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AutoProvAccount extends Request
{
    /**
     * The domain
     * @var DomainSelector
     */
    private $_domain;

    /**
     * The principal
     * @var PrincipalSelector
     */
    private $_principal;

    /**
     * The password
     * @var string
     */
    private $_password;

    /**
     * Constructor method for AutoProvAccount
     * @param Domain $domain
     * @param Principal $principal
     * @param string $password
     * @return self
     */
    public function __construct(Domain $domain, Principal $principal , $password = null)
    {
        parent::__construct();
        $this->_domain = $domain;
        $this->_principal = $principal;
        $this->_password = trim($password);
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
            return $this->_domain;
        }
        $this->_domain = $domain;
        return $this;
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
            return $this->_principal;
        }
        $this->_principal = $principal;
        return $this;
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
            return $this->_password;
        }
        $this->_password = trim($password);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = $this->_domain->toArray();
        $this->array += $this->_principal->toArray();
        if(!empty($this->_password))
        {
            $this->array['password'] = $this->_password;
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_domain->toXml())
                  ->append($this->_principal->toXml());
        if(!empty($this->_password))
        {
            $this->xml->addChild('password', $this->_password);
        }
        return parent::toXml();
    }
}
