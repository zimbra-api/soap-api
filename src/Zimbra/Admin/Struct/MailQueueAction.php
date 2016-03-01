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

use Zimbra\Enum\QueueAction;
use Zimbra\Enum\QueueActionBy;
use Zimbra\Struct\Base;

/**
 * MailQueueAction struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class MailQueueAction extends Base
{
    /**
     * Constructor method for MailQueueAction
     * @param  QueueQuery $query Query
     * @param  QueueAction $op Operation
     * @param  QueueActionBy $by By selector
     * @return self
     */
    public function __construct(QueueQuery $query, QueueAction $op, QueueActionBy $by)
    {
        parent::__construct();
        $this->setChild('query', $query);
        $this->setProperty('op', $op);
        $this->setProperty('by', $by);
    }

    /**
     * Gets the Time/rule for transitioning from daylight time to query time.
     *
     * @return QueueQuery
     */
    public function getQuery()
    {
        return $this->getChild('query');
    }

    /**
     * Sets the Time/rule for transitioning from daylight time to query time.
     *
     * @param  QueueQuery $query
     * @return self
     */
    public function setQuery(QueueQuery $query)
    {
        return $this->setChild('query', $query);
    }

    /**
     * Gets op enum
     *
     * @return Zimbra\Enum\QueueAction
     */
    public function getOp()
    {
        return $this->getProperty('op');
    }

    /**
     * Sets op enum
     *
     * @param  Zimbra\Enum\QueueAction $op
     * @return self
     */
    public function setOp(QueueAction $op)
    {
        return $this->setProperty('op', $op);
    }

    /**
     * Gets by enum
     *
     * @return Zimbra\Enum\QueueActionBy
     */
    public function getBy()
    {
        return $this->getProperty('by');
    }

    /**
     * Sets by enum
     *
     * @param  Zimbra\Enum\QueueActionBy $by
     * @return self
     */
    public function setBy(QueueActionBy $by)
    {
        return $this->setProperty('by', $by);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'action')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'action')
    {
        return parent::toXml($name);
    }
}
