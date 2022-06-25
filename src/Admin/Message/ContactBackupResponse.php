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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Admin\Struct\ContactBackupServer;
use Zimbra\Soap\ResponseInterface;

/**
 * ContactBackupResponse class
 * response for start/stop contact backup
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ContactBackupResponse implements ResponseInterface
{
    /**
     * List of mailbox ids
     * @Accessor(getter="getServers", setter="setServers")
     * @SerializedName("servers")
     * @Type("array<Zimbra\Admin\Struct\ContactBackupServer>")
     * @XmlList(inline = false, entry = "server")
     */
    private $servers = [];

    /**
     * Constructor method for ContactBackupResponse
     *
     * @param array $servers
     * @return self
     */
    public function __construct(array $servers)
    {
        $this->setServers($servers);
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
        $this->servers = array_filter($servers, static fn ($server) => $server instanceof ContactBackupServer);
        return $this;
    }

    /**
     * Add server.
     *
     * @param  ContactBackupServer $server
     * @return self
     */
    public function addServer(ContactBackupServer $server): self
    {
        $this->servers[] = $server;
        return $this;
    }
}
