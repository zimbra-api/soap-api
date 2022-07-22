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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};
use Zimbra\Admin\Struct\ServerSelector;
use Zimbra\Common\Enum\ContactBackupOp;
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

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
     * @XmlElement(namespace="urn:zimbraAdmin")
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
    private ContactBackupOp $op;

    /**
     * Constructor method for ContactBackupRequest
     * 
     * @param  array $servers
     * @param  ContactBackupOp $op
     * @return self
     */
    public function __construct(array $servers = [], ?ContactBackupOp $op = NULL)
    {
        $this->setServers($servers)
             ->setOp($op ?? ContactBackupOp::START());
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
     * @return ContactBackupOp
     */
    public function getOp(): ContactBackupOp
    {
        return $this->op;
    }

    /**
     * Sets operation
     *
     * @param  ContactBackupOp $op
     * @return self
     */
    public function setOp(ContactBackupOp $op): self
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
