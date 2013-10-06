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
 * GetAllServers class
 * Get all servers defined in the system or all servers that have a particular service enabled (eg, mta, antispam, spell).
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAllServers extends Request
{
    /**
     * Service name. e.g. mta, antispam, spell.
     * @var string
     */
    private $_service;

    /**
     * Apply config flag
     * @var bool
     */
    private $_applyConfig;

    /**
     * Constructor method for GetAllServers
     * @param  string $service
     * @param  bool $applyConfig
     * @return self
     */
    public function __construct($service = null, $applyConfig = null)
    {
        parent::__construct();
		$this->_service = trim($service);
        if(null !== $applyConfig)
        {
            $this->_applyConfig = (bool) $applyConfig;
        }
    }

    /**
     * Gets or sets service
     *
     * @param  string $service
     * @return string|self
     */
    public function service($service = null)
    {
        if(null === $service)
        {
            return $this->_service;
        }
        $this->_service = trim($service);
        return $this;
    }

    /**
     * Gets or sets applyConfig
     *
     * @param  bool $applyConfig
     * @return bool|self
     */
    public function applyConfig($applyConfig = null)
    {
        if(null === $applyConfig)
        {
            return $this->_applyConfig;
        }
        $this->_applyConfig = (bool) $applyConfig;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(!empty($this->_service))
        {
            $this->array['service'] = $this->_service;
        }
        if(is_bool($this->_applyConfig))
        {
            $this->array['applyConfig'] = $this->_applyConfig ? 1 : 0;
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
        if(!empty($this->_service))
        {
            $this->xml->addAttribute('service', $this->_service);
        }
        if(is_bool($this->_applyConfig))
        {
            $this->xml->addAttribute('applyConfig', $this->_applyConfig ? 1 : 0);
        }
        return parent::toXml();
    }
}
