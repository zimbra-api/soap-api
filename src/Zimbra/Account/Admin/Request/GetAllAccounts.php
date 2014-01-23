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
use Zimbra\Admin\Struct\DomainSelector as Domain;
use Zimbra\Soap\Request;

/**
 * GetAllAccounts request class
 * Get All servers matching the selectin criteria.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAllAccounts extends Request
{
    /**
     * Constructor method for GetAllAccounts
     * @param  Server $server
     * @param  Domain $domain
     * @return self
     */
    public function __construct(Server $server = null, Domain $domain = null)
    {
        parent::__construct();
        if($server instanceof Server)
        {
            $this->child('server', $server);
        }
        if($domain instanceof Domain)
        {
            $this->child('domain', $domain);
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
     * Gets or sets domain
     *
     * @param  Domain $domain
     * @return Domain|self
     */
    public function domain(Domain $domain = null)
    {
        if(null === $domain)
        {
            return $this->child('domain');
        }
        return $this->child('domain', $domain);
    }
}
