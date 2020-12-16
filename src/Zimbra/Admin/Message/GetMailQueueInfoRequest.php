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
use Zimbra\Struct\NamedElement as Server;
use Zimbra\Soap\Request;

/**
 * GetMailQueueInfoRequest request class
 * Get a count of all the mail queues by counting the number of files in the queue directories.
 * Note that the admin server waits for queue counting to complete before responding - client should invoke requests for different servers in parallel.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetMailQueueInfoRequest")
 */
class GetMailQueueInfoRequest extends Request
{
    /**
     * MTA Server
     * @Accessor(getter="getServer", setter="setServer")
     * @SerializedName("server")
     * @Type("Zimbra\Struct\NamedElement")
     * @XmlElement
     */
    private $server;

    /**
     * Constructor method for GetMailQueueInfoRequest
     *
     * @param  Server $server
     * @return self
     */
    public function __construct(Server $server)
    {
        $this->setServer($server);
    }

    /**
     * Gets the server.
     *
     * @return Server
     */
    public function getServer(): Server
    {
        return $this->server;
    }

    /**
     * Sets the server.
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
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetMailQueueInfoEnvelope)) {
            $this->envelope = new GetMailQueueInfoEnvelope(
                new GetMailQueueInfoBody($this)
            );
        }
    }
}
