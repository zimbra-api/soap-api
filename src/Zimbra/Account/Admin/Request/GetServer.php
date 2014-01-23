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

use Zimbra\Soap\Request;
use Zimbra\Admin\Struct\ServerSelector as Server;

/**
 * GetServer request class
 * Get Server.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetServer extends Request
{
    /**
     * Constructor method for GetServer
     * @param  Server $server Server
     * @param  bool $applyConfig Apply config flag
     * @param  string $attrs Comma separated list of attributes
     * @return self
     */
    public function __construct(Server $server = null, $applyConfig = null, $attrs = null)
    {
        parent::__construct();
        if($server instanceof Server)
        {
            $this->child('server', $server);
        }
        if(null !== $applyConfig)
        {
            $this->property('applyConfig', (bool) $applyConfig);
        }
        if(null !== $attrs)
        {
            $this->property('attrs', trim($attrs));
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
            return $this->child('server');
        }
        return $this->child('server', $server);
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

    /**
     * Gets or sets attrs
     *
     * @param  string $attrs
     * @return string|self
     */
    public function attrs($attrs = null)
    {
        if(null === $attrs)
        {
            return $this->property('attrs');
        }
        return $this->property('attrs', trim($attrs));
    }
}
