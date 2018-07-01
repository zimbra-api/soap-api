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
 * MailQueueQuery struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="queue")
 */
class MailQueueQuery
{
    /**
     * @Accessor(getter="getQuery", setter="setQuery")
     * @SerializedName("query")
     * @Type("Zimbra\Admin\Struct\QueueQuery")
     * @XmlElement
     */
    private $_query;

    /**
     * @Accessor(getter="getQueueName", setter="setQueueName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $_queueName;

    /**
     * @Accessor(getter="getScan", setter="setScan")
     * @SerializedName("scan")
     * @Type("bool")
     * @XmlAttribute
     */
    private $_scan;

    /**
     * @Accessor(getter="getWaitSeconds", setter="setWaitSeconds")
     * @SerializedName("wait")
     * @Type("integer")
     * @XmlAttribute
     */
    private $_waitSeconds;

    /**
     * Constructor method for MailQueueQuery
     * @param  QueueQuery $query Query
     * @param  string $name Queue name
     * @param  bool $scan To fora a queue scan, set this to 1 (true)
     * @param  int $wait Maximum time to wait for the scan to complete in seconds (default 3)
     * @return self
     */
    public function __construct(QueueQuery $query, $name, $scan = NULL, $wait = NULL)
    {
        $this->setQuery($query);
        $this->setQueueName($name);
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
    public function getQuery()
    {
        return $this->_query;
    }

    /**
     * Sets query.
     *
     * @param  QueueQuery $query
     * @return self
     */
    public function setQuery(QueueQuery $query)
    {
        $this->_query = $query;
        return $this;
    }

    /**
     * Gets the the queue name
     *
     * @return string
     */
    public function getQueueName()
    {
        return $this->_queueName;
    }

    /**
     * Sets the queue name
     *
     * @param  string $name
     * @return self
     */
    public function setQueueName($name)
    {
        $this->_queueName = trim($name);
        return $this;
    }

    /**
     * Gets queue scan
     *
     * @return bool
     */
    public function getScan()
    {
        return $this->_scan;
    }

    /**
     * Sets queue scan
     *
     * @param  bool $scan
     * @return self
     */
    public function setScan($scan)
    {
        $this->_scan = (bool) $scan;
        return $this;
    }

    /**
     * Gets the time to wait
     *
     * @return int
     */
    public function getWaitSeconds()
    {
        return $this->_waitSeconds;
    }

    /**
     * Sets the time to wait
     *
     * @param  int $wait
     * @return self
     */
    public function setWaitSeconds($wait)
    {
        $this->_waitSeconds = (int) $wait;
        return $this;
    }
}
