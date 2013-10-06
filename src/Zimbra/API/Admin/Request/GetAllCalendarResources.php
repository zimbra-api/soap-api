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
use Zimbra\Soap\Struct\ServerSelector as Server;
use Zimbra\Soap\Struct\DomainSelector as Domain;

/**
 * GetAllCalendarResources class
 * Get all calendar resources that match the selection criteria.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAllCalendarResources extends Request
{
    /**
     * Server
     * @var Server
     */
    private $_server;

    /**
     * Domain
     * @var Domain
     */
    private $_domain;

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
            $this->_server = $server;
        }
        if($domain instanceof Domain)
        {
            $this->_domain = $domain;
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
            return $this->_server;
        }
        $this->_server = $server;
        return $this;
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
            return $this->_domain;
        }
        $this->_domain = $domain;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if($this->_server instanceof Server)
        {
            $this->array += $this->_server->toArray();
        }
        if($this->_domain instanceof Domain)
        {
            $this->array += $this->_domain->toArray();
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if($this->_server instanceof Server)
        {
            $this->xml->append($this->_server->toXml());
        }
        if($this->_domain instanceof Domain)
        {
            $this->xml->append($this->_domain->toXml());
        }
        return parent::toXml();
    }
}
