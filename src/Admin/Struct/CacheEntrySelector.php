<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};
use Zimbra\Common\Enum\CacheEntryBy;

/**
 * CacheEntrySelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CacheEntrySelector
{
    /**
     * Select the meaning of {cache-entry-key}
     * @Accessor(getter="getBy", setter="setBy")
     * @SerializedName("by")
     * @Type("Zimbra\Common\Enum\CacheEntryBy")
     * @XmlAttribute
     */
    private CacheEntryBy $by;

    /**
     * The key used to identify the cache entry
     * 
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor method for CacheEntrySelector
     * @param  CacheEntryBy $by
     * @param  string $value
     * @return self
     */
    public function __construct(?CacheEntryBy $by = NULL, ?string $value = NULL)
    {
        $this->setBy($by ?? CacheEntryBy::ID());
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Get by enum
     *
     * @return CacheEntryBy
     */
    public function getBy(): CacheEntryBy
    {
        return $this->by;
    }

    /**
     * Set by enum
     *
     * @param  CacheEntryBy $by
     * @return self
     */
    public function setBy(CacheEntryBy $by): self
    {
        $this->by = $by;
        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
