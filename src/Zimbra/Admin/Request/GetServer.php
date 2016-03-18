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

use Zimbra\Admin\Struct\ServerSelector as Server;
use Zimbra\Struct\AttributeSelectorTrait;
use Zimbra\Struct\AttributeSelector;

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
class GetServer extends Base implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * Constructor method for GetServer
     * @param  Server $server Server
     * @param  bool $applyConfig Apply config flag
     * @param  array $attrs An array of attributes
     * @return self
     */
    public function __construct(Server $server = null, $applyConfig = null, array $attrs = [])
    {
        parent::__construct();
        if($server instanceof Server)
        {
            $this->setChild('server', $server);
        }
        if(null !== $applyConfig)
        {
            $this->setProperty('applyConfig', (bool) $applyConfig);
        }

        $this->setAttrs($attrs);
        $this->on('before', function(Base $sender)
        {
            $attrs = $sender->getAttrs();
            if(!empty($attrs))
            {
                $sender->setProperty('attrs', $attrs);
            }
        });
    }

    /**
     * Gets the server.
     *
     * @return Server
     */
    public function getServer()
    {
        return $this->getChild('server');
    }

    /**
     * Sets the server.
     *
     * @param  Server $server
     * @return self
     */
    public function setServer(Server $server)
    {
        return $this->setChild('server', $server);
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
