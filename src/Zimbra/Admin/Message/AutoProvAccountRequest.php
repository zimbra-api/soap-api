<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\{DomainSelector, PrincipalSelector};
use Zimbra\Soap\Request;

/**
 * AutoProvAccountRequest class
 * Auto-provision an account
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="AutoProvAccountRequest")
 */
class AutoProvAccountRequest extends Request
{
    /**
     * Domain
     * @Accessor(getter="getDomain", setter="setDomain")
     * @SerializedName("domain")
     * @Type("Zimbra\Admin\Struct\DomainSelector")
     * @XmlElement
     */
    private $domain;

    /**
     * Principal
     * @Accessor(getter="getPrincipal", setter="setPrincipal")
     * @SerializedName("principal")
     * @Type("Zimbra\Admin\Struct\PrincipalSelector")
     * @XmlElement
     */
    private $principal;

    /**
     * Password
     * @Accessor(getter="getPassword", setter="setPassword")
     * @SerializedName("password")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $password;

    /**
     * Constructor method for AutoProvAccountRequest
     * @param DomainSelector $domain The domain
     * @param PrincipalSelector $principal The principal
     * @param string  $password Password
     * @return self
     */
    public function __construct(
        DomainSelector $domain,
        PrincipalSelector $principal,
        ?string $password = NULL
    )
    {
        $this->setDomain($domain)
        	 ->setPrincipal($principal);
        if (NULL !== $password){
            $this->setPassword($password);
        }
    }

    /**
     * Gets the domain.
     *
     * @return DomainSelector
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Sets the domain.
     *
     * @param  DomainSelector $domain
     * @return self
     */
    public function setDomain(DomainSelector $domain): self
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * Gets the principal.
     *
     * @return PrincipalSelector
     */
    public function getPrincipal()
    {
        return $this->principal;
    }

    /**
     * Sets the principal.
     *
     * @param  Account $principal
     * @return self
     */
    public function setPrincipal(PrincipalSelector $principal): self
    {
        $this->principal = $principal;
        return $this;
    }

    /**
     * Gets password
     *
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Sets password
     *
     * @param  string $password
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof AutoProvAccountEnvelope)) {
            $this->envelope = new AutoProvAccountEnvelope(
                new AutoProvAccountBody($this)
            );
        }
    }
}
