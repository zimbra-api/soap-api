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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ContactBackupRequest request class
 * start/stop contact backup
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ContactBackupRequest extends SoapRequest
{
    /**
     * List of servers
     * 
     * @Accessor(getter="getServers", setter="setServers")
     * @SerializedName("servers")
     * @Type("array<Zimbra\Admin\Struct\ServerSelector>")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @XmlList(inline=false, entry="server", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getServers', setter: 'setServers')]
    #[SerializedName(name: 'servers')]
    #[Type(name: 'array<Zimbra\Admin\Struct\ServerSelector>')]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    #[XmlList(inline: false, entry: 'server', namespace: 'urn:zimbraAdmin')]
    private $servers = [];

    /**
     * op can be either start or stop
     * 
     * @Accessor(getter="getOp", setter="setOp")
     * @SerializedName("op")
     * @Type("Enum<Zimbra\Common\Enum\ContactBackupOp>")
     * @XmlAttribute
     * 
     * @var ContactBackupOp
     */
    #[Accessor(getter: 'getOp', setter: 'setOp')]
    #[SerializedName(name: 'op')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\ContactBackupOp>')]
    #[XmlAttribute]
    private $op;

    /**
     * Constructor
     * 
     * @param  array $servers
     * @param  ContactBackupOp $op
     * @return self
     */
    public function __construct(array $servers = [], ?ContactBackupOp $op = NULL)
    {
        $this->setServers($servers)
             ->setOp($op ?? new ContactBackupOp('start'));
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
     * Get operation
     *
     * @return ContactBackupOp
     */
    public function getOp(): ContactBackupOp
    {
        return $this->op;
    }

    /**
     * Set operation
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ContactBackupEnvelope(
            new ContactBackupBody($this)
        );
    }
}
