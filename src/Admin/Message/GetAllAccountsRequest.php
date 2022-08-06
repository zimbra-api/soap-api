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
use Zimbra\Admin\Struct\DomainSelector as Domain;
use Zimbra\Admin\Struct\ServerSelector as Server;
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
     */
    private ?Server $server = NULL;

    /**
     * Domain
     * 
     * @Accessor(getter="getDomain", setter="setDomain")
     * @SerializedName("domain")
     * @Type("Zimbra\Admin\Struct\DomainSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?Domain $domain = NULL;

    /**
     * Constructor
     * 
     * @param  Server $server
     * @param  Domain $domain
     * @return self
     */
    public function __construct(?Server $server = NULL, ?Domain $domain = NULL)
    {
        if ($server instanceof Server) {
            $this->setServer($server);
        }
        if ($domain instanceof Domain) {
            $this->setDomain($domain);
        }
    }

    /**
     * Get the server.
     *
     * @return Server
     */
    public function getServer(): ?Server
    {
        return $this->server;
    }

    /**
     * Set the server.
     *
     * @param  Server $server
     * @return self
     */
    public function setServer(Server $server): self
    {
        $this->server = $server;
        return $this;
    }

    /**
     * Set the domain.
     *
     * @return Domain
     */
    public function getDomain(): ?Domain
    {
        return $this->domain;
    }

    /**
     * Set the domain.
     *
     * @param  Domain $domain
     * @return self
     */
    public function setDomain(Domain $domain): self
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetAllAccountsEnvelope(
            new GetAllAccountsBody($this)
        );
    }
}
