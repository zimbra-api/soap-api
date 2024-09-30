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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Admin\Struct\{DomainSelector, PrincipalSelector};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * AutoProvAccountRequest class
 * Auto-provision an account
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AutoProvAccountRequest extends SoapRequest
{
    /**
     * The domain
     *
     * @var DomainSelector
     */
    #[Accessor(getter: "getDomain", setter: "setDomain")]
    #[SerializedName("domain")]
    #[Type(DomainSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private DomainSelector $domain;

    /**
     * The principal
     *
     * @var PrincipalSelector
     */
    #[Accessor(getter: "getPrincipal", setter: "setPrincipal")]
    #[SerializedName("principal")]
    #[Type(PrincipalSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private PrincipalSelector $principal;

    /**
     * Password
     *
     * @var string
     */
    #[Accessor(getter: "getPassword", setter: "setPassword")]
    #[SerializedName("password")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAdmin")]
    private $password;

    /**
     * Constructor
     *
     * @param DomainSelector $domain
     * @param PrincipalSelector $principal
     * @param string  $password
     * @return self
     */
    public function __construct(
        DomainSelector $domain,
        PrincipalSelector $principal,
        ?string $password = null
    ) {
        $this->setDomain($domain)->setPrincipal($principal);
        if (null !== $password) {
            $this->setPassword($password);
        }
    }

    /**
     * Get the domain.
     *
     * @return DomainSelector
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set the domain.
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
     * Get the principal.
     *
     * @return PrincipalSelector
     */
    public function getPrincipal()
    {
        return $this->principal;
    }

    /**
     * Set the principal.
     *
     * @param  PrincipalSelector $principal
     * @return self
     */
    public function setPrincipal(PrincipalSelector $principal): self
    {
        $this->principal = $principal;
        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set password
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new AutoProvAccountEnvelope(new AutoProvAccountBody($this));
    }
}
