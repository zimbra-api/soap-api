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
use Zimbra\Admin\Struct\{DomainSelector, ServerSelector};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetAllAccountsRequest request class
 * Get All accounts matching the selectin criteria
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAllAccountsRequest extends SoapRequest
{
    /**
     * Server
     *
     * @Accessor(getter="getServer", setter="setServer")
     * @SerializedName("server")
     * @Type("Zimbra\Admin\Struct\ServerSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var ServerSelector
     */
    #[Accessor(getter: "getServer", setter: "setServer")]
    #[SerializedName("server")]
    #[Type(ServerSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?ServerSelector $server;

    /**
     * Domain
     *
     * @Accessor(getter="getDomain", setter="setDomain")
     * @SerializedName("domain")
     * @Type("Zimbra\Admin\Struct\DomainSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var DomainSelector
     */
    #[Accessor(getter: "getDomain", setter: "setDomain")]
    #[SerializedName("domain")]
    #[Type(DomainSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?DomainSelector $domain;

    /**
     * Constructor
     *
     * @param  ServerSelector $server
     * @param  DomainSelector $domain
     * @return self
     */
    public function __construct(
        ?ServerSelector $server = null,
        ?DomainSelector $domain = null
    ) {
        $this->server = $server;
        $this->domain = $domain;
    }

    /**
     * Get the server.
     *
     * @return ServerSelector
     */
    public function getServer(): ?ServerSelector
    {
        return $this->server;
    }

    /**
     * Set the server.
     *
     * @param  ServerSelector $server
     * @return self
     */
    public function setServer(ServerSelector $server): self
    {
        $this->server = $server;
        return $this;
    }

    /**
     * Set the domain.
     *
     * @return DomainSelector
     */
    public function getDomain(): ?DomainSelector
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetAllAccountsEnvelope(new GetAllAccountsBody($this));
    }
}
