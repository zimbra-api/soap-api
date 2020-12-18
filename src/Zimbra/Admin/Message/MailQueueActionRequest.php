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
use Zimbra\Admin\Struct\ServerWithQueueAction as Server;
use Zimbra\Soap\Request;

/**
 * MailQueueActionRequest request class
 * Command to act on invidual queue files. This proxies through to postsuper.
 * list-of-ids can be ALL.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="MailQueueActionRequest")
 */
class MailQueueActionRequest extends Request
{
    /**
     * Server with queue action
     * @Accessor(getter="getServer", setter="setServer")
     * @SerializedName("server")
     * @Type("Zimbra\Admin\Struct\ServerWithQueueAction")
     * @XmlElement
     */
    private $server;

    /**
     * Constructor method for MailQueueActionRequest
     *
     * @param  Server $server
     * @param  LockoutOperation $operation
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
        if (!($this->envelope instanceof MailQueueActionEnvelope)) {
            $this->envelope = new MailQueueActionEnvelope(
                new MailQueueActionBody($this)
            );
        }
    }
}
