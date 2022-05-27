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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Common\Struct\{KeyValuePairs, KeyValuePair};

/**
 * AdminKeyValuePairs struct class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AdminKeyValuePairs implements KeyValuePairs
{
    /**
     * @Accessor(getter="getKeyValuePairs", setter="setKeyValuePairs")
     * @SerializedName("a")
     * @Type("array<Zimbra\Common\Struct\KeyValuePair>")
     * @XmlList(inline = true, entry = "a")
     */
    private $keyValuePairs = [];

    /**
     * AdminKeyValuePairs constructor.
     * @param array $keyValuePairs
     */
    public function __construct(array $keyValuePairs = [])
    {
        $this->setKeyValuePairs($keyValuePairs);
    }

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
     * Sets attr sequence
     *
     * @param  array $attrs
     * @return self
     */
    public function setKeyValuePairs(array $keyValuePairs): self
    {
        if (!empty($keyValuePairs)) {
            $this->keyValuePairs = [];
            foreach ($keyValuePairs as $kvp) {
                if ($kvp instanceof KeyValuePair) {
                    $this->keyValuePairs[] = $kvp;
                }
            }
        }
        return $this;
    }

    /**
     * Gets attr sequence
     *
     * @return array
     */
    public function getKeyValuePairs(): ?array
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
        if (!empty($this->keyValuePairs)) {
            foreach ($this->keyValuePairs as $kvp) {
                if ($kvp->getKey() == $key) {
                    return $kvp->getValue();
                }
            }
        }
        return NULL;
    }

    /**
     * Gets the matching values
     *
     * @return array
     */
    public function valuesForKey($key): ?array
    {
        if (!empty($this->keyValuePairs)) {
            $values = [];
            foreach ($this->keyValuePairs as $kvp) {
                if ($kvp->getKey() == $key) {
                    $values[] = $kvp->getValue();
                }
            }
            return $values;
        }
        return NULL;
    }
}
