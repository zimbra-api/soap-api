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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};

/**
 * AutoProvDirectoryEntry struct class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AutoProvDirectoryEntry extends AdminKeyValuePairs
{
    /**
     * dn
     * 
     * @Accessor(getter="getDn", setter="setDn")
     * @SerializedName("dn")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getDn', setter: 'setDn')]
    #[SerializedName(name: 'dn')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $dn;

    /**
     * Keys
     * 
     * @Accessor(getter="getKeys", setter="setKeys")
     * @Type("array<string>")
     * @XmlList(inline=true, entry="key", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getKeys', setter: 'setKeys')]
    #[Type(name: 'array<string>')]
    #[XmlList(inline: true, entry: 'key', namespace: 'urn:zimbraAdmin')]
    private $keys = [];

    /**
     * Constructor
     *
     * @param string $dn
     * @param array $keys
     * @param array $keyValuePairs
     * @return self
     */
    public function __construct(
        string $dn = '', array $keys = [], array $keyValuePairs = []
    )
    {
    	parent::__construct($keyValuePairs);
        $this->setDn($dn)
             ->setKeys($keys);
    }

    /**
     * Get dn
     *
     * @return string
     */
    public function getDn(): string
    {
        return $this->dn;
    }

    /**
     * Set dn
     *
     * @param  string $dn
     * @return self
     */
    public function setDn(string $dn): self
    {
        $this->dn = $dn;
        return $this;
    }

    /**
     * Get keys
     *
     * @return array
     */
    public function getKeys()
    {
        return $this->keys;
    }

    /**
     * Set keys
     *
     * @param  array $keys
     * @return self
     */
    public function setKeys(array $keys)
    {
        $this->keys = array_unique(array_map(static fn ($key) => trim($key), $keys));
        return $this;
    }
}
