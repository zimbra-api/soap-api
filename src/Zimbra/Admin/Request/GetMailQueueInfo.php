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

use Zimbra\Struct\NamedElement;

/**
 * GetMailQueueInfo request class
 * Get a count of all the mail queues by counting the number of files in the queue directories.
 * Note that the admin server waits for queue counting to complete before responding - client should invoke requests for different servers in parallel.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetMailQueueInfo extends Base
{
    /**
     * Constructor method for GetMailQueue
     * @param  Server $server MTA Server
     * @return self
     */
    public function __construct(NamedElement $server)
    {
        parent::__construct();
        $this->setChild('server', $server);
    }

    /**
     * Gets the server.
     *
     * @return NamedElement
     */
    public function getServer()
    {
        return $this->getChild('server');
    }

    /**
     * Sets the server.
     *
     * @param  NamedElement $server
     * @return self
     */
    public function setServer(NamedElement $server)
    {
        return $this->setChild('server', $server);
    }
}