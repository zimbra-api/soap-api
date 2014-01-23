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
        $this->child('query', $query);
        $this->property('name', trim($name));
        if(null !== $scan)
        {
            $this->property('scan', (bool) $scan);
        }
        if(null !== $wait)
        {
            $this->property('wait', (int) $wait);
        }
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
     * Gets or sets scan
     *
     * @param  bool $scan
     * @return bool|self
     */
    public function scan($scan = null)
    {
        if(null === $scan)
        {
            return $this->property('scan');
        }
        return $this->property('scan', (bool) $scan);
    }

    /**
     * Gets or sets wait
     *
     * @param  int $wait
     * @return int|self
     */
    public function wait($wait = null)
    {
        if(null === $wait)
        {
            return $this->property('wait');
        }
        return $this->property('wait', (int) $wait);
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
