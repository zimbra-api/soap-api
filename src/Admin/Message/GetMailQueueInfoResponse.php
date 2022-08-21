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
use Zimbra\Admin\Struct\ServerQueues as Server;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetMailQueueInfoResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetMailQueueInfoResponse extends SoapResponse
{
    /**
     * Information on queues organised by server
     * 
     * @Accessor(getter="getServer", setter="setServer")
     * @SerializedName("server")
     * @Type("Zimbra\Admin\Struct\ServerQueues")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var Server
     */
    #[Accessor(getter: 'getServer', setter: 'setServer')]
    #[SerializedName('server')]
    #[Type(Server::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private ?Server $server;

    /**
     * Constructor
     *
     * @param Server $server
     * @return self
     */
    public function __construct(?Server $server = NULL)
    {
        $this->server = $server;
    }

    /**
     * Get the server
     *
     * @return Server
     */
    public function getServer(): ?Server
    {
        return $this->server;
    }

    /**
     * Set server
     *
     * @param  Server $server
     * @return self
     */
    public function setServer(Server $server): self
    {
        $this->server = $server;
        return $this;
    }
}
