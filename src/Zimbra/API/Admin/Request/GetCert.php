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
use Zimbra\Soap\Enum\CertType;
use Zimbra\Soap\Enum\CSRType;

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
     * @var CertType
     */
    private $_type;

    /**
     * Required only when type is "staged"
     * Could be "self" (self-signed cert) or "comm" (commerical cert).
     * @var CSRType
     */
    private $_option;

    /**
     * Constructor method for GetCert
     * @param  string $server
     * @param  CertType $type
     * @param  CSRType $option
     * @return self
     */
    public function __construct($server, CertType $type, CSRType $option = null)
    {
        parent::__construct();
        $this->_server = trim($server);
        $this->_type = $type;
        if($option instanceof CSRType)
        {
            $this->_option = $option;
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
     * @param  CertType $type
     * @return CertType|self
     */
    public function type(CertType $type = null)
    {
        if(null === $type)
        {
            return $this->_type;
        }
        $this->_type = $type;
        return $this;
    }

    /**
     * Gets or sets option
     *
     * @param  CSRType $option
     * @return CSRType|self
     */
    public function option(CSRType $option = null)
    {
        if(null === $option)
        {
            return $this->_option;
        }
        $this->_option = $option;
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
            'type' => (string) $this->_type,
        );
        if($this->_option instanceof CSRType)
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
                  ->addAttribute('type', (string) $this->_type);
        if($this->_option instanceof CSRType)
        {
            $this->xml->addAttribute('option', (string) $this->_option);
        }
        return parent::toXml();
    }
}
