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
 * ServerMailQueueQuery struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ServerMailQueueQuery extends Base
{
    /**
     * Constructor method for ServerMailQueueQuery
     * @param  MailQueueQuery $query Mail queue query details
     * @param  string $name MTA Server
     * @return self
     */
    public function __construct(MailQueueQuery $queue, $name)
    {
        parent::__construct();
        $this->setChild('queue', $queue);
        $this->setProperty('name', trim($name));
    }

    /**
     * Gets the mail queue query details.
     *
     * @return MailQueueQuery
     */
    public function getQueue()
    {
        return $this->getChild('queue');
    }

    /**
     * Sets the mail queue query details.
     *
     * @param  MailQueueQuery $queue
     * @return self
     */
    public function setQueue(MailQueueQuery $queue)
    {
        return $this->setChild('queue', $queue);
    }

    /**
     * Gets the MTA Server
     *
     * @return string
     */
    public function getServerName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets the MTA Server
     *
     * @param  string $name
     * @return self
     */
    public function setServerName($name)
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
