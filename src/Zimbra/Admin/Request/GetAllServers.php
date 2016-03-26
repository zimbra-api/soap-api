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

/**
 * GetAllServers request class
 * Get all servers defined in the system or all servers that have a particular service enabled (eg, mta, antispam, spell).
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAllServers extends Base
{
    /**
     * Constructor method for GetAllServers
     * @param  string $service Service name. e.g. mta, antispam, spell.
     * @param  string $alwaysOnClusterId Always on cluster id.
     * @param  bool $applyConfig Apply config flag
     * @return self
     */
    public function __construct($service = null, $alwaysOnClusterId = null, $applyConfig = null)
    {
        parent::__construct();
        if(null !== $service)
        {
            $this->setProperty('service', trim($service));
        }
        if(null !== $alwaysOnClusterId)
        {
            $this->setProperty('alwaysOnClusterId', trim($alwaysOnClusterId));
        }
        if(null !== $applyConfig)
        {
            $this->setProperty('applyConfig', (bool) $applyConfig);
        }
    }

    /**
     * Gets service
     *
     * @return string
     */
    public function getService()
    {
        return $this->getProperty('service');
    }

    /**
     * Sets service
     *
     * @param  string $service
     * @return self
     */
    public function setService($service)
    {
        return $this->setProperty('service', trim($service));
    }

    /**
     * Gets alwaysOnClusterId
     *
     * @return string
     */
    public function getAlwaysOnClusterId()
    {
        return $this->getProperty('alwaysOnClusterId');
    }

    /**
     * Sets alwaysOnClusterId
     *
     * @param  string $alwaysOnClusterId
     * @return self
     */
    public function setAlwaysOnClusterId($alwaysOnClusterId)
    {
        return $this->setProperty('alwaysOnClusterId', trim($alwaysOnClusterId));
    }

    /**
     * Gets applyConfig
     *
     * @return bool
     */
    public function getApplyConfig()
    {
        return $this->getProperty('applyConfig');
    }

    /**
     * Sets applyConfig
     *
     * @param  bool $applyConfig
     * @return self
     */
    public function setApplyConfig($applyConfig)
    {
        return $this->setProperty('applyConfig', (bool) $applyConfig);
    }
}
