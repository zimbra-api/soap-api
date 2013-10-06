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
 * ReloadMemcachedClientConfig class
 * Reloads the memcached client configuration on this server.
 * Memcached client layer is reinitialized accordingly.
 * Call this command after updating the memcached server list, for example.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ReloadMemcachedClientConfig extends Request
{
    /**
     * Constructor method for ReloadMemcachedClientConfig
     * @return self
     */
    public function __construct()
    {
        parent::__construct();
    }
}
