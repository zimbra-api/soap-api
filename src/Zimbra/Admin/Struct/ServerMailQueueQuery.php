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
        $this->child('queue', $queue);
        $this->property('name', trim($name));
    }

    /**
     * Gets or sets queue
     *
     * @param  MailQueueQuery $queue
     * @return MailQueueQuery|self
     */
    public function queue(MailQueueQuery $queue = null)
    {
        if(null === $queue)
        {
            return $this->child('queue');
        }
        return $this->child('queue', $queue);
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->property('name');
        }
        return $this->property('name', trim($name));
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
