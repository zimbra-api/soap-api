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

use Zimbra\Admin\Struct\ServerSelector;
use Zimbra\Struct\AttributeSelectorTrait;
use Zimbra\Struct\AttributeSelector;

/**
 * SetServerOffline request class
 * Get Server.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SetServerOffline extends Base implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * Constructor method for SetServerOffline
     * @param ServerSelector $server Server
     * @param  array $attrs A list of attributes
     * @return self
     */
    public function __construct(ServerSelector $server, array $attrs = [])
    {
        parent::__construct();
        $this->setChild('server', $server);

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
     * Gets server.
     *
     * @return ServerSelector
     */
    public function getServer()
    {
        return $this->getChild('server');
    }

    /**
     * Sets server.
     *
     * @param  ServerSelector $server
     * @return self
     */
    public function setServer(ServerSelector $server)
    {
        return $this->setChild('server', $server);
    }
}
