<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Admin\Struct\CacheSelector;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * FlushCacheRequest class
 * Flush memory cache for specified LDAP or directory scan type/entries
 *
 * Directory scan caches(source of data is on local disk of the server): skin|locale
 * LDAP caches(source of data is LDAP): account|cos|domain|server|zimlet
 *
 * For LDAP caches, one or more optional entry can be specified.
 *
 * If entry(s) are specified, only the specified entries will be flushed.
 * If no entry is given, all enties of the type will be flushed from cache.
 * 
 * type can contain a combination of skin, locale and zimlet. E.g. type='skin,locale,zimlet' or type='zimletskin'
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class FlushCacheRequest extends SoapRequest
{
    /**
     * Cache
     * @Accessor(getter="getCache", setter="setCache")
     * @SerializedName("cache")
     * @Type("Zimbra\Admin\Struct\CacheSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?CacheSelector $cache = NULL;

    /**
     * Constructor method for FlushCacheRequest
     * 
     * @param  CacheSelector $cache
     * @return self
     */
    public function __construct(?CacheSelector $cache = NULL)
    {
        if ($cache instanceof CacheSelector) {
            $this->setCache($cache);
        }
    }

    /**
     * Get the cache.
     *
     * @return CacheSelector
     */
    public function getCache(): ?CacheSelector
    {
        return $this->cache;
    }

    /**
     * Set the cache.
     *
     * @param  CacheSelector $cache
     * @return self
     */
    public function setCache(CacheSelector $cache): self
    {
        $this->cache = $cache;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new FlushCacheEnvelope(
            new FlushCacheBody($this)
        );
    }
}
