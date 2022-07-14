<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};

/**
 * KeyValuePairsTrait trait
 * 
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
trait KeyValuePairsTrait
{
    /**
     * Key value pairs
     * 
     * @Accessor(getter="getKeyValuePairs", setter="setKeyValuePairs")
     * @SerializedName("a")
     * @Type("array<Zimbra\Common\Struct\KeyValuePair>")
     * @XmlList(inline=true, entry="a")
     */
    protected $keyValuePairs = [];

    /**
     * Add an attr
     *
     * @param  Attr $attr
     * @return self
     */
    public function addKeyValuePair(KeyValuePair $kvp): self
    {
        $this->keyValuePairs[] = $kvp;
        return $this;
    }

    /**
     * Sets key value pairs
     *
     * @param  array $pairs
     * @return self
     */
    public function setKeyValuePairs(array $pairs): self
    {
        $this->keyValuePairs = array_filter($pairs, static fn ($kvp) => $kvp instanceof KeyValuePair);
        return $this;
    }

    /**
     * Gets attr sequence
     *
     * @return array
     */
    public function getKeyValuePairs(): array
    {
        return $this->keyValuePairs;
    }

    /**
     * Gets the first value matching
     *
     * @return string
     */
    public function firstValueForKey($key): ?string
    {
        $keyValuePairs = array_filter($this->keyValuePairs, static fn ($kvp) => $kvp->getKey() == $key);
        $kvp = reset($keyValuePairs);
        if ($kvp instanceof KeyValuePair) {
            return $kvp->getValue();
        }
        return NULL;
    }

    /**
     * Gets the matching values
     *
     * @return array
     */
    public function valuesForKey($key): array
    {
        $keyValuePairs = array_filter($this->keyValuePairs, static fn ($kvp) => $kvp->getKey() == $key);
        return array_map(static fn ($kvp) => $kvp->getValue(), $keyValuePairs);
    }
}