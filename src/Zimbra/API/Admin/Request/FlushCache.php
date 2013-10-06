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
use Zimbra\Soap\Struct\CacheSelector as Cache;

/**
 * FlushCache class
 * Flush memory cache for specified LDAP or directory scan type/entries.
 * Directory scan caches(source of data is on local disk of the server): skin|locale LDAP caches(source of data is LDAP): account|cos|domain|server|zimlet.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class FlushCache extends Request
{
    /**
     * Cache
     * @var Cache
     */
    private $_cache;

    /**
     * Constructor method for FlushCache
     * @param  Cache $cache
     * @return self
     */
    public function __construct(Cache $cache = null)
    {
        parent::__construct();
        if($cache instanceof Cache)
        {
            $this->_cache = $cache;
        }
    }

    /**
     * Gets or sets cache
     *
     * @param  Cache $cache
     * @return Cache|self
     */
    public function cache(Cache $cache = null)
    {
        if(null === $cache)
        {
            return $this->_cache;
        }
        $this->_cache = $cache;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if($this->_cache instanceof Cache)
        {
            $this->array += $this->_cache->toArray('cache');
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
        if($this->_cache instanceof Cache)
        {
            $this->xml->append($this->_cache->toXml('cache'));
        }
        return parent::toXml();
    }
}
