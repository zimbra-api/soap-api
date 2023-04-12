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
use Zimbra\Admin\Struct\ServerMailQueueQuery as Server;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetMailQueueRequest request class
 * Summarize and/or search a particular mail queue on a particular server.
 * 
 * The admin SOAP server initiates a MTA queue scan (via ssh) and then caches the result of the queue scan.
 * To force a queue scan, specify scan=1 in the request. 
 * 
 * The response has two parts.
 *  - <qs> elements summarize queue by various types of data (sender addresses, recipient domain, etc).
 *    Only the deferred queue has error summary type.
 *  - <qi> elements list the various queue items that match the requested query.
 * The stale-flag in the response means that since the scan, some queue action was done and the data being presented is now stale.
 * This allows us to let the user dictate when to do a queue scan.
 *
 * The scan-flag in the response indicates that the server has not completed scanning the MTA queue,
 * and that this scan is in progress, and the client should ask again in a little while. 
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetMailQueueRequest extends SoapRequest
{
    /**
     * Server Mail Queue Query
     * 
     * @var Server
     */
    #[Accessor(getter: 'getServer', setter: 'setServer')]
    #[SerializedName('server')]
    #[Type(Server::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private Server $server;

    /**
     * Constructor
     *
     * @param  Server $server
     * @return self
     */
    public function __construct(Server $server)
    {
        $this->setServer($server);
    }

    /**
     * Get the server.
     *
     * @return Server
     */
    public function getServer(): Server
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetMailQueueEnvelope(
            new GetMailQueueBody($this)
        );
    }
}
