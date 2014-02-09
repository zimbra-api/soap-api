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
     * @param  bool $applyConfig Apply config flag
     * @return self
     */
    public function __construct($service = null, $applyConfig = null)
    {
        parent::__construct();
        if(null !== $service)
        {
            $this->property('service', trim($service));
        }
        if(null !== $applyConfig)
        {
            $this->property('applyConfig', (bool) $applyConfig);
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
            return $this->property('service');
        }
        return $this->property('service', trim($service));
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
            return $this->property('applyConfig');
        }
        return $this->property('applyConfig', (bool) $applyConfig);
    }
}
