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
 * MailQueueFlushRequest request class
 * Command to invoke postqueue -f.  All queues cached in the server are stale after
 * invoking this because this is a global operation to all the queues in a given server.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="MailQueueFlushRequest")
 */
class MailQueueFlushRequest extends Request
{
    /**
     * Mta server
     * @Accessor(getter="getServer", setter="setServer")
     * @SerializedName("server")
     * @Type("Zimbra\Struct\NamedElement")
     * @XmlElement
     */
    private $server;

    /**
     * Constructor method for MailQueueFlushRequest
     *
     * @param  Server $server
     * @return self
     */
    public function __construct(Server $server)
    {
        $this->setServer($server);
    }

    /**
     * Sets the server.
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
        if (!($this->envelope instanceof MailQueueFlushEnvelope)) {
            $this->envelope = new MailQueueFlushEnvelope(
                new MailQueueFlushBody($this)
            );
        }
    }
}
