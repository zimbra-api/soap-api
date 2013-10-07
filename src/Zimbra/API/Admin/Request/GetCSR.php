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
     * @var string
     */
    private $_type;

    /**
     * Valid types
     * @var array
     */
    private static $_validTypes = array(
        'self',
        'comm',
    );

    /**
     * Constructor method for GetCSR
     * @param  string $server
     * @param  string $type
     * @return self
     */
    public function __construct($server = null, $type = null)
    {
        parent::__construct();
		$this->_server = trim($server);
		$this->_type = in_array(trim($type), self::$_validTypes) ? trim($type) : null;
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
     * @param  string $type
     * @return string|self
     */
    public function type($type = null)
    {
        if(null === $type)
        {
            return $this->_type;
        }
        if(in_array(trim($type), self::$_validTypes))
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
        if(!empty($this->_server))
        {
            $this->array['server'] = $this->_server;
        }
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
        if(!empty($this->_server))
        {
            $this->xml->addAttribute('server', $this->_server);
        }
        if(!empty($this->_type))
        {
            $this->xml->addAttribute('type', $this->_type);
        }
        return parent::toXml();
    }
}
