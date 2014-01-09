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
use Zimbra\Soap\Enum\CSRType;

/**
 * GetCSR class
 * Get a certificate signing request (CSR).
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetCSR extends Request
{
    /**
     * Server ID. Can be "--- All Servers ---" or the ID of a server
     * @var string
     */
    private $_server;

    /**
     * Type of CSR (required)
     * self: self-signed certificate
     * comm: commercial certificate
     * @var CSRType
     */
    private $_type;

    /**
     * Constructor method for GetCSR
     * @param  string $server
     * @param  CSRType $type
     * @return self
     */
    public function __construct($server = null, CSRType $type = null)
    {
        parent::__construct();
        $this->_server = trim($server);
        if($type instanceof CSRType)
        {
            $this->_type = $type;
        }
    }

    /**
     * Gets or sets server
     *
     * @param  string $server
     * @return string|self
     */
    public function server($server = null)
    {
        if(null === $server)
        {
            return $this->_server;
        }
        $this->_server = trim($server);
        return $this;
    }

    /**
     * Gets or sets type
     *
     * @param  CSRType $type
     * @return CSRType|self
     */
    public function type(CSRType $type = null)
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
        if(!empty($this->_server))
        {
            $this->array['server'] = $this->_server;
        }
        if($this->_type instanceof CSRType)
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
        if(!empty($this->_server))
        {
            $this->xml->addAttribute('server', $this->_server);
        }
        if($this->_type instanceof CSRType)
        {
            $this->xml->addAttribute('type', (string) $this->_type);
        }
        return parent::toXml();
    }
}
