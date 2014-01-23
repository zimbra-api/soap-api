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
        $this->child('query', $query);
        $this->property('op', $op);
        $this->property('by', $by);
    }

    /**
     * Gets or sets query
     *
     * @param  QueueQuery $query
     * @return QueueQuery|self
     */
    public function query(QueueQuery $query = null)
    {
        if(null === $query)
        {
            return $this->child('query');
        }
        return $this->child('query', $query);
    }

    /**
     * Gets or sets op
     *
     * @param  QueueAction $op
     * @return QueueAction|self
     */
    public function op(QueueAction $op = null)
    {
        if(null === $op)
        {
            return $this->property('op');
        }
        return $this->property('op', $op);
    }

    /**
     * Gets or sets by
     *
     * @param  QueueActionBy $by
     * @return QueueActionBy|self
     */
    public function by(QueueActionBy $by = null)
    {
        if(null === $by)
        {
            return $this->property('by');
        }
        return $this->property('by', $by);
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
