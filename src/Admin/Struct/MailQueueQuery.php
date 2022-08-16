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
 * MailQueueQuery struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MailQueueQuery
{
    /**
     * Query
     * 
     * @var QueueQuery
     */
    #[Accessor(getter: 'getQuery', setter: 'setQuery')]
    #[SerializedName(name: 'query')]
    #[Type(name: QueueQuery::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $query;

    /**
     * Queue name
     * 
     * @var string
     */
    #[Accessor(getter: 'getQueueName', setter: 'setQueueName')]
    #[SerializedName(name: 'name')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $queueName;

    /**
     * To fora a queue scan, set this to 1 (true)
     * 
     * @var bool
     */
    #[Accessor(getter: 'getScan', setter: 'setScan')]
    #[SerializedName(name: 'scan')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $scan;

    /**
     * Maximum time to wait for the scan to complete in seconds (default 3)
     * 
     * @var int
     */
    #[Accessor(getter: 'getWaitSeconds', setter: 'setWaitSeconds')]
    #[SerializedName(name: 'wait')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $waitSeconds;

    /**
     * Constructor
     * 
     * @param  QueueQuery $query
     * @param  string $name
     * @param  bool $scan
     * @param  int $wait
     * @return self
     */
    public function __construct(
        QueueQuery $query, string $name = '', ?bool $scan = NULL, ?int $wait = NULL
    )
    {
        $this->setQuery($query)
             ->setQueueName($name);
        if (NULL !== $scan) {
            $this->setScan($scan);
        }
        if (NULL !== $wait) {
            $this->setWaitSeconds($wait);
        }
    }

    /**
     * Get query.
     *
     * @return QueueQuery
     */
    public function getQuery(): QueueQuery
    {
        return $this->query;
    }

    /**
     * Set query.
     *
     * @param  QueueQuery $query
     * @return self
     */
    public function setQuery(QueueQuery $query)
    {
        $this->query = $query;
        return $this;
    }

    /**
     * Get the the queue name
     *
     * @return string
     */
    public function getQueueName(): string
    {
        return $this->queueName;
    }

    /**
     * Set the queue name
     *
     * @param  string $name
     * @return self
     */
    public function setQueueName(string $name)
    {
        $this->queueName = $name;
        return $this;
    }

    /**
     * Get queue scan
     *
     * @return bool
     */
    public function getScan(): ?bool
    {
        return $this->scan;
    }

    /**
     * Set queue scan
     *
     * @param  bool $scan
     * @return self
     */
    public function setScan(bool $scan)
    {
        $this->scan = $scan;
        return $this;
    }

    /**
     * Get the time to wait
     *
     * @return int
     */
    public function getWaitSeconds(): ?int
    {
        return $this->waitSeconds;
    }

    /**
     * Set the time to wait
     *
     * @param  int $wait
     * @return self
     */
    public function setWaitSeconds(int $wait)
    {
        $this->waitSeconds = $wait;
        return $this;
    }
}
