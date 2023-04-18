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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlList};
use Zimbra\Admin\Struct\ContactBackupServer;
use Zimbra\Common\Struct\SoapResponse;

/**
 * ContactBackupResponse class
 * response for start/stop contact backup
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ContactBackupResponse extends SoapResponse
{
    /**
     * List of mailbox ids
     * 
     * @Accessor(getter="getServers", setter="setServers")
     * @SerializedName("servers")
     * @Type("array<Zimbra\Admin\Struct\ContactBackupServer>")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @XmlList(inline=false, entry="server", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getServers', setter: 'setServers')]
    #[SerializedName('servers')]
    #[Type('array<Zimbra\Admin\Struct\ContactBackupServer>')]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    #[XmlList(inline: false, entry: 'server', namespace: 'urn:zimbraAdmin')]
    private $servers = [];

    /**
     * Constructor
     *
     * @param array $servers
     * @return self
     */
    public function __construct(array $servers = [])
    {
        $this->setServers($servers);
    }

    /**
     * Get the servers.
     *
     * @return array
     */
    public function getServers(): array
    {
        return $this->servers;
    }

    /**
     * Set the servers.
     *
     * @param  array $servers
     * @return self
     */
    public function setServers(array $servers): self
    {
        $this->servers = array_filter(
            $servers, static fn ($server) => $server instanceof ContactBackupServer
        );
        return $this;
    }
}
