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
    XmlElement
};
use Zimbra\Common\Enum\{QueueAction, QueueActionBy};

/**
 * MailQueueAction struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MailQueueAction
{
    /**
     * @var QueueQuery
     */
    #[Accessor(getter: "getQuery", setter: "setQuery")]
    #[SerializedName("query")]
    #[Type(QueueQuery::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private $query;

    /**
     * @var QueueAction
     */
    #[Accessor(getter: "getOp", setter: "setOp")]
    #[SerializedName("op")]
    #[XmlAttribute]
    private QueueAction $op;

    /**
     * @var QueueActionBy
     */
    #[Accessor(getter: "getBy", setter: "setBy")]
    #[SerializedName("by")]
    #[XmlAttribute]
    private QueueActionBy $by;

    /**
     * Constructor
     *
     * @param  QueueQuery $query Query
     * @param  QueueAction $op Operation
     * @param  QueueActionBy $by By selector
     * @return self
     */
    public function __construct(
        QueueQuery $query,
        ?QueueAction $op = null,
        ?QueueActionBy $by = null
    ) {
        $this->setQuery($query)
            ->setOp($op ?? QueueAction::HOLD)
            ->setBy($by ?? QueueActionBy::QUERY);
    }

    /**
     * Get the Time/rule for transitioning from daylight time to query time.
     *
     * @return QueueQuery
     */
    public function getQuery(): QueueQuery
    {
        return $this->query;
    }

    /**
     * Set the Time/rule for transitioning from daylight time to query time.
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
     * Get op enum
     *
     * @return QueueAction
     */
    public function getOp(): QueueAction
    {
        return $this->op;
    }

    /**
     * Set op enum
     *
     * @param  QueueAction $op
     * @return self
     */
    public function setOp(QueueAction $op)
    {
        $this->op = $op;
        return $this;
    }

    /**
     * Get by enum
     *
     * @return QueueActionBy
     */
    public function getBy(): QueueActionBy
    {
        return $this->by;
    }

    /**
     * Set by enum
     *
     * @param  QueueActionBy $by
     * @return self
     */
    public function setBy(QueueActionBy $by)
    {
        $this->by = $by;
        return $this;
    }
}
