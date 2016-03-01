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

use Zimbra\Admin\Struct\ServerSelector as Server;
use Zimbra\Enum\IpType;

/**
 * GetServerNIfs request class
 * Get Network Interface information for a server
 * Get server's network interfaces.
 * Returns IP addresses and net masks.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetServerNIfs extends Base
{
    /**
     * Constructor method for GetServerNIfs
     * @param  Server $server Server
     * @param  string $type Specifics the ipAddress type (ipV4/ipV6/both). default is ipv4
     * @return self
     */
    public function __construct(Server $server, IpType $type = null)
    {
        parent::__construct();
        $this->setChild('server', $server);
        if($type instanceof IpType)
        {
            $this->setProperty('type', $type);
        }
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

    /**
     * Gets type
     *
     * @return IpType
     */
    public function getType()
    {
        return $this->getProperty('type');
    }

    /**
     * Sets type
     *
     * @param  IpType $type
     * @return self
     */
    public function setType(IpType $type)
    {
        return $this->setProperty('type', $type);
    }
}
