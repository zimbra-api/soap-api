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
     * @var string
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
    public function __construct(Server $server, $type = null)
    {
        parent::__construct();
        $this->_server = $server;
        if(in_array(trim($type), array('ipV4', 'ipV6', 'both')))
        {
            $this->_type = trim($type);
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
     * @param  string $type
     * @return string|self
     */
    public function type($type = null)
    {
        if(null === $type)
        {
            return $this->_type;
        }
        if(in_array(trim($type), array('ipV4', 'ipV6', 'both')))
        {
            $this->_type = trim($type);
        }
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
        if(!empty($this->_type))
        {
            $this->array['type'] = $this->_type;
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
        if(!empty($this->_type))
        {
            $this->xml->addAttribute('type', $this->_type);
        }
        return parent::toXml();
    }
}
