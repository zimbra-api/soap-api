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
use Zimbra\Common\Struct\{NamedElement, SoapEnvelopeInterface, SoapRequest};

/**
 * GetMailQueueInfoRequest request class
 * Get a count of all the mail queues by counting the number of files in the queue directories.
 * Note that the admin server waits for queue counting to complete before responding - client should invoke requests for different servers in parallel.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetMailQueueInfoRequest extends SoapRequest
{
    /**
     * MTA Server
     * 
     * @Accessor(getter="getServer", setter="setServer")
     * @SerializedName("server")
     * @Type("Zimbra\Common\Struct\NamedElement")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var NamedElement
     */
    #[Accessor(getter: 'getServer', setter: 'setServer')]
    #[SerializedName('server')]
    #[Type(NamedElement::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $server;

    /**
     * Constructor
     *
     * @param  NamedElement $server
     * @return self
     */
    public function __construct(NamedElement $server)
    {
        $this->setServer($server);
    }

    /**
     * Get the server.
     *
     * @return NamedElement
     */
    public function getServer(): NamedElement
    {
        return $this->server;
    }

    /**
     * Set the server.
     *
     * @param  NamedElement $server
     * @return self
     */
    public function setServer(NamedElement $server): self
    {
        $this->server = $server;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetMailQueueInfoEnvelope(
            new GetMailQueueInfoBody($this)
        );
    }
}
