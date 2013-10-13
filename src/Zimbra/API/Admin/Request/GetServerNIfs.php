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
use Zimbra\Soap\Enum\IpType;

/**
 * GetServerNIfs class
 * Get Network Interface information for a server
 * Get server's network interfaces.
 * Returns IP addresses and net masks.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetServerNIfs extends Request
{
    /**
     * Specifics the ipAddress type (ipV4/ipV6/both). default is ipv4
     * @var IpType
     */
    private $_type;

    /**
     * Server
     * @var Server
     */
    private $_server;

    /**
     * Constructor method for GetServerNIfs
     * @param  Server $server
     * @param  string $type
     * @return self
     */
    public function __construct(Server $server, IpType $type = null)
    {
        parent::__construct();
        $this->_server = $server;
        if($type instanceof IpType)
        {
            $this->_type = $type;
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
     * Gets or sets type
     *
     * @param  IpType $type
     * @return IpType|self
     */
    public function type(IpType $type = null)
    {
        if(null === $type)
        {
            return $this->_type;
        }
        $this->_type = $type;
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
        if($this->_type instanceof IpType)
        {
            $this->array['type'] = (string) $this->_type;
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
        $this->xml->append($this->_server->toXml());
        if($this->_type instanceof IpType)
        {
            $this->xml->addAttribute('type', (string) $this->_type);
        }
        return parent::toXml();
    }
}
