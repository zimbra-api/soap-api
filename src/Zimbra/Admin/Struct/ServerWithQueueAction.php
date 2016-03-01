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
 * ServerWithQueueAction struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ServerWithQueueAction extends Base
{
    /**
     * Constructor method for ServerWithQueueAction
     * @param  MailQueueWithAction $query Mail queue query details
     * @param  string $name MTA Server
     * @return self
     */
    public function __construct(MailQueueWithAction $queue, $name)
    {
        parent::__construct();
        $this->setChild('queue', $queue);
        $this->setProperty('name', trim($name));
    }

    /**
     * Gets the queue.
     *
     * @return MailQueueWithAction
     */
    public function getQueue()
    {
        return $this->getChild('queue');
    }

    /**
     * Sets the queue.
     *
     * @param  MailQueueWithAction $queue
     * @return self
     */
    public function setQueue(MailQueueWithAction $queue)
    {
        return $this->setChild('queue', $queue);
    }

    /**
     * Gets the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets the name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'server')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'server')
    {
        return parent::toXml($name);
    }
}
