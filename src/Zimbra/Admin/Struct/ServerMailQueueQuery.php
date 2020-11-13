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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};

/**
 * ServerMailQueueQuery struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="server")
 */
class ServerMailQueueQuery
{
    /**
     * @Accessor(getter="getQueue", setter="setQueue")
     * @SerializedName("queue")
     * @Type("Zimbra\Admin\Struct\MailQueueQuery")
     * @XmlElement
     */
    private $queue;

    /**
     * @Accessor(getter="getServerName", setter="setServerName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $serverName;

    /**
     * Constructor method for ServerMailQueueQuery
     * @param  MailQueueQuery $query Mail queue query details
     * @param  string $name MTA Server
     * @return self
     */
    public function __construct(MailQueueQuery $queue, $name)
    {
        $this->setQueue($queue)
             ->setServerName($name);
    }

    /**
     * Gets the mail queue query details.
     *
     * @return MailQueueQuery
     */
    public function getQueue(): MailQueueQuery
    {
        return $this->queue;
    }

    /**
     * Sets the mail queue query details.
     *
     * @param  MailQueueQuery $queue
     * @return self
     */
    public function setQueue(MailQueueQuery $queue): self
    {
        $this->queue = $queue;
        return $this;
    }

    /**
     * Gets the MTA Server
     *
     * @return string
     */
    public function getServerName(): string
    {
        return $this->serverName;
    }

    /**
     * Sets the MTA Server
     *
     * @param  string $name
     * @return self
     */
    public function setServerName($name): self
    {
        $this->serverName = trim($name);
        return $this;
    }
}
