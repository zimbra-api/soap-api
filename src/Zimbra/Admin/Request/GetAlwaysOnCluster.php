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

use Zimbra\Admin\Struct\AlwaysOnClusterSelector as AlwaysOnCluster;
use Zimbra\Struct\AttributeSelectorTrait;
use Zimbra\Struct\AttributeSelector;

/**
 * GetAlwaysOnCluster request class
 * Get Server.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAlwaysOnCluster extends Base implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * Constructor method for GetAlwaysOnCluster
     * @param AlwaysOnCluster $cluster Server
     * @param  array $attrs A list of attributes
     * @return self
     */
    public function __construct(AlwaysOnCluster $cluster, array $attrs = [])
    {
        parent::__construct();
        $this->setChild('alwaysOnCluster', $cluster);

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
     * @return AlwaysOnCluster
     */
    public function getAlwaysOnCluster()
    {
        return $this->getChild('alwaysOnCluster');
    }

    /**
     * Sets server.
     *
     * @param  AlwaysOnCluster $cluster
     * @return self
     */
    public function setAlwaysOnCluster(AlwaysOnCluster $cluster)
    {
        return $this->setChild('alwaysOnCluster', $cluster);
    }
}
