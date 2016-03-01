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

use Zimbra\Admin\Struct\DomainSelector as Domain;
use Zimbra\Admin\Struct\ServerSelector as Server;

/**
 * GetAllCalendarResources request class
 * Get all calendar resources that match the selection criteria.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAllCalendarResources extends Base
{
    /**
     * Constructor method for GetAllCalendarResources
     * @param  Server $server
     * @param  Domain $domain
     * @return self
     */
    public function __construct(Server $server = null, Domain $domain = null)
    {
        parent::__construct();
        if($server instanceof Server)
        {
            $this->setChild('server', $server);
        }
        if($domain instanceof Domain)
        {
            $this->setChild('domain', $domain);
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
     * Gets the domain.
     *
     * @return Domain
     */
    public function getDomain()
    {
        return $this->getChild('domain');
    }

    /**
     * Sets the domain.
     *
     * @param  Domain $domain
     * @return self
     */
    public function setDomain(Domain $domain)
    {
        return $this->setChild('domain', $domain);
    }
}
