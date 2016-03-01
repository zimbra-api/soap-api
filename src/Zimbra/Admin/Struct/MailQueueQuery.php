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

use Zimbra\Struct\Base;

/**
 * MailQueueQuery struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class MailQueueQuery extends Base
{
    /**
     * Constructor method for MailQueueQuery
     * @param  QueueQuery $query Query
     * @param  string $name Queue name
     * @param  bool $scan To fora a queue scan, set this to 1 (true)
     * @param  int $wait Maximum time to wait for the scan to complete in seconds (default 3)
     * @return self
     */
    public function __construct(QueueQuery $query, $name, $scan = null, $wait = null)
    {
        parent::__construct();
        $this->setChild('query', $query);
        $this->setProperty('name', trim($name));
        if(null !== $scan)
        {
            $this->setProperty('scan', (bool) $scan);
        }
        if(null !== $wait)
        {
            $this->setProperty('wait', (int) $wait);
        }
    }

    /**
     * Gets query.
     *
     * @return QueueQuery
     */
    public function getQuery()
    {
        return $this->getChild('query');
    }

    /**
     * Sets query.
     *
     * @param  QueueQuery $query
     * @return self
     */
    public function setQuery(QueueQuery $query)
    {
        return $this->setChild('query', $query);
    }

    /**
     * Gets the the queue name
     *
     * @return string
     */
    public function getQueueName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets the queue name
     *
     * @param  string $name
     * @return self
     */
    public function setQueueName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets queue scan
     *
     * @return bool
     */
    public function getScan()
    {
        return $this->getProperty('scan');
    }

    /**
     * Sets queue scan
     *
     * @param  bool $scan
     * @return self
     */
    public function setScan($scan)
    {
        return $this->setProperty('scan', (bool) $scan);
    }

    /**
     * Gets the time to wait
     *
     * @return int
     */
    public function getWaitSeconds()
    {
        return $this->getProperty('wait');
    }

    /**
     * Sets the time to wait
     *
     * @param  int $wait
     * @return self
     */
    public function setWaitSeconds($wait)
    {
        return $this->setProperty('wait', (int) $wait);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'queue')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'queue')
    {
        return parent::toXml($name);
    }
}
