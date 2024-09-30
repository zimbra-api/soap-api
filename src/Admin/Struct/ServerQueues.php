<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlList
};

/**
 * ServerQueues struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ServerQueues
{
    /**
     * MTA server
     *
     * @Accessor(getter="getServerName", setter="setServerName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getServerName", setter: "setServerName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private $serverName;

    /**
     * Queue information
     *
     * @Accessor(getter="getQueues", setter="setQueues")
     * @Type("array<Zimbra\Admin\Struct\MailQueueCount>")
     * @XmlList(inline=true, entry="queue", namespace="urn:zimbraAdmin")
     *
     * @var array
     */
    #[Accessor(getter: "getQueues", setter: "setQueues")]
    #[Type("array<Zimbra\Admin\Struct\MailQueueCount>")]
    #[XmlList(inline: true, entry: "queue", namespace: "urn:zimbraAdmin")]
    private $queues = [];

    /**
     * Constructor
     *
     * @param  string $serverName
     * @param  array  $queues
     * @return self
     */
    public function __construct(string $serverName = "", array $queues = [])
    {
        $this->setServerName($serverName)->setQueues($queues);
    }

    /**
     * Get ID
     *
     * @return string
     */
    public function getServerName(): string
    {
        return $this->serverName;
    }

    /**
     * Set ID
     *
     * @param  string $serverName
     * @return self
     */
    public function setServerName(string $serverName): self
    {
        $this->serverName = $serverName;
        return $this;
    }

    /**
     * Set queues
     *
     * @param array $queues
     * @return self
     */
    public function setQueues(array $queues): self
    {
        $this->queues = array_filter(
            $queues,
            static fn($queue) => $queue instanceof MailQueueCount
        );
        return $this;
    }

    /**
     * Get queues
     *
     * @return array
     */
    public function getQueues(): array
    {
        return $this->queues;
    }
}
