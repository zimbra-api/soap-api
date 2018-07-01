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

use Zimbra\Enum\QueueAction;
use Zimbra\Enum\QueueActionBy;

/**
 * MailQueueAction struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="action")
 */
class MailQueueAction
{
    /**
     * @Accessor(getter="getQuery", setter="setQuery")
     * @SerializedName("query")
     * @Type("Zimbra\Admin\Struct\QueueQuery")
     * @XmlElement
     */
    private $_query;

    /**
     * @Accessor(getter="getOp", setter="setOp")
     * @SerializedName("op")
     * @Type("string")
     * @XmlAttribute
     */
    private $_op;

    /**
     * @Accessor(getter="getBy", setter="setBy")
     * @SerializedName("by")
     * @Type("string")
     * @XmlAttribute
     */
    private $_by;

    /**
     * Constructor method for MailQueueAction
     * @param  QueueQuery $query Query
     * @param  string $op Operation
     * @param  string $by By selector
     * @return self
     */
    public function __construct(QueueQuery $query, $op, $by)
    {
        $this->setQuery($query)
             ->setOp($op)
             ->setBy($by);
    }

    /**
     * Gets the Time/rule for transitioning from daylight time to query time.
     *
     * @return QueueQuery
     */
    public function getQuery()
    {
        return $this->_query;
    }

    /**
     * Sets the Time/rule for transitioning from daylight time to query time.
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
     * Gets op enum
     *
     * @return string
     */
    public function getOp()
    {
        return $this->_op;
    }

    /**
     * Sets op enum
     *
     * @param  string $op
     * @return self
     */
    public function setOp($op)
    {
        if (QueueAction::has(trim($op))) {
            $this->_op = trim($op);
        }
        return $this;
    }

    /**
     * Gets by enum
     *
     * @return string
     */
    public function getBy()
    {
        return $this->_by;
    }

    /**
     * Sets by enum
     *
     * @param  string $by
     * @return self
     */
    public function setBy($by)
    {
        if (QueueActionBy::has(trim($by))) {
            $this->_by = trim($by);
        }
        return $this;
    }
}
