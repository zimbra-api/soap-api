<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Admin\Struct\ServerWithQueueAction as Server;

/**
 * MailQueueAction request class
 * Command to act on invidual queue files. This proxies through to postsuper.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class MailQueueAction extends Base
{
    /**
     * Constructor method for MailQueueAction
     * @param  Server $server Server Mail Queue Query
     * @return self
     */
    public function __construct(Server $server)
    {
        parent::__construct();
        $this->setChild('server', $server);
    }

    /**
     * Gets the server.
     *
     * @return Server
     */
    public function getServer()
    {
        return $this->getChild('server');
    }

    /**
     * Sets the server.
     *
     * @param  Server $server
     * @return self
     */
    public function setServer(Server $server)
    {
        return $this->setChild('server', $server);
    }
}