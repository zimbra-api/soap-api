<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * ServerMailQueueQuery struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
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
    private $_queue;

    /**
     * @Accessor(getter="getServerName", setter="setServerName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $_serverName;

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
    public function getQueue()
    {
        return $this->_queue;
    }

    /**
     * Sets the mail queue query details.
     *
     * @param  MailQueueQuery $queue
     * @return self
     */
    public function setQueue(MailQueueQuery $queue)
    {
        $this->_queue = $queue;
        return $this;
    }

    /**
     * Gets the MTA Server
     *
     * @return string
     */
    public function getServerName()
    {
        return $this->_serverName;
    }

    /**
     * Sets the MTA Server
     *
     * @param  string $name
     * @return self
     */
    public function setServerName($name)
    {
        $this->_serverName = trim($name);
        return $this;
    }
}
