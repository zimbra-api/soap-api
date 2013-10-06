<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\ServerWithQueueAction as Server;

/**
 * MailQueueAction class
 * Command to act on invidual queue files. This proxies through to postsuper.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class MailQueueAction extends Request
{
    /**
     * Server Mail Queue Query
     * @var Server
     */
    private $_server;

    /**
     * Constructor method for MailQueueAction
     * @param  Server $server
     * @return self
     */
    public function __construct(Server $server)
    {
        parent::__construct();
        $this->_server = $server;
    }

    /**
     * Gets or sets server
     *
     * @param  Server $server
     * @return Server|self
     */
    public function server(Server $server = null)
    {
        if(null === $server)
        {
            return $this->_server;
        }
        $this->_server = $server;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = $this->_server->toArray();
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_server->toXml());
        return parent::toXml();
    }
}