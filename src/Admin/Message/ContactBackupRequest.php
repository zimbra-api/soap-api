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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Admin\Struct\ServerSelector;
use Zimbra\Common\Enum\ContactBackupOp  as Operation;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * ContactBackupRequest request class
 * start/stop contact backup
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ContactBackupRequest extends Request
{
    /**
     * List of servers
     * @Accessor(getter="getServers", setter="setServers")
     * @SerializedName("servers")
     * @Type("array<Zimbra\Admin\Struct\ServerSelector>")
     * @XmlList(inline=false, entry="server", namespace="urn:zimbraAdmin")
     */
    private $servers = [];

    /**
     * op can be either start or stop
     * @Accessor(getter="getOp", setter="setOp")
     * @SerializedName("op")
     * @Type("Zimbra\Common\Enum\ContactBackupOp")
     * @XmlAttribute
     */
    private Operation $op;

    /**
     * Constructor method for ContactBackupRequest
     * 
     * @param  array $servers
     * @param  Operation $op
     * @return self
     */
    public function __construct(array $servers, Operation $op)
    {
        $this->setServers($servers)
             ->setOp($op);
    }

    /**
     * Gets the servers.
     *
     * @return array
     */
    public function getServers(): array
    {
        return $this->servers;
    }

    /**
     * Sets the servers.
     *
     * @param  array $servers
     * @return self
     */
    public function setServers(array $servers): self
    {
        $this->servers = array_filter($servers, static fn ($server) => $server instanceof ServerSelector);
        return $this;
    }

    /**
     * Add server.
     *
     * @param  ServerSelector $server
     * @return self
     */
    public function addServer(ServerSelector $server)
    {
        $this->servers[] = $server;
        return $this;
    }

    /**
     * Gets operation
     *
     * @return Operation
     */
    public function getOp(): Operation
    {
        return $this->op;
    }

    /**
     * Sets operation
     *
     * @param  Operation $op
     * @return self
     */
    public function setOp(Operation $op): self
    {
        $this->op = $op;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new ContactBackupEnvelope(
            new ContactBackupBody($this)
        );
    }
}
