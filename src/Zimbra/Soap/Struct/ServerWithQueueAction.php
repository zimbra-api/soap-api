<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * ServerWithQueueAction class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.;
 */
class ServerWithQueueAction
{
    /**
     * MTA Server
     * @var string
     */
    private $_name;

    /**
     * Mail queue query details
     * @var MailQueueWithAction
     */
    private $_queue;

    /**
     * Constructor method for ServerWithQueueAction
     * @param  string $name
     * @param  MailQueueWithAction $query
     * @return self
     */
    public function __construct($name, MailQueueWithAction $queue)
    {
        $this->_name = trim($name);
        $this->_queue = $queue;
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
            return $this->_name;
        }
        $this->_name = trim($name);
        return $this;
    }

    /**
     * Gets or sets queue
     *
     * @param  MailQueueWithAction $queue
     * @return MailQueueWithAction|self
     */
    public function queue(MailQueueWithAction $queue = null)
    {
        if(null === $queue)
        {
            return $this->_queue;
        }
        $this->_queue = $queue;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'server')
    {
        $name = !empty($name) ? $name : 'server';
        $arr = array(
            'name' => $this->_name,
        );
        $arr += $this->_queue->toArray('queue');
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'server')
    {
        $name = !empty($name) ? $name : 'server';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('name', $this->_name)
            ->append($this->_queue->toXml('queue'));
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
