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

use Zimbra\Admin\Struct\CacheSelector as Cache;

/**
 * FlushCache request class
 * Flush memory cache for specified LDAP or directory scan type/entries.
 * Directory scan caches(source of data is on local disk of the server): skin|locale LDAP caches(source of data is LDAP): cache|cos|domain|server|zimlet.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class FlushCache extends Base
{
    /**
     * Constructor method for FlushCache
     * @param  Cache $cache Cache
     * @return self
     */
    public function __construct(Cache $cache = null)
    {
        parent::__construct();
        if($cache instanceof Cache)
        {
            $this->setChild('cache', $cache);
        }
    }

    /**
     * Gets the cache.
     *
     * @return Cache
     */
    public function getCache()
    {
        return $this->getChild('cache');
    }

    /**
     * Sets the cache.
     *
     * @param  Cache $cache
     * @return self
     */
    public function setCache(Cache $cache)
    {
        return $this->setChild('cache', $cache);
    }
}
