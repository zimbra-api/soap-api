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
 * GetCert class
 * Get Certificate.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetCert extends Request
{
    /**
     * The server's ID whose cert is to be got
     * @var string
     */
    private $_server;

    /**
     * Certificate type 
     * @var string
     */
    private $_type;

    /**
     * Required only when type is "staged"
     * Could be "self" (self-signed cert) or "comm" (commerical cert).
     * @var string
     */
    private $_option;

    /**
     * Valid types
     * @var array
     */
    private static $_validTypes = array(
        'all',
        'mta',
        'ldap',
        'mailboxd',
        'proxy',
        'staged',
    );

    /**
     * Valid types
     * @var array
     */
    private static $_validOptions = array(
        'self',
        'comm',
    );

    /**
     * Constructor method for GetCert
     * @param  string $server
     * @param  string $type
     * @param  string $option
     * @return self
     */
    public function __construct($server, $type, $option = null)
    {
        parent::__construct();
        $this->_server = trim($server);
        if(in_array(trim($type), self::$_validTypes))
        {
            $this->_type = trim($type);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid type');
        }
		$this->_option = in_array(trim($option), self::$_validOptions) ? trim($option) : null;
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
        else
        {
            throw new \InvalidArgumentException('Invalid type');
        }
        return $this;
    }

    /**
     * Gets or sets option
     *
     * @param  string $option
     * @return string|self
     */
    public function option($option = null)
    {
        if(null === $option)
        {
            return $this->_option;
        }
        if(in_array(trim($option), self::$_validOptions))
        {
            $this->_option = trim($option);
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
        $this->array = array(
            'server' => $this->_server,
            'type' => $this->_type,
        );
        if(!empty($this->_option))
        {
            $this->array['option'] = $this->_option;
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
        $this->xml->addAttribute('server', $this->_server)
                  ->addAttribute('type', $this->_type);
        if(!empty($this->_option))
        {
            $this->xml->addAttribute('option', $this->_option);
        }
        return parent::toXml();
    }
}
