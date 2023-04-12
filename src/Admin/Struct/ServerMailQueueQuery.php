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
 * ServerMailQueueQuery struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ServerMailQueueQuery
{
    /**
     * Mail queue query details
     * 
     * @var MailQueueQuery
     */
    #[Accessor(getter: 'getQueue', setter: 'setQueue')]
    #[SerializedName('queue')]
    #[Type(MailQueueQuery::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private MailQueueQuery $queue;

    /**
     * MTA Server
     * 
     * @var string
     */
    #[Accessor(getter: 'getServerName', setter: 'setServerName')]
    #[SerializedName('name')]
    #[Type('string')]
    #[XmlAttribute]
    private $serverName;

    /**
     * Constructor
     * 
     * @param  MailQueueQuery $queue
     * @param  string $name
     * @return self
     */
    public function __construct(MailQueueQuery $queue, string $name = '')
    {
        $this->setQueue($queue)
             ->setServerName($name);
    }

    /**
     * Get the mail queue query details.
     *
     * @return MailQueueQuery
     */
    public function getQueue(): MailQueueQuery
    {
        return $this->queue;
    }

    /**
     * Set the mail queue query details.
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
