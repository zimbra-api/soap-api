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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};

/**
 * ServerMailQueueDetails struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ServerMailQueueDetails
{
    /**
     * Mail queue details
     * @Accessor(getter="getQueue", setter="setQueue")
     * @SerializedName("queue")
     * @Type("Zimbra\Admin\Struct\MailQueueDetails")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private MailQueueDetails $queue;

    /**
     * MTA Server
     * @Accessor(getter="getServerName", setter="setServerName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $serverName;

    /**
     * Constructor method for ServerMailQueueDetails
     * @param  MailQueueDetails $queue
     * @param  string $name
     * @return self
     */
    public function __construct(MailQueueDetails $queue, string $name = '')
    {
        $this->setQueue($queue)
             ->setServerName($name);
    }

    /**
     * Get mail queue details.
     *
     * @return MailQueueDetails
     */
    public function getQueue(): MailQueueDetails
    {
        return $this->queue;
    }

    /**
     * Set mail queue details.
     *
     * @param  MailQueueDetails $queue
     * @return self
     */
    public function setQueue(MailQueueDetails $queue): self
    {
        $this->queue = $queue;
        return $this;
    }

    /**
     * Get the MTA Server
     *
     * @return string
     */
    public function getServerName(): string
    {
        return $this->serverName;
    }

    /**
     * Set the MTA Server
     *
     * @param  string $name
     * @return self
     */
    public function setServerName(string $name): self
    {
        $this->serverName = $name;
        return $this;
    }
}
