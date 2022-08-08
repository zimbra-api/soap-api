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
use Zimbra\Admin\Struct\ServerWithQueueAction as Server;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * MailQueueActionRequest request class
 * Command to act on invidual queue files. This proxies through to postsuper.
 * list-of-ids can be ALL.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MailQueueActionRequest extends SoapRequest
{
    /**
     * Server with queue action
     * 
     * @Accessor(getter="getServer", setter="setServer")
     * @SerializedName("server")
     * @Type("Zimbra\Admin\Struct\ServerWithQueueAction")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @var Server
     */
    private $server;

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
     * Set the server.
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
        return new MailQueueActionEnvelope(
            new MailQueueActionBody($this)
        );
    }
}
