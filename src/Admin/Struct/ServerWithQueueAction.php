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
 * ServerWithQueueAction struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ServerWithQueueAction
{
    /**
     * Mail queue query details
     * 
     * @Accessor(getter="getQueue", setter="setQueue")
     * @SerializedName("queue")
     * @Type("Zimbra\Admin\Struct\MailQueueWithAction")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var MailQueueWithAction
     */
    #[Accessor(getter: 'getQueue', setter: 'setQueue')]
    #[SerializedName(name: 'queue')]
    #[Type(name: MailQueueWithAction::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $queue;

    /**
     * MTA Server
     * 
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName(name: 'name')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $name;

    /**
     * Constructor
     * 
     * @param  MailQueueWithAction $queue
     * @param  string $name
     * @return self
     */
    public function __construct(MailQueueWithAction $queue, string $name = '')
    {
        $this->setQueue($queue)
             ->setName($name);
    }

    /**
     * Get the queue.
     *
     * @return MailQueueWithAction
     */
    public function getQueue(): MailQueueWithAction
    {
        return $this->queue;
    }

    /**
     * Set the queue.
     *
     * @param  MailQueueWithAction $queue
     * @return self
     */
    public function setQueue(MailQueueWithAction $queue): self
    {
        $this->queue = $queue;
        return $this;
    }

    /**
     * Get the name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
}
