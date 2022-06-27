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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class MailQueueQuery
{
    /**
     * Query
     * @Accessor(getter="getQuery", setter="setQuery")
     * @SerializedName("query")
     * @Type("Zimbra\Admin\Struct\QueueQuery")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private QueueQuery $query;

    /**
     * Queue name
     * @Accessor(getter="getQueueName", setter="setQueueName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $queueName;

    /**
     * To fora a queue scan, set this to 1 (true)
     * @Accessor(getter="getScan", setter="setScan")
     * @SerializedName("scan")
     * @Type("bool")
     * @XmlAttribute
     */
    private $scan;

    /**
     * Maximum time to wait for the scan to complete in seconds (default 3)
     * @Accessor(getter="getWaitSeconds", setter="setWaitSeconds")
     * @SerializedName("wait")
     * @Type("integer")
     * @XmlAttribute
     */
    private $waitSeconds;

    /**
     * Constructor method for MailQueueQuery
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
     * Gets query.
     *
     * @return QueueQuery
     */
    public function getQuery(): QueueQuery
    {
        return $this->query;
    }

    /**
     * Sets query.
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
     * Gets the the queue name
     *
     * @return string
     */
    public function getQueueName(): string
    {
        return $this->queueName;
    }

    /**
     * Sets the queue name
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
     * Gets queue scan
     *
     * @return bool
     */
    public function getScan(): ?bool
    {
        return $this->scan;
    }

    /**
     * Sets queue scan
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
     * Gets the time to wait
     *
     * @return int
     */
    public function getWaitSeconds(): ?int
    {
        return $this->waitSeconds;
    }

    /**
     * Sets the time to wait
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
