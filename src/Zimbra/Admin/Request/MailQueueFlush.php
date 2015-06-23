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
 * MailQueueFlush request class
 * Command to invoke postqueue -f. All queues cached in the server are stale after invoking this because this is a global operation to all the queues in a given server.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class MailQueueFlush extends Base
{
    /**
     * Constructor method for MailQueueFlush
     * @param  NamedElement $server Mta server
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