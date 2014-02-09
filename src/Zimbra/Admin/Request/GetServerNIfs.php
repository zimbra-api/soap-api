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
        $this->child('server', $server);
        if($type instanceof IpType)
        {
            $this->property('type', $type);
        }
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
            return $this->child('server');
        }
        return $this->child('server', $server);
    }

    /**
     * Gets or sets type
     *
     * @param  IpType $type
     * @return IpType|self
     */
    public function type(IpType $type = null)
    {
        if(null === $type)
        {
            return $this->property('type');
        }
        return $this->property('type', $type);
    }
}
